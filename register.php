<?php include("includes/header.php"); ?>
    <div class="container mregister">
        <div id="login">
            <h1>Реєстрація</h1>
            <form action="register.php" id="registerform" method="post" name="registerform">
                <p><label for="user_login">Ім'я<br>
                        <input class="input" id="name" name="name" size="32" type="text" value=""></label></p>
                <p><label for="user_pass">E-mail<br>
                        <input class="input" id="email" name="email" size="32" type="email" value=""></label></p>
                <p><label for="user_pass">Номер телефону<br>
                        <input class="input" id="number" name="number" size="20" type="text" value=""></label></p>
                <p><label for="user_pass">Пароль<br>
                        <input class="input" id="password" name="password" size="32" type="password" value=""></label>
                </p>
                <p class="submit"><input class="button_in" id="register" name="register" type="submit"
                                         value="Зареєструватися"></p>
                <p class="regtext">Вже зареєстровані? <a href="login.php">Введіть ім'я користувача</a>!</p>
            </form>
        </div>
    </div>
<?php
if (isset($_POST["register"])) {

    if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['number']) && !empty($_POST['password'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
        $number = mysqli_real_escape_string($conn, $_POST['number']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));
        $query = mysqli_query($conn, "SELECT * FROM clients WHERE email='$email'");
        $num_rows = mysqli_num_rows($query);
        if ($num_rows == 0) {
            $sql = "INSERT INTO clients (name, email, number,password) VALUES ('$name','$email','$number','$password')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $message = "Account Successfully Created";
            } else {
                $message = "Failed to insert data information!";
            }
        } else {
            $message = "That email already exists! Please try another one!";
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