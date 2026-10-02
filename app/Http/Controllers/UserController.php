<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        //O site pega todas as instâncias de users.
        $users = User::paginate(40);
        //Retorna a lista completa de users
        return view('dashboard.user.index', ['users' => $users, 'filtro' => '']);
    }

    public function create(Request $request) {
        //Redireciona o usuário à tela de criação de users
        return view('dashboard.user.create');
    }

    public function store(Request $request) {
        try {
            //Armazena as informações dadas
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->type = $request->input('type');
            $user->birth_date = $request->input('birth_date');
            $user->description = $request->input('description');
            $user->save();
            //Mensagem de êxito.
            session()->flash('msg', 'Armazenado com sucesso!');
            return redirect()->route('dashboard.users.index');

            //Mensagem de erro.
        } catch (\Exception $e) {
            session()->flash('erro', 'Erro ao armazenar: ' . $e->getMessage());
            return redirect()->route('dashboard.users.create');
        }
        
    }

    public function edit(int $id) {
        //Se der sucesso, redireciona o usuário à tela de edição de users.
        try {
            $user = User::find($id);
            return view('dashboard.user.edit', ['user' => $user]);
        //se der falha, cospe mensagem de erro.
        } catch (\Exception $e) {
            session()->flash('erro', 'Erro ao carregar: ' . $e->getMessage());
            return redirect()->route('dashboard.users.index');
        }
    }

    public function update(Request $request, int $id) {
        try {
            //Armazena a atualização da post.
            $user = User::find($id);
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->type = $request->input('type');
            $user->birth_date = $request->input('birth_date');
            $user->description = $request->input('description');
            $user->save();
            //mensagem de êxito.
            session()->flash('msg', 'Atualizado com sucesso!');
            return redirect()->route('dashboard.users.index');
            //Mensagem de erro.
        } catch (\Exception $e) {
            session()->flash('erro', 'Erro ao atualizar: ' . $e->getMessage());
            return redirect()->route('dashboard.users.edit', ['user' => $user]);
        }   
    }

    public function destroy(int $id) {
        try {
            //Exclui a post requerida.
            $user = User::find($id);
            $user->posts()->delete(); // Exclui os posts associados ao usuário
            $user->comments()->delete(); // Exclui os comentários associados ao usuário
            $user->delete();
            //Mensagem de êxito.
            session()->flash('msg', 'Registro excluído com sucesso!');
            return redirect()->route('dashboard.users.index');
            //Mensagem de erro.
        } catch (\Exception $e) {
            session()->flash('erro', 'Erro ao excluir: ' . $e->getMessage());
            return redirect()->route('dashboard.users.index');
        }
    }

    public function search(Request $request) {
        //Detecta o filtro dado na barra de pesquisa.
        $filtro = trim((string) $request->input('filtro', ''));
        //procura users correspondentes.
        $users = User::where('name', 'like', "%$filtro%")->orderBy('id')->paginate(40);
        //redireciona o usuário à lista resultante.
        return view('dashboard.user.index', ['users' => $users, 'filtro' => $filtro]);
    }
}
