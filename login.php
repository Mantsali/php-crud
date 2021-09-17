<?php
// include_once 'header.php';
?>
<div class="form-design">

    <h2>Login</h2>
    <?php
    if (isset($_GET['error'])) {
        switch ($_GET['error']) {
            case "emptyinput":
                echo "<p>Please fill in the form</p>";
                break;
            case "invalidusername":
                echo "<p>Please enter user doesnt exist</p>";
                break;
            case "invalidlogin":
                echo "<p>The wrong login details were entered</p>";
                break;
            default:
                echo "<p>" . $_GET['error'] . "</p>";
        }
    }
    ?>
    <form action="backend/login_user.php" method="post">
        <label>Username / email:</label>
        <input type="text" name="username" style="display: block;">

        <label>Password:</label>
        <input type="password" name="password" style="display: block;">

        <input type="submit" value="Login" name="login">
    </form>
</div>

<?php
// include_once 'footer.php';
?>