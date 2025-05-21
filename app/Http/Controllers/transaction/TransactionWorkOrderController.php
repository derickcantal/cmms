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
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;
use Illuminate\Support\Facades\Storage;
 
class TransactionWorkOrderController extends Controller
{

    public function cwork(Request $request,$workorderid)
    {
        $timenow = Carbon::now()->timezone('Asia/Manila')->format('Y-m-d H:i:s');

        $validated = $request->validate([
            'imagec'=>'required|image|file',
        ]);

        $workorder = workorder::where('workorderid',$workorderid)->first();

        $manager = ImageManager::imagick();
        $name_gen = hexdec(uniqid()).'.'.$request->file('imagec')->getClientOriginalExtension();
        
        $image = $manager->read($request->file('imagec'));
       
        $encoded = $image->toWebp()->save(storage_path('app/public/workorder/'.$name_gen.'.webp'));
        $path = 'workorder/'.$name_gen.'.webp';

        
        if(!empty($workorder->dtstarted)){
            $workorders = workorder::where('workorderid',$workorder->workorderid)->update([ 
                'woeimage' => $path,
                'dtended' => $timenow,
                'mstatus' => 'Completed',
                'status' => 'Work Ended',
                ]);

            if($workorders){
            return redirect()->route('transactionworkorder.show',$workorder->workorderid)
                ->with('success','Work Order Ended');
            }else{
                return redirect()->route('transactionworkorder.show',$workorder->workorderid)
                    ->with('failed','Work Order Ended Error');
            }
        }else{
            return redirect()->route('transactionworkorder.show',$workorder->workorderid)
                ->with('failed','Work Order Ended Error');
        }
    }

    public function verify(Request $request,$workorderid)
    {
        $timenow = Carbon::now()->timezone('Asia/Manila')->format('Y-m-d H:i:s');

        $fullname = auth()->user()->lastname . ', ' . auth()->user()->firstname . ' ' . auth()->user()->middlename;

        $workorder = workorder::where('workorderid',$workorderid)->first();

        $personnel = User::where('userid',$request->personnel)->first();

        // dd($request,$workorder,$personnel);

        if($request->priority == 0)
        {
            $priorityid = 0;
            $prioritydesc = 'Immediate';
        }elseif($request->priority == 1)
        {
            $priorityid = 1;
            $prioritydesc = 'High';
        }elseif($request->priority == 2)
        {
            $priorityid = 2;
            $prioritydesc = 'Medium';
        }elseif($request->priority == 3)
        {
            $priorityid = 3;
            $prioritydesc = 'Low';
        }else
        {
            return redirect()->route('transactionworkorder.index')
                ->with('failed','Invalid Priority Number');
        }


        $workorders = workorder::where('workorderid',$workorder->workorderid)->update([
                'worfid' => $request->worfid,
                'verifybyid' => auth()->user()->userid,
                'vfullname' => $fullname,
                'vdeptid' => auth()->user()->deptid,
                'vdeptname' => auth()->user()->deptname,
                'vdtsigned' => $timenow,
                'vstatus' => 'Verified',
                'schedule' => $request->schedule,
                'startedbyid' => $personnel->userid,
                'sfullname' => $personnel->lastname .', '. $personnel->firstname .' '. $personnel->middlename,
                'priorityid' => $priorityid,
                'prioritydesc' => $prioritydesc,
                'eworkdays' => $request->eworkdays,
                'notes' => $request->notes,
                'mstatus' => 'Monitoring',
                'status' => 'On Process',
                ]);
        if($workorders){
            return redirect()->route('transactionworkorder.index')
                ->with('success','Work Order Verified. On Process.');
        }else{
            return redirect()->route('transactionworkorder.index')
                ->with('failed','Work Order Verification Error');
        }
    }

