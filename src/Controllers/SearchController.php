<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Kernel\Http\RequestInterface;
use App\Models\Movie;
use App\Services\MovieService;

/***
 * @var RequestInterface $request
 */

class SearchController extends Controller
{
    public function index(): void
    {
        $search = $this->request()->input('search');
        $movies = new MovieService($this->db());
        $home = 'Поиск по фильму: '.$this->request()->input('search');
        $this->view('home', [
            'movies' => $movies->newSearch($search),
            'home' => $home
        ], 'Главная страница');
    }
}