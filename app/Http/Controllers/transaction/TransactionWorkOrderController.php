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
use App\Models\history_workorder;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use \Carbon\Carbon;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\WOCreated;
use App\Mail\WODHApproved;
use App\Mail\WOfinalized;
use App\Mail\WOfinalsubmission;
use App\Mail\WOonprocess;
use App\Mail\WOworkended;
use App\Mail\WOworkstarted;
use Barryvdh\DomPDF\Facade\Pdf;
 
class TransactionWorkOrderController extends Controller
{

    public function printPDF($workorderid){
        $workorder = workorder::where('workorderid',$workorderid)->first();

        $wosupplies = wosupplies::where('workorderid',$workorder->workorderid)->latest()->get();
        // dd($workorder->worfid .'-'. $workorder->rdeptname.'.pdf');

        $newfilename = $workorder->worfid .'-'. $workorder->rdeptname.'.pdf';
        
        return view('transaction.workorder.form')->with(['workorder' => $workorder])
        ->with(['wosupplies' => $wosupplies])->with('i', (request()->input('page', 1) - 1) * 5);

        $printthis = true;
        
        $pdf = PDF::loadView('transaction.workorder.show', compact('printthis','workorder','wosupplies'))
                    ->setPaper('a4', 'portrait');
                    
        return $pdf->download($newfilename);
        
    }

    // notif for new work order sent to DEPT HEAD
    public function mailwocreated($workorderid)
    {
        $workorder = workorder::where('workorderid',$workorderid)->first();

        $user = User::where('deptname', $workorder->rdeptname)
                        ->where(function(Builder $builder) use($workorder){
                                    $builder->where('accessname','Dept. Head');
                                    })->get();
        
        foreach ($user as $u){
             Mail::to($u->email)->send(new WOCreated());
        }

    }

    // notif for approved work order sent to SUPERVISOR
    public function mailwopapproved($workorderid)
    {
        $workorder = workorder::where('workorderid',$workorderid)->first();

        $user = User::where('accessname','Supervisor')->get();
                        
        
        foreach ($user as $u){
            Mail::to($u->email)->send(new WODHApproved());
        }
    }

    // notif for verified work order sent to DEPT HEAD
    public function mailwoverified($workorderid)
    {
        $workorder = workorder::where('workorderid',$workorderid)->first();

        Mail::to($workorder->hemail)->send(new WOonprocess());
    }

    // notif for assigned work order sent to PERSONNEL
    public function mailwoassigned($workorderid)
    {
        $workorder = workorder::where('workorderid',$workorderid)->first();

        Mail::to($workorder->semail)->send(new WOonprocess());
    }

    // notif for started work order sent to DEPT HEAD
    public function mailwostarted($workorderid)
    {
        $workorder = workorder::where('workorderid',$workorderid)->first();

        Mail::to($workorder->hemail)->send(new WOworkstarted());
    }

         // notif for ended work order sent to DEPT HEAD
    public function mailwoended($workorderid)
    {
        $workorder = workorder::where('workorderid',$workorderid)->first();

        Mail::to($workorder->hemail)->send(new WOworkended());
    }
    
    // notif for completed work order sent to DEPT HEAD
    public function mailwofinished($workorderid)
    {
        $workorder = workorder::where('workorderid',$workorderid)->first();

        Mail::to($workorder->hemail)->send(new WOworkended());
    }

    // notif for monitored work order sent to SUPERVISOR
    public function mailwomonitored($workorderid)
    {
        $workorder = workorder::where('workorderid',$workorderid)->first();

        Mail::to($workorder->vemail)->send(new WOfinalized());
    }

    // notif for Finalized work order sent to DIRECTOR
    public function mailwofinalized($workorderid)
    {
        $workorder = workorder::where('workorderid',$workorderid)->first();

        $user = User::where('accessname','Director')->get();
        
        foreach ($user as $u){
            Mail::to($u->email)->send(new WOfinalsubmission());
        }
    }

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
                $this->mailwoended($workorderid);

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
        // dd($request,$request->starttime,$request->etime);
        $timenow = Carbon::now()->timezone('Asia/Manila')->format('Y-m-d H:i:s');

