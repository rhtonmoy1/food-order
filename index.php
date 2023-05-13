<?php require_once('header.php'); ?>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $cta_title = $row['cta_title'];
    $cta_content = $row['cta_content'];
    $cta_read_more_text = $row['cta_read_more_text'];
    $cta_read_more_url = $row['cta_read_more_url'];
    $cta_photo = $row['cta_photo'];
    $featured_product_title = $row['featured_product_title'];
    $featured_product_subtitle = $row['featured_product_subtitle'];
    $latest_product_title = $row['latest_product_title'];
    $latest_product_subtitle = $row['latest_product_subtitle'];
    $popular_product_title = $row['popular_product_title'];
    $popular_product_subtitle = $row['popular_product_subtitle'];
    $total_featured_product_home = $row['total_featured_product_home'];
    $total_latest_product_home = $row['total_latest_product_home'];
    $total_popular_product_home = $row['total_popular_product_home'];
    $home_service_on_off = $row['home_service_on_off'];
    $home_welcome_on_off = $row['home_welcome_on_off'];
    $home_featured_product_on_off = $row['home_featured_product_on_off'];
    $home_latest_product_on_off = $row['home_latest_product_on_off'];
    $home_popular_product_on_off = $row['home_popular_product_on_off'];
}


?>

<div id="bootstrap-touch-slider" class="carousel bs-slider fade control-round indicators-line" data-ride="carousel" data-pause="hover" data-interval="5000">

    <!-- Indicators -->
    <ol class="carousel-indicators">
        <?php
        $i = 0;
        $statement = $pdo->prepare("SELECT * FROM tbl_slider");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
        ?>
            <li data-target="#bootstrap-touch-slider" data-slide-to="<?php echo $i; ?>" <?php if ($i == 0) {
                                                                                            echo 'class="active"';
                                                                                        } ?>></li>
        <?php
            $i++;
        }
        ?>
    </ol>

    <!-- Wrapper For Slides -->
    <div class="carousel-inner" role="listbox">

        <?php
        $i = 0;
        $statement = $pdo->prepare("SELECT * FROM tbl_slider");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
        ?>
            <div class="item <?php if ($i == 0) {
                                    echo 'active';
                                } ?>" style="background-image:url(assets/uploads/<?php echo $row['photo']; ?>); height: 100vh;
                                width: 100%;
                                background-position: center;
                                background-repeat: no-repeat;
                                background-size: cover;">
                <div class="bs-slider-overlay"></div>
                <div class="container">
                    <div class="row">
                        <div class="slide-text <?php if ($row['position'] == 'Left') {
                                                    echo 'slide_style_left';
                                                } elseif ($row['position'] == 'Center') {
                                                    echo 'slide_style_center';
                                                } elseif ($row['position'] == 'Right') {
                                                    echo 'slide_style_right';
                                                } ?>">
                            <h1 data-animation="animated <?php if ($row['position'] == 'Left') {
                                                                echo 'zoomInLeft';
                                                            } elseif ($row['position'] == 'Center') {
                                                                echo 'flipInX';
                                                            } elseif ($row['position'] == 'Right') {
                                                                echo 'zoomInRight';
                                                            } ?>"><?php echo $row['heading']; ?></h1>
                            <p data-animation="animated <?php if ($row['position'] == 'Left') {
                                                            echo 'fadeInLeft';
                                                        } elseif ($row['position'] == 'Center') {
                                                            echo 'fadeInDown';
                                                        } elseif ($row['position'] == 'Right') {
                                                            echo 'fadeInRight';
                                                        } ?>"><?php echo nl2br($row['content']); ?></p>
                            <a href="<?php echo $row['button_url']; ?>" target="_blank" class="btn btn-primary" data-animation="animated <?php if ($row['position'] == 'Left') {
                                                                                                                                                echo 'fadeInLeft';
                                                                                                                                            } elseif ($row['position'] == 'Center') {
                                                                                                                                                echo 'fadeInDown';
                                                                                                                                            } elseif ($row['position'] == 'Right') {
                                                                                                                                                echo 'fadeInRight';
                                                                                                                                            } ?>"><?php echo $row['button_text']; ?></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php
            $i++;
        }
        ?>
    </div>

    <!-- Slider Left Control -->
    <a class="left carousel-control" href="#bootstrap-touch-slider" role="button" data-slide="prev">
        <span class="fa fa-angle-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>

    <!-- Slider Right Control -->
    <a class="right carousel-control" href="#bootstrap-touch-slider" role="button" data-slide="next">
        <span class="fa fa-angle-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>

