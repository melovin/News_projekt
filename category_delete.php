<?php
if (empty($_GET['id'])) {
    header('Location: admin.php');
    die();
}
session_start();
if(!$_SESSION['user']['IsAdmin'])
{
    header('Location: index.php');
    die();
}

require_once 'model/Database.php';
require_once 'model/BaseRepository.php';
require_once 'model/CategoryRepository.php';
require_once 'model/PostRepository.php';

$db = new Database();
$sr = new CategoryRepository($db);
$p = new PostRepository($db);
$posts = $p->getPosts();
$catId = $_GET['id'];
foreach ($posts as $post)
{
    if($post['IdCategory'] == $catId)
    {
        header('Location: category_admin.php?id='.$catId);
        die();
    }
}
$sr->deleteCategory($_GET['id']);

header('Location: category_admin.php');