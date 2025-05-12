<?php

namespace App\Http\Controllers\manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\department;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use \Carbon\Carbon; 

class ManageDepartmentController extends Controller
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
        return view('manage.department.index');
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
