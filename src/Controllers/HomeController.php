<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Kernel\Http\RequestInterface;
use App\Models\Movie;
use App\Services\MovieService;

/***
 * @var RequestInterface $request
 */

class HomeController extends Controller
{
    public function index(): void
    {
        $movies = new MovieService($this->db());
        $home = 'Главная страница';
        $this->view('home', [
            'movies' => $movies->new(),
            'home' => $home
        ], 'Главная страница');
    }

    public function showFilm(): void
    {
        $category_id = $this->request()->input('id');
        $category = $this->db()->first('categories',['id'=>$category_id]);
        $movies = new MovieService($this->db());
        $this->view('categoryfilms', [
            'movies' =>$movies->newWithCategories($category_id),
            'category' => $category['name'],
        ], 'Жанры');
    }
    public function showByRating():void
    {
        $best = 'Лучшее';
        $movies = new MovieService($this->db());
            $this->view('home', [
                'movies' =>$movies->newWithRating(),
                'best' => $best,
            ], 'Лучшее');
    }
}
