<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    include_once "../model/post.php";


    if (!empty($_GET['id'])) {
        $post = new Post();
        $posts = json_decode($post->getPost($_GET['id']));
        // print_r($posts);

        if ($posts->message == "success") {
            $results = json_decode($posts->results);
            echo $results->title;
            echo "<br>";
            echo $results->content;
        } else {
            echo "Post not found";
        }
    } else {
        echo "nothing to display";
    }
    ?>
</body>

</html>