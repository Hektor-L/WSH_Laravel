<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function returnUsers() {
        //O site pega todas as instâncias de usuários.
        $users = User::all();
        //Retorna a lista completa de usuários
        return response($users);
    }
    public function viewUser(int $id) {
        try {
            $user = User::find($id);
            return response($user, 200);
        //se der falha, cospe mensagem de erro.
        } catch (\Exception $e) {
            return response('Erro ao carregar: ' . $e->getMessage(), 400);
        }
    }
}
