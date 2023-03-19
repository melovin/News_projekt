<?php

if (empty($_GET['id'])) {
    header('Location: author_admin.php');
    die();
}

require_once 'model/Database.php';
require_once 'model/BaseRepository.php';
require_once 'model/AuthorRepository.php';
require_once 'model/PostRepository.php';

$db = new Database();
$sr = new AuthorRepository($db);
$p = new PostRepository($db);
$posts = $p->getPosts();
$autId = $_GET['id'];
foreach ($posts as $post)
{
    if($post['IdAuthor'] == $autId)
    {
        header('Location: author_admin.php?id='.$autId);
        die();
    }
}
$sr->deleteAuthor($_GET['id']);

header('Location: author_admin.php');