<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GeneralController extends Controller
{
    public function index(){
        //O site pega todas as instâncias de posts e categorias.
        $categories = Category::all()->split(2);
        $posts = Post::paginate(8);
        //Retorna a lista completa de posts
        return view('index', ['posts' => $posts, 'categories' => $categories,'filtro' => '']);
    }

    public function create(Request $request): View
    {
        $categories = Category::all();
        return view('post-create', ['user' => $request->user(), 'categories' => $categories]);
    }

    public function store(Request $request) {
        try {
            //Armazena as informações dadas
            $post = new Post();
            $post->title = $request->input('title');
            $post->description = $request->input('description');
            $post->poster_id = $request->input('poster_id');
            $post->category_id = $request->input('category_id');
            $post->save();
            //Mensagem de êxito.
            session()->flash('msg', 'Armazenado com sucesso!');
            return redirect()->route('index');

            //Mensagem de erro.
        } catch (\Exception $e) {
            session()->flash('erro', 'Erro ao armazenar: ' . $e->getMessage());
            return redirect()->route('dashboard.posts.create');
        }
    }

    public function view($id) {
        //Redireciona o usuário à tela de edição de posts.
        $post = Post::find($id);
        $comments = Comment::where('post_id', $post->id)->paginate(15);
        return view('post-view', ['post' => $post, 'comments' => $comments]);
    }

    public function update(Request $request, $id) {
        try {
            //Armazena a atualização da post.
            $post = Post::find($id);
            $post->title = $request->input('title');
            $post->description = $request->input('description');
            $post->poster_id = $request->input('poster_id');
            $post->category_id = $request->input('category_id');
            $post->save();
            //mensagem de êxito.
            session()->flash('msg', 'Atualizado com sucesso!');
            return redirect()->route('index');
            //Mensagem de erro.
        } catch (\Exception $e) {
            session()->flash('erro', 'Erro ao atualizar: ' . $e->getMessage());
            return redirect()->route('posts.view', ['id' => $id]);
        }   
    }

    public function destroy($id) {
        try {
            //Exclui a post requerida.
            $post = Post::find($id);
            $post->delete();
            //Mensagem de êxito.
            session()->flash('msg', 'Registro excluído com sucesso!');
            return redirect()->route('index');
            //Mensagem de erro.
        } catch (\Exception $e) {
            session()->flash('erro', 'Erro ao excluir: ' . $e->getMessage());
            return redirect()->route('posts.view', ['id' => $id]);
        }
    }

    public function search(Request $request)
    {
        //Detecta o filtro dado na barra de pesquisa.
        $filtro = trim((string) $request->input('filtro', ''));
        //procura posts correspondentes.
        $posts = Post::where('postTitle', 'like', "%{$filtro}%")                  
                       ->orderBy('id')
                       ->get();
        //redireciona o usuário à lista resultante.
        return view('index', ['posts' => $posts, 'filtro' => $filtro]);
    }

    public function filterByCategory($id) {
        try {
            $posts = Post::where('category_id', $id)
                        ->orderBy('id')
                        ->paginate(10);
            $categories = Category::all()->split(2);
            return view('index', ['posts' => $posts, 'categories' => $categories,'filtro' => '']);
        } catch (\Exception $e) {
            session()->flash('erro', 'Erro ao excluir: ' . $e->getMessage());
            return redirect()->route('index');
        }
        //procura posts correspondentes.
        
    }
}
