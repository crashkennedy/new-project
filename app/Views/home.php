<!DOCTYPE html>
<html lang="en">
<?php require_once('inc/header.php') ?>
<style>
    html,
    body {
        height: 100%;
        margin: 0;
    }

    .page-container {
        min-height: 100%;
        display: flex;
        flex-direction: column;
    }

    .content-wrap {
        flex: 1 0 auto;
    }

    .product-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .product-img-container {
        height: 250px;
        overflow: hidden;
    }

    .product-img-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .product-img-container:hover img {
        transform: scale(1.1);
    }

    .product-overlay {
        background: rgba(0, 0, 0, 0.5);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .product-img-container:hover .product-overlay {
        opacity: 1;
    }

    .hero {
        background-image: url('../../public/uploads/drugs.jpg');
        background-size: cover;
        background-position: center;
        color: white;
        height: 80vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .hero-background-overlay {
        background-color: rgba(0, 0, 0, 0.75);
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    .hero img {
        max-width: 90%;
        border: 5px solid white;
    }

    .category-card,
    .step-card,
    .testimonial-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .category-card:hover,
    .step-card:hover,
    .testimonial-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }

    .category-icon {
        width: 100px;
        height: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgba(220, 53, 69, 0.1);
        border-radius: 50%;
    }

    .step-card .step-number {
        margin-bottom: 1rem;
    }

    .testimonial-card .testimonial-quote i {
        font-size: 2rem;
        opacity: 0.5;
        margin-bottom: 1rem;
    }

    .testimonial-card .testimonial-author img {
        border: 3px solid #dc3545;
    }


    å footer {
        flex-shrink: 0;
    }
</style>

<body>
    <div class="page-container">
        <div class="content-wrap">
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
                                <a class="font-weight-bolder text-light mx-2 text-decoration-none" href="./login">Login</a>
                                <a class="font-weight-bolder text-light mx-2 text-decoration-none" href="./register">Register</a>
                                <a class="font-weight-bolder text-light mx-2 text-decoration-none" href="./admin">Admin Panel</a>
                            <?php
                            endif;
                            ?>
                        </div>
            </nav>
            <section class="hero position-relative">
                <div class="hero-background-overlay position-absolute w-100 h-100"></div>
                <div class="container py-5 position-relative">
                    <div class="row align-items-center">
                        <div class="col-lg-6 text-white">
                            <h1 class="display-4 fw-bold mb-4">Your Health, Our Priority</h1>
                            <p class="lead mb-4">
                                Convenient, secure, and reliable prescription management
                                and medical supplies delivery right to your doorstep.
                            </p>
                            <div class="d-flex gap-3">
                                <a href="/products" class="btn btn-danger bg-gradient-danger rounded-pill px-4 py-2">
                                    Shop Now
                                </a>
                                <a href="/consultation" class="btn btn-outline-danger rounded-pill px-4 py-2">
                                    Online Consultation
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            <!-- <section class="categories py-5 bg-light">
                <div class="container">
                    <div class="row">
                        <div class="col-12 text-center mb-5">
                            <h2 class="display-6 fw-bold">Our Product Categories</h2>
                            <p class="text-muted">Explore our wide range of medical products</p>
                        </div>
                    </div> -->
                    <!-- <div class="row g-4">
                        <?php
                        // $categories = [
                        //     ['name' => 'Prescription Drugs', 'icon' => 'fa-prescription-bottle', 'link' => '/prescription-drugs'],
                        //     ['name' => 'Over-the-Counter', 'icon' => 'fa-pills', 'link' => '/otc-drugs'],
                        //     ['name' => 'Medical Supplies', 'icon' => 'fa-first-aid', 'link' => '/medical-supplies'],
                        //     ['name' => 'Personal Care', 'icon' => 'fa-hand-holding-medical', 'link' => '/personal-care']
                        // ];

                        // foreach ($categories as $category):
                        ?>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                                <a href="<?= $category['link'] ?>" class="text-decoration-none">
                                    <div class="card category-card h-100 text-center border-0 shadow-sm hover-lift">
                                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                                            <div class="category-icon mb-3">
                                                <i class="fas <?= $category['icon'] ?> fa-3x text-danger"></i>
                                            </div>
                                            <h5 class="category-name text-dark"><?= $category['name'] ?></h5>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php
                        // endforeach
                        ?>
                    </div>
                </div>
            </section> -->

            <!-- <section class="how-it-works py-5">
                <div class="container">
                    <div class="row">
                        <div class="col-12 text-center mb-5">
                            <h2 class="display-6 fw-bold">How It Works</h2>
                            <p class="text-muted">Simple steps to manage your health needs</p> -->
                        <!-- </div>
                    </div>
                    <div class="row g-4">
                        <?php
                        // $steps = [
                        //     ['number' => '1', 'title' => 'Create Account', 'description' => 'Sign up and complete your profile'],
                        //     ['number' => '2', 'title' => 'Upload Prescription', 'description' => 'Securely upload your prescription'],
                        //     ['number' => '3', 'title' => 'Select Products', 'description' => 'Choose from our wide range of products'],
                        //     ['number' => '4', 'title' => 'Fast Delivery', 'description' => 'Get your products delivered quickly']
                        // ];

                        // foreach ($steps as $step):
                        ?>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                                <div class="card step-card h-100 border-0 shadow-sm text-center">
                                    <div class="card-body">
                                        <div class="step-number mb-3">
                                            <span class="badge bg-danger rounded-circle p-3 fs-4"><?= $step['number'] ?></span>
                                        </div>
                                        <h5 class="step-title mb-3"><?= $step['title'] ?></h5>
                                        <p class="step-description text-muted"><?= $step['description'] ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php
                        // endforeach
                        ?>
                    </div>
                </div>
            </section> -->

            <!-- <section class="testimonials py-5 bg-light">
                <div class="container">
                    <div class="row">
                        <div class="col-12 text-center mb-5">
                            <h2 class="display-6 fw-bold">What Our Customers Say</h2>
                            <p class="text-muted">Real experiences from our valued customers</p>
                        </div>
                    </div>
                    <div class="row g-4">
                        <?php
                        // $testimonials = [
                        //     [
                        //         'name' => 'John Doe',
                        //         'quote' => 'Incredibly convenient service! I can manage my prescriptions easily and get them delivered right to my home.',
                        //         'avatar' => '../../public/uploads/avatars/john-doe.jpg'
                        //     ],
                        //     [
                        //         'name' => 'Jane Smith',
                        //         'quote' => 'The online consultation was professional and quick. I felt supported throughout the process.',
                        //         'avatar' => '../../public/uploads/avatars/jane-smith.jpg'
                        //     ],
                        //     [
                        //         'name' => 'Mike Johnson',
                        //         'quote' => 'Great selection of medical supplies and over-the-counter medications. Highly recommended!',
                        //         'avatar' => '../../public/uploads/avatars/mike-johnson.jpg'
                        //     ]
                        // ];

                        // foreach ($testimonials as $testimonial):
                        ?>
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                                <div class="card testimonial-card h-100 border-0 shadow-sm">
                                    <div class="card-body text-center">
                                        <div class="testimonial-quote mb-3">
                                            <i class="fas fa-quote-left text-danger mb-2"></i>
                                            <p class="fst-italic"><?= $testimonial['quote'] ?></p>
                                        </div>
                                        <div class="testimonial-author d-flex align-items-center justify-content-center">
                                            <img src="<?= $testimonial['avatar'] ?>" alt="<?= $testimonial['name'] ?>" class="rounded-circle me-3" style="width: 60px; height: 60px; object-fit: cover;">
                                            <span class="fw-bold"><?= $testimonial['name'] ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        // endforeach
                        ?>
                    </div>
                </div>
            </section> -->

            <!-- <section class="py-3 bg-dark ">
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
            </section> -->
            <section class="products py-5">
                <div class="container">
                    <div class="row">
                        <div class="col-12 text-center mb-5">
                            <h2 class="display-6 fw-bold">Our Featured Products</h2>
                            <p class="text-muted">Discover our latest and most popular items</p>
                        </div>
                    </div>
                    <div class="row g-4">
                        <?php
                        foreach ($products as $row):
                        ?>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                                <div class="card product-card h-100 border-0 shadow-sm hover-lift">
                                    <div class="product-img-container position-relative overflow-hidden">
                                        <img src="<?= $row['image_path'] ?>" class="card-img-top product-img" alt="<?= htmlspecialchars($row['name']) ?>">
                                        <div class="product-overlay position-absolute w-100 h-100 d-flex align-items-center justify-content-center">
                                            <a href="./?p=products/view_product&id=<?= $row['id'] ?>" class="btn btn-danger bg-gradient-danger rounded-pill">View Details</a>
                                        </div>
                                    </div>
                                    <div class="card-body text-center">
                                        <h5 class="card-title mb-2"><?= $row['name'] ?></h5>
                                        <div class="product-meta mb-2">
                                            <span class="text-muted d-block"><?= $row['brand'] ?></span>
                                            <span class="text-muted">Stock: <?= $row['available'] ?></span>
                                        </div>
                                        <div class="product-price fw-bold text-danger">
                                            <?= $row['price'] ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        endforeach
                        ?>
                    </div>
                    <div class="text-center mt-5">
                        <a href="/products" class="btn btn-lg btn-outline-danger rounded-pill px-4">
                            Explore More Products
                        </a>
                    </div>
                </div>
            </section>
        </div>
        <?php require_once('inc/footer.php'); ?>
    </div>
</body>

</html>