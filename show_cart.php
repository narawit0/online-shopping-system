<?php include("includes/header.php"); ?>
<style type="text/css">
    .show-cart {
        margin-top: 2rem;
    }
    .show-cart--table {
        margin: 0 auto;
        width: 70rem;
        border-collapse: collapse;
        font-weight: 300;
    }

    .show-cart--table > thead {
        background-color: var(--color-grey-dark-1);
        color: var(--color-white);
    }

    .show-cart--table  * {
        padding: 1rem;
        text-align: center;
    }

    .show-cart--table > thead > tr > th:nth-child(1), th:nth-child(3)  {
        width: 5rem;
    }

    .show-cart--table > thead > tr > th:last-child {
        width: 10rem;
    }

    .show-cart--table  > tbody tr:nth-child(odd) {
        background-color: var(--color-secondary-dark);
    }

    .show-cart--table  > tbody tr:nth-child(even) {
        background-color: var(--color-grey-dark-2);
    }

    .show-cart--table  > tbody tr {
        color: var(--color-white);
        transition: all .3s;
    }

    .show-cart--table  > tbody tr:hover {
        background-color: var(--color-white);
        color: var(--color-primary-dark);
    }

    .show-cart--table > tfoot {
        background-color: var(--color-grey-dark-1);
        color: var(--color-white);
    }


</style>
<main class="show-cart">
    <div class="container">
        <table class="show-cart--table">
        <thead>
        <tr>
            <th>ลำดับ</th>
            <th>ชื่อสินค้า</th>
            <th>จำนวน</th>
            <th>ราคาสินค้า</th>
        </tr>
        </thead>
        <tbody>
<?php 
    $cart = new Cart();
    $cart->user_id = $_SESSION['id'];
    $result = $cart->show_products_in_cart();
    $i = 1;
    $total_price = 0;

    while($row = mysqli_fetch_assoc($result)) {
        $price = $row['quanity'] * $row['product_price'];
        $total_price += $price;
        echo "<tr>";
        echo "<td>{$i}</td>";
        echo "<td>{$row['product_name']}</td>";
        echo "<td>{$row['quanity']}</td>";
        echo "<td>" . number_format($price) . "</td>";
        echo "</tr>";
        $i++;
    }  
?>
        </tbody>
        <tfoot>
            <tr>
                <td></td>
                <td>รวมทั้งหมด</td>
                <td></td>
                <td><?php echo number_format($total_price); ?></td>
            </tr>
        </tfoot>
        </table>
    </div>
</main>
<?php include("includes/footer.php"); ?>
<script type="text/javascript">
    get_cart_count();
</script>
