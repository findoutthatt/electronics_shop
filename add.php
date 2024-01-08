<?php include("includes/header.php"); ?>
    <div class="container add" id="welcome">
        <div id="add">
            <h1>Додавання</h1>
            <form action="" id="addform" method="post" name="addform">
                <p><label for="name">name<br>
                        <input class="input" id="name" name="name"
                               type="text" value=""></label></p>
                <p><label for="description">Oпис<br>
                        <input class="input" id="desription" name="description"
                               type="description" value=""></label></p>
                <p><label for="price">price<br>
                        <input class="input" id="price" name="price"
                               type="price" value="">

                    </label></p>
                <select class="input" id="supplier_name" name="supplier_name">
                    <?php
                    $query = mysqli_query($conn, "SELECT name, supplier_id FROM supplier");
                    foreach ($query as $row)
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

        $query = mysqli_query($conn, "INSERT INTO products(name, description, price, supplier_id) VALUES ('$name','$description','$price','$supplier_id')");
        if (mysqli_error($conn)) {
            $message = "Price is not available!";
        } else {
            header("Location: showproducts.php");
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