</div>


<?php if ($home_service_on_off == 1) : ?>
    <div class="service bg-gray">
        <div class="container">
            <div class="row">
                <?php
                $statement = $pdo->prepare("SELECT * FROM tbl_service");
                $statement->execute();
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $row) {
                ?>
                    <div class="col-md-4">
                        <div class="item">
                            <div class="photo"><img src="assets/uploads/<?php echo $row['photo']; ?>" width="150px" alt="<?php echo $row['title']; ?>"></div>
                            <h3><?php echo $row['title']; ?></h3>
                            <p>
                                <?php echo nl2br($row['content']); ?>
                            </p>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
<?php endif; ?>


<!-- Feature Product -->

<?php if ($home_featured_product_on_off == 1) : ?>
    <div class="product pt_70 pb_70">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="headline">
                        <h2><?php echo $featured_product_title; ?></h2>
                        <h3><?php echo $featured_product_subtitle; ?></h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <div class="product-carousel">

                        <?php
                        // Retrieve all featured products that are active
                        $statement = $pdo->prepare("SELECT * FROM tbl_product WHERE p_is_featured=? AND p_is_active=? LIMIT " . $total_featured_product_home);
                        $statement->execute(array(1, 1));
                        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

                        // Loop through the result set
                        foreach ($result as $row) {
                            $current_price = $row['p_current_price'];
                            $old_price = $row['p_old_price'];
                            $sizes = array();

                            // Check if the product has any sizes
                            $size_statement = $pdo->prepare("SELECT * FROM tbl_product_size WHERE p_id=?");
                            $size_statement->execute(array($row['p_id']));
                            $size_result = $size_statement->fetchAll(PDO::FETCH_ASSOC);

                            if (!empty($size_result)) {
                                // Loop through each size and get the size name and price
                                foreach ($size_result as $size_row) {
                                    $size_id = $size_row['size_id'];
                                    $size_name = '';

                                    // Retrieve the size name from tbl_size
                                    $size_name_statement = $pdo->prepare("SELECT size_name FROM tbl_size WHERE size_id=?");
                                    $size_name_statement->execute(array($size_id));
                                    $size_name_result = $size_name_statement->fetch(PDO::FETCH_ASSOC);

                                    if ($size_name_result) {
                                        $size_name = $size_name_result['size_name'];
                                    }

                                    $sizes[] = array(
                                        'size_id' => $size_id,
                                        'size_name' => $size_name,
                                        'current_price' => $size_row['p_current_price'],
                                        'old_price' => $size_row['p_old_price']
                                    );
                                }
                            }

                            // Display the product information
                        ?>
                            <div class="item">
                                <a href="product.php?id=<?php echo $row['p_id']; ?>">
                                    <div class="thumb">
                                        <div class="photo" style="background-image:url(assets/uploads/<?php echo $row['p_featured_photo']; ?>);"></div>
                                        <div class="overlay"></div>
                                    </div>
                                    <div class="text">
                                        <h3><a href="product.php?id=<?php echo $row['p_id']; ?>"><?php echo $row['p_name']; ?></a></h3>
                                        <?php if (!empty($sizes)) { ?>
                                            <p>
                                                <?php foreach ($sizes as $size) { ?>
                                                    <span><?php echo $size['size_name']; ?>:</span>
                                                    <span><?php echo $size['current_price']; ?></span>
                                                    <?php if ($size['old_price'] != '') { ?>
                                                        <del><?php echo $size['old_price']; ?></del>
                                                    <?php } ?>
                                                    <br>
                                                <?php } ?>
                                            </p>
                                        <?php } else { ?>
                                            <h4>
                                                $<?php echo $current_price; ?>
                                                <?php if ($old_price != '' && $old_price != 0) : ?>
                                                    <del>
                                                        $<?php echo $old_price; ?>
                                                    </del>
                                                <?php endif; ?>
                                            </h4>
                                        <?php } ?>
                                        <p><a href="product.php?id=<?php echo $row['p_id']; ?>"><i class="fa fa-shopping-cart"></i> Add to Cart</a></p>
                                    </div>
                                </a>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>


<?php if ($home_latest_product_on_off == 1) : ?>
    <div class="product bg-gray pt_70 pb_30">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="headline">
                        <h2><?php echo $latest_product_title; ?></h2>
                        <h3><?php echo $latest_product_subtitle; ?></h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <div class="product-carousel">

                        <?php
                        $statement = $pdo->prepare("SELECT * FROM tbl_product WHERE p_is_active=? ORDER BY p_id DESC LIMIT " . $total_latest_product_home);
                        $statement->execute(array(1));
                        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($result as $row) {
                        ?>
                            <div class="item">
                                <div class="thumb">
                                    <div class="photo" style="background-image:url(assets/uploads/<?php echo $row['p_featured_photo']; ?>);"></div>
                                    <div class="overlay"></div>
                                </div>
                                <div class="text">
                                    <h3><a href="product.php?id=<?php echo $row['p_id']; ?>"><?php echo $row['p_name']; ?></a></h3>
                                    <h4>
                                        $<?php echo $row['p_current_price']; ?>
                                        <?php if ($row['p_old_price'] != '') : ?>
                                            <del>
                                                $<?php echo $row['p_old_price']; ?>
                                            </del>
                                        <?php endif; ?>
                                    </h4>



                                    <p><a href="product.php?id=<?php echo $row['p_id']; ?>"><i class="fa fa-shopping-cart"></i> Add to Cart</a></p>

                                </div>
                            </div>
                        <?php
                        }
                        ?>

                    </div>


                </div>
            </div>
        </div>
    </div>
<?php endif; ?>


<?php if ($home_popular_product_on_off == 1) : ?>
    <div class="product pt_70 pb_70">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="headline">
                        <h2><?php echo $popular_product_title; ?></h2>
                        <h3><?php echo $popular_product_subtitle; ?></h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <div class="product-carousel">

                        <?php
                        $statement = $pdo->prepare("SELECT * FROM tbl_product WHERE p_is_active=? ORDER BY p_total_view DESC LIMIT " . $total_popular_product_home);
                        $statement->execute(array(1));
                        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($result as $row) {
                        ?>
                            <div class="item">
                                <div class="thumb">
                                    <div class="photo" style="background-image:url(assets/uploads/<?php echo $row['p_featured_photo']; ?>);"></div>
                                    <div class="overlay"></div>
                                </div>
                                <div class="text">
                                    <h3><a href="product.php?id=<?php echo $row['p_id']; ?>"><?php echo $row['p_name']; ?></a></h3>
                                    <h4>
                                        $<?php echo $row['p_current_price']; ?>
                                        <?php if ($row['p_old_price'] != '') : ?>
                                            <del>
                                                $<?php echo $row['p_old_price']; ?>
                                            </del>
                                        <?php endif; ?>
                                    </h4>

                                    <p><a href="product.php?id=<?php echo $row['p_id']; ?>"><i class="fa fa-shopping-cart"></i> Add to Cart</a></p>

                                </div>
                            </div>
                        <?php
                        }
                        ?>

                    </div>

                </div>
            </div>
        </div>
    </div>
<?php endif; ?>




<?php require_once('footer.php'); ?>