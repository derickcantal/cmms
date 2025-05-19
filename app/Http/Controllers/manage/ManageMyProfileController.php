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

class ManageMyProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::where('userid',auth()->user()->userid)->first();
        
        return view('manage.myprofile.index')
                ->with(['user' => $user]);
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $userid)
    {
        $userdetails = User::where('userid',auth()->user()->userid)->first();

        $mod = 0;
        $mod = $userdetails->mod;

        if(!empty($userdetails->middlename)){
            $middlename = $userdetails->middlename;
        }else{
            $middlename = $request->middlename;
        }
        

        $user = User::where('userid',auth()->user()->userid)->update([
            'middlename' => $middlename,
            'mobile_primary' => $request->mobile_primary,
            'mobile_secondary' => $request->mobile_secondary,
            'homeno' => $request->homeno,
            'notes' => $request->notes,
            'updated_by' => auth()->user()->email,
            'mod' => $mod + 1,
        ]);

        if($user){
            
            return redirect()->back()
                        ->with('success','Updated successfully');
        }else{

            return redirect()->back()
                        ->with('failed','Update failed');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
