<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1'])) {
    $old_price = $_POST['old_price'];
    $current_price = $_POST['current_price'];
    $size_name = $_POST['size_name'];

    $stmt = $pdo->prepare("SELECT so_price, sc_price FROM tbl_product_size WHERE size_id IN (SELECT size_id FROM tbl_size WHERE size_name = ?)");
    $stmt->execute([$size_name]);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

	if(count($rows) > 0) {
		$size_id = $rows[0]['size_id'];
		$stmt = $pdo->prepare("SELECT size_id, so_price, sc_price FROM tbl_product_size WHERE size_id IN (SELECT size_id FROM tbl_size WHERE size_name = ?)");
		$stmt->execute([$size_id]);
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
		if(count($rows) > 0) {
			$so_price = $rows[0]['so_price'];
			$sc_price = $rows[0]['sc_price'];
			echo "SO Price: " . $so_price . "<br>";
			echo "SC Price: " . $sc_price . "<br>";
		} else {
			// No matching rows found, handle error here
		}
	}
	
}

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
