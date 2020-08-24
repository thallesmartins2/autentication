<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginFormRequest;
use App\User;

class AuthController extends Controller
{
    public function solicitaToken(LoginFormRequest $request)
    {
        if ($request->validated()) {

            $credenciais = [
                'email' => $request->email,
                'password' => $request->password
            ];

            if (!Auth::attempt($credenciais)) {
                return response()->json(['mensagem'=>'Acesso negado' , 'dados' => ''], Response::HTTP_NON_AUTHORITATIVE_INFORMATION);
            }

            $user = $request->user();
            try {
              $objToken = $user->createToken('Token de acesso');
            } catch (\Exception $e) {
              return response()->json(['mensagem'=>'Erro de dependencia! Verifique passport.' , 'dados' => ''], Response::HTTP_NOT_IMPLEMENTED);
            }
            $strToken = $objToken->accessToken;
            $usuario = [
                        'user' => $user,
                        'token' => $strToken
                        ];


            return response()->json($usuario, Response::HTTP_OK);
        } else {
            return response()->json(['mensagem' => 'Todos os campos devem ser preenchidos', 'dados' =>''], Response::HTTP_NON_AUTHORITATIVE_INFORMATION);
        }
    }
    
    public function logout(Request $request)
    {
        if ($request->user()->token()->revoke()) {
            return response()->json(['mensagem'=>'Token revogado'], Response::HTTP_OK);
        } else {
            return response()->json(['mensagem'=>'Token revogado'], Response::HTTP_NON_AUTHORITATIVE_INFORMATION);
        }
    }
    
    public function acessoNaoAutorizado()
    {
        return response()->json(['mensagem'=>'Token invalido', 'dados' => ''],Response::HTTP_NON_AUTHORITATIVE_INFORMATION);
    }

    public function acessoAutorizado()
    {
        return response()->json(['mensagem' => 'valido','dados' => ''], Response::HTTP_OK);
    }
}
