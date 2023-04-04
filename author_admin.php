<?php
session_start();
if(!$_SESSION['user']['IsAdmin'])
{
    header('Location: admin.php');
    die();
}
require 'Model\Database.php';
require 'Model\BaseRepository.php';
require 'Model\PostRepository.php';
require 'Model\AuthorRepository.php';

$db = new Database();
$sr = new PostRepository($db);
$a = new AuthorRepository($db);
$posts = $sr->getPostsAdmin();
$auths = $a->getAuthors();
$visibility = "display: none;";
if(isset($_GET['id']))
{
    $visibility = "";
    $auth = $a->getAuthor($_GET['id']);
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.108.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
</head>
<body>
<div style="<?= $visibility ?>">
    <div class="text-center" style="height: 200px; width:500px; background-color: grey; left: calc(50% - 110px); top: calc(50% - 100px); position: absolute; z-index: 2">
        <p style="color: white; font-size: 25px">Autora <strong><?= $auth['Name'] . " " . $auth['Surname'] ?></strong> nelze smazat! <br> Má napsané články!</p>
        <a href="author_admin.php" class="btn btn-danger">OK</a>
    </div>
</div>
<div class="d-flex">
    <aside>
        <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 280px;height: 100vh;">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white">
                <svg class="bi pe-none me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
                <span class="fs-4">Admin panel</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="admin.php" class="nav-link text-white" aria-current="page">
                        Přehled článků
                    </a>
                </li>
                <li>
                    <a href="category_admin.php" class="nav-link text-white ">
                        Kategorie
                    </a>
                </li>
                <li>
                    <a href="author_admin.php" class="nav-link text-white active">
                        Autoři
                    </a>
                </li>
                <a href="index.php" class="nav-link text-white">
                    Odejít
                </a>
                </li>
            </ul>

    </aside>
    <div class="content justify-content-evenly mx-auto" style="width:80%">
        <h1 class="text-center mb-5 mt-5">Přehled autorů</h1>
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="d-flex justify-content-end">
                        <a href="author_add.php" class="btn btn-primary mb-5 ">Přidat nového →</a>
                    </div>
                    <div class="row">
                        <?php foreach ($auths as  $aut): ?>
                            <div class="col-sm-6 mb-3 mb-sm-5">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $aut['Name'] . " " . $aut['Surname'] . ': '?><?= $aut['IsAdmin'] ? 'Admin' : 'Editor'?> </h5>
                                        <p class="card-text"><?= $aut['AuthDesc'] ?></p>
                                        <a href="author_delete.php?id=<?= $aut['Id'] ?>" class="btn btn-danger">Odstranit</a>
                                        <a href="author_edit.php?id=<?= $aut['Id'] ?>" class="btn btn-primary">Upravit</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
