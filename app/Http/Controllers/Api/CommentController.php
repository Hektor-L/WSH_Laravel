<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function returnComments(Request $request) {
        //O site pega todas as instâncias de comentários.
        $comments = Comment::all();
        //Retorna a lista completa de comentários
        return response($comments);
    }
}
