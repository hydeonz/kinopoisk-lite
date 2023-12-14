<?php
/**
 * @var \App\Kernel\Auth\AuthInterface $auth
 * @var \App\Kernel\View\ViewInterface $view
 * @var \App\Kernel\Session\SessionInterface $session
 * @var \App\Kernel\Storage\StorageInterface $storage
 * @var \App\Models\Movie $movie
 * @var \App\Models\Category $category
 * @var \App\Models\Category $category_name
 */
$_POST();
if($auth->check()){
    $is_admin = $auth->user()->is_admin();
} else{
    $is_admin = false;
}
?>

<?php $view->component('start'); ?>

<main>
    <div class="container">
        <div class="one-movie">
            <div class="card mb-3 mt-3 one-movie__item">
                <div class="row g-3">
                    <div class="col-md-4">
                        <img src="<?php echo $storage->url($movie->preview()) ?>" class="img-fluid rounded one-movie__image" alt="<?php echo $movie->name() ?>">
                        <?php if ($auth->check() && !($auth->hasReview($movie->id()))) { ?>
                            <form action="/reviews/add" method="post" class="m-3 w-100">
                                <input type="hidden" value="<?php echo $movie->id() ?>" name="id">
                                <select
                                    class="form-select <?php echo $session->has('rating') ? 'is-invalid' : '' ?>"
                                    name="rating"
                                    aria-label="Default select example"
                                >
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                                <label for="opt_selected">Оценка</label>
                                <?php if ($session->has('rating')) { ?>
                                    <div id="name" class="invalid-feedback">
                                        <?php echo $session->getFlash('rating')[0] ?>
                                    </div>
                                <?php } ?>
                                <div class="form-floating mt-2">
                                    <textarea
                                        class="form-control <?php echo $session->has('comment') ? 'is-invalid' : '' ?>"
                                        name="comment"
                                        placeholder="Укажи свое мнение о фильме"
                                        id="floatingTextarea2"
                                        style="height: 100px"
                                    ></textarea>
                                    <label for="floatingTextarea2">Комментарий</label>
                                    <?php if ($session->has('comment')) { ?>
                                        <div id="name" class="invalid-feedback">
                                            <?php echo $session->getFlash('comment')[0] ?>
                                        </div>
                                    <?php } ?>

                                </div>
                                <button class="btn btn-primary mt-2">Оставить отзыв</button>
                            </form>
                        <?php } if($auth->hasReview($movie->id())) { ?>
                            <div class="m-3 w-100">

                            </div>
                        <?php } if(!($auth->check())){?>
                            <div class="alert alert-warning m-3 w-100">
                                Для того, чтобы оставить отзыв, необходимо <a href="/login">авторизоваться</a>
                            </div>
                        <?php }?>
                    </div>
                    <div class="col-md-8">
                        <?php if ($is_admin){?>
                        <div class="d-flex justify-content-end m-3">
                            <div class="dropdown" style="position: absolute; margin: 0 0 auto auto; height: max-content; width: max-content">
                                <button  class="dropbtn" style="position: relative; height: max-content;">Действия</button>
                                    <div class="dropdown-content" style="">
                                        <a class="btn btn-warning w-100 d-flex" href="/admin/movies/update?id=<?php echo $movie->id() ?>">Изменить</a>
                                        <form action="/admin/movies/destroy" method="post">
                                            <input type="hidden" value="<?php echo $movie->id() ?>" name="id">
                                            <button class="btn btn-warning w-100" type="submit"">Удалить</button>
                                        </form>
                                    </div>

                                </div>
                            <?php }?>
                        <div class="card-body">
                            <h1 class="card-title"><?php echo $movie->name() ?></h1>

                            <p class="card-text">Оценка <span class="badge bg-warning warn__badge"><?php echo $movie->avgRating() ?></span></p>
                            <p class="card-text"><b>Описание:</b> <br><?php echo $movie->description() ?></p>
                            <p class="card-text"> <?php if ($category_name){?>Жанр: <?php echo $category_name?></p> <?php }?>
                            <p class="card-text"><small class="text-body-secondary">Добавлен <?php echo $movie->createdAt() ?></small></p>
                            <?php if (!$movie->reviews()){?><h4>Отзывов нет</h4><?php }else{?>
                                <h4>Отзывы</h4>
                            <?php }?>
                            <div class="one-movie__reviews">
                                <?php foreach ($movie->reviews() as $review) { ?>
                                    <?php $view->component('review_card', ['review' => $review]) ?>
                                        <?php if($auth->check() && $review->user()->id() == $auth->user()->id() && (isset($review))){?>
                                <a href="/reviews/delete?id=<?php echo $review->id()?>&movie_id=<?php echo $movie->id()?>" <button  class="badge bg-warning warn__badge">Удалить</button></a>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php $view->component('end'); ?>