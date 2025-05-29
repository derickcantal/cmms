<?php

namespace App\Http\Controllers\reports;

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

class ReportHistoryWorkOrderController extends Controller
{
    public function printPDF($workorderid){
        $workorder = history_workorder::where('workorderid',$workorderid)->first();

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

    public function search(Request $request)
    {
        $workclass = workclass::get();

        if(auth()->user()->accessname == 'Administrator' or
            auth()->user()->accessname == 'Director' or
            auth()->user()->accessname == 'Supervisor'
        ){
            if($request->workclass != 'all'){
                $workorder = history_workorder::where('workclassdesc','like',"%{$request->workclass}%")
                                ->where(function(Builder $builder) use($request){
                                    $builder->orwhere('prioritydesc','like',"%{$request->search}%")
                                            ->orwhere('workorderdesc','like',"%{$request->search}%")
                                            ->orwhere('notes','like',"%{$request->search}%")
                                            ->orWhere('status','like',"%{$request->search}%"); 
                                })->orderBy('priorityid',$request->orderrow)
                                ->paginate($request->pagerow);
            }else{
                $workorder = history_workorder::orderBy('priorityid',$request->orderrow)
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
                $workorder = history_workorder::where('rdeptname',auth()->user()->deptname)
                ->where('workclassdesc','like',"%{$request->workclass}%")
                ->where(function(Builder $builder) use($request){
                    $builder->orwhere('workorderdesc','like',"%{$request->search}%")
                            ->orwhere('prioritydesc','like',"%{$request->search}%")
                            ->orwhere('notes','like',"%{$request->search}%")
                            ->orWhere('status','like',"%{$request->search}%"); 
                })->orderBy('priorityid',$request->orderrow)
                ->paginate($request->pagerow);
                
            }else{
                $workorder = history_workorder::where('rdeptname',auth()->user()->deptname)
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
                $workorder = history_workorder::where('requesterid',auth()->user()->userid)
                ->where('workclassdesc','like',"%{$request->workclass}%")
                ->where(function(Builder $builder) use($request){
                    $builder->orwhere('workorderdesc','like',"%{$request->search}%")
                            ->orwhere('prioritydesc','like',"%{$request->search}%")
                            ->orwhere('notes','like',"%{$request->search}%")
                            ->orWhere('status','like',"%{$request->search}%");
                })->orderBy('priorityid',$request->orderrow)
                ->paginate($request->pagerow);
            }else{
                $workorder = history_workorder::where('requesterid',auth()->user()->userid)
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
                $workorder = history_workorder::where('startedbyid',auth()->user()->userid)
                ->where('workclassdesc','like',"%{$request->workclass}%")
                ->where(function(Builder $builder) use($request){
                    $builder->orwhere('workorderdesc','like',"%{$request->search}%")
                            ->orwhere('prioritydesc','like',"%{$request->search}%")
                            ->orwhere('notes','like',"%{$request->search}%")
                            ->orWhere('status','like',"%{$request->search}%");
                })->orderBy('priorityid',$request->orderrow)
                ->paginate($request->pagerow);
            }else{
                $workorder = history_workorder::where('startedbyid',auth()->user()->userid)
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
        
    
        return view('reports.workorder.index',compact('workorder'))
            ->with(['workclass' => $workclass])
            ->with('i', (request()->input('page', 1) - 1) * $request->pagerow);
    }
    public function index()
    {
        $workclass = workclass::get();
        if(auth()->user()->accessname == 'Administrator' or
            auth()->user()->accessname == 'Director' or
            auth()->user()->accessname == 'Supervisor'
        ){
            $workorder = history_workorder::latest()->paginate(5);
        }elseif(auth()->user()->accessname == 'Dept. Head'){
            $workorder = history_workorder::where('rdeptname',auth()->user()->deptname)
                                        ->latest()
                                        ->paginate(5);
        }elseif(auth()->user()->accessname == 'Requester'){
            $workorder = history_workorder::where('requesterid',auth()->user()->userid)
                                        ->latest()
                                        ->paginate(5);
        }elseif(auth()->user()->accessname == 'Personnel'){
            $workorder = history_workorder::where('startedbyid',auth()->user()->userid)
                                        ->latest()
                                        ->paginate(5);
        }

        return view('reports.workorder.index')
                        ->with(['workorder' => $workorder])
                        ->with(['workclass' => $workclass])
                        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function show($workorderid)
    {
       $workorder = history_workorder::where('workorderid',$workorderid)->first();

        $wosupplies = wosupplies::where('workorderid',$workorder->workorderid)->latest()->get();

        return view('reports.workorder.show')
                    ->with(['wosupplies' => $wosupplies])
                    ->with(['workorder' => $workorder])
                    ->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
