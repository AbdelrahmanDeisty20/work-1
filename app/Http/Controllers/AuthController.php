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
            'name'=>'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ], [
            'name.required' => 'يجب إدخال الاسم.',
            'name.string' => 'الاسم يجب أن يكون نصاً.',
            'name.max' => 'الاسم لا يجب أن يتجاوز 255 حرفاً.',
            'email.required' => 'يجب إدخال البريد الإلكتروني.',
            'email.email' => 'يجب إدخال بريد إلكتروني صحيح.',
            'email.unique' => 'هذا البريد الإلكتروني مسجل بالفعل.',
            'password.required' => 'يجب إدخال كلمة المرور.',
            'password.min' => 'كلمة المرور يجب ألا تقل عن 8 أحرف.',
        ]);
        
        $user= User::create([
            'name'=> $validatedData['name'],
            'email'=>$validatedData['email'],
            'password'=>Hash::make($validatedData['password'])
        ]);
        return redirect()->route('login')->with('success', 'تم إنشاء الحساب بنجاح! يمكنك الآن تسجيل الدخول.');
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
        ], [
            'email.required' => 'يجب إدخال البريد الإلكتروني.',
            'email.email' => 'يجب إدخال بريد إلكتروني صحيح.',
            'password.required' => 'يجب إدخال كلمة المرور.',
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