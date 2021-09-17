<?php
// include_once 'header.php';
?>
<div class="form-design">
    <h2>Sign Up</h2>

    <?php
    if (isset($_GET['error'])) {
        switch ($_GET['error']) {
            case "emptyinput":
                echo "<p>Please fill in the form</p>";
                break;
            case "invalidusername":
                echo "<p>Please enter a valid username, no speacial characters</p>";
                break;
            case "invalidemail":
                echo "<p>The email entered is not a valid email address</p>";
                break;
            case "passwordsdontmatch":
                echo "<p>Passwords do not match</p>";
                break;
            case "userexists":
                echo "<p>User already exists</p>";
                break;

            default:
                echo "<p>" . $_GET['error'] . "</p>";
        }
    }
    ?>
    <form action="backend/signup_new_user.php" method="post">
        <label>Username:</label>
        <input type="text" name="username" style="display: block;">

        <label>Name:</label>
        <input type="text" name="name" style="display: block;">

        <label>Email:</label>
        <input type="text" name="email" style="display: block;">


        <label>Password:</label>
        <input type="password" name="password" style="display: block;">

        <label>Retype Password:</label>
        <input type="password" name="rpassword" style="display: block;">

        <!-- <input type="submit" value="Sign up" name="signup">-->
        <button type="submit" name="signup">Sign up</button>
    </form>
</div>

<?php
// include_once 'footer.php';
?>