<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function index()
    {
        try {
            return response()->json(User::getAll(), Response::HTTP_OK); 
         } catch (\Exception $ex) {
            return json_encode(['erro' => 'Erro ao salvar novo usuário.'.$ex->getMessage()], Response::HTTP_NO_CONTENT);
         }
    }

    public function store(Request $request)
    {
        try {
            return response()->json(User::putUser($request), Response::HTTP_OK); 
         } catch (\Exception $ex) {
            return json_encode(['erro' => 'Erro ao salvar novo usuário.'.$ex->getMessage()], Response::HTTP_NO_CONTENT);
         }
    }
    
    public function show($id)
    {
        try {
            return response()->json(User::getUserById($id), Response::HTTP_OK); 
         } catch (\Exception $ex) {
            return json_encode(['erro' => 'Erro ao salvar novo usuário.'.$ex->getMessage()], Response::HTTP_NO_CONTENT);
         }
    }

    public function update(Request $request, $id)
    {
        try {
            return response()->json(User::updateUserById($request, $id), Response::HTTP_OK); 
         } catch (\Exception $ex) {
            return json_encode(['erro' => 'Erro ao salvar novo usuário.'.$ex->getMessage()], Response::HTTP_NO_CONTENT);
         }
    }

    public function destroy($id)
    {
        try {
            return response()->json(User::deleteUserById($id), Response::HTTP_OK); 
         } catch (\Exception $ex) {
            return json_encode(['erro' => 'Erro ao salvar novo usuário.'.$ex->getMessage()], Response::HTTP_NO_CONTENT);
         }
    }
}