        $fullname = auth()->user()->lastname . ', ' . auth()->user()->firstname . ' ' . auth()->user()->middlename;

        $workorder = workorder::where('workorderid',$workorderid)->first();

        

        $personnel = User::where('userid',$request->personnel)->first();

        // dd($request,$workorder,$personnel);

        if($request->priority == 0)
        {
            $priorityid = 0;
            $prioritydesc = 'Emergency';
            $color = 'Red';
        }elseif($request->priority == 1)
        {
            $priorityid = 1;
            $prioritydesc = 'High';
            $color = 'Orange';
        }elseif($request->priority == 2)
        {
            $priorityid = 2;
            $prioritydesc = 'Moderate';
            $color = 'Yellow';
        }elseif($request->priority == 3)
        {
            $priorityid = 3;
            $prioritydesc = 'Low';
            $color = 'Green';
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
                'vemail' => auth()->user()->email,
                'vdtsigned' => $timenow,
                'vstatus' => 'Verified',
                'start' => $request->start . ' ' . $request->starttime ,
                'end' => $request->end . ' ' . $request->etime,
                'color' => $color,
                'startedbyid' => $personnel->userid,
                'sfullname' => $personnel->lastname .', '. $personnel->firstname .' '. $personnel->middlename,
                'semail' => $personnel->email,
                'priorityid' => $priorityid,
                'prioritydesc' => $prioritydesc,
                'eworkdays' => $request->eworkdays,
                'notes' => $request->notes,
                'mstatus' => 'Monitoring',
                'status' => 'On Process',
                ]);
        if($workorders){

            $this->mailwoassigned($workorderid);

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
                'cemail' => auth()->user()->email,
                'status' => 'For Final Submission',
                ]);
                if($workorders){

                    $this->mailwofinished($workorderid);

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
                'hemail' => auth()->user()->email,
                'hdeptid' => auth()->user()->deptid,
                'hdeptname' => auth()->user()->deptname,
                'hdtsigned' => $timenow,
                'hstatus' => 'Approved',
                'status' => 'For GSO Approval',
                ]);
                if($workorders){

                    $this->mailwopapproved($workorderid);

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
                $today = Carbon::now();
                $today->month;
                $today->year;

                $tyear = $today->year;

                $personnel = User::where('accessname','Personnel')->get();
                // dd($workorder->workclassdesc);
                $worfidno = workorder::where('workclassdesc',$workorder->workclassdesc)
                                ->where(function(Builder $builder) use($request){
                        $builder->where('status','On Process'); 
                })
                ->latest()->first();

                if(empty($worfidno))
                {
                    $worfidno = history_workorder::where('workclassdesc',$workorder->workclassdesc)
                                ->where(function(Builder $builder) use($request){
                        $builder->where('status','On Process'); 
                                })
                                ->latest()->first();
                }
                if(empty($worfidno))
                {
                    $num = $worfidno + 1;
                    $str_length = 3;

                    // Left padding if number < $str_length
                    $newworfid = $tyear . '-' .substr("0000{$num}", -$str_length);
                    // echo sprintf($str);
                }else{
                    // $n4 = preg_replace('/[-]+/', '', $worfidno->worfid);
                    // $last3Char = substr($newworfid, -3);
                    $last3Char = substr($worfidno->worfid, -3);
                    $str_length = 3;
                    $newnumber = $last3Char + 1;
                    $newtotal = $tyear . '-' .substr("0000{$newnumber}", -$str_length);
                }
                
                // dd($workorder->workclassdesc,$worfidno,$newworfid,$last3Char,$newnumber,$newtotal);
                if (!empty($newworfid)){
                    $setnewworf = $newworfid;
                }elseif(!empty($newtotal)){
                    $setnewworf = $newtotal;
                }
               
                // dd($setnewworf);

                return view('transaction.workorder.verify',compact('workorder'))
                            ->with(['personnel' => $personnel])
                            ->with(['setnewworf' => $setnewworf]);

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
                $this->mailwostarted($workorderid);
                
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
                    'memail' => auth()->user()->email,
                    'mdtsigned' => $timenow,
                    'status' => 'For Final Submission',
                    ]);
                if($workorders){

                    $this->mailwomonitored($workorderid);

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
                    'fsemail' => auth()->user()->email,
                    'fsdeptid' => auth()->user()->deptid,
                    'fseptname' => auth()->user()->deptname,
                    'fstsigned' => $timenow,
                    'fsstatus' => 'Finalized',
                    'status' => 'Work Finalized',
                    ]);

            if($workorders){

                $this->mailwofinalized($workorderid);

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
                    'fdemail' => auth()->user()->email,
                    'fddeptid' => auth()->user()->deptid,
                    'fddeptname' => auth()->user()->deptname,
                    'fddtsigned' => $timenow,
                    'fdstatus' => 'Finalized',
                    'status' => 'Completed',
                    ]);

            if($workorders){
                $archived = workorder::query()->where('workorderid',$workorder->workorderid)
                                        ->where(function(Builder $builder){
                                            $builder->where('status', "Completed");
                                        })
                                        ->each(function ($oldRecord) {
                                            $newRecord = $oldRecord->replicate();
                                            $newRecord->setTable('history_workorder');
                                            $newRecord->save();
                                            $oldRecord->delete();
                                        });
                if($archived)
                {
                    return redirect()->route('transactionworkorder.index')
                        ->with('success','Work Order Completed and archived');
                }else{
                    return redirect()->route('transactionworkorder.index')
                    ->with('failed','Work Order Archive Failed');
                }
                
            }else{
                return redirect()->back()
                    ->with('failed','Work Order Completion Failed');
            }
        }

    }

    public function search(Request $request)
    {
        $workclass = workclass::get();

        if(auth()->user()->accessname == 'Administrator' or
            auth()->user()->accessname == 'Director' or
            auth()->user()->accessname == 'Supervisor'
        ){
            if($request->workclass != 'all'){
                $workorder = workorder::where('workclassdesc','like',"%{$request->workclass}%")
                                ->where(function(Builder $builder) use($request){
                                    $builder->orwhere('prioritydesc','like',"%{$request->search}%")
                                            ->orwhere('workorderdesc','like',"%{$request->search}%")
                                            ->orwhere('notes','like',"%{$request->search}%")
                                            ->orWhere('status','like',"%{$request->search}%"); 
                                })->orderBy('priorityid',$request->orderrow)
                                ->paginate($request->pagerow);
            }else{
                $workorder = workorder::orderBy('priorityid',$request->orderrow)
                                ->where(function(Builder $builder) use($request){
                                    $builder->orwhere('prioritydesc','like',"%{$request->search}%")
                                            ->orwhere('workorderdesc','like',"%{$request->search}%")
                                            ->orwhere('notes','like',"%{$request->search}%")
                                            ->orWhere('status','like',"%{$request->search}%"); 
                                })
                                ->paginate($request->pagerow);
            }

        }elseif(auth()->user()->accessname == 'Dept. Head'){
            if($request->workclass != 'all'){
                $workorder = workorder::where('rdeptname',auth()->user()->deptname)
                ->where('workclassdesc','like',"%{$request->workclass}%")
                ->where(function(Builder $builder) use($request){
                    $builder->orwhere('workorderdesc','like',"%{$request->search}%")
                            ->orwhere('prioritydesc','like',"%{$request->search}%")
                            ->orwhere('notes','like',"%{$request->search}%")
                            ->orWhere('status','like',"%{$request->search}%"); 
                })->orderBy('priorityid',$request->orderrow)
                ->paginate($request->pagerow);
                
            }else{
                $workorder = workorder::where('rdeptname',auth()->user()->deptname)
                ->where(function(Builder $builder) use($request){
                    $builder->orwhere('workorderdesc','like',"%{$request->search}%")
                            ->orwhere('prioritydesc','like',"%{$request->search}%")
                            ->orwhere('notes','like',"%{$request->search}%")
                            ->orWhere('status','like',"%{$request->search}%"); 
                })->orderBy('priorityid',$request->orderrow)
                ->paginate($request->pagerow);
            }
            

        }elseif(auth()->user()->accessname == 'Requester'){
            if($request->workclass != 'all'){
                $workorder = workorder::where('requesterid',auth()->user()->userid)
                ->where('workclassdesc','like',"%{$request->workclass}%")
                ->where(function(Builder $builder) use($request){
                    $builder->orwhere('workorderdesc','like',"%{$request->search}%")
                            ->orwhere('prioritydesc','like',"%{$request->search}%")
                            ->orwhere('notes','like',"%{$request->search}%")
                            ->orWhere('status','like',"%{$request->search}%");
                })->orderBy('priorityid',$request->orderrow)
                ->paginate($request->pagerow);
            }else{
                $workorder = workorder::where('requesterid',auth()->user()->userid)
                ->where(function(Builder $builder) use($request){
                    $builder->orwhere('workorderdesc','like',"%{$request->search}%")
                            ->orwhere('prioritydesc','like',"%{$request->search}%")
                            ->orwhere('notes','like',"%{$request->search}%")
                            ->orWhere('status','like',"%{$request->search}%");
                })->orderBy('priorityid',$request->orderrow)
                ->paginate($request->pagerow);
            }
            
                
        }elseif(auth()->user()->accessname == 'Personnel'){
            if($request->workclass != 'all'){
                $workorder = workorder::where('startedbyid',auth()->user()->userid)
                ->where('workclassdesc','like',"%{$request->workclass}%")
                ->where(function(Builder $builder) use($request){
                    $builder->orwhere('workorderdesc','like',"%{$request->search}%")
                            ->orwhere('prioritydesc','like',"%{$request->search}%")
                            ->orwhere('notes','like',"%{$request->search}%")
                            ->orWhere('status','like',"%{$request->search}%");
                })->orderBy('priorityid',$request->orderrow)
                ->paginate($request->pagerow);
            }else{
                $workorder = workorder::where('startedbyid',auth()->user()->userid)
                ->where(function(Builder $builder) use($request){
                    $builder->where('workclassdesc','like',"%{$request->workclass}%")
                            ->orwhere('workorderdesc','like',"%{$request->search}%")
                            ->orwhere('prioritydesc','like',"%{$request->search}%")
                            ->orwhere('notes','like',"%{$request->search}%")
                            ->orWhere('status','like',"%{$request->search}%");
                })->orderBy('priorityid',$request->orderrow)
                ->paginate($request->pagerow);
            }
            
        }
        
    
        return view('transaction.workorder.index',compact('workorder'))
            ->with(['workclass' => $workclass])
            ->with('i', (request()->input('page', 1) - 1) * $request->pagerow);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $workclass = workclass::get();
        if(auth()->user()->accessname == 'Administrator' or
            auth()->user()->accessname == 'Director' or
            auth()->user()->accessname == 'Supervisor'
        ){
            $workorder = workorder::latest()->paginate(5);
        }elseif(auth()->user()->accessname == 'Dept. Head'){
            $workorder = workorder::where('rdeptname',auth()->user()->deptname)
                                        ->latest()
                                        ->paginate(5);
        }elseif(auth()->user()->accessname == 'Requester'){
            $workorder = workorder::where('requesterid',auth()->user()->userid)
                                        ->latest()
                                        ->paginate(5);
        }elseif(auth()->user()->accessname == 'Personnel'){
            $workorder = workorder::where('startedbyid',auth()->user()->userid)
                                        ->latest()
                                        ->paginate(5);
        }

        return view('transaction.workorder.index')
                        ->with(['workorder' => $workorder])
                        ->with(['workclass' => $workclass])
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
            'title' => $request->workorderdesc,
            'description' => $workclass->workclassdesc,
            'requesterid' => auth()->user()->userid,
            'rfullname' => $fullname,
            'remail' => auth()->user()->email,
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

            $workorders = workorder::where('woimage',$path)->first();

            $workorderid = $workorders->workorderid;

            $this->mailwocreated($workorderid);
    
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

        $wosupplies = wosupplies::where('workorderid',$workorder->workorderid)->latest()->get();

        return view('transaction.workorder.show')
                    ->with(['wosupplies' => $wosupplies])
                    ->with(['workorder' => $workorder])
                    ->with('i', (request()->input('page', 1) - 1) * 5);  
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
