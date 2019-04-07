<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
class UserController extends Controller
{
    public function store(Request $request)
    {
        $user = User::create(["email" => $request->email, "password" => \Hash::make($request->password), "name" => $request->name, "url" => $request->url]);
        $token = \Str::random(60);

        $user->forceFill([
            'api_token' => hash('sha256', $token),
        ])->save();
        return [
            "api_token" => $token
        ];
    }
    public function login(Request $request)
    {
        $user = User::where("email", '=', $request->email)->first();
        if ($user) {
            if (\Hash::check($request->password, $user->password)) {
                $token = \Str::random(60);

                $user->forceFill([
                    'api_token' => hash('sha256', $token),
                ])->save();
                return [
                    "api_token" => $token
                ];
            }
        }
    }
}
