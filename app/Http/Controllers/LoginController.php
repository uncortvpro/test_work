<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

class LoginController extends Controller
{
    public $users = [
        ['id'=>1,'name'=>'Артем','last_name'=>'Баринов','email'=>'barinov21@gmail.com','123456'],
        ['id'=>2,'name'=>'Максим','last_name'=>'Тульский','email'=>'tulamaks@gmail.com','qwerty123'],
        ['id'=>3,'name'=>'Марк','last_name'=>'Твен','email'=>'mark_tven1992@gmail.com','tven1992']
    ];
    public function register(Request $request){
        if($request->ajax()){
            $validated = Validator::make($request->all(),[
               'name' => 'required|min:2|max:70',
               'last_name' => 'required|min:2|max:70',
               'email' => 'required|min:5|max:255|email',
               'password' => 'required|min:6|max:70',
               'confirm_password' => 'required|same:password',
            ]);

            if ($validated->passes()) {
                return response()->json(['success'=>'Registration completed successfully!']);
            }
            foreach ($this->users as $user){
                if($user['email']==$request->input('email')){
                    return response()->json(['error_email'=>'This email already exists!']);
                }
            }
            if($validated->errors()->all())
            return response()->json(['error'=>$validated->errors()->all()]);
        }
        return view('register');
    }
}
