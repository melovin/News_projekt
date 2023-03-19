<?php
require 'Model\Database.php';
require 'Model\BaseRepository.php';
require 'Model\PostRepository.php';

$db = new Database();
$sr = new PostRepository($db);
$posts = $sr->getPostsAdmin();
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
                    <a href="admin.php" class="nav-link active" aria-current="page">
                        Přehled článků
                    </a>
                </li>
                <li>
                    <a href="category_admin.php" class="nav-link text-white">
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
        <h1 class="text-center mb-5 mt-5">Přehled článků</h1>
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <!-- Post preview-->
                    <!-- Pager-->
                    <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="add_post.php">Přidat nový →</a></div>
                    <?php foreach ($posts as $post): ?>
                        <div class="post-preview">
                            <a href="post_detail.php?id=<?= $post['Id'] ?>">
                                <h2 class="post-title"><?= $post['Title'] ?></h2>
                                <h3 class="post-subtitle"><?= $post['Preview'] ?></h3>
                            </a>
                            <p class="post-meta">
                                Autor:
                                <a href="post_by_author.php?id=<?= $post['IdAut'] ?>"><?= $post['Name'] . " " . $post['Surname'] ?></a>
                                | Datum: <?= date_format(new DateTime($post['Date']), 'd.m.Y H.i.s'); ?>
                                | Kategorie: <a href="posts_by_category.php?id=<?= $post['IdCat'] ?>"><?= $post['CatName'] ?> </a>
                                <a href="delete_post.php?id=<?= $post['Id'] ?>"><img style="height: 25px; padding-left: 50px" src="assets/img/delete.svg" alt="delete_icon"></a>
                                <a href="edit_post.php?id=<?= $post['Id'] ?>"><img style="height: 25px; padding-left: 25px" src="assets/img/edit.svg" alt="edit_icon"></a>
                                <?php if ($post['Active']): ?>
                                    <span style="color: green">Veřejný</span>
                                <?php else : ?>
                                    <span style="color: red">Koncept</span>
                                <?php endif; ?>

                            </p>
                        </div>
                        <!-- Divider-->
                        <hr class="my-4" />
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
