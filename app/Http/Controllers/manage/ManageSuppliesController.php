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
                            ->orWhere('particulars','like',"%{$request->search}%")
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
        return view('manage.supplies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $timenow = Carbon::now()->timezone('Asia/Manila')->format('Y-m-d H:i:s');

        $supplies = supplies::create([
            'suppliesdesc' => $request->suppliesdesc,
            'qty' => 0,
            'stocks' => 0,
            'price' => 0,
            'srp' => 0,
            'notes' => $request->notes,
            'created_by' => auth()->user()->email,
            'updated_by' => 'Null',
            'timerecorded' => $timenow,
            'modifiedid' => 0,
            'mod' => 0,
            'status' => 'Active',
        ]);
    
        if ($supplies) {
    
            return redirect()->route('managesupplies.index')
                        ->with('success','Supplies created successfully.');
        }else{

            return redirect()->route('managesupplies.index')
                        ->with('failed','Supplies creation failed');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($suppliesid)
    {
         $supplies = supplies::where('suppliesid',$suppliesid)->first();

        return view('manage.supplies.show')
                    ->with(['supplies' => $supplies]); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($suppliesid)
    {
        $supplies = supplies::where('suppliesid',$suppliesid)->first();

        return view('manage.supplies.edit')
                    ->with(['supplies' => $supplies]); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $suppliesid)
    {
        $suppliesid = supplies::where('suppliesid',$suppliesid)->first();

        $timenow = Carbon::now()->timezone('Asia/Manila')->format('Y-m-d H:i:s');

        $mod = 0;
        $mod = $suppliesid->mod;

            $supplies = supplies::where('suppliesid',$suppliesid->suppliesid)->update([
                'suppliesdesc' => $request->supplies,
                'notes' => $request->notes,
                'updated_by' => auth()->user()->email,
                'mod' => $mod + 1,
                'status' => $request->status,
            ]);
            if($supplies){
               
                return redirect()->route('managesupplies.index')
                            ->with('success','User updated successfully');
            }else{

                return redirect()->route('managesupplies.index')
                            ->with('failed','User update failed');
            }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($suppliesid)
    {
        $supplies = supplies::where('suppliesid', $suppliesid)->first();
        $timenow = Carbon::now()->timezone('Asia/Manila')->format('Y-m-d H:i:s');

        if($supplies->status == 'Active')
        {
            supplies::where('suppliesid', $supplies->suppliesid)
            ->update([
            'status' => 'Inactive',
        ]);



        return redirect()->route('managesupplies.index')
            ->with('success','Supplies Decativated successfully');
        }
        elseif($supplies->status == 'Inactive')
        {
            supplies::where('suppliesid', $supplies->suppliesid)
            ->update([
            'status' => 'Active',
        ]);


        return redirect()->route('managesupplies.index')
            ->with('success','Supplies Activated successfully');
        }
    }
}
