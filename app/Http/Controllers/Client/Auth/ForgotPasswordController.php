<?php

namespace App\Http\Controllers\Client\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Notifications\SendMailForgotPassword;

class ForgotPasswordController extends Controller
{
    const PATH_VIEW = "client.password.";

    public function showFormForgotPassword() {

        return view(self::PATH_VIEW . "email");

    }

    public function sendMailReset(Request $request) {

        $user = User::where('email', $request->email)->firstOrFail();
        $token = base64_encode($user->email);
        $user->notify(new SendMailForgotPassword($token));

        return back()->with('message', "Chúng tôi đã gửi cho bạn liên kết đặt lại mật khẩu qua email.");
    }

    public function showFormResetPassword($email) {

        $email = base64_decode($email);

        return view(self::PATH_VIEW . "reset", compact('email'));
    }

    public function ResetUpdatePassword(Request $request) {
        // dd($request->toArray());
        $validaton = $request->validate([
            "email" => 'required|email',
            "password" => 'required|confirmed'
        ]);

        $user = User::query()->where("email", $request->email)->firstOrFail();

        $user->update([
            "password" => bcrypt($request->password)
        ]);

        Auth::login($user);

        request()->session()->regenerate();

        return redirect()->intended('/');
    }
}