    public function approve(Request $request,$workorderid)
    {
        $timenow = Carbon::now()->timezone('Asia/Manila')->format('Y-m-d H:i:s');
        $fullname = auth()->user()->lastname . ', ' . auth()->user()->firstname . ' ' . auth()->user()->middlename;

        $workorder = workorder::where('workorderid',$workorderid)->first();

        // dd($workorder);
        if($request->input('action') == "personnel")
        {
            // dd('I am a personnel');
            if(empty($workorder->dtstarted) and empty($workorder->dtended)){
                return redirect()->back()
                        ->with('failed','Work Order Completion Error');
            }
            $workorders = workorder::where('workorderid',$workorder->workorderid)->update([
                'completedbyid' => auth()->user()->userid,
                'cfullname' => $fullname,
                'status' => 'For Final Submission',
                ]);
                if($workorders){
                    return redirect()->back()
                        ->with('success','Work Order Completed');
                }else{
                    return redirect()->back()
                        ->with('failed','Work Order Completion Error');
                }
        }elseif($request->input('action') == "deptheadapproval")
        {
            if(empty($workorder->headid)){
                $workorders = workorder::where('workorderid',$workorder->workorderid)->update([
                'headid' => auth()->user()->userid,
                'hfullname' => $fullname,
                'hdeptid' => auth()->user()->deptid,
                'hdeptname' => auth()->user()->deptname,
                'hdtsigned' => $timenow,
                'hstatus' => 'Approved',
                'status' => 'For GSO Approval',
                ]);
                if($workorders){
                    return redirect()->back()
                        ->with('success','Work Order Approved');
                }else{
                    return redirect()->back()
                        ->with('failed','Work Order Approval Error');
                }
                
            }elseif(empty($workorder->completedbyid)){
                return redirect()->back()
                        ->with('failed','Work Order Not signed by Personnel');
            }

        }elseif($request->input('action') == "supervisorverify")
        {
            if(empty($workorder->headid)){
                return redirect()->back()
                        ->with('failed','Work Order Need Head Deparment Approval');
            }else{

                $personnel = User::where('accessname','Personnel')->get();

                return view('transaction.workorder.verify',compact('workorder'))
                            ->with(['personnel' => $personnel]);

                return redirect()->back()
                        ->with('failed','Work Order Need Work Order Referrence ID');
            }
        }elseif($request->input('action') == "personnelswork")
        {
            if(!empty($workorder->startedbyid) and empty($workorder->dtstarted)){
                $workorders = workorder::where('workorderid',$workorder->workorderid)->update([ 
                    'dtstarted' => $timenow,
                    'mstatus' => 'Monitoring',
                    'status' => 'Work Started',
                    ]);
            }else{
                return redirect()->back()
                    ->with('failed','Work Order Started Error');
            }
                
            if($workorders){
                return redirect()->back()
                    ->with('success','Work Order Started');
            }else{
                return redirect()->back()
                    ->with('failed','Work Order Started Error');
            }
        }elseif($request->input('action') == "personnelcwork")
        {

                return view('transaction.workorder.personnel',compact('workorder'));
        }elseif($request->input('action') == "deptheadwe")
        {
            if(!empty($workorder->dtstarted) and empty(!$workorder->dtended)){
                $workorders = workorder::where('workorderid',$workorder->workorderid)->update([ 
                    'monitoredbyid' => auth()->user()->userid,
                    'mfullname' => $fullname,
                    'mdtsigned' => $timenow,
                    'status' => 'For Final Submission',
                    ]);
                if($workorders){
                    return redirect()->back()
                        ->with('success','Work Order Ended');
                }else{
                    return redirect()->back()
                        ->with('failed','Work Order Ended Error');
                }
            }
            

        
        }elseif($request->input('action') == "supervisorfinal")
        {
            $workorders = workorder::where('workorderid',$workorder->workorderid)->update([ 
                    'fsuserid' => auth()->user()->userid,
                    'fsfullname' => $fullname,
                    'fsdeptid' => auth()->user()->deptid,
                    'fseptname' => auth()->user()->deptname,
                    'fstsigned' => $timenow,
                    'fsstatus' => 'Finalized',
                    'status' => 'Work Finalized',
                    ]);

            if($workorders){
                return redirect()->back()
                    ->with('success','Work Order Finalized');
            }else{
                return redirect()->back()
                    ->with('failed','Work Order Finalize Error');
            }
        }elseif($request->input('action') == "director")
        {
            $workorders = workorder::where('workorderid',$workorder->workorderid)->update([ 
                    'fduserid' => auth()->user()->userid,
                    'fdfullname' => $fullname,
                    'fddeptid' => auth()->user()->deptid,
                    'fddeptname' => auth()->user()->deptname,
                    'fddtsigned' => $timenow,
                    'fdstatus' => 'Finalized',
                    'status' => 'Completed',
                    ]);

            if($workorders){
                return redirect()->back()
                    ->with('success','Work Order Completed');
            }else{
                return redirect()->back()
                    ->with('failed','Work Order Completed');
            }
        }

    }

