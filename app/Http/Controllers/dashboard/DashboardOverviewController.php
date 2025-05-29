<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\workorder;
use App\Models\history_workorder;
use App\Models\schedule;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;


class DashboardOverviewController extends Controller
{
    public function admindata()
    {
        $wonewdata = workorder::where('status','For Approval')
                                ->get();
        $wonew = collect($wonewdata)->count('status');

        $woupdata = workorder::where('status','For GSO Approval')
                                ->get();
        $woup = collect($woupdata)->count('status');

        $woemdata = workorder::where('prioritydesc','Emergency')
                                ->get();
        $woem = collect($woemdata)->count('prioritydesc');

        $woimdata = workorder::where('prioritydesc','Immediate')
                                ->get();
        $woim = collect($woimdata)->count('prioritydesc');

        $womoddata = workorder::where('prioritydesc','Moderate')
                                ->get();
        $womod = collect($womoddata)->count('prioritydesc');

        $wolowdata = workorder::where('prioritydesc','Low')
                                ->get();
        $wolow = collect($wolowdata)->count('prioritydesc');

        $wocomdata = history_workorder::where('status','Completed')
                                ->get();
        $wocom = collect($wocomdata)->count('status');

        return view('dashboard.overview.index')
                ->with(['wonew' => $wonew])
                ->with(['woup' => $woup])
                ->with(['woem' => $woem])
                ->with(['woim' => $woim])
                ->with(['womod' => $womod])
                ->with(['wolow' => $wolow])
                ->with(['wocom' => $wocom]);
    }

    public function personneldata()
    {
        $wonewdata = workorder::where('status','For Approval')
                                ->get();
        $wonew = 'N/A';

        $woupdata = workorder::where('status','For GSO Approval')
                                ->get();
        $woup = 'N/A';

        $woemdata = workorder::where('startedbyid',auth()->user()->userid)
                                ->where('prioritydesc','Emergency')
                                ->get();
        $woem = collect($woemdata)->count('prioritydesc');

        $woimdata = workorder::where('startedbyid',auth()->user()->userid)
                                ->where('prioritydesc','Immediate')
                                ->get();
        $woim = collect($woimdata)->count('prioritydesc');

        $womoddata = workorder::where('startedbyid',auth()->user()->userid)
                                ->where('prioritydesc','Moderate')
                                ->get();
        $womod = collect($womoddata)->count('prioritydesc');

        $wolowdata = workorder::where('startedbyid',auth()->user()->userid)
                                ->where('prioritydesc','Low')
                                ->get();
        $wolow = collect($wolowdata)->count('prioritydesc');

        $wocomdata = history_workorder::where('startedbyid',auth()->user()->userid)
                                ->where('status','Completed')
                                ->get();
        $wocom = collect($wocomdata)->count('status');

        return view('dashboard.overview.index')
                ->with(['wonew' => $wonew])
                ->with(['woup' => $woup])
                ->with(['woem' => $woem])
                ->with(['woim' => $woim])
                ->with(['womod' => $womod])
                ->with(['wolow' => $wolow])
                ->with(['wocom' => $wocom]);
    }

    public function rdata()
    {
        $wonewdata = workorder::where('requesterid',auth()->user()->userid)
                                ->where('status','For Approval')
                                ->get();
        $wonew = collect($wonewdata)->count('status');

        $woupdata = workorder::where('requesterid',auth()->user()->userid)
                                ->where('status','For GSO Approval')
                                ->get();
        $woup = collect($woupdata)->count('status');

        $woemdata = workorder::where('requesterid',auth()->user()->userid)
                                ->where('prioritydesc','Emergency')
                                ->get();
        $woem = collect($woemdata)->count('prioritydesc');

        $woimdata = workorder::where('requesterid',auth()->user()->userid)
                                ->where('prioritydesc','Immediate')
                                ->get();
        $woim = collect($woimdata)->count('prioritydesc');

        $womoddata = workorder::where('requesterid',auth()->user()->userid)
                                ->where('prioritydesc','Moderate')
                                ->get();
        $womod = collect($womoddata)->count('prioritydesc');

        $wolowdata = workorder::where('requesterid',auth()->user()->userid)
                                ->where('prioritydesc','Low')
                                ->get();
        $wolow = collect($wolowdata)->count('prioritydesc');

        $wocomdata = history_workorder::where('requesterid',auth()->user()->userid)
                                ->where('status','Completed')
                                ->get();
        $wocom = collect($wocomdata)->count('status');

        return view('dashboard.overview.index')
                ->with(['wonew' => $wonew])
                ->with(['woup' => $woup])
                ->with(['woem' => $woem])
                ->with(['woim' => $woim])
                ->with(['womod' => $womod])
                ->with(['wolow' => $wolow])
                ->with(['wocom' => $wocom]);
    }

    public function hdata()
    {
        $wonewdata = workorder::where('rdeptname',auth()->user()->deptname)
                                ->where('status','For Approval')
                                ->get();
        $wonew = collect($wonewdata)->count('status');

        $woupdata = workorder::where('rdeptname',auth()->user()->deptname)
                                ->where('status','For GSO Approval')
                                ->get();
        $woup = collect($woupdata)->count('status');

        $woemdata = workorder::where('rdeptname',auth()->user()->deptname)
                                ->where('prioritydesc','Emergency')
                                ->get();
        $woem = collect($woemdata)->count('prioritydesc');

        $woimdata = workorder::where('rdeptname',auth()->user()->deptname)
                                ->where('prioritydesc','Immediate')
                                ->get();
        $woim = collect($woimdata)->count('prioritydesc');

        $womoddata = workorder::where('rdeptname',auth()->user()->deptname)
                                ->where('prioritydesc','Moderate')
                                ->get();
        $womod = collect($womoddata)->count('prioritydesc');

        $wolowdata = workorder::where('rdeptname',auth()->user()->deptname)
                                ->where('prioritydesc','Low')
                                ->get();
        $wolow = collect($wolowdata)->count('prioritydesc');

        $wocomdata = history_workorder::where('rdeptname',auth()->user()->deptname)
                                ->where('status','Completed')
                                ->get();
        $wocom = collect($wocomdata)->count('status');

        return view('dashboard.overview.index')
                ->with(['wonew' => $wonew])
                ->with(['woup' => $woup])
                ->with(['woem' => $woem])
                ->with(['woim' => $woim])
                ->with(['womod' => $womod])
                ->with(['wolow' => $wolow])
                ->with(['wocom' => $wocom]);
    }

    public function index(Request $request)
    {
        if(auth()->user()->accessname == 'Administrator' or
           auth()->user()->accessname == 'Director' or
           auth()->user()->accessname == 'Supervisor')
           {
            return $this->admindata();
        }
        elseif(auth()->user()->accessname == 'Dept. Head'){
            return $this->hdata();
        }
        elseif(auth()->user()->accessname == 'Requester')
        {
            return $this->rdata();
        }
        elseif(auth()->user()->accessname == 'Personnel'){
            return $this->personneldata();
        }
    }

    public function getevents(){
        $data = workorder::all();

             return response()->json($data);
    }

}
