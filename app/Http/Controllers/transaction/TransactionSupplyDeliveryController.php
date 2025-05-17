<?php

namespace App\Http\Controllers\transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\supplies;
use App\Models\supplies_delivery;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use \Carbon\Carbon; 

class TransactionSupplyDeliveryController extends Controller
{

    public function search(Request $request)
    {
        $supplies_delivery = supplies_delivery::orderBy('sdeliveryid',$request->orderrow)
                ->where(function(Builder $builder) use($request){
                    $builder->where('suppliesdesc','like',"%{$request->search}%")
                            ->where('notes','like',"%{$request->search}%")
                            ->orWhere('status','like',"%{$request->search}%"); 
                            
                })->paginate($request->pagerow);
    
        return view('transaction.supplydelivery.index',compact('supplies_delivery'))
            ->with('i', (request()->input('page', 1) - 1) * $request->pagerow);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supplies_delivery = supplies_delivery::paginate(5);

        return view('transaction.supplydelivery.index')
                        ->with(['supplies_delivery' => $supplies_delivery])
                        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $supplies = supplies::get();

        return view('transaction.supplydelivery.create')
                        ->with(['supplies' => $supplies]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $timenow = Carbon::now()->timezone('Asia/Manila')->format('Y-m-d H:i:s');

        $supplies = supplies::where('suppliesid',$request->supplies)->first();
        
        $stocks = $supplies->stocks + $request->qty;


        $supplies_delivery = supplies_delivery::create([
            'suppliesid' => $supplies->suppliesid,
            'suppliesdesc' => $supplies->suppliesdesc,
            'particulars' => $request->particulars,
            'qty' => $request->qty,
            'stocks' => $stocks,
            'price' => $request->price,
            'srp' => 0,
            'total' => 0,
            'notes' => $request->notes,
            'created_by' => auth()->user()->email,
            'updated_by' => 'Null',
            'timerecorded' => $timenow,
            'modifiedid' => 0,
            'mod' => 0,
            'status' => 'Active',
        ]);
    
        $updatestocks = supplies::where('suppliesid',$supplies->suppliesid)->update([
                'stocks' => $stocks,
            ]);

        if ($supplies_delivery) {
    
            return redirect()->route('transactionsupplydelivery.index')
                        ->with('success','Supplies Delivery created successfully.');
        }else{

            return redirect()->route('transactionsupplydelivery.index')
                        ->with('failed','Supplies Delivery creation failed');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($sdeliveryid)
    {
        $supplies_delivery = supplies_delivery::where('sdeliveryid',$sdeliveryid)->first();

        return view('transaction.supplydelivery.show')
                    ->with(['supplies_delivery' => $supplies_delivery]); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($sdeliveryid)
    {
        $supplies_delivery = supplies_delivery::where('sdeliveryid',$sdeliveryid)->first();

        return view('transaction.supplydelivery.edit')
                    ->with(['supplies_delivery' => $supplies_delivery]); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $sdeliveryid)
    {
        $supplies_delivery = supplies_delivery::where('sdeliveryid',$sdeliveryid)->first();

        $timenow = Carbon::now()->timezone('Asia/Manila')->format('Y-m-d H:i:s');

        $mod = 0;
        $mod = $supplies_delivery->mod;

            $supplies_delivery = supplies_delivery::where('sdeliveryid',$supplies_delivery->sdeliveryid)->update([
                'notes' => $request->notes,
                'updated_by' => auth()->user()->email,
                'mod' => $mod + 1,
            ]);
            if($supplies_delivery){
               
                return redirect()->route('transactionsupplydelivery.index')
                            ->with('success','Supplies Delivery updated successfully');
            }else{

                return redirect()->route('transactionsupplydelivery.index')
                            ->with('failed','Supplies Delivery update failed');
            }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($sdeliveryid)
    {
        $supplies_delivery = supplies_delivery::where('sdeliveryid', $sdeliveryid)->first();
        $timenow = Carbon::now()->timezone('Asia/Manila')->format('Y-m-d H:i:s');

        if($workorder->status == 'Active')
        {
            supplies_delivery::where('sdeliveryid', $supplies_delivery->sdeliveryid)
            ->update([
            'status' => 'Inactive',
        ]);



        return redirect()->route('transactionsupplydelivery.index')
            ->with('success','Supplies Delivery Decativated successfully');
        }
        elseif($workorder->status == 'Inactive')
        {
            supplies_delivery::where('sdeliveryid', $supplies_delivery->sdeliveryid)
            ->update([
            'status' => 'Active',
        ]);


        return redirect()->route('transactionsupplydelivery.index')
            ->with('success','Supplies Delivery Activated successfully');
        }
    }
}
