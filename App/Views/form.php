<?php
$errors = $_SESSION['errors'] ?? [];
$data = $_SESSION['data'] ?? [];
$success = $_SESSION['success'] ?? false;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <link rel="stylesheet" href="App/Views/css/style.css">
</head>

<body>
    <header>
        <div class="container flex-center">
            <div class="header-logo"><img src="App/Views/images/Frame.svg"></div>
            <ul class="header-action__items">
                <li class="header-action__item">O nas</li>
                <li class="header-action__item">Uslugi</li>
                <li class="header-action__item">Cennik</li>
                <li class="header-action__item">Kontakt</li>
                <li class="header-action__item">Opinie</li>
                <li class="header-action__item">Pytana i opdowiedzi</li>
            </ul>
            <div class="header-number">
                <a href="tel:+48690590089" class="header-number__tel bold">+48690590089</a>
                <div class="header-number__text"> Zamów rozmowę</div>
            </div>
            <div class="header-language flex-center">
                <div class="header-language__text">PL</div>
                <div class="header-language__select"><img src="App/Views/images/Arrow.svg" alt=""></div>
            </div>
        </div>
    </header>

    <div class="clients">
        <div class="container flex-center">
            <div class="clients-left">
                <div class="clients-title bold">Nasi kurierzy</div>
                <div class="clients-items">
                    <div class="clients-item"><img src="App/Views/images/companies/dpd.png" alt="DPD"></div>
                    <div class="clients-item"><img src="App/Views/images/companies/gls.png" alt="GLS"></div>
                    <div class="clients-item"><img src="App/Views/images/companies/dhl.png" alt="DHL"></div>
                    <div class="clients-item"><img src="App/Views/images/companies/shopify.png" alt="Shopify"></div>
                    <div class="clients-item"><img src="App/Views/images/companies/woocommerce.png" alt="WooCommerce">
                    </div>
                    <div class="clients-item"><img src="App/Views/images/companies/prestashop.png" alt="PrestaShop">
                    </div>
                    <div class="clients-item"><img src="App/Views/images/companies/ppl.png" alt="PPL"></div>
                    <div class="clients-item"><img src="App/Views/images/companies/slovenskaposta.png"
                            alt="Slovenska Posta">
                    </div>
                    <div class="clients-item"><img src="App/Views/images/companies/magento.png" alt="Magento"></div>
                </div>
            </div>
            <div class="clients-right">
                <div class="clients-right__image"><img src="App/Views/images/box-delivery.png" alt="Box Delivery"></div>
            </div>
        </div>
    </div>


    <div class="contact-form">
        <div class="container">
            <form id="contact" method="POST" action="index.php">
                <h1 class="bold">Szukasz najlepszej oferty?</h1>
                <p>Zostaw aplikację, a nasz menedżer skontaktuje się z Tobą w celu konsultacji</p>

                <div class="name-row">
                    <div class="input-container">
                        <label class="form-label">Twoje imię</label>
                        <input type="text" name="first_name" maxlength="50" required>

                    </div>
                    <div class="input-container">
                        <label class="form-label">Twoje nazwisko</label>
                        <input type="text" name="last_name" maxlength="50" required>

                    </div>
                    <div class="input-container">
                        <label class="form-label">Twoje drugie имię</label>
                        <input type="text" name="surname" maxlength="50">

                    </div>
                </div>

                <label class="form-label">Twoja data urodzenia<input type="date" name="birth_date" required></label>
                <label class="form-label">Email <input type="email" name="email" autocomplete="on"></label>

                <div class="input-container">
                    <label class="form-label">Telefon</label>
                    <div id="additional-phone-fields">
                        <div class="phone-row">
                            <select name="country_code[]" class="country-select">
                                <option value="+375" data-flag="belarus">Беларусь</option>
                                <option value="+7" data-flag="russia">Россия</option>
                            </select>
                            <div class="phone-row__country belarus"></div>
                            <input type="tel" name="phone[]" placeholder="+375 (__) ___-__-__">
                        </div>
                    </div>
                    <button type="button" class="add-phone-btn">+</button>
                </div>


                <label class="form-label">Stan cywilny
                    <select name="marital_status">
                        <option value="single">Samotny/niezamężny</option>
                        <option value="married">Żonaty</option>
                        <option value="divorced">Rozwiedziony</option>
                        <option value="widowed">Wdowiec/wdowa</option>
                    </select>
                </label>

                <label>O mnie
                    <textarea name="about" rows="7" maxlength="1000"></textarea>
                </label>
                <div class="contact-form__bottom flex-center">
                    <div class="contact-form__bottom_agree">
                        <input type="checkbox" class="contact-form__bottom_agree_checkbox" name="agree_rules" required>
                        Przeczytałem zasady
                    </div>
                    <button type="submit">Wysłać</button>
                </div>
                <?php if (isset($_SESSION['errors'])): ?>
                    <div class="error-messages">
                        <?php foreach ($_SESSION['errors'] as $error): ?>
                            <p><?php echo htmlspecialchars($error); ?></p>
                        <?php endforeach; ?>
                    </div>
                    <?php unset($_SESSION['errors']); ?>
                <?php endif; ?>

                <?php if (isset($_SESSION['success'])): ?>
                    <div class="success-message">Форма успешно отправлена!</div>
                    <?php unset($_SESSION['success']); ?>
                <?php endif; ?>

            </form>
        </div>
    </div>

    <footer>
        <div class="container">
            <div class="footer-main">
                <div class="footer-contact">
                    <div class="footer-logo"><img src="App/Views/images/Frame.svg"></div>
                    <div class="footer-item flex-center">
                        <div class="footer-icon"><img src="App/Views/images/Telephone.svg"></div>
                        +48690590089
                    </div>
                    <a href="/">Zamów rozmowę</a>
                    <div class="footer-item flex-center">
                        <div class="footer-icon"><img src="App/Views/images/Mail.svg"></div>
                        info@enemer.pl
                    </div>
                    <div class="footer-item flex-center">
                        <div class="footer-icon"><img src="App/Views/images/Location.svg"></div>
                        Błonie, Pass 20I, budynek 15, 05-870
                    </div>
                </div>
                <div class="footer-services">
                    <ul class="footer-services__list">
                        <li class="footer-text bold">Usługi</li>
                        <li class="footer-text">Usługi logistyczne dla e-commerce</li>
                        <li class="footer-text">Outsourcing magazynu</li>
                        <li class="footer-text">Outsourcing logistyczny</li>
                        <li class="footer-text">Obsługa logistyczna sklepów internetowych</li>
                        <li class="footer-text">Logistyka kontraktowa</li>
                        <br>
                        <li class="footer-text"><a href="/">Zobacz wszystkie →</a></li>
                    </ul>
                </div>
                <div class="footer-actions">
                    <ul class="footer-actions__list">
                        <li class="footer-text bold">O nas</li>
                        <li class="footer-text bold">Cennik</li>
                        <li class="footer-text bold">Pytania i odpowiedzi</li>
                        <li class="footer-text bold">Kontakt</li>
                        <li class="footer-text bold">Blog</li>
                    </ul>
                </div>

                <span class="footer-watermark">
                    <pre>
            Space Logistics Sp.z.o.o. 02-727
            Warszawa ul. Wołodyjowskiego 67A
            KRS: 0000824771 NIP: 5213888029
            REGON: 385377605</pre>
                </span>
            </div>
            <div class="footer-dev flex-center">
                <a href="/">Polityka prywatności</a>
                <div class="footer-dev-info flex-center">
                    dev.grizzly.by
                    <img src="App/Views/images/bear.svg">
                    seo.grizzly.by
                </div>
            </div>
        </div>
    </footer>
    <script src="App/Views/script.js"></script>
</body>
</html>