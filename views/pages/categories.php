<?php
/**
 * @var \App\Kernel\View\ViewInterface $view
 * @var array<\App\Models\Category> $categories
 * @var \App\Services\CategoryService $category
 * @var \App\Kernel\View\ViewInterface $view
 * @var array<\App\Models\Movie> $movies
 */
?>

<?php $view->component('start'); ?>

<main>
    <div class="container">
        <h3 class="mt-3">Жанры</h3>
        <hr>
        <div class="movies">
            <?php foreach ($categories as $category) { ?>
                <a href="/category?id=<?php echo $category->id()?>" class="card text-decoration-none movies__item">
                    <img src="https://glossymag.ru/thetsoaz/2021/10/000-10-glavnyh-filmov-opredelivshih-zhanr-francuzskaya-kinokomediya.jpg" height="200px" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $category->name() ?></h5>
                    </div>
                </a>
            <?php } ?>
        </div>
    </div>
</main>

<?php $view->component('end'); ?>