<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


class PasswordController extends Controller
{
    public function showForgotPasswordForm()
    {
        return view('auth.password');
    }
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);
        $token = Str::random(10);
        DB::table('password_resets')->UpdateOrInsert(
            ['email'=>$request->email],
            ['email'=>$request->email,
                'token'=>$token,
                'created_at'=>Carbon::now()]
        );
        $resetLink = route('password.reset') . '?token=' . $token . '&email=' . $request->email;
        Mail::send('email.reset-password', ['resetLink' => $resetLink], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });
        return back()->with('status', 'We have e-mailed your password reset link!');
    }

    public function showResetPasswordForm(Request $request)
    {
        $request->validate(['token' => 'required', 'email' => 'required|email']);
        return view('auth.reset-password', ['token' => $request->token, 'email' => $request->email]);
    }
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6|confirmed',
        ]);
        $passwordReset = DB::table('password_resets')
            ->where('email', $request->email)->first();
        if (!$passwordReset || !Hash::check($request->token, $passwordReset->token)) {
            return back()->withErrors(['token' => 'Invalid token.']);
        }
        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();
        DB::table('password_resets')->where('email', $request->password)->delete();
        return redirect('/login')->with('status', 'Your password has been reset!');
    }
}
