<?php include("includes/header.php");
session_start();
?>
<div id="welcome" style="width: 90%;">
    <h1><span>Список заказів:</span></h1>
    <?php
    $query = mysqli_query($conn, "SELECT products.name AS product_name, orderlist.count, stock.name AS stock_name, operators.name AS operator_name, sellers.name AS seller_name
    FROM orderlist 
    LEFT JOIN products ON products.product_id = orderlist.product_id
    LEFT JOIN stock ON stock.stock_id = orderlist.stock_id
    LEFT JOIN operators ON operators.operator_id = orderlist.operator_id
    LEFT JOIN sellers ON sellers.seller_id = orderlist.seller_id
    WHERE client_id = '" . $_SESSION['session_id'] . "';");

    $message = mysqli_error($conn);

    if (mysqli_num_rows($query) == 0) echo "<p>Ваш список порожній</p>";
    else {
        $num_rows = mysqli_num_rows($query);
        echo "<p>Всього товарів: $num_rows</p>";
        echo "<table><tr><th>Назва</th><th>Кількість</th><th>Адреса складу</th><th>Ім'я оператору</th><th>Ім'я продавця</th></tr>";
        while ($row = mysqli_fetch_assoc($query)) {
            echo "<tr>";
            echo "<td>" . $row["product_name"] . "</td>";
            echo "<td>" . $row["count"] . "</td>";
            echo "<td>" . $row["stock_name"] . "</td>";
            echo "<td>" . $row["operator_name"] . "</td>";
            echo "<td>" . $row["seller_name"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    ?>
    <p></p>
</div>

<?php
if (!empty($message)) {
    echo "<p class='error'>" . "MESSAGE: " . $message . "</p>";
}
?>
<?php include("includes/footer.php"); ?>
