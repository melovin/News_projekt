<?php

if (empty($_GET['id'])) {
    header('Location: admin.php');
    die();
}

require_once 'model/Database.php';
require_once 'model/BaseRepository.php';
require_once 'model/PostRepository.php';

$db = new Database();
$sr = new PostRepository($db);

$sr->deletePost($_GET['id']);

header('Location: admin.php');