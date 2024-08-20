<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use App\Models\User;
use App\Mail\OtpMail;
use App\Mail\ForgetPasswordMail;
use App\Models\AdditionalInfo;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    // Show login form
    public function showLoginForm()
    {
        return view('front.login');
    }

    // Handle login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Attempt to authenticate user
        if (Auth::attempt($credentials)) {
            // Check user status before redirecting
            $user = Auth::user();

            if ($user->status == 1) {
                return redirect()->route('dashboard');
            } else {
                Auth::logout(); // Logout the user if status is not 1
                return redirect()->route('users.login')->withErrors('Your account is not active. Please contact support.');
            }
        }

        return redirect()->route('users.login')->withErrors('Invalid credentials');
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('users.login');
    }

    // Show signup form
    public function showSignupForm()
    {
        return view('front.signup');
    }

    // Handle signup
    public function postSignup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'mobile_number' => 'required',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'address' => 'required|string',
            'country' => 'required|string',
            'city' => 'required|string',
            'postal_code' => 'required|string',
            'citizenship' => 'required|string',
            'passport_number' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => 2,
                'mobile_number' => $request->mobile_number,
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
                'address' => $request->address,
                'country' => $request->country,
                'city' => $request->city,
                'postal_code' => $request->postal_code,
                'citizenship' => $request->citizenship,
                'passport_number' => $request->passport_number,
            ]);
            if ($user) {
                $AdditionalInfo = new AdditionalInfo;
                $AdditionalInfo->user_id = $user->id;
                $AdditionalInfo->save();

                $otp = $this->generateUniqueOtp();
                $otpExpiresAt = now()->addMinutes(15);

                $data = User::find($user->id);
                $data->otp = $otp;
                $data->expires_at = $otpExpiresAt;
                $data->update();

                Mail::to($user->email)->send(new OtpMail($otp, $user->name, $otpExpiresAt));

                return redirect()->route('users.otp')->with('success', 'OTP has been resent.');
            } else {
                return back()->with('error', 'Failed to create user. Please try again.');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    // Show otp form
    public function otp()
    {
        return view('front.otp');
    }

    public function resendOtp()
    {
        return view('front.resend-otp');
    }

    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otp' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }

        $user = User::where('otp', $request->otp)->first();

        if ($user) {
            // Check if OTP is not expired

            if ($user->expires_at > now()->subMinutes(15)) {
                if ($user->otp == $request->otp && $user->otp_verified === 0) {
                    $user->status = 1;
                    $user->otp_verified = 1;
                    $user->otp = null; // Clear OTP
                    $user->expires_at = null; // Clear OTP expiration
                    $user->save();

                    return redirect()->route('user.login')->with('success', 'OTP Verified Successfully. Please log in.');
                }
            } else {
                return back()->with('error', 'The OTP has expired.');
            }
        }

        return back()->with('error', 'Failed to verify OTP.');
    }

    public function postResendOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $otp = $this->generateUniqueOtp();
            $otpExpiresAt = now()->addMinutes(15);

            $user->otp = $otp;
            $user->expires_at = $otpExpiresAt;
            $user->update();

            Mail::to($user->email)->send(new OtpMail($otp, $user->name, $otpExpiresAt));

            return redirect()->route('users.otp')->with('success', 'OTP has been resent.');
        }

        return back()->with('error', 'Failed to Send OTP.');
    }

    public function showForgotPassword()
    {
        return view('front.forgot-password');
    }

    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'User not found.');
        }

        $token = Str::random(60);

        DB::table('password_reset')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => $token,
                'pin' => rand(100000, 999999),
                'expires_at' => Carbon::now()->addMinutes(60),
                'created_at' => now()
            ]
        );

        $encryptedID = Crypt::encryptString($user->id);

        // Send email with reset link
        Mail::to($user->email)->send(new ForgetPasswordMail($user->name, $encryptedID));

        return back()->with('success', 'Password reset link has been sent to your email.');
    }

    public function showResetPasswordForm($id)
    {
        $decryptedID = Crypt::decryptString($id);
        return view('front.forget-password-link', ['id' => $decryptedID]);
    }

    public function postResetPasswordForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }

        $user = User::where('id', $request->id)->first();
        $user->password = Hash::make($request->input('password'));
        $user->update();

        DB::table('password_reset')->where(['email' => $user->email])->delete();

        return redirect()->route('users.login')->with('success', 'Your password has been changed!');
    }

    private function generateUniqueOtp()
    {
        $otp = rand(100000, 999999);

        $existingOtpCount = DB::table('users')->where('otp', $otp)->count();

        if ($existingOtpCount > 0) {
            return $this->generateUniqueOtp();
        }

        return $otp;
    }
}
