<?php include("includes/header.php");
session_start();
?>
<div id="welcome" style="width: 90%;">
    <h1><span>Список продуктів:</span></h1>
    <?php
    $query = mysqli_query($conn, "SELECT * FROM products");

    $edit_button = "https://cdn-icons-png.flaticon.com/32/84/84380.png";
    $delete_button = "https://cdn-icons-png.flaticon.com/32/3405/3405244.png";

    echo "<p>Всього товарів: $query->num_rows</p>";
    echo "<table><tr><th>Id</th><th>Назва</th><th>Опис</th><th>Ціна</th><th>Дії</th></tr>";
    foreach ($query as $row) {
        echo "<tr>";
        echo "<td>" . $row["product_id"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["description"] . "</td>";
        echo "<td>" . $row["price"] . " грн</td>";
        echo "<td><form method='post'>";
        echo "<input type='hidden' name='get_id' value='" . $row["product_id"] . "'>";
        echo "<button type='submit' name='edit'><img src='$edit_button' /></button>";
        echo "<button type='submit' name='delete'><img src='$delete_button' /></button>";
        echo "</form></td>";
        echo "</tr>";
    }
    echo "</table>";
    ?>
    <p></p>
    <a href="add.php" class="button">Додати</a>
</div>

<?php
if (isset($_POST["edit"])) {
    $_SESSION['edit_id'] = $_POST["get_id"];
    echo "<script>location.href='edit.php';</script>";

}

if (isset($_POST["delete"])) {
    $get_id = $_POST["get_id"];
    $query = mysqli_query($conn, "DELETE FROM products WHERE product_id='$get_id'");
    if (mysqli_error($conn)) {
        $message = "This element in order list.";
    } else {
        $message = "Element was deleted!";
        echo "<meta http-equiv='refresh' content='0'>";
    }
}
?>

<?php
if (!empty($message)) {
    echo "<p class='error'>" . "MESSAGE: " . $message . "</p>";
}
?>

<?php include("includes/footer.php"); ?>
