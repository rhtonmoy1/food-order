<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1'])) {
    $old_price = $_POST['old_price'];
    $current_price = $_POST['current_price'];
    $size_name = $_POST['size_name'];
    $p_id = $_GET['id'];

    // Check if the product size already exists
    $stmt = $pdo->prepare("SELECT * FROM tbl_product_size WHERE p_id = ? AND size_id IN (SELECT size_id FROM tbl_size WHERE size_name = ?)");
    $stmt->execute([$p_id, $size_name]);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(count($rows) > 0) {
        // Product size already exists, update the prices
        $size_id = $rows[0]['size_id'];
        $stmt = $pdo->prepare("UPDATE tbl_product_size SET p_old_price = ?, p_current_price = ? WHERE p_id = ? AND size_id = ?");
        $stmt->execute([$old_price, $current_price, $p_id, $size_id]);
        $success_message = "Size quantity updated successfully.";
    } else {
        // Product size does not exist, insert a new row
        $stmt = $pdo->prepare("INSERT INTO tbl_product_size (p_id, size_id, p_old_price, p_current_price) VALUES (?, (SELECT size_id FROM tbl_size WHERE size_name = ?), ?, ?)");
        $stmt->execute([$p_id, $size_name, $old_price, $current_price]);
        $success_message = "Size quantity added successfully.";
    }
}

// Fetch the product details
$stmt = $pdo->prepare("SELECT * FROM tbl_product WHERE p_id = ?");
$stmt->execute([$_GET['id']]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

?>


<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php if ($error_message) : ?>
                <div class="callout callout-danger">
                    <p>
                        <?php echo $error_message; ?>
                    </p>
                </div>
            <?php endif; ?>

            <?php if ($success_message) : ?>
                <div class="callout callout-success">
                    <p><?php echo $success_message; ?></p>
                </div>
            <?php endif; ?>

            <form class="form-horizontal" method="POST" action="">
                <div class="box box-info">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="size_name">Size:</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="size_name" id="size_name" required>
                                    <?php
                                    $stmt = $pdo->prepare("SELECT size_name FROM tbl_size");
                                    $stmt->execute();
                                    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($rows as $row) {
                                        echo "<option value='" . $row['size_name'] . "'>" . $row['size_name'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="old_price">Old Price:</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="old_price" id="old_price" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="current_price">Current Price:</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="current_price" id="current_price" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" name="form1" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<?php require_once('footer.php'); ?>
