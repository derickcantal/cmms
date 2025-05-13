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

class ManageUsersController extends Controller
{
    public function search(Request $request)
    {
        $user = User::orderBy('lastname',$request->orderrow)
                ->where(function(Builder $builder) use($request){
                    $builder->where('username','like',"%{$request->search}%")
                            ->orWhere('firstname','like',"%{$request->search}%")
                            ->orWhere('lastname','like',"%{$request->search}%")
                            ->orWhere('middlename','like',"%{$request->search}%")
                            ->orWhere('email','like',"%{$request->search}%")
                            ->orWhere('status','like',"%{$request->search}%"); 
                            
                })->paginate($request->pagerow);
    
        return view('manage.users.index',compact('user'))
            ->with('i', (request()->input('page', 1) - 1) * $request->pagerow);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $timenow = Carbon::now()->timezone('Asia/Manila')->format('Y-m-d H:i:s');

        $user = User::orderBy('status','asc')
                    ->paginate(5);

        // $notes = 'Users';
        // $status = 'Success';
        // $this->userlog($notes,$status);

        return view('manage.users.index',compact('user'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $access = access::get();
        $department = department::get();

       return view('manage.users.create')
                    ->with(['access' => $access])
                    ->with(['department' => $department]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $n1 = strtoupper($request->firstname[0]);
        // $n2 = strtoupper($request->middlename[0]);
        $n3 = strtoupper($request->lastname[0]);
        $n4 = preg_replace('/[-]+/', '', $request->birthdate);

        // $newpassword = $n1 . $n2 . $n3 . $n4;
        $newpassword = $n1 . $n3 . $n4;
        //dd($newpassword);

        $timenow = Carbon::now()->timezone('Asia/Manila')->format('Y-m-d H:i:s');

        if(auth()->user()->accesstype == 'Supervisor')
        {
            if($request->accesstype == 'Adminstrator')
            {
                return redirect()->route('manageuser.index')
                        ->with('failed','User creation failed');
            }
            elseif($request->accesstype == 'Supervisor')
            {

                return redirect()->route('manageuser.index')
                        ->with('failed','User creation failed');
            }
        }
        $user = User::create([
            'avatar' => 'avatars/avatar-default.jpg',
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($newpassword),
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'birthdate' => $request->birthdate,
            'branchid' => $br->branchid,
            'branchname' => $br->branchname,
            'cabid' => 0,
            'cabinetname' => 'Null',
            'accesstype' => $request->accesstype,
            'created_by' => auth()->user()->email,
            'updated_by' => 'Null',
            'timerecorded' => $timenow,
            'mod' => 0,
            'status' => 'Active',
        ]);
    
        if ($user) {
    
            return redirect()->route('manageuser.index')
                        ->with('success','User created successfully.');
        }else{

            return redirect()->route('manageuser.index')
                        ->with('failed','User creation failed');
        }  
    }

    /**
     * Display the specified resource.
     */
    public function show($userid)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($userid)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $userid)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($userid)
    {
        $user = User::where('userid', $userid)->first();
        $fullname = $user->lastname . ', ' . $user->firstname . ' ' . $user->middlename;

        if($user->userid == auth()->user()->userid){
            $notes = 'Users. Activation. Self Account. ' . $fullname;

                return redirect()->route('manageuser.index')
                        ->with('failed','User Update on own account not allowed.');
        }
        $timenow = Carbon::now()->timezone('Asia/Manila')->format('Y-m-d H:i:s');
        if(auth()->user()->accesstype == 'Supervisor')
        {
            if($user->accesstype == 'Administrator')
            {

                return redirect()->route('manageuser.index')
                        ->with('failed','User update failed');
            }
            elseif($user->accesstype == 'Supervisor')
            {

                return redirect()->route('manageuser.index')
                        ->with('failed','User update failed');
            }
        }

        if($user->status == 'Active')
        {
            User::where('userid', $user->userid)
            ->update([
            'status' => 'Inactive',
        ]);

        $user = User::all()->get();


        return redirect()->route('manageuser.index')
            ->with('success','User Decativated successfully');
        }
        elseif($user->status == 'Inactive')
        {
            User::where('userid', $user->userid)
            ->update([
            'status' => 'Active',
        ]);

        $user = User::all()->get();

        return redirect()->route('manageuser.index')
            ->with('success','User Activated successfully');
        }
    }
}
