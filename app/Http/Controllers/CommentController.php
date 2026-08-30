<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(){
        //O site pega todas as instâncias de posts.
        $comments = Comment::paginate(10);
        //Retorna a lista completa de posts
        return view('dashboard.post.index', ['posts' => $comments, 'filtro' => '']);
    }

    public function create(){
        //Redireciona o usuário à tela de criação de posts
        return view('dashboard.post.create');
    }

    public function store(Request $request) {
        try {
            //Armazena as informações dadas
            $comment = new Comment();
            $comment->text = $request->input('text');
            $comment->post_id = $request->input('post_id');
            $comment->commenter_id = $request->input('commenter_id');
            $comment->save();
            //Mensagem de êxito.
            session()->flash('msg', 'Armazenado com sucesso!');
            return redirect()->route('dashboard.posts.index');

            //Mensagem de erro.
        } catch (\Exception $e) {
            session()->flash('erro', 'Erro ao armazenar: ' . $e->getMessage());
            return redirect()->route('dashboard.posts.create');
        }
        
    }

    public function view($id) {
        //Se der sucesso, redireciona o usuário à tela de edição de posts.
        try {
            $comment = Post::find($id);
            return view('dashboard.post.edit', ['post' => $comment]);
        //se der falha, cospe mensagem de erro.
        } catch (\Exception $e) {
            session()->flash('erro', 'Erro ao carregar: ' . $e->getMessage());
            return redirect()->route('dashboard.posts.index');
        }
    }

    public function update(Request $request, $id) {
        try {
            //Armazena a atualização da post.
            $comment = Post::find($id);
            $comment->title = $request->input('title');
            $comment->description = $request->input('description');
            $comment->poster_id = $request->input('poster_id');
            $comment->save();
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
            $comment = Post::find($id);
            $comment->delete();
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
        $comments = Post::where('title', 'like', "%{$filtro}%")                  
                       ->orderBy('id')
                       ->paginate(10);
        //redireciona o usuário à lista resultante.
        return view('dashboard.post.index', ['posts' => $comments, 'filtro' => $filtro]);
    }
}
