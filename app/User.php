<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Eloquent\SoftDeletes;

use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes;

    protected $table ='user';

    protected $fillable = [
        'name',
        'email',
        'cpf_cnpj',
        'email',
        'user_type_id',
        'password'
    ];

    protected const USER = ['name', 'email', 'cpf_cnpj', 'email', 'user_type_id', 'password'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getAll()
    {
        return self::all();
    }

    public static function getUserById($id)
    {
        return self::find($id);
    }

    public static function updateUserById($request, $id)
    {
        DB::beginTransaction();
        if (self::verifyInputUser($request->all())) {
            self::find($id)->update($request->all());
            DB::commit();
            return ['mensagem' => 'Usuário editado com sucesso'];
        } else {
            return ['mensagem' => 'Falha ao editar usuário '];
        }
    }

    public static function getUser($email)
    {
        return User::where('email','=',$email)->first();
    }

    public static function putUser($request)
    {
        DB::beginTransaction();
        if (self::verifyInputUser($request->all())) {
            try {
                self::create($request->all());
                DB::commit();
                return ['mensagem' => 'Usuário criado com sucesso'];
            } catch (\Throwable $th) {
                return ['mensagem' => 'Falha ao criar novo usuário '];
            }
        } else {
            return ['mensagem' => 'Favor inserir os campos corretamente'];
        }

    }

    public static function deleteUserById($id)
    {
        DB::beginTransaction();
        try {
            self::find($id)->delete();
            DB::commit();
            return ['mensagem' => 'Usuário deletado com sucesso'];
        } catch (\Throwable $th) {
            return ['mensagem' => 'Falha ao deletar novo usuário '];
        }
    }

    public static function verifyInputUser($formUser)
    {
        $validation = true;
        foreach ($formUser as $key => $value) {
            if (!in_array($key, self::USER)) {
                $validation = false;
            }
        }
        return $validation;
    }

    public static function getUserPorId($user_id)
    {
        return self::find($user_id);
    }
}
