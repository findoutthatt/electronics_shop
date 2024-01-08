<?php include("includes/header.php");
session_start();
$edit_id = $_SESSION['edit_id'];
$query = mysqli_query($conn, "SELECT * FROM products WHERE product_id='$edit_id'");
foreach ($query as $row){
    $name = $row["name"];
    $description = $row["description"];
    $price = $row["price"];
    $supplier_id = $row["supplier_id"];
    $product_id = $row['product_id'];

}
?>
<div class="container add" id="welcome">
    <div id="edit">
        <h1>Зміна</h1>
        <form action="" id="editform" method="post" name="editform">
            <p><label for="name">Назва<br>
                    <input class="input" id="name" name="name"
                           type="text" value="<?php echo htmlspecialchars($name) ?>"></label></p>
            <p><label for="description">Oпис<br>
                    <input class="input" id="desription" name="description"
                           type="description"  value="<?php echo htmlspecialchars($description)?>"></label></p>
            <p><label for="price">Ціна<br>
                    <input class="input" id="price" name="price"
                           type="price" value="<?php echo $price?>">

                </label></p>
            <select class="input" id="supplier_name" name="supplier_name">
                <?php
                $query = mysqli_query($conn, "SELECT name, supplier_id FROM supplier");
                foreach ($query as $row)
                    if ($row["supplier_id"] == $supplier_id){
                        echo "<option value=".$row["supplier_id"]." selected>" . $row['name'] . "</option>";
                    }else
                        echo "<option value=".$row["supplier_id"].">" . $row['name'] . "</option>" ?>
            </select>

            <p class="submit"><input class="button_in" name="ok" type="submit" value="Ok"></p>
            <p class="submit"><input class="button_in" name="cancel" type="submit" value="Cancel"></p>

        </form>
    </div>
</div>

<?php
if (isset($_POST["ok"])) {

    if (!empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['price']) && !empty($_POST['supplier_name'])) {

        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $price = mysqli_real_escape_string($conn, $_POST['price']);
        $supplier_id = mysqli_real_escape_string($conn, $_POST['supplier_name']);
        $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);


        $query = mysqli_query($conn, "UPDATE products SET name='$name', description='$description', price='$price', supplier_id='$supplier_id' WHERE product_id='$edit_id'");
        if (mysqli_error($conn)) {
            $message = "Price is not available!";
        } else {
            echo "<script>location.href='showproducts.php';</script>";
        }

    } else {
        $message = "All fields are required!";
    }
}?>
<?php
if (isset($_POST["cancel"])) {
    header("Location: showproducts.php");
}
?>

<?php
if (!empty($message)) {
    echo "<p class='error'>" . "MESSAGE: " . $message . "</p>";
}
?>

<?php include("includes/footer.php"); ?>
