<?php
if (empty($_GET['id'])) {
    header('Location: admin.php');
    die();
}
require_once 'model/Database.php';
require_once 'model/BaseRepository.php';
require_once 'model/PostRepository.php';
require_once 'model/AuthRepository.php';
$db = new Database();
$sr = new PostRepository($db);
$a = new AuthRepository($db);
session_start();

$auth = true;
if(!$_SESSION['user'])
{
    header('Location: index.php');
    die();
}
else if(!$_SESSION['user']['IsAdmin'])
{
    $auth = $a->Check($_SESSION['user']['Id'], $_GET['id']);
}



if($auth) {
    $sr->deletePost($_GET['id']);
}

header('Location: admin.php');