<?php

namespace App\Http\Controllers\manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\supplies;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use \Carbon\Carbon; 

class ManageSuppliesController extends Controller
{
    public function search(Request $request)
    {
        $supplies = supplies::orderBy('suppliesdesc',$request->orderrow)
                ->where(function(Builder $builder) use($request){
                    $builder->where('suppliesdesc','like',"%{$request->search}%")
                            ->orWhere('workorderid','like',"%{$request->search}%")
                            ->orWhere('particulars','like',"%{$request->search}%")
                            ->orWhere('remarks','like',"%{$request->search}%")
                            ->orWhere('fullname','like',"%{$request->search}%")
                            ->orWhere('notes','like',"%{$request->search}%")
                            ->orWhere('status','like',"%{$request->search}%"); 
                            
                })->paginate($request->pagerow);
    
        return view('manage.supplies.index',compact('supplies'))
            ->with('i', (request()->input('page', 1) - 1) * $request->pagerow);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supplies = supplies::paginate(5);

        return view('manage.supplies.index')
                        ->with(['supplies' => $supplies])
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
