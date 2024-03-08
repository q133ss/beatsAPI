<?php

namespace App\Services\ForgotController;

use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotService
{
    public function forgot(string $email): \Illuminate\Http\JsonResponse
    {
        $token = Str::random(15);
        DB::table('password_resets')->insert(['email' => $email, 'token' => $token]);

        Mail::to($email)->send(new ResetPasswordMail($token));

        return Response()->json(['message' => 'На вашу почту отправленно письмо']);
    }

    public function check(array $data): \Illuminate\Http\JsonResponse
    {
        $table = DB::table('password_resets')
            ->where('token', $data['token'])
            ->where('email', $data['email']);
        if($table->exists()){
            return Response()->json(['message' => 'Токен верный'], 200);
        }else{
            return Response()->json(['message' => 'Неверный токен'], 403);
        }
    }
}
