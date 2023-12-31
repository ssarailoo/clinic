<?php

use Core\Application;
use Core\View;

/** @var $this View */
$class = Application::$app->userClass;
if (str_contains($class, 'Doctor'))
    $str = 'doctor';
if (str_contains($class, 'Manager'))
    $str = 'manager';
if (str_contains($class, 'Patient'))
    $str = 'patient';
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?= $this->title ?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="Storage/View/layouts/assets/img/favicon.png" rel="icon">
    <link href="Storage/View/layouts/assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="Storage/View/layouts/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="Storage/View/layouts/assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="Storage/View/layouts/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="Storage/View/layouts/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="Storage/View/layouts/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="Storage/View/layouts/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="Storage/View/layouts/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="Storage/View/layouts/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="Storage/View/layouts/assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
    * Template Name: Medilab
    * Updated: Jul 27 2023 with Bootstrap v5.3.1
    * Template URL: https://bootstrapmade.com/medilab-free-medical-bootstrap-theme/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
</head>

<body>

<!-- ======= Top Bar ======= -->
<div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex justify-content-between">
        <div class="contact-info d-flex align-items-center">
            <i class="bi bi-envelope"></i> <a href="mailto:contact@example.com">contact@example.com</a>
            <i class="bi bi-phone"></i> +1 5589 55488 55
        </div>
        <div class="d-none d-lg-flex social-links align-items-center">
            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
        </div>
    </div>
</div>

<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

        <h1 class="logo me-auto"><a href="/">Medilab</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

        <nav id="navbar" class="navbar order-last order-lg-0">
            <ul>
                <li><a class="nav-link scrollto active" href="/">Home</a></li>
                <li><a class="nav-link scrollto" href="/contact">Contact</a></li>
                <li><a class="nav-link scrollto" href="#about">About</a></li>
                <li><a class="nav-link scrollto" href="#services">Services</a></li>
                <li><a class="nav-link scrollto" href="#departments">Departments</a></li>
                <li><a class="nav-link scrollto" href="#doctors">Doctors</a></li>
                <?php if (Application::isGuest()) { ?>
                    <li class="dropdown"><a href="/"><span>Register</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="/register-patient">As Patient</a></li>

                            <li><a href="/register-doctor">As Doctor</a></li>
                            <li><a href="/register-manager">As Manager</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a href="#"><span>Login</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="/login-patient">As Patient</a></li>

                            <li><a href="/login-doctor">As Doctor</a></li>
                            <li><a href="/login-manager">As Manager</a></li>
                        </ul>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <?php if (!Application::docIsCompleted()) { ?>
                            <iconify-icon icon="solar:danger-circle-bold" style="color: red;"></iconify-icon>
                        <?php } ?>
                        <?php if (Application::getRole() === 0) { ?>
                            <iconify-icon icon="medical-icon:i-outpatient" width="30"></iconify-icon>
                        <?php } elseif (Application::getRole() === 2) { ?>
                            <iconify-icon icon="grommet-icons:user-manager" width="30"></iconify-icon>
                        <?php } else { ?>
                            <iconify-icon icon="maki:doctor" width="30"></iconify-icon>
                        <?php } ?>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page"
                           href=" <?= "/profile-" . $str ?>"><?= Application::$app->user->firstname . ' ' . Application::$app->user->lastname . ' ' ?>
                        </a>
                    </li>
                    <li><a class="nav-link scrollto" href="/logout">Logout</a></li>
                <?php } ?>

            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

        <a href="#appointment" class="appointment-btn scrollto"><span class="d-none d-md-inline">Make an</span>
            Appointment</a>

    </div>
</header><!-- End Header -->

<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">
    <div class="container">
        <?php if (Application::$app->session->getFlash('success')) { ?>
            <div class="alert alert-success">
                <?= Application::$app->session->getFlash('success') ?>
            </div>
        <?php } ?>
        <h1>Welcome to Medilab</h1>
        <a href="#about" class="btn-get-started scrollto">Get Started</a>
    </div>
