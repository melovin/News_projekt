<?php
require 'Model\Database.php';
require 'Model\BaseRepository.php';
require 'Model\PostRepository.php';
require 'Model\AuthorRepository.php';
require 'Model\CategoryRepository.php';
if(!isset($_GET['id']))
{
    header('Location: admin.php');
    die();
}
$db = new Database();
$sr = new PostRepository($db);
$a = new AuthorRepository($db);
$c = new CategoryRepository($db);
$post = $sr->getPost($_GET['id']);
$authors = $a->getAuthors();
$categories = $c->getCategories();

if (isset($_GET['id'], $_POST['cat'], $_POST['auth'], $_POST['title'], $_POST['content'], $_POST['preview'])) {
    if(isset($_POST['activity']))
        $active = 1;
    else
        $active = 0;
    $sr->updatePost($_GET['id'], $_POST['cat'], $_POST['auth'], $_POST['title'], $_POST['content'], $_POST['preview'],$active);

    header('Location: admin.php');
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
    <script>
        tinymce.init({
            selector: '#posttextarea',
        });
        tinymce.init({
            selector: '#previewtextarea'
        });
    </script>
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
                    <a href="#" class="nav-link text-white">
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
        <h1 class="text-center mb-5 mt-5">Edit článku</h1>
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <form action="" method="post">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-content-center flex-wrap">
                                Zveřejnit
                                <?php if ($post['Active']): ?>
                                    <input checked type="checkbox" name="activity" class="ms-2">
                                <?php else : ?>
                                    <input type="checkbox" name="activity" class="ms-2">
                                <?php endif; ?>
                            </div>
                            <div class="d-flex justify-content-end mb-4"><button class="btn btn-primary text-uppercase" >Uložit</button></div>
                        </div>
                        <div class="d-flex">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="inputGroupSelect01">Options</label>
                                <select class="form-select" id="inputGroupSelect01" name="cat">
                                    <?php foreach ($categories as $cat): ?>
                                        <option value="<?= $cat['Id'] ?>"
                                            <?php if ($cat['Id'] === $post['IdCat']): ?>
                                                selected
                                            <?php endif; ?>
                                        ><?= $cat['CatName'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="inputGroupSelect01">Options</label>
                                <select class="form-select" id="inputGroupSelect01" name="auth">
                                    <?php foreach ($authors as $auth): ?>
                                        <option value="<?= $auth['Id'] ?>"
                                            <?php if ($auth['Id'] === $post['IdAut']): ?>
                                                selected
                                            <?php endif; ?>
                                        ><?= $auth['Name'] . " " . $auth['Surname'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="input-group mb-5">
                            <span class="input-group-text">Titulek</span>
                            <textarea class="form-control" aria-label="With textarea" name="title"><?= $post['Title'] ?></textarea>
                        </div>

                        Náhled
                        <textarea name="preview" id="previewtextarea"><?= $post['Preview'] ?></textarea>
                        <div class="mt-5" style="margin-bottom: 200px">
                            Kontent:
                            <textarea name="content" id="posttextarea"><?= $post['Content'] ?></textarea>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

