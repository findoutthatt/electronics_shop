<?php include("includes/header.php"); ?>
    <div class="container mlogin">
        <div id="login">
            <h1>Вхід</h1>
            <form action="" id="loginform" method="post" name="loginform">
                <p><label for="user_login">E-mail<br>
                        <input class="input" id="email" name="email" size="20"
                               type="text" value=""></label></p>
                <p><label for="user_pass">Пароль<br>
                        <input class="input" id="password" name="password" size="20"
                               type="password" value=""></label></p>
                <p class="submit"><input class="button_in" name="login" type="submit" value="Log In"></p>
                <p class="regtext">Ще не зареєстровані?<a href="register.php">Реєстрація</a>!</p>
            </form>
        </div>
    </div>

<?php
session_start();
?>


<?php

if (isset($_SESSION["session_email"])) {
// вывод "Session is set"; // в целях проверки

    header("Location: intropage.php");
}

if (isset($_POST["login"])) {

    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = mysqli_real_escape_string($conn, filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));
        $query = mysqli_query($conn, "SELECT * FROM clients WHERE email='$email' AND password='$password'");
        $num_rows = mysqli_num_rows($query);
        if ($num_rows != 0) {
            $row = mysqli_fetch_assoc($query);
            $db_email = $row['email'];
            $db_password = $row['password'];

            if ($email == $db_email && $password == $db_password) {
                // старое место расположения
                //  session_start();
                $_SESSION['session_name'] = $row['name'];
                $_SESSION['session_email'] = $row['email'];
                $_SESSION['session_id'] = $row['client_id'];
                /* Перенаправление браузера */
                header("Location: intropage.php");
            }
        } else {
            //  $message = "Invalid email or password!";

            $message = "Invalid email or password!";
        }
    } else {
        $message = "All fields are required!";
    }
}
?>

<?php
if (!empty($message)) {
    echo "<p class='error'>" . "MESSAGE: " . $message . "</p>";
}
?>

<?php include("includes/footer.php"); ?>