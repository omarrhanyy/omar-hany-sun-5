<?php
    require_once('inc/db.php');
    // number of orders displayed
    $num = isset($_GET['num']) && $_GET['num'] > 0 ? $_GET['num'] : 0;
    // sql query
    if (!empty($num)) {
        $query = "SELECT * FROM orders JOIN customers ON orders.customerNumber = customers.customerNumber LIMIT $num";
        // sql obj result
        $result = mysqli_query($connection, $query);
        $records = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    require_once('inc/header.php');
?>
    <form action="" method="GET">
        <input class="form-control" type="number" name="num" value="<?= $num ?>" placeholder="Number of orders displayed" />
        <button class="btn btn-primary mt-4" type="submit">Submit</button>
    </form>
    <?php if (isset($records) && count($records)) { ?>
        <table class="table table-striped mt-3">
        <thead class="text-nowrap">
            <tr>
                <th>Order Number</th>
                <th>Customer</th>
                <th>Order Date</th>
                <th>Required Date</th>
                <th>Status</th>
                <th>Comments</th>
            </tr>
        </thead>
        <tbody class="small">
            <?php foreach ($records as $record) { ?>
            <tr>
                <td><?= $record['orderNumber'] ?></td>
                <td><?= $record['customerName'] ?> #<?= $record['customerNumber'] ?><br>Phone: <?= $record['phone'] ?></td>
                <td><?= $record['orderDate'] ?></td>
                <td><?= $record['requiredDate'] ?></td>
                <td class="text-nowrap">
                    <?= $record['status'] ?>
                    <?php if (isset($record['shippedDate'])) { ?>
                        <br>
                        <?= $record['shippedDate'] ?>
                    <?php } ?>
                </td>
                <td><?= $record['comments'] ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php } ?>
<?php require_once('inc/footer.php') ?>