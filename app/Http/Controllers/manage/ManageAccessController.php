<?php

namespace App\Http\Controllers\manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\access;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use \Carbon\Carbon; 

class ManageAccessController extends Controller
{
    public function search(Request $request)
    {
        $access = access::orderBy('accessname',$request->orderrow)
                ->where(function(Builder $builder) use($request){
                    $builder->where('accessname','like',"%{$request->search}%")
                            ->orWhere('status','like',"%{$request->search}%"); 
                            
                })->paginate($request->pagerow);
    
        return view('manage.access.index',compact('access'))
            ->with('i', (request()->input('page', 1) - 1) * $request->pagerow);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $access = access::paginate(5);

        return view('manage.access.index')
                        ->with(['access' => $access])
                        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manage.access.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $timenow = Carbon::now()->timezone('Asia/Manila')->format('Y-m-d H:i:s');

        $access = access::create([
            'accessname' => $request->access,
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
    
        if ($access) {
    
            return redirect()->route('manageaccess.index')
                        ->with('success','Access created successfully.');
        }else{

            return redirect()->route('manageaccess.index')
                        ->with('failed','Access creation failed');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($accessid)
    {
        $access = access::where('accessid',$accessid)->first();

        return view('manage.access.show')
                    ->with(['access' => $access]); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($accessid)
    {
        $access = access::where('accessid',$accessid)->first();

        return view('manage.access.edit')
                    ->with(['access' => $access]); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $accessid)
    {
        $accessid = access::where('accessid',$accessid)->first();

        $timenow = Carbon::now()->timezone('Asia/Manila')->format('Y-m-d H:i:s');

        $mod = 0;
        $mod = $accessid->mod;

            $access = access::where('accessid',$accessid->deptid)->update([
                'accessname' => $request->access,
                'notes' => $request->notes,
                'updated_by' => auth()->user()->email,
                'mod' => $mod + 1,
                'status' => $request->status,
            ]);
            if($access){
               
                return redirect()->route('manageaccess.index')
                            ->with('success','Access updated successfully');
            }else{

                return redirect()->route('manageaccess.index')
                            ->with('failed','Access update failed');
            }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($accessid)
    {
        $access = access::where('accessid', $accessid)->first();
        $timenow = Carbon::now()->timezone('Asia/Manila')->format('Y-m-d H:i:s');

        if($access->status == 'Active')
        {
            access::where('accessid', $access->accessid)
            ->update([
            'status' => 'Inactive',
        ]);



        return redirect()->route('manageaccess.index')
            ->with('success','Access Decativated successfully');
        }
        elseif($access->status == 'Inactive')
        {
            access::where('accessid', $access->accessid)
            ->update([
            'status' => 'Active',
        ]);


        return redirect()->route('manageaccess.index')
            ->with('success','Access Activated successfully');
        }
    }
}
