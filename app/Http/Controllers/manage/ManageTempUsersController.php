<?php

namespace App\Http\Controllers\manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\temp_users;
use App\Models\access;
use App\Models\department;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use \Carbon\Carbon; 

class ManageTempUsersController extends Controller
{
    public function search(Request $request)
    {
        $user = temp_users::orderBy('lastname',$request->orderrow)
                ->where(function(Builder $builder) use($request){
                    $builder->where('username','like',"%{$request->search}%")
                            ->orWhere('firstname','like',"%{$request->search}%")
                            ->orWhere('lastname','like',"%{$request->search}%")
                            ->orWhere('middlename','like',"%{$request->search}%")
                            ->orWhere('email','like',"%{$request->search}%")
                            ->orWhere('status','like',"%{$request->search}%"); 
                })
                ->paginate($request->pagerow);
    
        return view('manage.tempusers.index',compact('user'))
            ->with('i', (request()->input('page', 1) - 1) * $request->pagerow);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = temp_users::orderBy('userid','asc') 
                    ->paginate(5);

        // $notes = 'Users';
        // $status = 'Success';
        // $this->userlog($notes,$status);

        return view('manage.tempusers.index',compact('user'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($userid)
    {
        $user = temp_users::where('userid',$userid)->first();

        return view('manage.tempusers.show')
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

        $access = access::where('accessname','!=','Administrator')->get();
        $department = department::get();

       return view('manage.tempusers.edit')
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($userid)
    {
        //
    }
}
