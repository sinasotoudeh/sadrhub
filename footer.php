    <!-- ============================================ -->
    <!-- SECTION 9: FOOTER -->
    <!-- ============================================ -->
    <footer class="footer">
        <div class="footer__container container">
            <!-- Footer Top -->
            <div class="footer__top">
                <!-- Company Info -->
                <div class="footer__column footer__column--about">
                    <div class="footer__logo">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/logo.png" alt="<?php bloginfo('name'); ?>" class="footer__logo-img">
                        <!-- Footer Logo: 180x50px, Light version for dark background -->
                        <span class="footer__logo-text">صدرهاب</span>
                    </div>
                    <p class="footer__description">
                          فروشگاه‌ساز ایرانی برای فروشندگان اینستاگرامی و آنلاین‌شاپ‌ها </p>
                    <div class="footer__social">
                        <a href="#" class="social__link" aria-label="Instagram">
                            <i class="ri-instagram-line"></i>
                        </a>
                        <a href="#" class="social__link" aria-label="Telegram">
                            <i class="ri-telegram-line"></i>
                        </a>
                        <a href="#" class="social__link" aria-label="LinkedIn">
                            <i class="ri-linkedin-line"></i>
                        </a>
                        <a href="#" class="social__link" aria-label="Twitter">
                            <i class="ri-twitter-x-line"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="footer__column">
                    <h4 class="footer__title">دسترسی سریع</h4>
                    <ul class="footer__links">
                        <li><a href="#features">امکانات</a></li>
                        <li><a href="#pricing">تعرفه‌ها</a></li>
                        <li><a href="#faq">سوالات متداول</a></li>
                        <li><a href="#">درباره ما</a></li>
                        <li><a href="#">تماس با ما</a></li>
                        <li><a href="#">وبلاگ</a></li>
                    </ul>
                </div>

                <!-- Resources -->
                <div class="footer__column">
                    <h4 class="footer__title">منابع</h4>
                    <ul class="footer__links">
                        <li><a href="#">مستندات API</a></li>
                        <li><a href="#">راهنمای کاربری</a></li>
                        <li><a href="#">ویدیوهای آموزشی</a></li>
                        <li><a href="#">مطالعات موردی</a></li>
                        <li><a href="#">وضعیت سرویس</a></li>
                        <li><a href="#">تغییرات اخیر</a></li>
                    </ul>
                </div>

                <!-- Legal -->
                <div class="footer__column">
                    <h4 class="footer__title">قوانین</h4>
                    <ul class="footer__links">
                        <li><a href="#">شرایط استفاده</a></li>
                        <li><a href="#">حریم خصوصی</a></li>
                        <li><a href="#">سیاست کوکی‌ها</a></li>
                        <li><a href="#">قوانین بازپرداخت</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div class="footer__column">
                    <h4 class="footer__title">تماس با ما</h4>
                    <ul class="footer__contact">
                        <li>
                            <i class="ri-mail-line"></i>
                            <a href="mailto:info@sadrhub.com">info@sadrhub.com</a>
                        </li>
                        <li>
                            <i class="ri-map-pin-line"></i>
                            <span>تهران، سهروردی شمالی، پلاک 541، واحد6، شرکت نوین اندیشان صدر</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="footer__bottom">
                <p class="footer__copyright">
                    © ۱۴۰۴صدرهاب. تمامی حقوق محفوظ است.
                </p>
                <div class="footer__badges">
                <a referrerpolicy='origin' target='_blank' href='https://trustseal.enamad.ir/?id=706215&Code=oKx9VUjPnQd8SsPg3CO8MzUYqapixfgt'>;<img referrerpolicy='origin' src='https://trustseal.enamad.ir/logo.aspx?id=706215&Code=oKx9VUjPnQd8SsPg3CO8MzUYqapixfgt' alt='' style='cursor:pointer' code='oKx9VUjPnQd8SsPg3CO8MzUYqapixfgt'></a>                    <!-- Enamad Badge: 100x100px -->
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/badges/etehadie.png" alt="ساماندهی" class="footer__badge">
                    <!-- Samandehi Badge: 100x100px -->
                </div>
            </div>
        </div>
    </footer>



    <!-- ============================================ -->
    <!-- SCROLL TO TOP BUTTON -->
    <!-- ============================================ -->
    <button class="scroll-top" id="scroll-top" aria-label="Scroll to top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <?php wp_footer(); ?>
    <!-- Lightbox Modal (اضافه کردن به فوتر سایت) -->
<div id="image-lightbox" class="lightbox">
    <span class="lightbox__close">&times;</span>
    <img class="lightbox__content" id="lightbox-img">
    <div class="lightbox__caption"></div>
</div>
</body>

</html>