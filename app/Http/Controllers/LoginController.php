<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        try {
            $userData = array(
                'email' => $request->email,
                'password' => $request->password
            );
            if (Auth::attempt($userData)) {
                return response()->json(['success' => true, 'url' => route('students.list')], 200);
            } else {
                throw new \Exception('Usuário com os dados informados não se encontra no sistema.');
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
