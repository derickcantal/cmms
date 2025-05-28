<?php

namespace App\Http\Controllers\transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\access;
use App\Models\department;
use App\Models\workclass;
use App\Models\workorder;
use App\Models\wosupplies;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use \Carbon\Carbon;

class TransactionWOSupplyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($workorderid)
    {
        $workorder = workorder::where('workorderid',$workorderid)->first();
        if(empty($workorder->worfid)){
            return redirect()->route('transactionworkorder.index')
                    ->with('failed','Supervisor Approval Needed to Add and List Supplies');
        }
        $wosupplies = wosupplies::where('workorderid',$workorder->workorderid)
                                        ->latest()
                                        ->paginate(5);
        // dd($workorder->workorderid,$wosupplies);

        return view('transaction.wosupply.index')
                        ->with(['workorder' => $workorder])
                        ->with(['wosupplies' => $wosupplies])
                        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($workorderid)
    {
        $workorder = workorder::where('workorderid',$workorderid)->first();
        if(empty($workorder->worfid)){
            return redirect()->route('transactionworkorder.index')
                    ->with('failed','Supervisor Approval Needed to Add and List Supplies');
        }
        return view('transaction.wosupply.create')
                    ->with(['workorder' => $workorder]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,$workorderid)
    {
        $workorder = workorder::where('workorderid',$workorderid)->first();

        $timenow = Carbon::now()->timezone('Asia/Manila')->format('Y-m-d H:i:s');

        $fullname = auth()->user()->lastname . ', ' . auth()->user()->firstname . ' ' . auth()->user()->middlename;
        $wosupplies = wosupplies::create([
            'wosuppliesdesc' => $request->suppliesdesc,
            'workorderid' => $workorder->workorderid,
            'worfid' => $workorder->worfid,
            'particulars' => $request->particulars,
            'qty' => $request->qty,
            'remarks' => $request->remarks,
            'userid' => auth()->user()->userid,
            'fullname' => $fullname,
            'created_by' => auth()->user()->email,
            'updated_by' => 'Null',
            'timerecorded' => $timenow,
            'modifiedid' => 0,
            'mod' => 0,
            'status' => 'Active',
        ]);
    
        if ($wosupplies) {
    
            return redirect()->route('transactionwosupply.index',$workorder->workorderid)
                        ->with('success','Supply Added successfully.');
        }else{

            return redirect()->route('transactionwosupply.index',$workorder->workorderid)
                        ->with('failed','Access Adding failed');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($wosuppliesid)
    {
        $wosupplies = wosupplies::where('wosuppliesid',$wosuppliesid)->first();

        return view('transaction.wosupply.show')
                    ->with(['wosupplies' => $wosupplies]); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($wosuppliesid)
    {

        $wosupplies = wosupplies::where('wosuppliesid',$wosuppliesid)->first();

        return view('transaction.wosupply.edit')
                    ->with(['wosupplies' => $wosupplies]); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $wosuppliesid)
    {
        $wosupplies = wosupplies::where('wosuppliesid',$wosuppliesid)->first();

        $timenow = Carbon::now()->timezone('Asia/Manila')->format('Y-m-d H:i:s');

        $mod = 0;
        $mod = $wosupplies->mod;

        $wosupply = wosupplies::where('wosuppliesid',$wosupplies->wosuppliesid)->update([
            'wosuppliesdesc' => $request->suppliesdesc,
            'particulars' => $request->particulars,
            'qty' => $request->qty,
            'remarks' => $request->remarks,
            'updated_by' => auth()->user()->email,
            'mod' => $mod + 1,
        ]);
        if($wosupply){
            
            return redirect()->route('transactionwosupply.index',$wosupplies->workorderid)
                        ->with('success','Access updated successfully');
        }else{

            return redirect()->route('transactionwosupply.index',$wosupplies->workorderid)
                        ->with('failed','Access update failed');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($wosuppliesid)
    {
        $wosupplies = wosupplies::where('wosuppliesid', $wosuppliesid)->first();
        $timenow = Carbon::now()->timezone('Asia/Manila')->format('Y-m-d H:i:s');

        if($wosupplies->status == 'Active')
        {
            wosupplies::where('wosuppliesid', $wosupplies->wosuppliesid)
            ->update([
            'status' => 'Inactive',
        ]);



        return redirect()->route('transactionwosupply.index')
            ->with('success','Supply Decativated successfully');
        }
        elseif($wosupplies->status == 'Inactive')
        {
            wosuppliesid::where('wosuppliesid', $wosupplies->wosuppliesid)
            ->update([
            'status' => 'Active',
        ]);


        return redirect()->route('transactionwosupply.index')
            ->with('success','Supply Activated successfully');
        }
    }
}