</section><!-- End Hero -->

<main id="main">
    <div class="container">

        {{content}}
    </div>

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container-fluid">

            <div class="row">
                <div
                    class="col-xl-5 col-lg-6 video-box d-flex justify-content-center align-items-stretch position-relative">
                    <a href="https://www.youtube.com/watch?v=jDDaplaOz7Q" class="glightbox play-btn mb-4"></a>
                </div>

                <div
                    class="col-xl-7 col-lg-6 icon-boxes d-flex flex-column align-items-stretch justify-content-center py-5 px-lg-5">
                    <h3>Enim quis est voluptatibus aliquid consequatur fugiat</h3>
                    <p>Esse voluptas cumque vel exercitationem. Reiciendis est hic accusamus. Non ipsam et sed minima
                        temporibus laudantium. Soluta voluptate sed facere corporis dolores excepturi. Libero laboriosam
                        sint et id nulla tenetur. Suscipit aut voluptate.</p>

                    <div class="icon-box">
                        <div class="icon"><i class="bx bx-fingerprint"></i></div>
                        <h4 class="title"><a href="">Lorem Ipsum</a></h4>
                        <p class="description">Voluptatum deleniti atque corrupti quos dolores et quas molestias
                            excepturi sint occaecati cupiditate non provident</p>
                    </div>

                    <div class="icon-box">
                        <div class="icon"><i class="bx bx-gift"></i></div>
                        <h4 class="title"><a href="">Nemo Enim</a></h4>
                        <p class="description">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis
                            praesentium voluptatum deleniti atque</p>
                    </div>

                    <div class="icon-box">
                        <div class="icon"><i class="bx bx-atom"></i></div>
                        <h4 class="title"><a href="">Dine Pad</a></h4>
                        <p class="description">Explicabo est voluptatum asperiores consequatur magnam. Et veritatis
                            odit. Sunt aut deserunt minus aut eligendi omnis</p>
                    </div>

                </div>
            </div>

        </div>
    </section><!-- End About Section -->


    <!-- ======= Appointment Section ======= -->
    <!--    <section id="appointment" class="appointment section-bg">-->
    <!--        <div class="container">-->
    <!---->
    <!--            <div class="section-title">-->
    <!--                <h2>Make an Appointment</h2>-->
    <!--                <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint-->
    <!--                    consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia-->
    <!--                    fugiat sit in iste officiis commodi quidem hic quas.</p>-->
    <!--            </div>-->
    <!---->
    <!--            <form action="forms/appointment.php" method="post" role="form" class="php-email-form">-->
    <!--                <div class="row">-->
    <!--                    <div class="col-md-4 form-group">-->
    <!--                        <input type="text" name="name" class="form-control" id="name" placeholder="Your Name"-->
    <!--                               data-rule="minlen:4" data-msg="Please enter at least 4 chars">-->
    <!--                        <div class="validate"></div>-->
    <!--                    </div>-->
    <!--                    <div class="col-md-4 form-group mt-3 mt-md-0">-->
    <!--                        <input type="email" class="form-control" name="email" id="email" placeholder="Your Email"-->
    <!--                               data-rule="email" data-msg="Please enter a valid email">-->
    <!--                        <div class="validate"></div>-->
    <!--                    </div>-->
    <!--                    <div class="col-md-4 form-group mt-3 mt-md-0">-->
    <!--                        <input type="tel" class="form-control" name="phone" id="phone" placeholder="Your Phone"-->
    <!--                               data-rule="minlen:4" data-msg="Please enter at least 4 chars">-->
    <!--                        <div class="validate"></div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--                <div class="row">-->
    <!--                    <div class="col-md-4 form-group mt-3">-->
    <!--                        <input type="datetime" name="date" class="form-control datepicker" id="date"-->
    <!--                               placeholder="Appointment Date" data-rule="minlen:4"-->
    <!--                               data-msg="Please enter at least 4 chars">-->
    <!--                        <div class="validate"></div>-->
    <!--                    </div>-->
    <!--                    <div class="col-md-4 form-group mt-3">-->
    <!--                        <select name="department" id="department" class="form-select">-->
    <!--                            <option value="">Select Department</option>-->
    <!--                            <option value="Department 1">Department 1</option>-->
    <!--                            <option value="Department 2">Department 2</option>-->
    <!--                            <option value="Department 3">Department 3</option>-->
    <!--                        </select>-->
    <!--                        <div class="validate"></div>-->
    <!--                    </div>-->
    <!--                    <div class="col-md-4 form-group mt-3">-->
    <!--                        <select name="doctor" id="doctor" class="form-select">-->
    <!--                            <option value="">Select Doctor</option>-->
    <!--                            <option value="Doctor 1">Doctor 1</option>-->
    <!--                            <option value="Doctor 2">Doctor 2</option>-->
    <!--                            <option value="Doctor 3">Doctor 3</option>-->
    <!--                        </select>-->
    <!--                        <div class="validate"></div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!---->
    <!--                <div class="form-group mt-3">-->
    <!--                    <textarea class="form-control" name="message" rows="5" placeholder="Message (Optional)"></textarea>-->
    <!--                    <div class="validate"></div>-->
    <!--                </div>-->
    <!--                <div class="mb-3">-->
    <!--                    <div class="loading">Loading</div>-->
    <!--                    <div class="error-message"></div>-->
    <!--                    <div class="sent-message">Your appointment request has been sent successfully. Thank you!</div>-->
    <!--                </div>-->
    <!--                <div class="text-center">-->
    <!--                    <button type="submit">Make an Appointment</button>-->
    <!--                </div>-->
    <!--            </form>-->
    <!---->
    <!--        </div>-->
    <!--    </section>-->
    <!-- End Appointment Section -->

    <!-- ======= Departments Section ======= -->
    <!--    <section id="departments" class="departments">-->
    <!--        <div class="container">-->
    <!---->
    <!--            <div class="section-title">-->
    <!--                <h2>Departments</h2>-->
    <!--                <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint-->
    <!--                    consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia-->
    <!--                    fugiat sit in iste officiis commodi quidem hic quas.</p>-->
    <!--            </div>-->
    <!---->
    <!--            <div class="row gy-4">-->
    <!--                <div class="col-lg-3">-->
    <!--                    <ul class="nav nav-tabs flex-column">-->
    <!--                        <li class="nav-item">-->
    <!--                            <a class="nav-link active show" data-bs-toggle="tab" href="#tab-1">Cardiology</a>-->
    <!--                        </li>-->
    <!--                        <li class="nav-item">-->
    <!--                            <a class="nav-link" data-bs-toggle="tab" href="#tab-2">Neurology</a>-->
    <!--                        </li>-->
    <!--                        <li class="nav-item">-->
    <!--                            <a class="nav-link" data-bs-toggle="tab" href="#tab-3">Hepatology</a>-->
    <!--                        </li>-->
    <!--                        <li class="nav-item">-->
    <!--                            <a class="nav-link" data-bs-toggle="tab" href="#tab-4">Pediatrics</a>-->
    <!--                        </li>-->
    <!--                        <li class="nav-item">-->
    <!--                            <a class="nav-link" data-bs-toggle="tab" href="#tab-5">Eye Care</a>-->
    <!--                        </li>-->
    <!--                    </ul>-->
    <!--                </div>-->
    <!--                <div class="col-lg-9">-->
    <!--                    <div class="tab-content">-->
    <!--                        <div class="tab-pane active show" id="tab-1">-->
    <!--                            <div class="row gy-4">-->
    <!--                                <div class="col-lg-8 details order-2 order-lg-1">-->
    <!--                                    <h3>Cardiology</h3>-->
    <!--                                    <p class="fst-italic">Qui laudantium consequatur laborum sit qui ad sapiente dila-->
    <!--                                        parde sonata raqer a videna mareta paulona marka</p>-->
    <!--                                    <p>Et nobis maiores eius. Voluptatibus ut enim blanditiis atque harum sint. Laborum-->
    <!--                                        eos ipsum ipsa odit magni. Incidunt hic ut molestiae aut qui. Est repellat-->
    <!--                                        minima eveniet eius et quis magni nihil. Consequatur dolorem quaerat quos qui-->
    <!--                                        similique accusamus nostrum rem vero</p>-->
    <!--                                </div>-->
    <!--                                <div class="col-lg-4 text-center order-1 order-lg-2">-->
    <!--                                    <img src="assets/img/departments-1.jpg" alt="" class="img-fluid">-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                        <div class="tab-pane" id="tab-2">-->
    <!--                            <div class="row gy-4">-->
    <!--                                <div class="col-lg-8 details order-2 order-lg-1">-->
    <!--                                    <h3>Et blanditiis nemo veritatis excepturi</h3>-->
    <!--                                    <p class="fst-italic">Qui laudantium consequatur laborum sit qui ad sapiente dila-->
    <!--                                        parde sonata raqer a videna mareta paulona marka</p>-->
    <!--                                    <p>Ea ipsum voluptatem consequatur quis est. Illum error ullam omnis quia et-->
    <!--                                        reiciendis sunt sunt est. Non aliquid repellendus itaque accusamus eius et velit-->
    <!--                                        ipsa voluptates. Optio nesciunt eaque beatae accusamus lerode pakto madirna-->
    <!--                                        desera vafle de nideran pal</p>-->
    <!--                                </div>-->
    <!--                                <div class="col-lg-4 text-center order-1 order-lg-2">-->
    <!--                                    <img src="assets/img/departments-2.jpg" alt="" class="img-fluid">-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                        <div class="tab-pane" id="tab-3">-->
    <!--                            <div class="row gy-4">-->
    <!--                                <div class="col-lg-8 details order-2 order-lg-1">-->
    <!--                                    <h3>Impedit facilis occaecati odio neque aperiam sit</h3>-->
    <!--                                    <p class="fst-italic">Eos voluptatibus quo. Odio similique illum id quidem non enim-->
    <!--                                        fuga. Qui natus non sunt dicta dolor et. In asperiores velit quaerat perferendis-->
    <!--                                        aut</p>-->
    <!--                                    <p>Iure officiis odit rerum. Harum sequi eum illum corrupti culpa veritatis-->
    <!--                                        quisquam. Neque necessitatibus illo rerum eum ut. Commodi ipsam minima molestiae-->
    <!--                                        sed laboriosam a iste odio. Earum odit nesciunt fugiat sit ullam. Soluta et-->
    <!--                                        harum voluptatem optio quae</p>-->
    <!--                                </div>-->
    <!--                                <div class="col-lg-4 text-center order-1 order-lg-2">-->
    <!--                                    <img src="assets/img/departments-3.jpg" alt="" class="img-fluid">-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                        <div class="tab-pane" id="tab-4">-->
    <!--                            <div class="row gy-4">-->
    <!--                                <div class="col-lg-8 details order-2 order-lg-1">-->
    <!--                                    <h3>Fuga dolores inventore laboriosam ut est accusamus laboriosam dolore</h3>-->
    <!--                                    <p class="fst-italic">Totam aperiam accusamus. Repellat consequuntur iure voluptas-->
    <!--                                        iure porro quis delectus</p>-->
    <!--                                    <p>Eaque consequuntur consequuntur libero expedita in voluptas. Nostrum ipsam-->
    <!--                                        necessitatibus aliquam fugiat debitis quis velit. Eum ex maxime error in-->
    <!--                                        consequatur corporis atque. Eligendi asperiores sed qui veritatis aperiam quia a-->
    <!--                                        laborum inventore</p>-->
    <!--                                </div>-->
    <!--                                <div class="col-lg-4 text-center order-1 order-lg-2">-->
    <!--                                    <img src="assets/img/departments-4.jpg" alt="" class="img-fluid">-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                        <div class="tab-pane" id="tab-5">-->
    <!--                            <div class="row gy-4">-->
    <!--                                <div class="col-lg-8 details order-2 order-lg-1">-->
    <!--                                    <h3>Est eveniet ipsam sindera pad rone matrelat sando reda</h3>-->
    <!--                                    <p class="fst-italic">Omnis blanditiis saepe eos autem qui sunt debitis porro-->
    <!--                                        quia.</p>-->
    <!--                                    <p>Exercitationem nostrum omnis. Ut reiciendis repudiandae minus. Omnis recusandae-->
    <!--                                        ut non quam ut quod eius qui. Ipsum quia odit vero atque qui quibusdam amet.-->
    <!--                                        Occaecati sed est sint aut vitae molestiae voluptate vel</p>-->
    <!--                                </div>-->
    <!--                                <div class="col-lg-4 text-center order-1 order-lg-2">-->
    <!--                                    <img src="assets/img/departments-5.jpg" alt="" class="img-fluid">-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!---->
    <!--        </div>-->
    <!--    </section>-->
    <!-- End Departments Section -->

    <!-- ======= Doctors Section ======= -->

    <section id="doctors" class="doctors">
        <div class="container">

            <div class="section-title">
                <h2>Doctors</h2>
                <p>Our Lovely Doctors</p>
            </div>
            <?php $doctors = Application::$app->database->all('doctors');
            $doctors = array_filter($doctors, fn($doc) => $doc->is_active == 1);

            foreach ($doctors as $doctor) {
                ?>

                                <div class="row flex justify-content-center align-items-center">

                <div class="col-lg-6">
                    <div class="member d-flex align-items-center">
                <div class="row">
                </div>
                        <div class="pic"><img src="<?= $doctor->profile_pic ?>" class="img-fluid" alt=""></div>
                        <div class="member-info">
                            <h4><?= ucfirst($doctor->firstname) . ' ' . ucfirst($doctor->lastname) ?></h4>
                            <span><?php $id = $doctor->section_id;
                                echo Application::$app->database->select('sections', ['column' => 'id', 'operation' => '=', 'value' => $id],'name'); ?></span>
                            <p><?= $doctor->education ?></p>
                            <p><?= $doctor->address ?></p>
                            <div class="social">
                                <a href=""><i class="ri-twitter-fill"></i></a>
                                <a href=""><i class="ri-facebook-fill"></i></a>
                                <a href=""><i class="ri-instagram-fill"></i></a>
                                <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                            </div>
                        </div>
                    </div>
                </div>
                                </div>
            <?php } ?>

        </div>
    </section><!-- End Doctors Section -->


