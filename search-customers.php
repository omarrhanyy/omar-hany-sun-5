<?php
    require_once('inc/db.php');
    // number of orders displayed
    $search_keyword = isset($_GET['search_keyword']) && !empty($_GET['search_keyword']) ? $_GET['search_keyword'] : '';
    // sql query
    if (!empty($search_keyword)) {
        $query = "SELECT customerNumber, customerName, contactFirstName, contactLastName FROM customers WHERE customerName LIKE '%$search_keyword%' OR contactFirstName LIKE '%$search_keyword%' OR contactLastName LIKE '%$search_keyword%'";
        // sql obj result
        $result = mysqli_query($connection, $query);
        $records = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    require_once('inc/header.php');
?>
    <form action="" method="GET">
        <input class="form-control" type="text" name="search_keyword" value="<?= $search_keyword ?>" placeholder="search customers" />
        <button class="btn btn-primary mt-4" type="submit">Submit</button>
    </form>
    
    <?php if (isset($records) && count($records)) { ?>
        <table class="table table-striped mt-3">
        <thead class="text-nowrap">
            <tr>
                <th>Customer #</th>
                <th>Customer Name</th>
                <th>Contact First Name</th>
                <th>Contact Last Name</th>
            </tr>
        </thead>
        <tbody class="small">
            <?php foreach ($records as $record) { ?>
            <tr>
                <td><?= $record['customerNumber'] ?></td>
                <td><?= $record['customerName'] ?></td>
                <td><?= $record['contactFirstName'] ?></td>
                <td><?= $record['contactLastName'] ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php } ?>
<?php require_once('inc/footer.php') ?>