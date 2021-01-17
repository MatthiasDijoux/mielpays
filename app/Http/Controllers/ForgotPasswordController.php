<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function sendResetLinkResponse(Request $request, $response)
    {
        return response()->json(['status' => 200, 'message' => 'Nous vous avons envoyé un e-mail pour changer votre mot de passe']);
    }

    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        return response()->json(['status' => 401, 'email' => 'Reessayez']);
    }
}