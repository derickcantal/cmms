<?php

namespace App\Http\Controllers\transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\access;
use App\Models\department;
use App\Models\workclass;
use App\Models\workorder;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use \Carbon\Carbon; 
 
class TransactionWorkOrderController extends Controller
{
    public function search(Request $request)
    {
        $workorder = workorder::orderBy('priorityid',$request->orderrow)
                ->where(function(Builder $builder) use($request){
                    $builder->where('workorderdesc','like',"%{$request->search}%")
                            ->where('prioritydesc','like',"%{$request->search}%")
                            ->where('notes','like',"%{$request->search}%")
                            ->orWhere('status','like',"%{$request->search}%"); 
                            
                })->paginate($request->pagerow);
    
        return view('transaction.workorder.index',compact('workorder'))
            ->with('i', (request()->input('page', 1) - 1) * $request->pagerow);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $workorder = workorder::paginate(5);

        return view('transaction.workorder.index')
                        ->with(['workorder' => $workorder])
                        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('transaction.workorder.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $timenow = Carbon::now()->timezone('Asia/Manila')->format('Y-m-d H:i:s');

        $workorder = workorder::create([
            'workorderdesc' => $request->workorderdesc,
            'deptid' => 0,
            'deptname' => 'Null',
            'notes' => $request->notes,
            'created_by' => auth()->user()->email,
            'updated_by' => 'Null',
            'timerecorded' => $timenow,
            'modifiedid' => 0,
            'mod' => 0,
            'status' => 'Active',
        ]);
    
        if ($workorder) {
    
            return redirect()->route('transactionworkorder.index')
                        ->with('success','Work Order created successfully.');
        }else{

            return redirect()->route('transactionworkorder.index')
                        ->with('failed','Work Order creation failed');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($workorderid)
    {
        $workorder = workorder::where('workorderid',$workorderid)->first();

        return view('transaction.workorder.show')
                    ->with(['workorder' => $workorder]); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($workorderid)
    {
        $workorder = workorder::where('workorderid',$workorderid)->first();

        return view('transaction.workorder.edit')
                    ->with(['workorder' => $workorder]); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $workorderid)
    {
        $workorder = workorder::where('workorderid',$workorderid)->first();

        $timenow = Carbon::now()->timezone('Asia/Manila')->format('Y-m-d H:i:s');

        $mod = 0;
        $mod = $workorder->mod;

            $workorder = workorder::where('workorderid',$workorder->workorderid)->update([
                'workorderdesc' => $request->workorderdesc,
                'notes' => $request->notes,
                'updated_by' => auth()->user()->email,
                'mod' => $mod + 1,
                'status' => $request->status,
            ]);
            if($workorder){
               
                return redirect()->route('transactionworkorder.index')
                            ->with('success','Work Order updated successfully');
            }else{

                return redirect()->route('transactionworkorder.index')
                            ->with('failed','Work Order update failed');
            }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($workorderid)
    {
        $workorder = workorder::where('workorderid', $workorderid)->first();
        $timenow = Carbon::now()->timezone('Asia/Manila')->format('Y-m-d H:i:s');

        if($workorder->status == 'Active')
        {
            workorder::where('workorderid', $workorder->workorderid)
            ->update([
            'status' => 'Inactive',
        ]);



        return redirect()->route('transactionworkorder.index')
            ->with('success','Work Order Decativated successfully');
        }
        elseif($workorder->status == 'Inactive')
        {
            workorder::where('workorderid', $workorder->workorderid)
            ->update([
            'status' => 'Active',
        ]);


        return redirect()->route('transactionworkorder.index')
            ->with('success','Work Order Activated successfully');
        }
    }
}
