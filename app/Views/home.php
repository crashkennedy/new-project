<!DOCTYPE html>
<html lang="en">
<?php require_once('inc/header.php') ?>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-gradient-danger">
        <div class="container px-4 px-lg-5 ">
            <button class="navbar-toggler btn btn-sm" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <a class="navbar-brand" href="./">
                <img src="../../public/uploads/logo.png"  width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
                <?php
                // echo $_settings->info('short_name')
                 ?>
            </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link text-white" aria-current="page" href="./">Home</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="./?p=products">Products</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="./?p=about">About</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="./?p=contact">Contact Us</a>
                    <li class="nav-item"><a class="nav-link text-white" href="./?p=faq">FAQ</a></li>
                    <?php
                    // if($_settings->userdata('id') != '' && $_settings->userdata('id') != 2):
                    //   $cart = $conn->query("SELECT SUM(quantity) FROM `cart_list` where customer_id = '{$_settings->userdata('id')}' ")->fetch_array()[0];
                    // endif;
                    // $cart = isset($cart) && $cart > 0 ? $cart : '';
                    ?>
                    <?php
                    // if (
                    //     $_settings->userdata('id') != '' && $_settings->userdata('login_type') == 2):
                    //
                    ?>
                        <li class="nav-item"><a class="nav-link text-white" href="./?p=cart_list">Cart <span class="ml-2 badge badge-primary"><?= $cart > 0 ? format_num($cart) : '' ?></span></a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="./?p=pres">Prescription Management</a></li>
                    <?php
                // endif;
                ?>

                </ul>
                <div class="d-flex align-items-center">
                    <?php
                    // if ($_settings->userdata('id') != '' && $_settings->userdata('login_type') == 2):
                    ?>
                        <!-- <div class="btn-group nav-link">
                            <button type="button" class="btn btn-rounded badge badge-light dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                <span><img src="<?php echo validate_image($_settings->userdata('avatar')) ?>" class="img-circle elevation-2 user-img" alt="User Image"></span>
                                <span class="ml-3"><?php echo ucwords($_settings->userdata('firstname') . ' ' . $_settings->userdata('lastname')) ?></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu">
                                <a class="dropdown-item" href="<?php echo base_url . '?p=user' ?>"><span class="fa fa-user"></span> My Account</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?php echo base_url . '?p=orders' ?>"><span class="fa fa-table"></span> My Orders</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?php echo base_url . '/classes/Login.php?f=logout_customer' ?>"><span class="fas fa-sign-out-alt"></span> Logout</a>
                            </div>
                        </div> -->
                    <?php
                // else:
                 ?>
                        <a class="font-weight-bolder text-light mx-2 text-decoration-none" href="./login.php">Login</a>
                        <a class="font-weight-bolder text-light mx-2 text-decoration-none" href="./register.php">Register</a>
                        <a class="font-weight-bolder text-light mx-2 text-decoration-none" href="./admin">Admin Panel</a>
                    <?php
                // endif;
                ?>
                </div>
                <section class="py-3">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="carouselExampleControls" class="carousel slide bg-dark" data-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="carousel-item h-100 ">
                                            <img src="<?php echo $full_path ?>" class="d-block w-100  h-100" alt="img">
                                        </div>
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-target="#carouselExampleControls" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-target="#carouselExampleControls" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center mt-n3">
                            <div class="col-lg-10 col-md-11 col-sm-11 col-sm-11">
                                <div class="card card-outline rounded-0">
                                    <div class="card-body">
                                        <div class="row row-cols-xl-4 row-md-6 col-sm-12 col-xs-12 gy-2 gx-2">
                                            <?php
                                            // $sql = "SELECT *,
                                            //     (COALESCE((SELECT SUM(quantity) FROM stock_list WHERE product_id = product_list.id AND (expiration IS NULL OR date(expiration) > :current_date)), 0) -
                                            //     COALESCE((SELECT SUM(quantity) FROM order_items WHERE product_id = product_list.id), 0)) AS available
                                            //     FROM product_list
                                            //     WHERE (COALESCE((SELECT SUM(quantity) FROM stock_list WHERE product_id = product_list.id AND (expiration IS NULL OR date(expiration) > :current_date)), 0) -
                                            //     COALESCE((SELECT SUM(quantity) FROM order_items WHERE product_id = product_list.id), 0)) > 0
                                            //     ORDER BY RANDOM() LIMIT 4";
                                            // $stmt = $conn->prepare($sql);
                                            // $stmt->execute(['current_date' => date("Y-m-d")]);
                                            // while ($row = $stmt->fetch(PDO::FETCH_ASSOC)):
                                            ?>
                                            <div class="col">
                                                <a class="card rounded-0 shadow product-item text-decoration-none text-reset" href="./?p=products/view_product&id=<?= $row['id'] ?>">
                                                    <div class="position-relative">
                                                        <div class="img-top position-relative product-img-holder">
                                                            <img src="<?= validate_image($row['image_path']) ?>" alt="" class="product-img">
                                                        </div>
                                                        <div class="position-absolute bottom-1 right-1" style="bottom:.5em;right:.5em">
                                                            <span class="badge badge-light bg-gradient-light border text-dark px-4 rounded-pill"><?= format_num($row['price'], 2) ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <div style="line-height:1em">
                                                            <div class="card-title w-100 mb-0"><?= $row['name'] ?></div>
                                                            <div class="card-description w-100"><small class="text-muted"><?= $row['brand'] ?></small></div>
                                                            <div class="card-description w-100"><small class="text-muted">Stock: <?= format_num($row['available'], 0) ?></small></div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <?php
                                            // endwhile;
                                            ?>
                                        </div>
                                        <div class="text-center py-1">
                                            <a href="./?p=products" class="btn btn-lg btn-deafault text-light bg-gradient-maroon col-lg-4 col-md-6 col-sm-12 col-xs-12 rounded-pill">Explore More Product</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
</body>

</html>