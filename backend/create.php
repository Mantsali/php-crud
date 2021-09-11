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

    $verified = TRUE;
    $data = array();
    //if (isset($_POST['submit'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // print_r($_POST);

        $fields = array('title', 'content');

        foreach ($fields as $field) {
            //escape fields

            if (empty($_POST[$field])) {
                //field is missing a value
                $verified = FALSE;
                exit();
            }

            $data[$field] = escape_input($_POST[$field]);
        }

        if ($verified == TRUE) {
            $post = new Post();

            $post->title = $data['title'];
            $post->content = $data['content'];

            echo $post->insertall();
        }
        //clear post
        $_POST = array();
    }

    function escape_input($data)
    {
        return htmlspecialchars(stripslashes(trim($data)));
    }
    ?>
    <h1>Create New Blog</h1>
    <?php
    if (!$verified) {
        echo "Form incomplete";
    }
    ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <input type="text" name="title">
        <textarea name="content">

        </textarea>
        <input type="submit" name="submit" value="submit">

    </form>
</body>

</html>