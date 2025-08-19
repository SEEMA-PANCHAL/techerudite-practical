<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class CustomerAuthController extends Controller
{
    public function showCustomerRegisterForm(){
        return view('customers.register');
    }

    public function registerCustomer(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name'  => 'required|string',
            'email'      => 'required|email|unique:users',
            'password'   => 'required|min:6',
        ],[
            'required' => 'Required',
        ]);
        try {
            
            $verificationCode = rand(100000, 999999);
            $name = $request->first_name .''. $request->last_name;
            $user = User::create([
                'name' => $name,
                'email'      => $request->email,
                'password'   => Hash::make($request->password),
                'is_admin'   => '0', // customer
                'verification_code' => $verificationCode
            ]);
            try {
                Mail::send('emails.customer-verify', ['verificationCode' => $verificationCode, 'user' => $user], function ($msg) use ($user) {
                        $msg->to($user->email)
                        ->subject('Email Verification');
                    });
             } catch (\Exception $e) {
               \Log::error('Mail sending failed: ' . $e->getMessage());
            }

            return redirect()->route('show.customer.verify.form')->with('success','Check your email for verification code.');

         } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function showCustomerVerify() {
        return view('customers.verify');
    }

    public function verifyCustomer(Request $request) {
        $request->validate(['verification_code' => 'required'],['required' => 'Required',]);
        
        $user = User::where('verification_code',$request->verification_code)
                    ->where('is_admin','0')->first();

        if(!$user){
            return back()->with('error','Invalid code.');
        }

        $user->update(['is_verified'=>1,'verification_code'=>null]);
        return redirect()->route('show.customer.register.form')->with('success','Your account is verified!');
    }

}
