<!DOCTYPE html>
<html lang="en">
<?php

require_once('inc/header.php') ?>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-gradient-danger">
        <div class="container px-4 px-lg-5 ">
            <button class="navbar-toggler btn btn-sm" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <a class="navbar-brand" href="./">
                <img src="../../public/uploads/logo.png" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
                <?php
                echo $settings->info('short_name')
                ?>
            </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link text-white" aria-current="page" href="/">Home</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="/products">Products</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="/about">About</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="/contact">Contact Us</a>
                    <li class="nav-item"><a class="nav-link text-white" href="/faq">FAQ</a></li>
                    <?php
                    // if($_settings->userdata('id') != '' && $_settings->userdata('id') != 2):
                    //   $cart = $conn->query("SELECT SUM(quantity) FROM `cart_list` where customer_id = '{$_settings->userdata('id')}' ")->fetch_array()[0];
                    // endif;
                    // $cart = isset($cart) && $cart > 0 ? $cart : '';
                    $cart = $cart;
                    ?>
                    <?php
                    if (
                        $settings->userdata('id') != '' && $settings->userdata('login_type') == 2
                    ):

                    ?>
                        <li class="nav-item"><a class="nav-link text-white" href="./?p=cart_list">Cart <span class="ml-2 badge badge-primary"><?
                                                                                                                                                // = $cart > 0 ? format_num($cart) : ''
                                                                                                                                                ?>
                                </span></a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="./?p=pres">Prescription Management</a></li>
                    <?php
                    endif;
                    ?>

                </ul>
                <div class="d-flex align-items-center">
                    <?php
                    if ($settings->userdata('id') != '' && $settings->userdata('login_type') == 2):
                    ?>
                        <div class="btn-group nav-link">
                            <button type="button" class="btn btn-rounded badge badge-light dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                <span><img src="<?php echo $settings->userdata('avatar') ?>" class="img-circle elevation-2 user-img" alt="User Image"></span>
                                <span class="ml-3"><?php echo ucwords($settings->userdata('firstname') . ' ' . $settings->userdata('lastname')) ?></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu">
                                <a class="dropdown-item" href="<?php echo '/user' ?>"><span class="fa fa-user"></span> My Account</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?php echo '/orders' ?>"><span class="fa fa-table"></span> My Orders</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?php echo  '/logout' ?>"><span class="fas fa-sign-out-alt"></span> Logout</a>
                            </div>
                        </div>
                    <?php
                    else:
                    ?>
                        <a class="font-weight-bolder text-light mx-2 text-decoration-none" href="./login.php">Login</a>
                        <a class="font-weight-bolder text-light mx-2 text-decoration-none" href="./register.php">Register</a>
                        <a class="font-weight-bolder text-light mx-2 text-decoration-none" href="./admin">Admin Panel</a>
                    <?php
                    endif;
                    ?>
                </div>
    </nav>
    <section class="py-3 bg-dark">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="carouselExampleControls" class="carousel slide bg-dark" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item h-100 ">
                                <img src="../../public/uploads/banner/wp1.jpg" class="d-block w-100  h-100" alt="img">
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
        </div>
    </section>
    <section>
            <div class="row justify-content-center mt-n3">
                <div class="col-lg-10 col-md-11 col-sm-11 col-sm-11">
                    <div class="card card-outline rounded-0">
                        <div class="card-body">
                            <div class="row row-cols-xl-4 row-md-6 col-sm-12 col-xs-12 gy-2 gx-2">
                                <?php
                                foreach ($products as $row):
                                ?>
                                    <div class="col">
                                        <a class="card rounded-0 shadow product-item text-decoration-none text-reset" href="./?p=products/view_product&id=<?= $row['id'] ?>">
                                            <div class="position-relative">
                                                <div class="img-top position-relative product-img-holder">
                                                    <img src="<?= $row['image_path'] ?>" alt="" class="product-img">
                                                </div>
                                                <div class="position-absolute bottom-1 right-1" style="bottom:.5em;right:.5em">
                                                    <span class="badge badge-light bg-gradient-light border text-dark px-4 rounded-pill"><?$row['price'] ?></span>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div style="line-height:1em">
                                                    <div class="card-title w-100 mb-0"><?= $row['name'] ?></div>
                                                    <div class="card-description w-100"><small class="text-muted"><?= $row['brand'] ?></small></div>
                                                    <div class="card-description w-100"><small class="text-muted">Stock: <?= $row['available']?></small></div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                <?php
                                endforeach
                                ?>
                            </div>
                            <div class="text-center py-1">
                                <a href="/products" class="btn btn-lg btn-deafault text-light bg-gradient-maroon col-lg-4 col-md-6 col-sm-12 col-xs-12 rounded-pill">Explore More Product</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>