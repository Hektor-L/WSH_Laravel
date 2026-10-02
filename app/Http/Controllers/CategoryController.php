<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        //O site pega todas as instâncias de categories.
        $categories = Category::paginate(40);
        //Retorna a lista completa de categories
        return view('dashboard.category.index', ['categories' => $categories, 'filtro' => '']);
    }

    public function create(Request $request) {
        //Redireciona o usuário à tela de criação de categories
        $users = \App\Models\User::all();
        $posts = \App\Models\Post::all();
        return view('dashboard.category.create', ['user' => $request->user(), 'posts' => $posts, 'users' => $users]);
    }

    public function store(Request $request) {
        try {
            //Armazena as informações dadas
            $category = new Category();
            $category->name = $request->input('name');
            $category->save();
            //Mensagem de êxito.
            session()->flash('msg', 'Armazenado com sucesso!');
            return redirect()->route('dashboard.categories.index');

            //Mensagem de erro.
        } catch (\Exception $e) {
            session()->flash('erro', 'Erro ao armazenar: ' . $e->getMessage());
            return redirect()->route('dashboard.categories.create');
        }
    }

    public function edit(int $id) {
        //Se der sucesso, redireciona o usuário à tela de edição de categories.
        try {
            $users = \App\Models\User::all();
            $posts = \App\Models\Post::all();
            $category = Category::find($id);
            return view('dashboard.category.edit', ['category' => $category, 'users' => $users, 'posts' => $posts]);
        //se der falha, cospe mensagem de erro.
        } catch (\Exception $e) {
            session()->flash('erro', 'Erro ao carregar: ' . $e->getMessage());
            return redirect()->route('dashboard.categories.index');
        }
    }

    public function update(Request $request, int $id) {
        try {
            //Armazena a atualização da category.
            $category = Category::find($id);
            $category->name = $request->input('name');
            $category->save();
            //mensagem de êxito.
            session()->flash('msg', 'Atualizado com sucesso!');
            return redirect()->route('dashboard.categories.index');
            //Mensagem de erro.
        } catch (\Exception $e) {
            session()->flash('erro', 'Erro ao atualizar: ' . $e->getMessage());
            return redirect()->route('dashboard.categories.edit', ['category' => $category]);
        }   
    }

    public function destroy(int $id) {
        try {
            //Exclui a category requerida.
            $category = Category::find($id);
            $category->delete();
            //Mensagem de êxito.
            session()->flash('msg', 'Registro excluído com sucesso!');
            return redirect()->route('dashboard.categories.index');
            //Mensagem de erro.
        } catch (\Exception $e) {
            session()->flash('erro', 'Erro ao excluir: ' . $e->getMessage());
            return redirect()->route('dashboard.categories.index');
        }
    }

    public function search(Request $request) {
        //Detecta o filtro dado na barra de pesquisa.
        $filtro = trim((string) $request->input('filtro', ''));
        //procura categories correspondentes.
        $categories = Category::where('name', 'like', "%$filtro%")->orderBy('id')->paginate(40);
        //redireciona o usuário à lista resultante.
        return view('dashboard.category.index', ['categories' => $categories, 'filtro' => $filtro]);
    }
}
