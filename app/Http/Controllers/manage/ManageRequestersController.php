<?php

namespace App\Http\Controllers\manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\access;
use App\Models\department;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use \Carbon\Carbon; 

class ManageRequestersController extends Controller
{
    public function search(Request $request)
    {
        $user = User::where('accessname','Requester')
                ->where(function(Builder $builder) use($request){
                    $builder->orderBy('lastname',$request->orderrow)
                            ->where('username','like',"%{$request->search}%")
                            ->orWhere('firstname','like',"%{$request->search}%")
                            ->orWhere('lastname','like',"%{$request->search}%")
                            ->orWhere('middlename','like',"%{$request->search}%")
                            ->orWhere('email','like',"%{$request->search}%")
                            ->orWhere('status','like',"%{$request->search}%"); 
                            
                })->paginate($request->pagerow);
    
        return view('manage.requesters.index',compact('user'))
            ->with('i', (request()->input('page', 1) - 1) * $request->pagerow);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $timenow = Carbon::now()->timezone('Asia/Manila')->format('Y-m-d H:i:s');

        $user = User::where('accessname','Requester')
                    ->orderBy('status','asc')
                    ->paginate(5);

        // $notes = 'Users';
        // $status = 'Success';
        // $this->userlog($notes,$status);

        return view('manage.requesters.index',compact('user'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $access = access::get();
        $department = department::get();

       return view('manage.requesters.create')
                    ->with(['access' => $access])
                    ->with(['department' => $department]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $access = access::where('accessname','Requester')->first();
        $department = department::where('deptid',$request->department)->first();
        // dd($access);
        // dd($request, $access, $department);
        $n1 = strtoupper($request->firstname[0]);
        // $n2 = strtoupper($request->middlename[0]);
        $n3 = strtoupper($request->lastname[0]);
        $n4 = preg_replace('/[-]+/', '', $request->birthdate);

        // $newpassword = $n1 . $n2 . $n3 . $n4;
        $newpassword = $n1 . $n3 . $n4;
        //dd($newpassword);

        $timenow = Carbon::now()->timezone('Asia/Manila')->format('Y-m-d H:i:s');

        $user = User::create([
            'avatar' => 'avatars/avatar-default.jpg',
            'username' => $request->email,
            'email' => $request->email,
            'password' => Hash::make($newpassword),
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'birthdate' => $request->birthdate,
            'accessid' => $access->accessid,
            'accessname' => $access->accessname,
            'deptid' => $department->deptid,
            'deptname' => $department->deptname,
            'created_by' => auth()->user()->email,
            'updated_by' => 'Null',
            'timerecorded' => $timenow,
            'modifiedid' => 0,
            'mod' => 0,
            'status' => 'Active',
        ]);
    
        if ($user) {
    
            return redirect()->route('managerequesters.index')
                        ->with('success','Requester created successfully.');
        }else{

            return redirect()->route('managerequesters.index')
                        ->with('failed','Requester creation failed');
        }  
    }

    /**
     * Display the specified resource.
     */
    public function show($userid)
    {
        $user = User::where('userid',$userid)->first();

        return view('manage.requesters.show')
                    ->with(['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($userid)
    {
        $user = User::where('userid',$userid)->first();

        $accessid = access::where('accessid', $user->accessid)->first();
        $departmentid = department::where('deptid', $user->deptid)->first();

        $access = access::get();
        $department = department::get();

       return view('manage.requesters.edit')
                    ->with(['user' => $user])
                    ->with(['access' => $access])
                    ->with(['department' => $department])
                    ->with(['accessid' => $accessid])
                    ->with(['departmentid' => $departmentid]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $userid)
    {
        $user = User::where('userid', $userid)->first();

        $access = access::where('accessid',$request->access)->first();
        $department = department::where('deptid',$request->department)->first();

        $fullname = $user->lastname . ', ' . $user->firstname . ' ' . $user->middlename;

        $timenow = Carbon::now()->timezone('Asia/Manila')->format('Y-m-d H:i:s');

        $mod = 0;
        $mod = $user->mod;

        if(auth()->user()->accesstype == 'Supervisor')
        {
            if($request->accesstype == 'Administrator')
            {
                return redirect()->route('managerequesters.index')
                        ->with('failed','Requester update failed');
            }
            elseif($request->accesstype == 'Supervisor')
            {
       
                return redirect()->route('managerequesters.index')
                        ->with('failed','Requester update failed');
            }
        }

        if(!empty($request->password) != !empty($request->password_confirmation)){
            return redirect()->route('managerequesters.index')
                    ->with('failed','User update failed');
        }
        if(empty($request->password)){
            $user =User::where('userid',$user->userid)->update([
                'username' => $request->email,
                'email' => $request->email,
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'birthdate' => $request->birthdate,
                'deptid' => $department->deptid,
                'deptname' => $department->deptname,
                'mobile_primary' => $request->mobile,
                'notes' => $request->notes,
                'updated_by' => auth()->user()->email,
                'mod' => $mod + 1,
                'status' => $request->status,
            ]);
            if($user){
               
                return redirect()->route('managerequesters.index')
                            ->with('success','Requester updated successfully');
            }else{

                return redirect()->route('managerequesters.index')
                            ->with('failed','Requester update failed');
            }
        }elseif($request->password == $request->password_confirmation){
            $user =User::where('userid',$user->userid)->update([
                'username' => $request->email,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'firstname' => $request->firstname,
                'middlename' => $request->middlename,
                'lastname' => $request->lastname,
                'birthdate' => $request->birthdate,
                'deptid' => $department->deptid,
                'deptname' => $department->deptname,
                'mobile_primary' => $request->mobile,
                'notes' => $request->notes,
                'updated_by' => auth()->user()->email,
                'mod' => $mod + 1,
                'status' => $request->status,
            ]);
            if($user){
                return redirect()->route('managerequesters.index')
                            ->with('success','Requester updated successfully');
            }else{
               
                
                return redirect()->route('managerequesters.index')
                            ->with('failed','Requester update failed');
            }
        }else{
            return redirect()->back()
                    ->with('failed','Requester update failed. Password Mismatched');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($userid)
    {
        $user = User::where('userid', $userid)->first();
        $fullname = $user->lastname . ', ' . $user->firstname . ' ' . $user->middlename;
        // dd($userid,$fullname,$user);
        if($user->userid == auth()->user()->userid){
            $notes = 'Requester. Activation. Self Account. ' . $fullname;

                return redirect()->route('managerequesters.index')
                        ->with('failed','Requester Update on own account not allowed.');
        }
        $timenow = Carbon::now()->timezone('Asia/Manila')->format('Y-m-d H:i:s');
        if(auth()->user()->accesstype == 'Supervisor')
        {
            if($user->accesstype == 'Administrator')
            {

                return redirect()->route('managerequesters.index')
                        ->with('failed','Requester update failed');
            }
            elseif($user->accesstype == 'Supervisor')
            {

                return redirect()->route('managerequesters.index')
                        ->with('failed','Requester update failed');
            }
        }

        if($user->status == 'Active')
        {
            User::where('userid', $user->userid)
            ->update([
            'status' => 'Inactive',
        ]);



        return redirect()->route('managerequesters.index')
            ->with('success','Requester Decativated successfully');
        }
        elseif($user->status == 'Inactive')
        {
            User::where('userid', $user->userid)
            ->update([
            'status' => 'Active',
        ]);


        return redirect()->route('managerequesters.index')
            ->with('success','Requester Activated successfully');
        }
    }
}
