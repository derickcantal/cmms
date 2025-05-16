<?php

namespace App\Http\Controllers\manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\workclass;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use \Carbon\Carbon; 

class ManageWorkClassController extends Controller
{
    public function search(Request $request)
    {
        $workclass = workclass::orderBy('workclassid',$request->orderrow)
                ->where(function(Builder $builder) use($request){
                    $builder->where('workclassdesc','like',"%{$request->search}%")
                            ->orWhere('notes','like',"%{$request->search}%")
                            ->orWhere('status','like',"%{$request->search}%"); 
                            
                })->paginate($request->pagerow);
    
        return view('manage.workclass.index',compact('workclass'))
            ->with('i', (request()->input('page', 1) - 1) * $request->pagerow);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $workclass = workclass::paginate(5);

        return view('manage.workclass.index')
                        ->with(['workclass' => $workclass])
                        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manage.workclass.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $timenow = Carbon::now()->timezone('Asia/Manila')->format('Y-m-d H:i:s');

        $workclass = workclass::create([
            'workclassdesc' => $request->workclassdesc,
            'notes' => $request->notes,
            'created_by' => auth()->user()->email,
            'updated_by' => 'Null',
            'timerecorded' => $timenow,
            'modifiedid' => 0,
            'mod' => 0,
            'status' => 'Active',
        ]);
    
        if ($workclass) {
    
            return redirect()->route('manageworkclass.index')
                        ->with('success','Work Class created successfully.');
        }else{

            return redirect()->route('manageworkclass.index')
                        ->with('failed','Work Class creation failed');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($workclassid)
    {
        $workclass = workclass::where('workclassid',$workclassid)->first();

        return view('manage.workclass.show')
                    ->with(['workclass' => $workclass]); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($workclassid)
    {
        $workclass = workclass::where('workclassid',$workclassid)->first();

        return view('manage.workclass.edit')
                    ->with(['workclass' => $workclass]); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $workclassid)
    {
        $workclassid = workclass::where('workclassid',$workclassid)->first();

        $timenow = Carbon::now()->timezone('Asia/Manila')->format('Y-m-d H:i:s');

        $mod = 0;
        $mod = $workclassid->mod;

        $workclass = workclass::where('workclassid',$workclassid->workclassid)->update([
            'workclassdesc' => $request->workclassdesc,
            'notes' => $request->notes,
            'updated_by' => auth()->user()->email,
            'mod' => $mod + 1,
            'status' => $request->status,
        ]);
        if($workclass){
            
            return redirect()->route('manageworkclass.index')
                        ->with('success','Work Class updated successfully');
        }else{

            return redirect()->route('manageworkclass.index')
                        ->with('failed','Work Class update failed');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($workclassid)
    {
        $workclass = workclass::where('workclassid', $workclassid)->first();
        $timenow = Carbon::now()->timezone('Asia/Manila')->format('Y-m-d H:i:s');

        if($workclass->status == 'Active')
        {
            workclass::where('workclassid', $workclass->workclassid)
            ->update([
            'status' => 'Inactive',
        ]);



        return redirect()->route('manageworkclass.index')
            ->with('success','Work Class Decativated successfully');
        }
        elseif($workclass->status == 'Inactive')
        {
            workclass::where('workclassid', $workclass->workclassid)
            ->update([
            'status' => 'Active',
        ]);


        return redirect()->route('manageworkclass.index')
            ->with('success','Work Class Activated successfully');
        }
    }
}
