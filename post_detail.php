<?php
require 'Model\Database.php';
require 'Model\BaseRepository.php';
require 'Model\PostRepository.php';
require 'Model\AuthRepository.php';

session_start();
$isValid = false;
$db = new Database();
$sr = new PostRepository($db);
$post = $sr->getPost($_GET['id']);

$auth = new AuthRepository($db);
if (isset($_SESSION['user']))
{
    $isValid = $auth->Check($_SESSION['user']['Id'], $post['Id']);
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Clean Blog - Start Bootstrap Theme</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="index.php">PHP News</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="index.php">Domů</a></li>
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="all_posts.php">Zprávy</a></li>
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="category.php">Kategorie</a></li>
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="author.php">Autoři</a></li>
                        <?php if (isset($_SESSION['user'])): ?>
                            <li class="nav-item"><a style="color: #9adcad;" class="nav-link px-lg-3 py-3 py-lg-4" href="admin.php">Administrace článku</a></li>
                            <li class="nav-item ms-5"><a style="color: #a6a6ff;" class="nav-link px-lg-3 py-3 py-lg-4" href="#">Prihlášen: <?= $_SESSION['user']['Name'] . " " . $_SESSION['user']['Surname'] ?> </a></li>
                            <li class="nav-item"><a style="color: #a6a6ff;" class="nav-link px-lg-3 py-3 py-lg-4" href="logout.php">Odhlásit</a></li>

                        <?php else: ?>
                            <li class="nav-item"><a style="color: #9adcad;" class="nav-link px-lg-3 py-3 py-lg-4" href="login.php">Přihlásit</a></li>
                            <li class="nav-item"><a style="color: #a6a6ff;" class="nav-link px-lg-3 py-3 py-lg-4" href="register.php">Zaregistrovat</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page Header-->
        <header class="masthead" style="background-image: url('assets/img/post-bg.jpg')">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="post-heading">
                            <h1><?= $post['Title'] ?></h1>
                            <h2 class="subheading"><?= $post['Preview'] ?></h2>
                            <span class="meta">
                                Autor:
                                <a href="post_by_author.php?id=<?= $post['IdAut'] ?>"><?= $post['Name'] . " " . $post['Surname'] ?></a>
                                | Datum: <?= date_format(new DateTime($post['Date']), 'd.m.Y H.i.s'); ?>
                                | Kategorie: <a href="posts_by_category.php?id=<?= $post['IdCat'] ?>"><?= $post['CatName'] ?> </a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Post Content-->
        <article class="mb-4">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <?= $post['Content'] ?>
                        <?php if ($isValid): ?>
                            <div class="d-flex justify-content-end">
                                <a class="me-5" href="edit_post.php?id=<?= $_GET['id'] ?>">Upravit</a>
                                <a href="delete_post.php?id=<?= $_GET['id'] ?>">Smazat</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </article>
        <!-- Footer-->
        <footer class="border-top">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <ul class="list-inline text-center">
                            <li class="list-inline-item">
                                <a href="#!">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#!">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#!">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                        </ul>
                        <div class="small text-center text-muted fst-italic">Copyright &copy; Your Website 2022</div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
