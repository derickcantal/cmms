<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Models\temp_users;
use App\Models\User;
use App\Models\access;
use App\Models\department;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use \Carbon\Carbon; 

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $access = access::where('accessname','!=','Administrator')->get();
        $department = department::get();

        return view('auth.register')
                        ->with(['access' => $access])
                        ->with(['department' => $department]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $access = access::where('accessid',$request->access)->first();
        $department = department::where('deptid',$request->department)->first();

        $timenow = Carbon::now()->timezone('Asia/Manila')->format('Y-m-d H:i:s');
        
        $n1 = strtoupper($request->firstname[0]);
        $n3 = strtoupper($request->lastname[0]);
        $n4 = preg_replace('/[-]+/', '', $request->birthdate);

        $newpassword = $n1 . $n3 . $n4;

        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'birthdate' => ['required', 'string', 'max:255'],
            'access' => ['required', 'string', 'max:255'],
            'department' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class,'unique:'.temp_users::class],
            // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $temp_users = temp_users::create([
            'avatar' => 'avatars/avatar-default.jpg',
            'username' => $request->email,
            'email' => $request->email,
            'password' => Hash::make($newpassword),
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'birthdate' => $request->birthdate,
            'mobile_primary' => $request->mobile,
            'accessid' => $access->accessid,
            'accessname' => $access->accessname,
            'deptid' => $department->deptid,
            'deptname' => $department->deptname,
            'created_by' => 'Self Registration',
            'updated_by' => 'Null',
            'timerecorded' => $timenow,
            'modifiedid' => 0,
            'mod' => 0,
            'notes' => $request->notes,
            'status' => 'For Approval',
        ]);
        if($temp_users){
            return redirect()->route('register')
                        ->with('success','User creation success. Please wait for Admin Approval');
        }else{
            return redirect()->route('register')
                        ->with('failed','User creation failed. Please Contact Administrator');
        }
        

        // $user = User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        // ]);

        // event(new Registered($user));

        // Auth::login($user);

        // return redirect(route('dashboard', absolute: false));
    }
}
