<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function showAdminRegisterForm()
    {
        return view('admins.register');
    }

    public function registerAdmin(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => ['required', 'email', 'unique:users'],
            'password' => 'required|min:6'
        ], [
            'required' => 'Required',
        ]);

        try {
            $verificationCode = rand(100000, 999999);
            $name = $request->first_name . ' ' . $request->last_name;

            $user = User::create([
                'name' => $name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'is_admin' => '1', // admin
                'verification_code' => $verificationCode
            ]);
            try {
                Mail::send('emails.admin-verify', ['verificationCode' => $verificationCode, 'user' => $user], function ($msg) use ($user) {
                    $msg->to($user->email)
                        ->subject('Admin Email Verification');
                });
            }catch (\Exception $e) {
               \Log::error('Mail sending failed: ' . $e->getMessage());
            }

            return redirect()->route('admin.verify')->with('success', 'Check your email for verification code.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function showVerify()
    {
        return view('admins.verify');
    }

    public function verifyAdmin(Request $request)
    {
        $request->validate(['verification_code' => 'required'],['required' => 'Required',]);
        $user = User::where('verification_code', $request->verification_code)
            ->where('is_admin', '1')->first();
        if (!$user) {
            return back()->with('error', 'Invalid code.');
        }

        $user->update(['is_verified' => 1, 'verification_code' => null]);
        return redirect()->route('show.admin.login.form')->with('success', 'Your account is verified! You can login now.');
    }

    public function showAdminLoginForm()
    {
        return view('admins.login');
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return back()->with('error', 'Invalid credentials');
            }
            if (!$user || $user->is_admin == '0') {
                return back()->with('error', 'You are not allowed to login from here.');
            }

            if (!$user->is_verified) {
                return back()->with('error', 'Please verify your account first.');
            }

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_admin' => '1'])) {
                return redirect()->route('admin.dashboard');
            } else {
                return back()->with('error', 'Invalid credentials.');
            }

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function adminDashboard()
    {
        return view('admins.dashboard');
    }

    public function logout()
    {
        if (Auth::check()) {
            $user = Auth::user();

            Auth::logout();

            if ($user->is_admin == 1) {
                return redirect()->route('show.admin.login.form')->with('success', 'Admin logged out successfully');
            } else {
                return redirect()->route('user.login')->with('success', 'User logged out successfully');
            }
        }

        return redirect()->route('show.admin.login.form')->with('error', 'No active session found');
    }
}
