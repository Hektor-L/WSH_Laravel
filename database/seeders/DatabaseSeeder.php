<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            "name" => "Hektor L",
            "email"=> "hektornas@gmail.com",
            "password" => Hash::make("!Warioo!!"),
            "type" => "staff",
            "birth_date" => "2008-12-01",
            "description" => "Olá, sou Hektor, um experiente desenvolvedor Web e Móvel.",
        ]);
        User::create([
            "name" => "Admin",
            "email" => "admin@ficmail.com",
            "password" => Hash::make("SuperUser2019"),
            "type" => "staff",
            "birth_date" => "2000-01-01",
        ]);
        User::create([
            "name" => "Pedro Alves",
            "email"=> "pedroalves732@ficmail.com",
            "password" => Hash::make("Angela582"),
            "type" => "worker",
            "birth_date" => "2008-05-17",
            "description" => "Olá! Me chamo Pedro, e trabalho na área de Administração. Contate-me neste número: (37) 99326-6584",
        ]);
        User::create([
            "name" => "Luiza Lara",
            "email"=> "luizalima295@ficmail.com",
            "password" => Hash::make("Jaqueline423"),
            "type" => "common",
            "birth_date" => "2004-04-12",
            "description" => "Tenho Interesse na área Eletrotécnica e Administração.",
        ]);
        Category::create([
            "name" => "Informática",
        ]);
        Category::create([
            "name" => "Eletrotécnica",
        ]);
        Category::create([
            "name" => "Administração",
        ]);
        Post::create([
            "title" => "Como eu posso calcular o rendimento de um projeto de uma empresa?",
            "description" => "Sou experiente em Administração, e em até uma semana, eu tenho que planejar as próximas ações de uma empresa dependendo se o projeto anterior dela foi um sucesso ou não. Como eu posso calcular se tal projeto deu lucro ou não?",
            "poster_id" => 3,
            "category_id" => 3,
        ]);
        Comment::create([
            "text" => "É necessário calcular o ganho médio da empresa no momento antes da realização do projeto, e então, calcular a diferença entre a média e o ganho do projeto através de uma subtração.",
            "post_id" => 1,
            "commenter_id" => 4,
        ]);
        Comment::create([
            "text" => "Eu agradeço, Luiza, isso vai acelerar o meu trabalho.",
            "parent_comment_id" => 1,
            "commenter_id" => 3,
        ]);

    }
}
