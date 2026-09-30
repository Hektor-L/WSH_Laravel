<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function returnCategories() {
        //O site pega todas as instâncias de categorias.
        $categories = Category::all();
        //Retorna a lista completa de categorias
        return response($categories);
    }
}
