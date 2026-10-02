<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index() {
        //O site pega todas as instâncias de comments.
        $comments = Comment::paginate(40);
        //Retorna a lista completa de comments
        return view('dashboard.comment.index', ['comments' => $comments, 'filtro' => '']);
    }

    public function create(Request $request) {
        //Redireciona o usuário à tela de criação de comments
        $users = \App\Models\User::all();
        $posts = \App\Models\Post::all();
        return view('dashboard.comment.create', ['user' => $request->user(), 'posts' => $posts, 'users' => $users]);
    }

    public function store(Request $request) {
        try {
            //Armazena as informações dadas
            $comment = new Comment();
            $comment->text = $request->input('text');
            $comment->commenter_id = $request->input('commenter_id');
            $comment->post_id = $request->input('post_id');
            $comment->save();
            //Mensagem de êxito.
            session()->flash('msg', 'Armazenado com sucesso!');
            return redirect()->route('dashboard.comments.index');

            //Mensagem de erro.
        } catch (\Exception $e) {
            session()->flash('erro', 'Erro ao armazenar: ' . $e->getMessage());
            return redirect()->route('dashboard.comments.create');
        }
    }

    public function edit(int $id) {
        //Se der sucesso, redireciona o usuário à tela de edição de comments.
        try {
            $users = \App\Models\User::all();
            $posts = \App\Models\Post::all();
            $comment = Comment::find($id);
            return view('dashboard.comment.edit', ['comment' => $comment, 'users' => $users, 'posts' => $posts]);
        //se der falha, cospe mensagem de erro.
        } catch (\Exception $e) {
            session()->flash('erro', 'Erro ao carregar: ' . $e->getMessage());
            return redirect()->route('dashboard.comments.index');
        }
    }

    public function update(Request $request, int $id) {
        try {
            //Armazena a atualização da comment.
            $comment = Comment::find($id);
            $comment->text = $request->input('text');
            $comment->commenter_id = $request->input('commenter_id');
            $comment->post_id = $request->input('post_id');
            $comment->save();
            //mensagem de êxito.
            session()->flash('msg', 'Atualizado com sucesso!');
            return redirect()->route('dashboard.comments.index');
            //Mensagem de erro.
        } catch (\Exception $e) {
            session()->flash('erro', 'Erro ao atualizar: ' . $e->getMessage());
            return redirect()->route('dashboard.comments.edit', ['comment' => $comment]);
        }   
    }

    public function destroy(int $id) {
        try {
            //Exclui a comment requerida.
            $comment = Comment::find($id);
            $comment->delete();
            //Mensagem de êxito.
            session()->flash('msg', 'Registro excluído com sucesso!');
            return redirect()->route('dashboard.comments.index');
            //Mensagem de erro.
        } catch (\Exception $e) {
            session()->flash('erro', 'Erro ao excluir: ' . $e->getMessage());
            return redirect()->route('dashboard.comments.index');
        }
    }

    public function search(Request $request) {
        //Detecta o filtro dado na barra de pesquisa.
        $filtro = trim((string) $request->input('filtro', ''));
        //procura comments correspondentes.
        $comments = Comment::where('text', 'like', "%$filtro%")->orderBy('id')->paginate(40);
        //redireciona o usuário à lista resultante.
        return view('dashboard.comment.index', ['comments' => $comments, 'filtro' => $filtro]);
    }
}
