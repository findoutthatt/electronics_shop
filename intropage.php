<?php include("includes/header.php");
session_start();
?>

<div id="welcome">
    <h3>Вітаємо, <span><?php echo $_SESSION['session_name'];?></span>!</h3>
    <p class="submit">
        <a href="showproducts.php" class="button">Товари</a>
        <a href="showorder.php" class="button">Чек ліст</a>
        <a href="showuser.php" class="button">Інформація користувача</a>
    </p>
    <p><a href="logout.php">Вийти</a> із системи</p>
</div>
<?php include("includes/footer.php"); ?>