    public function search(Request $request)
    {
        if(auth()->user()->accessname == 'Administrator' or
            auth()->user()->accessname == 'Director' or
            auth()->user()->accessname == 'Supervisor'
        ){
            $workorder = workorder::orderBy('priorityid',$request->orderrow)
                ->where(function(Builder $builder) use($request){
                    $builder->where('workorderdesc','like',"%{$request->search}%")
                            ->where('prioritydesc','like',"%{$request->search}%")
                            ->where('notes','like',"%{$request->search}%")
                            ->orWhere('status','like',"%{$request->search}%"); 
                })->paginate($request->pagerow);

        }elseif(auth()->user()->accessname == 'Dept. Head'){
            $workorder = workorder::where('rdeptname',auth()->user()->deptname)
                ->where(function(Builder $builder) use($request){
                    $builder->where('workorderdesc','like',"%{$request->search}%")
                            ->where('prioritydesc','like',"%{$request->search}%")
                            ->where('notes','like',"%{$request->search}%")
                            ->orWhere('status','like',"%{$request->search}%"); 
                })->orderBy('priorityid',$request->orderrow)
                ->paginate($request->pagerow);

        }elseif(auth()->user()->accessname == 'Requester'){
            $workorder = workorder::where('requesterid',auth()->user()->userid)
                ->where(function(Builder $builder) use($request){
                    $builder->where('workorderdesc','like',"%{$request->search}%")
                            ->where('prioritydesc','like',"%{$request->search}%")
                            ->where('notes','like',"%{$request->search}%")
                            ->orWhere('status','like',"%{$request->search}%"); 
                })->orderBy('priorityid',$request->orderrow)
                ->paginate($request->pagerow);
                
        }elseif(auth()->user()->accessname == 'Personnel'){
            $workorder = workorder::where('startedbyid',auth()->user()->userid)
                ->where(function(Builder $builder) use($request){
                    $builder->where('workorderdesc','like',"%{$request->search}%")
                            ->where('prioritydesc','like',"%{$request->search}%")
                            ->where('notes','like',"%{$request->search}%")
                            ->orWhere('status','like',"%{$request->search}%"); 
                })->orderBy('priorityid',$request->orderrow)
                ->paginate($request->pagerow);
        }
        
    
        return view('transaction.workorder.index',compact('workorder'))
            ->with('i', (request()->input('page', 1) - 1) * $request->pagerow);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth()->user()->accessname == 'Administrator' or
            auth()->user()->accessname == 'Director' or
            auth()->user()->accessname == 'Supervisor'
        ){
            $workorder = workorder::paginate(5);
        }elseif(auth()->user()->accessname == 'Dept. Head'){
            $workorder = workorder::where('rdeptname',auth()->user()->deptname)->paginate(5);
        }elseif(auth()->user()->accessname == 'Requester'){
            $workorder = workorder::where('requesterid',auth()->user()->userid)->paginate(5);
        }elseif(auth()->user()->accessname == 'Personnel'){
            $workorder = workorder::where('startedbyid',auth()->user()->userid)->paginate(5);
        }

        return view('transaction.workorder.index')
                        ->with(['workorder' => $workorder])
                        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $workclass = workclass::get();

        return view('transaction.workorder.create')
                     ->with(['workclass' => $workclass]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $timenow = Carbon::now()->timezone('Asia/Manila')->format('Y-m-d H:i:s');

        $workclass = workclass::where('workclassid', $request->workclass)->first();

        $fullname = auth()->user()->lastname . ', ' . auth()->user()->firstname . ' ' . auth()->user()->middlename;

        $validated = $request->validate([
            'imagep'=>'required|image|file',
        ]);
        $ipath = 'workorder/';

        if(!Storage::disk('public')->exists($ipath)){
            Storage::disk('public')->makeDirectory($ipath);
            // dd('path created');
        }
        
        $manager = ImageManager::imagick();
        $name_gen = hexdec(uniqid()).'.'.$request->file('imagep')->getClientOriginalExtension();
        
        $image = $manager->read($request->file('imagep'));
       
        $encoded = $image->toWebp()->save(storage_path('app/public/workorder/'.$name_gen.'.webp'));
        $path = 'workorder/'.$name_gen.'.webp';
        
        $workorder = workorder::create([
            'woimage' => $path,
            'workorderdesc' => $request->workorderdesc,
            'requesterid' => auth()->user()->userid,
            'rfullname' => $fullname,
            'email' => auth()->user()->email,
            'rdeptid' => auth()->user()->deptid,
            'rdeptname' => auth()->user()->deptname,
            'workclassid' => $workclass->workclassid,
            'workclassdesc' => $workclass->workclassdesc,
            'notes' => $request->notes,
            'created_by' => $fullname,
            'updated_by' => 'Null',
            'timerecorded' => $timenow,
            'modifiedid' => 0,
            'mod' => 0,
            'status' => 'For Approval',
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
