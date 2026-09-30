<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function login(Request $request) {
        if (!Auth::attempt($request->only('email','password'))) {
            return response()->json([
                'status' => 'error',
                'message' => 'Credenciais inválidas!'
            ], 401);
        }
        $user = User::where('email', $request['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'status' => 'success',
            'message' => 'Login realizado com sucesso!',
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'password' => $user->password,
                'description' => $user->description,
                'birth_date' => $user->birth_date,
                'created_at' => $user->created_at,
                'type' => $user->type,
                'token' => $token,
                'token_type' => 'Bearer'
            ]
        ]);
    }
    public function logout(Request $request) {
        Auth::user()->currentAccessToken()->delete();
        auth()->guard('web')->logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Logout realizado com sucesso!'
        ]);
    }
    public function createUser(Request $request) {
        try {
            //Armazena as informações dadas
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->type = $request->type;
            $user->password = bcrypt($request->password);
            $user->save();
            $token = $user->createToken('auth_token')->plainTextToken;
            //Mensagem de êxito.
            return response()->json([
                'status' => 'success',
                'message' => 'Usuário armazenado com sucesso!',
                'data' => [
                    'token' => $token,
                    'token_type' => 'Bearer'
                ]
            ], 201);
            //Mensagem de erro.
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erro ao armazenar: ' . $e->getMessage()
            ], 400);
        }
        
    }
    public function updateUser(Request $request, int $id) {
        try {
            //Armazena a atualização da user.
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->type = $request->type;
            $user->password = bcrypt($request->password);
            $user->birth_date = $request->birth_date;
            $user->description = $request->description;
            $user->save();
            //mensagem de êxito.
            return response()->json([
                'status' => 'success',
                'message' => 'Usuário atualizado com sucesso!'
            ]);
            //Mensagem de erro.
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erro ao atualizar: ' . $e->getMessage()
            ], 400);
        }   
    }
    public function destroy(Request $request) {
        try {
            //Exclui a user requerida.
            $user = $request->user();
            $user->comments()->forceDelete();
            $user->posts()->forceDelete();
            $user->interests()->delete();
            $user->forceDelete();
            //Mensagem de êxito.
            return response()->json([
                'status' => 'success',
                'message' => 'Registro excluído com sucesso!'
            ]);
            //Mensagem de erro.
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erro ao excluir: ' . $e->getMessage()
            ], 400);
        }
    }
    public function search(Request $request)
    {
        //Detecta o filtro dado na barra de pesquisa.
        $filtro = trim((string) $request->input('filtro', ''));
        //procura users correspondentes.
        $users = user::where('title', 'like', "%{$filtro}%")                  
                       ->orderBy('id')
                       ->paginate(10);
        //redireciona o usuário à lista resultante.
        return response()->json([
            'status' => 'success',
            'data' => [$users, $filtro]
        ]);
    }
}
