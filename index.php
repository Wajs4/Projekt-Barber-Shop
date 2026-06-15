<?php
function get_greeting(): char
{
    $hour = (int) date('G');
    if ($hour >= 5 && $hour < 12) {
        return 'Dobré ráno';
    } elseif ($hour >= 12 && $hour < 18) {
        return 'Dobrý deň';
    }

    return 'Dobrý večer';
}
?>

<!doctype html>
<html lang="sk">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title>Pánsky holič - Barber</title>

        <!-- CSS FILES -->        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@300;500&display=swap" rel="stylesheet">

        <link href="css/bootstrap.min.css" rel="stylesheet">

        <link href="css/bootstrap-icons.css" rel="stylesheet">

        <link href="css/templatemo-barber-shop.css" rel="stylesheet">
<!--

TemplateMo 585 Barber Shop

https://templatemo.com/tm-585-barber-shop

-->
    </head>
    
    <body>

        <div class="container-fluid">
            <div class="row">

                <button class="navbar-toggler d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <nav id="sidebarMenu" class="col-md-4 col-lg-3 d-md-block sidebar collapse p-0">

                    <div class="position-sticky sidebar-sticky d-flex flex-column justify-content-center align-items-center">
                        <a class="navbar-brand" href="index.php">
                            <img src="images/templatemo-barber-logo.png" class="logo-image img-fluid" align="">
                        </a>

                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link click-scroll" href="#section_1">Domov</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link click-scroll" href="#section_2">O nás</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link click-scroll" href="#section_3">Služby</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link click-scroll" href="#section_4">Cenník</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#reviews">Recenzie</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link click-scroll" href="#section_5">Kontakt</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="/barber/admin/login.php">Admin</a>
                            </li>
                        </ul>
                    </div>
                </nav>
                
                <div class="col-md-8 ms-sm-auto col-lg-9 p-0">
                    <section class="hero-section d-flex justify-content-center align-items-center" id="section_1">

                            <div class="container">
                                <div class="row">

                                    <div class="col-lg-8 col-12">
                                        <h1 class="text-white mb-lg-3 mb-4"><strong>Barber <em>Shop</em></strong></h1>
                                        <p class="text-black">Získajte najprofesionálnejší strih pre vás</p>
                                        <br>
                                        <a class="btn custom-btn custom-border-btn custom-btn-bg-white smoothscroll me-2 mb-2" href="#section_2">O nás</a>

                                        <a class="btn custom-btn smoothscroll mb-2" href="#section_3">Čo ponúkame</a>
                                    </div>
                                </div>
                            </div>

                            <div class="custom-block d-lg-flex flex-column justify-content-center align-items-center">
                                <img src="images/vintage-chair-barbershop.jpg" class="custom-block-image img-fluid" alt="">

                                <h4><strong class="text-white">Ponáhľajte sa! Získajte skvelý strih.</strong></h4>

                                <a href="#booking-section" class="smoothscroll btn custom-btn custom-btn-italic mt-3">Rezervovať termín</a>
                            </div>
                    </section>


                    <section class="about-section section-padding" id="section_2">
                        <div class="container">
                            <div class="row">

                                <div class="col-lg-12 col-12 mx-auto">
                                    <h2 class="mb-4">Najlepší holiči v Berline</h2>

                                    <div class="border-bottom pb-3 mb-5">
                                        <p>Gentlemen's Barber Shop je miesto, kde sa spája precízne remeslo s moderným štýlom. Ponúkame profesionálne strihy, úpravu brady a individuálny prístup, aby ste odchádzali vždy spokojní a sebavedomí. Vaša spokojnosť a dokonalý vzhľad sú našou prioritou.</p>
                                    </div>
                                </div>

                                    <h6 class="mb-5">Naši Barbery</h6>

                                        <div class="col-lg-5 col-12 custom-block-bg-overlay-wrap me-lg-5 mb-5 mb-lg-0">
                                            <img src="images/barber/portrait-male-hairdresser-with-scissors.jpg" class="custom-block-bg-overlay-image img-fluid" alt="">

                                            <div class="team-info d-flex align-items-center flex-wrap">
                                                <p class="mb-0">Fides</p>

                                                <ul class="social-icon ms-auto">
                                                    <li class="social-icon-item">
                                                        <a href="#" class="social-icon-link bi-facebook">
                                                        </a>
                                                    </li>

                                                    <li class="social-icon-item">
                                                        <a href="#" class="social-icon-link bi-instagram">
                                                        </a>
                                                    </li>

                                                    <li class="social-icon-item">
                                                        <a href="#" class="social-icon-link bi-whatsapp">
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="col-lg-5 col-12 custom-block-bg-overlay-wrap mt-4 mt-lg-0 mb-5 mb-lg-0">
                                            <img src="images/barber/portrait-mid-adult-bearded-male-barber-with-folded-arms.jpg" class="custom-block-bg-overlay-image img-fluid" alt="">

                                            <div class="team-info d-flex align-items-center flex-wrap">
                                                <p class="mb-0">JOJO</p>

                                                <ul class="social-icon ms-auto">
                                                    <li class="social-icon-item">
                                                        <a href="#" class="social-icon-link bi-facebook">
                                                        </a>
                                                    </li>

                                                    <li class="social-icon-item">
                                                        <a href="#" class="social-icon-link bi-instagram">
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                </div>

                            </div>
                        </div>
                    </section>

                    <section class="featured-section section-padding">
                        <div class="section-overlay"></div>

                        <div class="container">
                            <div class="row">

                                <div class="col-lg-10 col-12 mx-auto">
                                    <h2 class="mb-3">Zľava 32%</h2>

                                    <p>počas každého druhého týždňa v mesiaci</p>

                                    <strong>Promo kód: BarBerMo</strong>
                                </div>

                            </div>
                        </div>
                    </section>


                    <section class="services-section section-padding" id="section_3">
                        <div class="container">
                            <div class="row">

                                <div class="col-lg-12 col-12">
                                    <h2 class="mb-5">Služby</h2>
                                </div>
                                <?php
                                    require_once __DIR__ . '/src/bootstrap.php';
                                    $repo = new ServiceRepository(__DIR__ . '/data/services.json');
                                    $services = $repo->getAll();
                                    foreach ($services as $service) {
                                        $img = htmlspecialchars($service->getImage());
                                        $title = htmlspecialchars($service->getTitle());
                                        $price = htmlspecialchars($service->getPrice());
                                        echo "<div class=\"col-lg-6 col-12 mb-4\">";
                                        echo "<div class=\"services-thumb\">";
                                        echo "<img src=\"$img\" class=\"services-image img-fluid\" alt=\"\">";
                                        echo "<div class=\"services-info d-flex align-items-end\">";
                                        echo "<h4 class=\"mb-0\">$title</h4>";
                                        echo "<strong class=\"services-thumb-price\">$price</strong>";
                                        echo "</div></div></div>";
                                    }
                                ?>
                            </div>
                        </div>
                    </section>

                    <section class="booking-section section-padding" id="booking-section">
                    <div class="container">
                        <div class="row">

                            <div class="col-lg-10 col-12 mx-auto">
                                <form action="booking_handler.php" method="post" class="custom-form booking-form" id="bb-booking-form" role="form">
                                    <div class="text-center mb-5">
                                        <h2 class="mb-1">Rezervácia</h2>

                                        <p>Vyplňte formulár a my sa vám ozveme</p>
                                        <?php if (isset($_GET['booking']) && $_GET['booking'] === 'ok'): ?>
                                            <div class="alert alert-success mt-3">Rezervácia bola uložená. ID: <?php echo htmlspecialchars($_GET['id'] ?? ''); ?></div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="booking-form-body">
                                        <div class="row">

                                            <div class="col-lg-6 col-12">
                                                <input type="text" name="bb-name" id="bb-name" class="form-control" placeholder="Meno a priezvisko" required>
                                            </div>

                                            <div class="col-lg-6 col-12">
                                                <input type="tel" class="form-control" name="bb-phone" placeholder="Telefón 010-020-0340" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required="">
                                            </div>
                                        
                                            <div class="col-lg-6 col-12">
                                                <input class="form-control" type="time" name="bb-time" value="18:30" />
                                            </div>

                                            <div class="col-lg-6 col-12">
                                                <select class="form-select form-control" name="bb-branch" id="bb-branch" aria-label="Default select example">
                                                    <option selected="">Vyberte pobočku</option>
                                                    <option value="Grünberger">Grünberger</option>
                                                    <option value="Behrenstraße">Behrenstraße</option>
                                                    <option value="Weinbergsweg">Weinbergsweg</option>
                                                </select>

                                            </div>
                                            <div class="col-lg-6 col-12">
                                                <input type="date" name="bb-date" id="bb-date" class="form-control" placeholder="Dátum" required>
                                            </div>

                                            <div class="col-lg-6 col-12">
                                                <input type="number" name="bb-number" id="bb-number" class="form-control" placeholder="Počet osôb" required>
                                            </div>
                                        </div>

                                        <textarea name="bb-message" rows="3" class="form-control" id="bb-message" placeholder="Poznámka (voliteľné)"></textarea>

                                        <div class="col-lg-4 col-md-10 col-8 mx-auto">
                                            <button type="submit" class="form-control">Odoslať</button>
                                        </div>
                                    </div>
                                </form>
                        </div>
                    </div>
                </section>


                    <section class="price-list-section section-padding" id="section_4">
                        <div class="container">
                            <div class="row">

                                <div class="col-lg-8 col-12">
                                    <div class="price-list-thumb-wrap">
                                        <div class="mb-4">
                                            <h2 class="mb-2">Cenník</h2>

                                            <strong>Ceny od €25</strong>
                                        </div>

                                        <div class="price-list-thumb">
                                            <h6 class="d-flex">
                                                Strih vlasov
                                                <span class="price-list-thumb-divider"></span>

                                                <strong>€32.00</strong>
                                            </h6>
                                        </div>

                                        <div class="price-list-thumb">
                                            <h6 class="d-flex">
                                                Zastrihnutie brady
                                                <span class="price-list-thumb-divider"></span>

                                                <strong>€26.00</strong>
                                            </h6>
                                        </div>

                                        <div class="price-list-thumb">
                                            <h6 class="d-flex">
                                                Rez britvou
                                                <span class="price-list-thumb-divider"></span>

                                                <strong>€36.00</strong>
                                            </h6>
                                        </div>

                                        <div class="price-list-thumb">
                                            <h6 class="d-flex">
                                                Holenie
                                                <span class="price-list-thumb-divider"></span>

                                                <strong>€30.00</strong>
                                            </h6>
                                        </div>

                                        <div class="price-list-thumb">
                                            <h6 class="d-flex">
                                                Úprava / Farbenie
                                                <span class="price-list-thumb-divider"></span>

                                                <strong>€25.00</strong>
                                            </h6>
                                        </div>

                                        <div class="price-list-thumb">
                                            <h6 class="d-flex">
                                                Depilácia chlpov
                                                <span class="price-list-thumb-divider"></span>

                                                <strong>€20.00</strong>
                                            </h6>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-12 custom-block-bg-overlay-wrap mt-5 mb-5 mb-lg-0 mt-lg-0 pt-3 pt-lg-0">
                                    <img src="images/vintage-chair-barbershop.jpg" class="custom-block-bg-overlay-image img-fluid" alt="">
                                </div>

                            </div>
                        </div>
                    </section>

                    <section class="reviews-section section-padding" id="reviews">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-8 col-12 mx-auto">
                                    <h2 class="mb-4">Recenzie</h2>
                                </div>
                            </div>

                            <?php
                                $reviewsPath = __DIR__ . '/data/reviews.json';
                                $rvData = @file_get_contents($reviewsPath);
                                $reviews = json_decode($rvData, true) ?: [];
                            ?>

                            <div class="row mb-4">
                                <?php if (isset($_GET['review']) && $_GET['review'] === 'ok'): ?>
                                    <div class="col-12"><div class="alert alert-success">Ďakujeme za recenziu!</div></div>
                                <?php elseif (isset($_GET['review']) && $_GET['review'] === 'error'): ?>
                                    <div class="col-12"><div class="alert alert-danger">Vyplň prosím meno a text recenzie.</div></div>
                                <?php endif; ?>

                                <div class="col-lg-8 col-12">
                                    <?php if (count($reviews) === 0): ?>
                                        <p>Zatiaľ žiadne recenzie — buď prvý!</p>
                                    <?php else: ?>
                                        <?php foreach (array_reverse($reviews) as $r): ?>
                                            <div class="card mb-3">
                                                <div class="card-body">
                                                    <h5 class="card-title mb-1"><?php echo htmlspecialchars($r['name'] ?? ''); ?></h5>
                                                    <div class="mb-2">
                                                        <?php $rating = (int)($r['rating'] ?? 5);
                                                            for ($i=0;$i<5;$i++) {
                                                                if ($i < $rating) echo '<span style="color:#f6c44d;">★</span>'; else echo '<span style="color:#ddd;">★</span>';
                                                            }
                                                        ?>
                                                    </div>
                                                    <p class="card-text"><?php echo nl2br(htmlspecialchars($r['message'] ?? '')); ?></p>
                                                    <small class="text-muted"><?php echo htmlspecialchars(date('d.m.Y H:i', strtotime($r['created_at'] ?? ''))); ?></small>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>

                                <div class="col-lg-4 col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Napíš recenziu</h5>
                                            <form action="reviews_handler.php" method="post">
                                                <div class="mb-3">
                                                    <label class="form-label">Meno</label>
                                                    <input name="rv-name" class="form-control" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Hodnotenie</label>
                                                    <select name="rv-rating" class="form-select">
                                                        <option value="5">5</option>
                                                        <option value="4">4</option>
                                                        <option value="3">3</option>
                                                        <option value="2">2</option>
                                                        <option value="1">1</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Recenzia</label>
                                                    <textarea name="rv-message" rows="4" class="form-control" required></textarea>
                                                </div>
                                                <div class="d-grid">
                                                    <button class="btn btn-primary" type="submit">Odoslať recenziu</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                <section class="contact-section" id="section_5">
                    <div class="section-padding section-bg">
                        <div class="container">
                            <div class="row">   

                                    <div class="col-lg-8 col-12 mx-auto">
                                    <h2 class="text-center"><?php echo get_greeting(); ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="section-padding">
                        <div class="container">
                            <div class="row">

                                <div class="col-lg-6 col-12">
                                    <h5 class="mb-3"><strong>Kontaktné</strong> informácie</h5>

                                    <p class="text-white d-flex mb-1">
                                        <a href="tel: 120-240-3600" class="site-footer-link">
                                            (+49) 
                                            120-240-3600
                                        </a>
                                    </p>

                                    <p class="text-white d-flex">
                                        <a href="mailto:info@yourgmail.com" class="site-footer-link">
                                            hello@barber.beauty
                                        </a>
                                    </p>

                                    <ul class="social-icon">
                                        <li class="social-icon-item">
                                            <a href="#" class="social-icon-link bi-facebook">
                                            </a>
                                        </li>
            
                                        <li class="social-icon-item">
                                            <a href="#" class="social-icon-link bi-twitter">
                                            </a>
                                        </li>
            
                                        <li class="social-icon-item">
                                            <a href="#" class="social-icon-link bi-instagram">
                                            </a>
                                        </li>

                                        <li class="social-icon-item">
                                            <a href="#" class="social-icon-link bi-youtube">
                                            </a>
                                        </li>

                                        <li class="social-icon-item">
                                            <a href="#" class="social-icon-link bi-whatsapp">
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-lg-5 col-12 contact-block-wrap mt-5 mt-lg-0 pt-4 pt-lg-0 mx-auto">
                                    <div class="contact-block">
                                        <h6 class="mb-0">
                                            <i class="custom-icon bi-shop me-3"></i>

                                            <strong>Otvorené denne</strong>

                                            <span class="ms-auto">10:00 - 20:00</span>
                                        </h6>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-12 mx-auto mt-5 pt-5">
                                    <iframe class="google-map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7702.122299518348!2d13.396786616231472!3d52.531268574169616!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47a85180d9075183%3A0xbba8c62c3dc41a7d!2sBarbabella%20Barbershop!5e1!3m2!1sen!2sth!4v1673886261201!5m2!1sen!2sth" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div>

                            </div>
                        </div>
                    </div>
                </section>

                <footer class="site-footer">
                    <div class="container">
                        <div class="row">

                            <div class="col-lg-12 col-12">
                                <h4 class="site-footer-title mb-4">Naše pobočky</h4>
                            </div>

                            <div class="col-lg-4 col-md-6 col-11">
                                <div class="site-footer-thumb">
                                    <strong class="mb-1">Grünberger</strong>

                                    <p>Grünberger Str. 31, 10245 Berlin, Germany</p>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-11">
                                <div class="site-footer-thumb">
                                    <strong class="mb-1">Behrenstraße</strong>

                                    <p>Behrenstraße 27, 10117 Berlin, Germany</p>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-11">
                                <strong class="mb-1">Weinbergsweg</strong>

                                <p>Weinbergsweg 23, 10119 Berlin, Germany</p>
                            </div>
                        </div>
                    </div>

                    <div class="site-footer-bottom">
                        <div class="container">
                            <div class="row align-items-center">

                                <div class="col-lg-8 col-12 mt-4">
                                    <p class="copyright-text mb-0">Copyright © 2036 Barber Shop 
                                    - Design: <a href="https://templatemo.com" rel="nofollow" target="_blank">TemplateMo</a></p>
                                </div>

                                <div class="col-lg-2 col-md-3 col-3 mt-lg-4 ms-auto">
                                    <a href="#section_1" class="back-top-icon smoothscroll" title="Na začiatok">
                                        <i class="bi-arrow-up-circle"></i>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </footer>
            </div>

        <!-- JAVASCRIPT FILES -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/click-scroll.js"></script>
        <script src="js/custom.js"></script>

    </body>
</html>
