<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        //O site pega todas as instâncias de posts.
        $posts = Post::paginate(10);
        //Retorna a lista completa de posts
        return view('dashboard.post.index', ['posts' => $posts, 'filtro' => '']);
    }

    public function create(){
        //Redireciona o usuário à tela de criação de posts
        return view('dashboard.post.create');
    }

    public function store(Request $request) {
        try {
            //Armazena as informações dadas
            $post = new Post();
            $post->title = $request->input('title');
            $post->description = $request->input('description');
            $post->poster_id = $request->input('poster_id');
            $post->save();
            //Mensagem de êxito.
            session()->flash('msg', 'Armazenado com sucesso!');
            return redirect()->route('dashboard.posts.index');

            //Mensagem de erro.
        } catch (\Exception $e) {
            session()->flash('erro', 'Erro ao armazenar: ' . $e->getMessage());
            return view('dashboard.post.create');
        }
        
    }

    public function view($id) {
        //Se der sucesso, redireciona o usuário à tela de edição de posts.
        try {
            $post = Post::find($id);
            return view('dashboard.post.edit', ['post' => $post]);
        //se der falha, cospe mensagem de erro.
        } catch (\Exception $e) {
            session()->flash('erro', 'Erro ao carregar: ' . $e->getMessage());
            return redirect()->route('dashboard.posts.index');
        }
    }

    public function update(Request $request, $id) {
        try {
            //Armazena a atualização da post.
            $post = Post::find($id);
            $post->title = $request->input('title');
            $post->description = $request->input('description');
            $post->poster_id = $request->input('poster_id');
            $post->save();
            //mensagem de êxito.
            session()->flash('msg', 'Atualizado com sucesso!');
            return redirect()->route('dashboard.posts.index');
            //Mensagem de erro.
        } catch (\Exception $e) {
            session()->flash('erro', 'Erro ao atualizar: ' . $e->getMessage());
            return redirect()->route('dashboard.posts.index');
        }   
    }

    public function destroy($id) {
        try {
            //Exclui a post requerida.
            $post = Post::find($id);
            $post->delete();
            //Mensagem de êxito.
            session()->flash('msg', 'Registro excluído com sucesso!');
            return redirect()->route('dashboard.posts.index');
            //Mensagem de erro.
        } catch (\Exception $e) {
            session()->flash('erro', 'Erro ao excluir: ' . $e->getMessage());
            return redirect()->route('dashboard.posts.index');
        }
    }

    public function search(Request $request)
    {
        //Detecta o filtro dado na barra de pesquisa.
        $filtro = trim((string) $request->input('filtro', ''));
        //procura posts correspondentes.
        $posts = Post::where('title', 'like', "%{$filtro}%")                  
                       ->orderBy('id')
                       ->paginate(10);
        //redireciona o usuário à lista resultante.
        return view('dashboard.post.index', ['posts' => $posts, 'filtro' => $filtro]);
    }
}
