<?php

namespace App\Http\Controllers\manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\department;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use \Carbon\Carbon; 

class ManageDepartmentController extends Controller
{
    public function search(Request $request)
    {
        $department = department::orderBy('deptname',$request->orderrow)
                ->where(function(Builder $builder) use($request){
                    $builder->where('deptname','like',"%{$request->search}%")
                            ->orWhere('status','like',"%{$request->search}%"); 
                            
                })->paginate($request->pagerow);
    
        return view('manage.users.index',compact('user'))
            ->with('i', (request()->input('page', 1) - 1) * $request->pagerow);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $department = department::paginate(5);

        return view('manage.department.index')
                        ->with(['department' => $department])
                        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
       return view('manage.department.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $timenow = Carbon::now()->timezone('Asia/Manila')->format('Y-m-d H:i:s');

        $department = department::create([
            'deptname' => $request->department,
            'notes' => $request->notes,
            'created_by' => auth()->user()->email,
            'updated_by' => 'Null',
            'timerecorded' => $timenow,
            'modifiedid' => 0,
            'mod' => 0,
            'status' => 'Active',
        ]);
    
        if ($department) {
    
            return redirect()->route('managedepartment.index')
                        ->with('success','Department created successfully.');
        }else{

            return redirect()->route('managedepartment.index')
                        ->with('failed','Department creation failed');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($deptid)
    {
        $department = department::where('deptid',$deptid)->first();

        return view('manage.department.show')
                    ->with(['department' => $department]); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($deptid)
    {
        $department = department::where('deptid',$deptid)->first();

        return view('manage.department.edit')
                    ->with(['department' => $department]); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $deptid)
    {

        $departmentid = department::where('deptid',$deptid)->first();

        $timenow = Carbon::now()->timezone('Asia/Manila')->format('Y-m-d H:i:s');

        $mod = 0;
        $mod = $departmentid->mod;

            $department = department::where('deptid',$departmentid->deptid)->update([
                'deptname' => $request->department,
                'notes' => $request->notes,
                'updated_by' => auth()->user()->email,
                'mod' => $mod + 1,
                'status' => $request->status,
            ]);
            if($department){
               
                return redirect()->route('managedepartment.index')
                            ->with('success','Department updated successfully');
            }else{

                return redirect()->route('managedepartment.index')
                            ->with('failed','Department update failed');
            }
      
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($deptid)
    {
        $department = department::where('deptid', $deptid)->first();
        $timenow = Carbon::now()->timezone('Asia/Manila')->format('Y-m-d H:i:s');

        if($department->status == 'Active')
        {
            department::where('deptid', $department->deptid)
            ->update([
            'status' => 'Inactive',
        ]);



        return redirect()->route('managedepartment.index')
            ->with('success','Department Decativated successfully');
        }
        elseif($department->status == 'Inactive')
        {
            department::where('deptid', $department->deptid)
            ->update([
            'status' => 'Active',
        ]);


        return redirect()->route('managedepartment.index')
            ->with('success','Department Activated successfully');
        }
    }
}
