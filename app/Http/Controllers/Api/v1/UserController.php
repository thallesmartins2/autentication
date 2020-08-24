<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return response()->json(User::getAll(), Response::HTTP_OK); 
         } catch (\Exception $ex) {
            return json_encode(['erro' => 'Erro ao salvar novo usuário.'.$ex->getMessage()], Response::HTTP_NO_CONTENT);
         }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            return response()->json(User::putUser($request), Response::HTTP_OK); 
         } catch (\Exception $ex) {
            return json_encode(['erro' => 'Erro ao salvar novo usuário.'.$ex->getMessage()], Response::HTTP_NO_CONTENT);
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            return response()->json(User::getUserById($id), Response::HTTP_OK); 
         } catch (\Exception $ex) {
            return json_encode(['erro' => 'Erro ao salvar novo usuário.'.$ex->getMessage()], Response::HTTP_NO_CONTENT);
         }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            return response()->json(User::updateUserById($request, $id), Response::HTTP_OK); 
         } catch (\Exception $ex) {
            return json_encode(['erro' => 'Erro ao salvar novo usuário.'.$ex->getMessage()], Response::HTTP_NO_CONTENT);
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            return response()->json(User::deleteUserById($id), Response::HTTP_OK); 
         } catch (\Exception $ex) {
            return json_encode(['erro' => 'Erro ao salvar novo usuário.'.$ex->getMessage()], Response::HTTP_NO_CONTENT);
         }
    }
}
