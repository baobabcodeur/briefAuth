<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    //

    public function sendResetLinkEmail(Request $request)
{
    $request->validate(['email' => 'required|email']);

    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return back()->withErrors(['email' => trans('passwords.user')]);
    }

    // Générer un OTP
    $otp = rand(100000, 999999);
    $user->otp_code = $otp;
    $user->otp_expires_at = Carbon::now()->addMinutes(10); // Expire dans 10 minutes
    $user->save();

    // Envoyer l'OTP par email
    Mail::raw("Votre code OTP pour réinitialiser votre mot de passe est : $otp", function ($message) use ($user) {
        $message->to($user->email)->subject('Code OTP pour réinitialiser votre mot de passe');
    });

    return back()->with('status', 'Nous avons envoyé un code OTP à votre adresse email.');
}
}
