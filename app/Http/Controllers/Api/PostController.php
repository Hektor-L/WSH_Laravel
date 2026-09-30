<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function returnPosts() {
        //O site pega todas as instâncias de publicações.
        $posts = Post::all();
        //Retorna a lista completa de publicações
        return response($posts);
    }
    public function createPost(Request $request) {
        try {
            //Armazena as informações dadas
            $post = new Post();
            $post->title = $request->input('title');
            $post->description = $request->input('description');
            $post->poster_id = $request->input('poster_id');
            $post->category_id = $request->input('category_id');
            $post->save();
            //Mensagem de êxito.
            return response('Post criado com sucesso!', 201);

            //Mensagem de erro.
        } catch (\Exception $e) {
            return response('Erro ao armazenar post: ' . $e->getMessage(), 400);
        }
        
    }

    public function viewPost(int $id) {
        //Se der sucesso, redireciona o usuário à tela de edição de posts.
        try {
            $post = Post::find($id);
            return response($post);
        //se der falha, cospe mensagem de erro.
        } catch (\Exception $e) {
            return response('Erro ao carregar post: ' . $e->getMessage(), 400);
        }
    }

    public function updatePost(Request $request, int $id) {
        try {
            //Armazena a atualização da post.
            $post = Post::find($id);
            $post->title = $request->input('title');
            $post->description = $request->input('description');
            $post->poster_id = $request->input('poster_id');
            $post->category_id = $request->input('category_id');
            $post->save();
            //mensagem de êxito.
            return response('Post atualizado com sucesso!');
            //Mensagem de erro.
        } catch (\Exception $e) {
            return response('Erro ao atualizar post: ' . $e->getMessage(), 400);
        }   
    }

    public function deletePost(int $id) {
        try {
            //Exclui a post requerida.
            $post = Post::find($id);
            $post->delete();
            //Mensagem de êxito.
            return response('Post excluído com sucesso!');
            //Mensagem de erro.
        } catch (\Exception $e) {
            return response('Erro ao excluir post: ' . $e->getMessage(), 400);
        }
    }
}
