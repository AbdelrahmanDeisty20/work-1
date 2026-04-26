<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Auth;
class AuthController extends Controller
{

    public function register(){
        
    
        return view('work.register');
    }
    //________________________________________________________________________________________________________


    public function registeruser(Request $request){
        
        $validatedData = $request->validate([
            'name'=>'required|string',
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        $user= User::create([
            'name'=> $validatedData['name'],
            'email'=>$validatedData['email'],
            'password'=>Hash::make($validatedData['password'])
        ]);
        return view('work.login');
    }

    //__________________________________________________________________________________________________________
    public function login()
    {
        return view('work.login');
    }
    public function loginuser(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $user = User::where('email', $validatedData['email'])->first();
        
        if (!$user) {
            return back()->withErrors([
                'email' => 'هذا البريد الإلكتروني غير مسجل لدينا.',
            ])->withInput();
        }

        if (!Hash::check($validatedData['password'], $user->password)) {
            return back()->withErrors([
                'password' => 'كلمة المرور غير صحيحة.',
            ])->withInput();
        }
        Auth::login($user);

        return redirect()->route('index');
    }
    //______________________________________________________________________________________________________________
    
    public function logout()
    {
        auth()->guard('web')->logout();

        return view('work.login');
        
    }


}