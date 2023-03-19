<?php
require 'Model\Database.php';
require 'Model\BaseRepository.php';
require 'Model\CategoryRepository.php';

$db = new Database();
$c = new CategoryRepository($db);
$myCat = $c->getCategory($_GET['id']);

if (isset($_GET['id'], $_POST['catName'], $_POST['des'])) {

    $c->updateCategory($_GET['id'], $_POST['catName'], $_POST['des']);

    header('Location: category_admin.php');
    die();
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
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

</head>
<body>

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
                    <a href="category_admin.php" class="nav-link text-white active">
                        Kategorie
                    </a>
                </li>
                <li>
                    <a href="author_admin.php" class="nav-link text-white">
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
        <h1 class="text-center mb-5 mt-5">Přidání kategorie</h1>
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <form action="" method="post">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex justify-content-end mb-4"><button class="btn btn-primary text-uppercase" >Uložit</button></div>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Název kategorie</span>
                            <input value="<?= $myCat['CatName'] ?>" name="catName" type="text" class="form-control" placeholder="Název" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group">
                            <span class="input-group-text">Popis kategorie</span>
                            <textarea name="des" class="form-control" aria-label="With textarea"><?= $myCat['Description'] ?></textarea>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>


