<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <a href="new_blog.php">create</a>
    <a href="">read</a>
    <a href="">update</a>

    <a href="">delete</a>

    <?php
    include_once "../model/post.php";

    $post = new Post();
    $posts = json_decode($post->getAllPosts());
    // print_r($posts);

    // print_r($posts->message);
    ?>

    <table>
        <tr>
            <th>Title</th>
            <th>Content</th>
            <th colspan="3">Actions</th>

        </tr>
        <?php
        if ($posts->message == "success") {
            // echo "<br>" . $posts->results;
            $results = json_decode($posts->results);
            foreach ($results as $p) {
                echo "<tr>";
                echo "<td>" . $p->title . "</td>";
                echo "<td>" . substr($p->content, 0, 80) . " ...</td>";
                echo "<td><a href='view.php?id=" . $p->id . "'>Read</a></td>";
                echo "<td><a href='edit.php?id=" . $p->id . "'>Edit</a></td>";
                echo "<td><a href='delete.php?id=" . $p->id . "'>Delete</a></td>";
                echo "</tr>";
            }
        } else {

            echo '<tr><td colspan="5">No entries</td></tr>';
            // echo "<br>" . "nothing returned";
        }

        ?>



    </table>


    <footer style="position:fixed; bottom: 0px;">
        <?php
        echo "<p>Copyright &copy; " . date("Y") . " </p>";
        ?>
    </footer>
</body>

</html>