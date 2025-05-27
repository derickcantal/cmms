<?php

namespace App\Http\Controllers\transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\workorder;
use App\Models\schedule;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;

class TransactionCalendarController extends Controller
{
    public function index(Request $request)
    {
        return view('transaction.calendar.index');
    }

    public function getevents(){
        $data = workorder::all();

             return response()->json($data);
    }
}
