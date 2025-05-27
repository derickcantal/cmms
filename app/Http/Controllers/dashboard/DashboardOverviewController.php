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
    public function wonew()
    {
        

    }

    public function index(Request $request)
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

        // dd($workorder,$wonew);

        return view('dashboard.overview.index')
                ->with(['wonew' => $wonew])
                ->with(['woup' => $woup])
                ->with(['woem' => $woem])
                ->with(['woim' => $woim])
                ->with(['womod' => $womod])
                ->with(['wolow' => $wolow])
                ->with(['wocom' => $wocom])
                ;
    }

    public function getevents(){
        $data = workorder::all();

             return response()->json($data);
    }

}