</main><!-- End #main -->

<!-- ======= Footer ======= -->
<footer id="footer">

    <div class="footer-top">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-md-6 footer-contact">
                    <h3>Medilab</h3>
                    <p>
                        A108 Adam Street <br>
                        New York, NY 535022<br>
                        United States <br><br>
                        <strong>Phone:</strong> +1 5589 55488 55<br>
                        <strong>Email:</strong> info@example.com<br>
                    </p>
                </div>

                <div class="col-lg-2 col-md-6 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Our Services</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-6 footer-newsletter">
                    <h4>Join Our Newsletter</h4>
                    <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
                    <form action="" method="post">
                        <input type="email" name="email"><input type="submit" value="Subscribe">
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="container d-md-flex py-4">

        <div class="me-md-auto text-center text-md-start">
            <div class="copyright">
                &copy; Copyright <strong><span>Medilab</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/medilab-free-medical-bootstrap-theme/ -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>
        <div class="social-links text-center text-md-right pt-3 pt-md-0">
            <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
            <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
            <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
            <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
            <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
        </div>
    </div>
</footer><!-- End Footer -->

<div id="preloader"></div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="Storage/View/layouts/assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="Storage/View/layouts/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="Storage/View/layouts/assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="Storage/View/layouts/assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="Storage/View/layouts/assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="Storage/View/layouts/assets/js/main.js"></script>

</body>

</html>