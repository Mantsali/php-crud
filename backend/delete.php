<?php

include_once "../model/post.php";


if (!empty($_GET['id'])) {
    $post = new Post();

    echo $post->deletePost($_GET['id']);
} else {
    header('Location: index.php');
}
