<?php
    require_once('inc/db.php');
    // number of orders displayed
    $product_name = isset($_GET['product_name']) && !empty($_GET['product_name']) ? $_GET['product_name'] : '';
    // sql query
    if (!empty($product_name)) {
        $query = "SELECT SUM(quantityOrdered) AS totalQuantityOrdered FROM orderdetails WHERE productCode = '$product_name'
        GROUP BY productCode";
        // sql obj result
        $result = mysqli_query($connection, $query);
        $records = mysqli_fetch_assoc($result);
    }
    require_once('inc/header.php');
?>
    <form action="" method="GET">
        <input class="form-control" type="text" name="product_name" value="<?= $product_name ?>" placeholder="product code" />
        <button class="btn btn-primary mt-4" type="submit">Submit</button>
    </form>
    <?php if (isset($records) && isset($records['totalQuantityOrdered'])) { ?>
        <table class="table table-striped mt-3">
        <tbody class="text-nowrap">
            <tr>
                <td>Total Number of Pieces Ordered of <strong><?= $product_name ?></strong></td>
                <td><?= $records['totalQuantityOrdered'] ?></td>
            </tr>
        </tbody>
    </table>
    <?php } ?>
<?php require_once('inc/footer.php') ?>