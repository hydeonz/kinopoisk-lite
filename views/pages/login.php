<?php
/**
 * @var \App\Kernel\View\ViewInterface $view
 * @var \App\Kernel\Session\SessionInterface $session
 */
$emailInput = $session->getFlash('emailInput') ?? null;
$passwordInput = $session->getFlash('passwordInput') ?? null;
?>

<?php $view->component('start_simple'); ?>

<main class="form-signin w-100 m-auto">
    <form action="/login" method="post">
            <?php if ($session->has('error')) { ?>
                <div class="alert alert-danger">
                    <?php echo $session->getFlash('error') ?>
                </div>
            <?php } ?>
            <div class="d-flex" style="align-items: center; justify-content: space-between">
                <h2>Вход</h2>
                <a href="/" class="d-flex align-items-center mb-5 mb-lg-0 text-white text-decoration-none">
                    <h5 class="m-0">Кинопоиск <span class="badge bg-warning warn__badge">Lite</span></h5>
                </a>
            </div>
            <div class="form-floating mt-3">
                <input
                    type="email"
                    class="form-control"
                    name="email"
                    id="floatingInput"
                    placeholder="name@areaweb.su"
                    value="<?php echo $emailInput?>"
                >
                <label for="floatingInput">E-mail</label>
            </div>
            <div class="form-floating">
                <input
                    type="password"
                    name="password"
                    class="form-control"
                    id="floatingPassword"
                    placeholder="Пароль"
                    value="<?php echo $passwordInput?>"
                >
                <label for="floatingPassword">Пароль</label>
            </div>
            <button class="btn btn-primary w-100 py-2" type="submit">Войти</button>
            <p class="mt-5 mb-3 text-body-secondary">&copy; Кинопоиск Lite 2023</p>
        </form>
    </main>
<?php
?>
<?php $view->component('end_simple'); ?>