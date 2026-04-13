<?php 
/*
Template Name: Sadrhub Front
Author: Sina Sotoudeh
Website: sinasotoudeh.ir
github: github.com/sinasotoudeh
*/
get_header(); ?>

<!-- ============================================ -->
    <!-- SECTION 2: HERO SECTION -->
    <!-- ============================================ -->
    <section class="hero" id="home">
        <div class="hero__container container">
            <div class="hero__content">
                <!-- Badge -->
                <div class="hero__badge">
                    <span class="badge">
                        <i class="ri-sparkling-fill"></i>
                        ویژه فروشگاه‌های اینترنتی و آنلاین‌شاپ‌های اینستاگرامی
                    </span>
                </div>

                <!-- Main Heading -->
                <h1 class="hero__title">
                    ساخت فروشگاه اینترنتی حرفه‌ای
                    <br>

                    <span class="gradient-text">صدرهاب</span>
                    <br>

                    افزایش چند برابری فروش
                    <br>
                    راحت، سریع و بدون دردسر
                </h1>

                <!-- Description -->
                <p class="hero__description hide-on-mobile">
                <ul class="quicklist hide-on-mobile">
                    <li>مهاجرت آسان از وردپرس، میکسین، شاپفا، کاموا و سایر فروشگاه سازها</li>
                    <li>مدیریت سفارش، انبار و مرجوعی با پنل ساده موبایلی</li>
                    <li>اتصال به همُهٔ درگاه‌ها و پرداخت‌های اقساطی</li>
                </ul>
                </p>
            </div>

            <!-- Hero Image/Illustration -->
            <div class="hero__image">
                <div class="hero__image-wrapper">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/hero-dashboard.png" alt="Atajoy Dashboard Preview" class="hero__img">
                    <!-- Hero Image: 800x600px, Modern dashboard mockup showing Instagram DM automation, use perspective and shadow -->

                    <!-- Floating Elements -->
                    <div class="floating-card floating-card--1">
                        <i class="ri-verified-badge-line"></i>
                        <span>Meta Business Partner</span>
                    </div>
                    <div class="floating-card floating-card--2">
                        <i class="ri-user-follow-line"></i>
                        <span>ماهانه ۹۹,۰۰۰ تومان</span>
                    </div>
                    <div class="floating-card floating-card--3">
                        <i class="ri-dashboard-2-line"></i>
                        <span>سریع و بهینه</span>
                    </div>
                </div>
                <!-- CTA Buttons -->
                <div class="hero__buttons">
                    <a href="#pricing" class="btn btn--primary btn--large">
                        <span>رایگان شروع کنید</span>
                        <i class="ri-arrow-left-line"></i>
                    </a>
                    <a href="#demo" class="btn btn--secondary btn--large">
                        <i class="ri-play-circle-line"></i>
                        <span>مشاهده دموی ۲ دقیقه‌ای</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Animated Background -->
        <div class="hero__bg">
            <div class="gradient-blob gradient-blob--1"></div>
            <div class="gradient-blob gradient-blob--2"></div>
            <div class="gradient-blob gradient-blob--3"></div>
            <div class="gradient-blob gradient-blob--4"></div>
        </div>
    </section>

    <!-- ============================================ -->
    <!-- SECTION 3: WHAT IS ATAJOY -->
    <!-- ============================================ -->
    <section class="about section" id="about">
        <div class="about__container container">
            <!-- Section Header -->
            <div class="section__header">
                <span class="section__subtitle"> چرا صدرهاب؟</span>
                <h2 class="section__title">
                    هر آنچه از یک فروشگاه ساز انتظار دارید
                    <span class="gradient-text">و حتی بیشتر </span>


                </h2>
                <p class="section__description">
                    از آپلود و انتقال محصولات تا پرداخت، ثبت سفارش و ارسال و حتی یکپارچه سازی با اینستاگرام و بازارگاه
                    ها: همه‌چیز در
                    یک پنل.
                    بدون نیاز به دانش فنی، بدون هزینهٔ اولیه.
                </p>
            </div>

            <!-- Core Features Grid -->
            <div class="about__grid">
                <!-- Feature Card 1 -->
                <div class="about__card" data-aos="zoom-in">
                    <div class="about__card-icon">
                        <i class="ri-robot-2-line"></i>
                    </div>
                    <h3 class="about__card-title">افزایش واقعی فروش</h3>
                    <p class="about__card-description">
                        تمام ابزارهای افزایش فروش از جمله ربات اینستاگرام، بهینه ساز صفحه محصول، داشبورد گزارش فروش،
                        و ارسال سریع با واسط پستی </p>
                </div>

                <!-- Feature Card 2 -->
                <div class="about__card" data-aos="zoom-in" data-aos-delay="100">
                    <div class="about__card-icon">
                        <i class="ri-store-3-line"></i>
                    </div>
                    <h3 class="about__card-title">مهاجرت بدون ریسک</h3>
                    <p class="about__card-description">
                        انتقال کامل محصولات، سفارش‌ها و ترافیک سایت با حفظ سئو و ریدایرکت لینک‌ها — تیم ما همراه شماست.
                    </p>
                </div>

                <!-- Feature Card 3 -->
                <div class="about__card" data-aos="zoom-in" data-aos-delay="200">
                    <div class="about__card-icon">
                        <i class="ri-user-heart-line"></i>
                    </div>
                    <h3 class="about__card-title">پشتیبانی رشد</h3>
                    <p class="about__card-description">
                        آکادمی آموزش های بازاریابی و راهکارهای عملی برای استفاده از تمامی بخش ها و امکانات فروشگاه
                        ساز و افزایش فروش </p>
                </div>

                <!-- Feature Card 4 -->
                <div class="about__card" data-aos="zoom-in" data-aos-delay="300">
                    <div class="about__card-icon">
                        <i class="ri-line-chart-line"></i>
                    </div>
                    <h3 class="about__card-title">بدون نیاز به دانش فنی!</h3>
                    <p class="about__card-description">
                        با صدرهاب بدون هیچ دغدغه فنی و تخصصی برای ساخت و نگهداری از وبسایت فروشگاهی خود، تنها روی فروش
                        محصولات و افزایش درآمدتان تمرکز کنید. </p>
                </div>
            </div>

            <!-- Use Cases -->
            <div class="about__usecases" data-aos="fade-up" data-aos-delay="0">
                <h3 class="about__usecases-title"> صدرهاب دقیقا هماهنگ با نیازهای شماست</h3>
                <div class="usecases__grid">
                    <div class="usecase__item">
                        <i class="ri-shopping-bag-3-line"></i>
                        <span>آنلاین شاپ های اینستاگرامی</span>
                    </div>
                    <div class="usecase__item">
                        <i class="ri-service-line"></i>
                        <span>ارائه‌دهندگان خدمات</span>
                    </div>
                    <div class="usecase__item">
                        <i class="ri-home-smile-line"></i>
                        <span> فروشندگان کالای فیزیکی یا دیجیتال </span>
                    </div>
                    <div class="usecase__item">
                        <i class="ri-store-2-line"></i>
                        <span> ساخت اولین فروشگاه آنلاین خودتان بدون دانش فنی</span>
                    </div>
                    <div class="usecase__item">
                        <i class="ri-briefcase-line"></i>
                        <span> مهاجرت از وردپرس یا دیگر فروشگاه ساز ها</span>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- ============================================ -->
    <!-- SECTION 4: FEATURES / CAPABILITIES -->
    <!-- ============================================ -->
    <section class="features section" id="features">
        <div class="features__container container">
            <!-- Section Header -->
            <div class="section__header">
                <span class="section__subtitle">امکانات پیشرفته</span>
                <h2 class="section__title">
                    هر چیزی که برای
                    <span class="gradient-text"> فروش</span>
                    نیاز دارید.
                </h2>
            </div>

            <!-- Features List -->
            <div class="features__list">
                <!-- Feature Item 1 -->
                <div class="feature__item" data-aos="fade-up">
                    <div class="feature__content">
                        <div class="feature__icon-wrapper">
                            <div class="feature__icon">
                                <i class="ri-chat-smile-3-line"></i>
                            </div>
                        </div>
                        <div class="feature__text">
                            <h3 class="feature__title">افزایش فروش با مدیریت هوشمند شبکه‌های اجتماعی </h3>
                            <p class="feature__description">همگام‌سازی محصولات با اینستاگرام، لیست کردن در بازارگاه‌ها،
                                ابزار ایمیل مارکتینگ و
                                باشگاه مشتریان.
                            </p>
                            <ul class="feature__highlights">
                                <li><i class="ri-check-line"></i> همکاری رسمی و مستقیم باشرکت "متا"
                                    (
                                    اینستاگرام و فیس بوک
                                    )
                                    <br>
                                    (Official Meta Business Partner)
                                </li>
                                <li><i class="ri-check-line"></i>ربات پاسخ‌دهی به دایرکت و کامنت های اینستاگرام و
                                    جمع‌آوری لید</li>
                                <li><i class="ri-check-line"></i>ایجاد کمپین‌های هدفمند روی محصول و هدفگیری مشتریان
                                    فعال/منفعل</li>
                                <li><i class="ri-check-line"></i>پیشنهادات خودکار در دایرکت، صفحهٔ محصول و
                                    صفحهٔ پرداخت</li>
                                <li><i class="ri-check-line"></i>ابزار ارسال ایمیل و پیامک و اتوماسیون بازاریابی</li>
                            </ul>
                        </div>
                    </div>
                    <div class="feature__image">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/meta_business_partner.webp" alt="meta business partner">
                        <!-- Feature Image 1: 600x500px, Mockup showing meta_business_partner badge -->
                    </div>
                </div>

                <!-- Feature Item 2 -->
                <div class="feature__item feature__item--reverse" data-aos="fade-up">
                    <div class="feature__content">
                        <div class="feature__icon-wrapper">
                            <div class="feature__icon">
                                <i class="ri-shopping-basket-line"></i>
                            </div>
                        </div>
                        <div class="feature__text">
                            <h3 class="feature__title">مدیریت پیشرفتهٔ محصولات</h3>
                            <p class="feature__description">
                                تعریف نامحدود محصول، ویژگی، و متغیرها؛ وارد کردن از اکسل/CSV
                                یا فروشگاه قبلی و همگام‌سازی با
                                اینستاگرام.
                            </p>
                            <ul class="feature__highlights">
                                <li><i class="ri-check-line"></i>محصولات فیزیکی، دیجیتال و خدمات</li>
                                <li><i class="ri-check-line"></i>ویژگی‌های چندگانه (رنگ، سایز و …) و مدیریت قیمت‌های
                                    ترکیبی</li>
                                <li><i class="ri-check-line"></i>یکپارچه سازی با بازارگاه‌ها (مانند ترب، ایمالز، فی بین
                                    و...)</li>
                                <li><i class="ri-check-line"></i>مدیریت موجودی هوشمند و هشدار کمبود کالا</li>
                                <li><i class="ri-check-line"></i>قابلیت لیست قیمت/قیمت‌گذاری عمده‌ای و عرضهٔ ویژه</li>

                            </ul>
                        </div>
                    </div>
                    <div class="feature__image">
                        <!-- تصویر اول (زیرین) -->
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/product1.PNG" alt="Analytics View" class="pos-back">

                        <!-- تصویر دوم (رویی) -->
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/product2.PNG" alt="Follow Check" class="pos-front">
                    </div>
                </div>

                <!-- Feature Item 3 -->
                <div class="feature__item" data-aos="fade-up">
                    <div class="feature__content">
                        <div class="feature__icon-wrapper">
                            <div class="feature__icon">
                                <i class="ri-paint-brush-line"></i>
                            </div>
                        </div>
                        <div class="feature__text">
                            <h3 class="feature__title">قالب‌ها و ویرایشگر حرفه‌ای (Drag & Drop)</h3>
                            <p class="feature__description">
                                قالب‌های فروش‌محور و بهینه شده برای موبایل، ویرایش کامل صفحات با ابزار
                                Drag & Drop — بدون یک خط کدنویسی.
                            </p>
                            <ul class="feature__highlights">
                                <li><i class="ri-check-line"></i>قالب‌های اختصاصی و قابل ویرایش "مدرن" و "کلاسیک".</li>
                                <li><i class="ri-check-line"></i>A/B tested templates برای افزایش تبدیل</li>
                                <li><i class="ri-check-line"></i>پیش‌نمایش موبایل و دسکتاپ و undo/redo</li>
                                <li><i class="ri-check-line"></i>امکان تغییر کامل CSS/HTML برای توسعه‌دهندگان</li>

                            </ul>
                        </div>
                    </div>
                    <div class="feature__image">
                        <!-- تصویر اول (زیرین) -->
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/theme1.PNG" alt="Analytics View" class="pos-back">

                        <!-- تصویر دوم (رویی) -->
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/theme2.PNG" alt="Follow Check" class="pos-front">
                    </div>
                </div>

                <!-- Feature Item 4 -->
                <div class="feature__item feature__item--reverse" data-aos="fade-up">
                    <div class="feature__content">
                        <div class="feature__icon-wrapper">
                            <div class="feature__icon">
                                <i class="ri-google-fill"></i>
                            </div>
                        </div>
                        <div class="feature__text">
                            <h3 class="feature__title">سئو، سرعت و دسترسی</h3>
                            <p class="feature__description">بهینه‌سازی دوستانه برای موتورهای جستجو، تولید خودکار تگ‌ها و
                                نقشه سایت و زیرساخت CDN برای
                                بارگذاری سریع.
                            </p>
                            <ul class="feature__highlights">
                                <li><i class="ri-check-line"></i>سرعت و پرفورمنس خیره کننده در مقایسه با
                                    وردپرس و دیگر فروشگاه ساز ها</li>
                                <li><i class="ri-check-line"></i>عنوان
                                    (title)
                                    و متادسکریپشن
                                    (metadescription)
                                    خودکار با امکان ویرایش</li>

                                <li><i class="ri-check-line"></i>تنظیم خودکار متن alt برای تصاویر محصولات</li>
                                <li><i class="ri-check-line"></i>مدیریت مهاجرت و حفظ ترافیک و رتبه گوگل از طریق ریدایرکت
                                    و حفط urlها</li>
                                <li><i class="ri-check-line"></i>Sitemap.xml و Robots.txt تولید خودکار</li>
                                <li><i class="ri-check-line"></i>پشتیبانی از Schema/Structured Data برای محصولات</li>
                                <li><i class="ri-check-line"></i>CDN و بهینه‌سازی تصاویر برای لود سریع در موبایل</li>
                            </ul>
                        </div>
                    </div>
                    <div class="feature__image">
                        <!-- تصویر اول (زیرین) -->
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/seo1.PNG" alt="Analytics View" class="pos-back">

                        <!-- تصویر دوم (رویی) -->
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/seo2.jpg" alt="Follow Check" class="pos-front">
                    </div>
                </div>

                <!-- Feature Item 5 -->
                <div class="feature__item" data-aos="fade-up">
                    <div class="feature__content">
                        <div class="feature__icon-wrapper">
                            <div class="feature__icon">
                                <i class="ri-bank-card-2-line"></i>
                            </div>
                        </div>
                        <div class="feature__text">
                            <h3 class="feature__title">پرداخت‌ها، مالیات و فاکتورها</h3>
                            <p class="feature__description">اتصال به درگاه‌های مستقیم و واسط ایرانی، پشتیبانی از پرداخت
                                اقساطی و صدور فاکتور رسمی و
                                پیش‌فاکتور.
                            </p>
                            <ul class="feature__highlights">
                                <li><i class="ri-check-line"></i>پشتیبانی زرین‌پال، به‌پرداخت، پی‌پینگ و درگاه‌های دیگر
                                </li>
                                <li><i class="ri-check-line"></i>درگاه‌های پرداخت اقساطی و یکپارچه با بانکی‌ها
                                </li>
                                <li><i class="ri-check-line"></i>صدور اتوماتیک فاکتور و ارسال ایمیل/پی‌دی‌اف برای مشتری
                                </li>
                                <li><i class="ri-check-line"></i>گزارش‌های مالی و خروجی برای حسابداری (Excel, CSV)</li>
                            </ul>
                        </div>
                    </div>
                    <div class="feature__image">
                        <!-- تصویر اول (زیرین) -->
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/oerder1.PNG" alt="Analytics View" class="pos-back">

                        <!-- تصویر دوم (رویی) -->
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/order2.PNG" alt="Follow Check" class="pos-front">
                    </div>
                </div>

                <!-- Feature Item 6 -->
                <div class="feature__item feature__item--reverse" data-aos="fade-up">
                    <div class="feature__content">
                        <div class="feature__icon-wrapper">
                            <div class="feature__icon">
                                <i class="ri-truck-line"></i>
                            </div>
                        </div>
                        <div class="feature__text">
                            <h3 class="feature__title">ارسال و لجستیک یکپارچه</h3>
                            <p class="feature__description">اتصال به پیک‌ها و سرویس‌های پستی (پست، تیپاکس، الوپیک و…)،
                                محاسبهٔ هزینهٔ ارسال و چاپ
                                بارکد/آدرس.
                            </p>
                            <ul class="feature__highlights">
                                <li><i class="ri-check-line"></i>قابلیت تعریف مناطق ارسال و هزینهٔ داینامیک</li>
                                <li><i class="ri-check-line"></i>کاهش هزینه های ارسال (تخفیف پستی) با دسترسی به
                                    پنل واسط پستی (SadrCOD) </li>

                                <li><i class="ri-check-line"></i>پرینت فهرست بسته بندی و بارکد برای تسریع پروسهٔ ارسال
                                </li>
                                <li><i class="ri-check-line"></i>اتصال به سرویس‌های لجستیکی و رهگیری سفارش</li>
                            </ul>
                        </div>
                    </div>
                    <div class="feature__image">
                        <!-- تصویر اول (زیرین) -->
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/cod1.PNG" alt="Analytics View" class="pos-back">

                        <!-- تصویر دوم (رویی) -->
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/cod2.PNG" alt="Follow Check" class="pos-front">
                    </div>
                </div>
            </div>

            <!-- Additional Features Grid -->
            <div class="features__extra">
                <h3 class="features__extra-title">امکانات بیشتر</h3>
                <div class="extra__grid">
                    <div class="extra__item" data-aos="zoom-in">
                        <i class="ri-shopping-bag-4-fill"></i>
                        <h4> سبد خرید هوشمند</h4>
                        <p>بروزرسانی قیمت و موجودی در تمام سبدها به صورت لحظه ای</p>
                    </div>
                    <div class="extra__item" data-aos="zoom-in" >
                        <i class="ri-camera-ai-line"></i>
                        <h4>جستجوی تصویری </h4>
                        <p>جستجوی محصول با عکس ژورنالی یا گرفتن عکس با موبایل</p>
                    </div>
                    <div class="extra__item" data-aos="zoom-in">
                        <i class="ri-bar-chart-box-line"></i>
                        <h4>داشبورد و گزارش ها</h4>
                        <p>نمودار نرخ تبدیل، آمار بازدیدکنندگان، سفارشات، وضعیت
                            بازارگاه‌ها</p>
                    </div>
                    <div class="extra__item" data-aos="zoom-in">
                        <i class="ri-user-heart-line"></i>
                        <h4>پشتیبانی و آموزش</h4>
                        <p>راهنمای ویدیویی، آکادمی آموزشی و سرویس مشاورهٔ</p>
                    </div>
                    <div class="extra__item" data-aos="zoom-in">
                        <i class="ri-shield-check-line"></i>
                        <h4>امنیت و پایداری</h4>
                        <p>SSL خودکار و HTTPS و تضمین ثبات سرعت بدون نیاز به نگهداری</p>
                    </div>
                    <!--   <div class="extra__item">
                        <i class="ri-customer-service-line"></i>
                        <h4>پشتیبانی ۲۴/۷</h4>
                        <p>همیشه در کنار شما هستیم</p>
                    </div>  -->
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================ -->
    <!-- SECTION 5: WHY ATAJOY / BENEFITS -->
    <!-- ============================================ -->
    <section class="benefits section" id="why-atajoy">
        <div class="benefits__container container">
            <!-- Section Header -->
            <div class="section__header">
                <span class="section__subtitle">از رقبا قوی‌تر؛ </span>
                <h2 class="section__title">
                    چه چیزهایی
                    <span class="gradient-text"> صدرهاب</span>
                </h2>را متمایز می‌کند؟
            </div>

            <!-- Impact Statistics -->
            <div class="benefits__stats">
                <div class="stat__card" data-aos="zoom-in" data-aos-delay="100">
                    <div class="stat__icon">
                        <i class="ri-line-chart-line"></i>
                    </div>
                    <h3 class="stat__value" data-target="350">0</h3>
                    <p class="stat__unit">%</p>
                    <p class="stat__description">افزایش نرخ تبدیل</p>
                </div>

                <div class="stat__card" data-aos="zoom-in" data-aos-delay="200">
                    <div class="stat__icon">
                        <i class="ri-time-line"></i>
                    </div>
                    <h3 class="stat__value" data-target="80">0</h3>
                    <p class="stat__unit">%</p>
                    <p class="stat__description">صرفه‌جویی در زمان</p>
                </div>

                <div class="stat__card" data-aos="zoom-in" data-aos-delay="300">
                    <div class="stat__icon">
                        <i class="ri-medal-line"></i>
                    </div>
                    <h3 class="stat__value" data-target="95">0</h3>
                    <p class="stat__unit">%</p>
                    <p class="stat__description">رضایت مشتریان</p>
                </div>

                <div class="stat__card" data-aos="zoom-in" data-aos-delay="400">
                    <div class="stat__icon">
                        <i class="ri-wallet-3-line"></i>
                    </div>
                    <h3 class="stat__value" data-target="5">0</h3>
                    <p class="stat__unit">x</p>
                    <p class="stat__description">بازگشت سرمایه (ROI)</p>
                </div>
            </div>

            <!-- Benefits Grid -->
            <div class="benefits__grid">
                <!-- Benefit 1 -->
                <div class="benefit__card" data-aos="fade-up">
                    <div class="benefit__icon-wrapper">
                        <i class="ri-rocket-line"></i>
                    </div>
                    <h3 class="benefit__title">معماری SSR</h3>
                    <p class="benefit__description">
                        پایداری سرعت و پرفورمنس سایت در بالاترین حد ممکن بدون نیاز به تخصص فنی و بهینه سازی های
                        مداوم و مکرر </p>
                </div>

                <!-- Benefit 2 -->
                <div class="benefit__card" data-aos="fade-up" data-aos-delay="100">
                    <div class="benefit__icon-wrapper">
                        <i class="ri-logout-box-r-line"></i>
                    </div>
                    <h3 class="benefit__title">مهاجرت آسان با حفظ سئو
                    </h3>
                    <p class="benefit__description">
                        انتقال کامل با نگهداری URLها و ریدایرکت‌های مناسب </p>
                </div>

                <!-- Benefit 3 -->
                <div class="benefit__card" data-aos="fade-up" data-aos-delay="200">
                    <div class="benefit__icon-wrapper">
                        <i class="ri-robot-3-line"></i>
                    </div>
                    <h3 class="benefit__title">دایرکت-به-سفارش:</h3>
                    <p class="benefit__description">
                        تبدیل مکالمهٔ اینستاگرامی به سفارش با یک کلیک داخل پنل </p>
                </div>

                <!-- Benefit 4 -->
                <div class="benefit__card" data-aos="fade-up" data-aos-delay="300">
                    <div class="benefit__icon-wrapper">
                        <i class="ri-sticky-note-add-line"></i>
                    </div>
                    <h3 class="benefit__title">مقیاس‌پذیری</h3>
                    <p class="benefit__description">
                        با رشد کسب‌وکار، صدرهاب عقب نمی ماند. تضمین ثبات سرعت و کیفیت پرفورمنس فروشگاه با هرتعدادی از
                        محصول، صفحه و کاربر
                    </p>
                </div>

                <!-- Benefit 5 -->
                <div class="benefit__card" data-aos="fade-up" data-aos-delay="400">
                    <div class="benefit__icon-wrapper">
                        <i class="ri-code-s-slash-line"></i>
                    </div>
                    <h3 class="benefit__title">امکان توسعه ماژول ها در پنل پشتیبانی</h3>
                    <p class="benefit__description">
                        در صورت نیاز و به طور سفارشی امکان هرگونه تغییر و توسعه برای نهاد ها و شرکت ها وجود دارد</p>
                </div>

                <!-- Benefit 6 -->
                <div class="benefit__card" data-aos="fade-up" data-aos-delay="500">
                    <div class="benefit__icon-wrapper">
                        <i class="ri-shield-check-line"></i>
                    </div>
                    <h3 class="benefit__title">Meta API رسمی</h3>
                    <p class="benefit__description">
                        اتصال رسمی با Meta Business API، بدون نگرانی از بلاک شدن اکانت
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================ -->
    <!-- SECTION 6: PRICING PLANS -->
    <!-- ============================================ -->
    <section class="pricing section" id="pricing">
        <div class="pricing__container container">
            <!-- Section Header -->
            <div class="section__header">
                <span class="section__subtitle">تعرفه‌ها</span>
                <h2 class="section__title">
                    ارزانترین و با این حال <span class="gradient-text"> با کیفیت تر از همه</span>
                </h2>
            </div>

            <!-- Billing Toggle -->
            <div class="pricing__toggle">
                <span class="toggle__label">سالانه <span class="toggle__badge">۲۰٪ تخفیف</span></span>

                <div class="toggle__switch">
                    <input type="checkbox" id="billing-toggle" class="toggle__input">
                    <label for="billing-toggle" class="toggle__slider"></label>
                </div>
                <span class="toggle__label">ماهانه</span>

            </div>

            <!-- Pricing Cards -->
            <div class="pricing__grid">


                <!-- Professional Plan (Popular) 
                <div class="free-offer">
                    <div class="pricing__card pricing__card--popular" data-aos="fade-up" data-aos-delay="200">


                        <div class="pricing__badge">برای ایران</div>
                        <div class="pricing__header">
                            <h3 class="pricing__name">کنارتان هستیم</h3>
                            <p class="pricing__description">یک سال استفاده از تمام امکانات صدرهاب</p>
                        </div>
                        <div class="pricing__price">
                            <span class="price__amount monthly-price">رایگان</span>
                            <span class="price__amount yearly-price" style="display:none;">رایگان</span>
                        </div>
                        با توجه به شرایط فعلی کشور و از دست رفتن کسب و کار بسیاری از فروشگاه های اینترنتی در بستر های
                        بین المللی ،صدرهاب با افتخار کلیه امکانات سرویس فروشگاه ساز را تا یک سال به صورت
                        کاملا رایگان در اختیار هموطنان عزیز قرار میدهد.
                        <br>
                        <br>
                        <ul class="pricing__features">
                            <li><i class="ri-check-line"></i> تمام امکانات فروشگاهی</li>
                            <li><i class="ri-check-line"></i> کارمزد هر سفارش فقط: 1500 تومان </li>
                            <li><i class="ri-check-line"></i> شارژ هدیه پنل در بازارگاه فی بین: 300 هزارتومان</li>

                        </ul>

                        <a href="#" class="btn btn--primary btn--full">شروع رایگان با کد تخفیف: FORIRAN</a>
                    </div>
                </div> -->

                <!-- Professional Plan (Popular) -->
                <div class="pricing__card pricing__card--popular" data-aos="fade-up" data-aos-delay="200">
                    <div class="pricing__badge">محبوب‌ترین</div>
                    <div class="pricing__header">
                        <h3 class="pricing__name">ما بی رقیبیم</h3>
                        <p class="pricing__description">چه در قیمت و چه در امکانات</p>
                    </div>
                    <div class="pricing__price">
                        <span class="price__amount monthly-price">۹۹,۰۰۰</span>
                        <span class="price__amount yearly-price" style="display:none;">۹۹۹,۰۰۰</span>
                        <span class="price__currency">تومان</span>
                        <span class="price__period monthly-period">/ماهانه</span>
                        <span class="price__period yearly-period" style="display:none;">/سالانه</span>
                    </div>
                    <ul class="pricing__features">
                        <li><i class="ri-check-line"></i> تمام امکانات فروشگاهی</li>
                        <li><i class="ri-check-line"></i> کارمزد هر سفارش فقط: 1500 تومان </li>
                        <li><i class="ri-check-line"></i> شارژ هدیه پنل در بازارگاه فی بین: 300 هزارتومان</li>
                    </ul>

                    <a href="#" class="btn btn--primary btn--full">شروع</a>
                </div>

            </div>

            <!-- Pricing Note 
            <div class="pricing__note">
                <i class="ri-information-line"></i>
            </div>-->
        </div>
    </section>

    <!-- ============================================ -->
    <!-- SECTION 7: PARTNERS / BRANDS / BLOGGERS -->
    <!-- ============================================ -->
    <section class="partners section">
        <div class="partners__container container">
            <!-- Section Header -->
            <div class="section__header">
                <span class="section__subtitle">همکاران ما</span>
                <h2 class="section__title">
                    برندها و کسب‌وکارهایی که به
                    <span class="gradient-text">صدرهاب اعتماد کرده‌اند</span>
                </h2>
            </div>

            <!-- Partners Logo Carousel -->
            <div class="partners__slider">
                <div class="partners__track">
                    <!-- Partner logos will scroll automatically -->
                    <div class="partner__item">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/partners/partner-1.png" alt="Partner 1">
                        <!-- Partner Logo 1: 200x80px, Grayscale logo, will be colored on hover -->
                    </div>
                    <div class="partner__item">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/partners/partner-2.png" alt="Partner 2">
                        <!-- Partner Logo 2: 200x80px -->
                    </div>
                    <div class="partner__item">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/partners/partner-3.png" alt="Partner 3">
                        <!-- Partner Logo 3: 200x80px -->
                    </div>
                    <div class="partner__item">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/partners/partner-4.png" alt="Partner 4">
                        <!-- Partner Logo 4: 200x80px -->
                    </div>
                    <div class="partner__item">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/partners/partner-5.png" alt="Partner 5">
                        <!-- Partner Logo 5: 200x80px -->
                    </div>
                    <div class="partner__item">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/partners/partner-6.png" alt="Partner 6">
                        <!-- Partner Logo 6: 200x80px -->
                    </div>
                    <div class="partner__item">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/partners/partner-7.png" alt="Partner 7">
                        <!-- Partner Logo 7: 200x80px -->
                    </div>
                    <div class="partner__item">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/partners/partner-8.png" alt="Partner 8">
                        <!-- Partner Logo 8: 200x80px -->
                    </div>
                    <!-- Duplicate for seamless loop -->
                    <div class="partner__item">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/partners/partner-1.png" alt="Partner 1">
                    </div>
                    <div class="partner__item">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/partners/partner-2.png" alt="Partner 2">
                    </div>
                    <div class="partner__item">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/partners/partner-3.png" alt="Partner 3">
                    </div>
                    <div class="partner__item">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/partners/partner-4.png" alt="Partner 4">
                    </div>
                </div>
            </div>

            <!-- Testimonials -->
            <div class="testimonials">
                <h3 class="testimonials__title">نظرات کاربران</h3>
                <div class="testimonials__grid">
                    <!-- Testimonial 1 -->
                    <div class="testimonial__card" data-aos="fade-up">
                        <div class="testimonial__rating">
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                        </div>
                        <p class="testimonial__text">
                            "با صدرهاب فروش ما ۴ برابر شد! دیگر نگران از دست دادن مشتری در شب‌ها نیستیم. پاسخگویی خودکار
                            باعث شد مشتریان راضی‌تر باشند."
                        </p>
                        <div class="testimonial__author">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/testimonials/download.jpg" alt="سارا احمدی" class="author__avatar">
                            <!-- Avatar 1: 60x60px, Professional portrait photo -->
                            <div class="author__info">
                                <h4 class="author__name">سارا احمدی</h4>
                                <p class="author__position">مدیر فروشگاه آنلاین پوشاک</p>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonial 2 -->
                    <div class="testimonial__card" data-aos="fade-up" data-aos-delay="100">
                        <div class="testimonial__rating">
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                        </div>
                        <p class="testimonial__text">
                            "رابط کاربری فوق‌العاده ساده و کاربردیه. تو چند ساعت تونستم همه چیو راه‌اندازی کنم.
                            صرفه‌جویی زمانی که صدرهاب ایجاد کرده باورنکردنیه."
                        </p>
                        <div class="testimonial__author">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/testimonials/450190-4cd7bda3.webp" alt="امیر رضایی"
                                class="author__avatar">
                            <!-- Avatar 2: 60x60px -->
                            <div class="author__info">
                                <h4 class="author__name">امیر رضایی</h4>
                                <p class="author__position">بنیانگذار استارتاپ فناوری</p>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonial 3 -->
                    <div class="testimonial__card" data-aos="fade-up" data-aos-delay="200">
                        <div class="testimonial__rating">
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                        </div>
                        <p class="testimonial__text">
                            "ویترین محصولات صدرهاب عالیه! مشتریا راحت محصولات رو میبینن و سفارش میدن. سیستم فالوآپ هم
                            خیلی به افزایش فروش کمک کرده."
                        </p>
                        <div class="testimonial__author">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/testimonials/images.jpg" alt="نگار کریمی" class="author__avatar">
                            <!-- Avatar 3: 60x60px -->
                            <div class="author__info">
                                <h4 class="author__name">نگار کریمی</h4>
                                <p class="author__position">صاحب برند لوازم آرایشی</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================ -->
    <!-- SECTION 8: FAQ / TUTORIALS -->
    <!-- ============================================ -->
    <section class="faq section" id="faq">
        <div class="faq__container container">
            <!-- Section Header -->
            <div class="section__header">
                <span class="section__subtitle">سوالات متداول</span>
                <h2 class="section__title">
                    پاسخ سوالات
                    <span class="gradient-text">شما</span>
                </h2>
            </div>

            <!-- FAQ Accordion -->
            <div class="faq__accordion">
                <!-- FAQ Item 1 -->
                <div class="faq__item" data-aos="fade-up">
                    <button class="faq__question">
                        <span>ربات اینستاگرام صدرهاب چگونه کار می‌کند؟</span>
                        <i class="ri-arrow-down-s-line faq__icon"></i>
                    </button>
                    <div class="faq__answer">
                        <p>
                            صدرهاب با استفاده از Meta Business API رسمی به اکانت اینستاگرام و فیسبوک شما متصل می‌شود.
                            شما سناریوهای دلخواه خود را تنظیم می‌کنید و صدرهاب به صورت خودکار به پیام‌ها و کامنت‌های
                            کاربران پاسخ می‌دهد. همه چیز بدون نیاز به دانش فنی و در چند کلیک انجام می‌شود.
                        </p>
                    </div>
                </div>

                <!-- FAQ Item 2
                <div class="faq__item" data-aos="fade-up" data-aos-delay="50">
                    <button class="faq__question">
                        <span>آیا امکانات واقعاً در سال اول رایگان است؟</span>
                        <i class="ri-arrow-down-s-line faq__icon"></i>
                    </button>
                    <div class="faq__answer">
                        <p>
                            بله. همهٔ امکانات پایه و حرفه‌ای برای ۱۲ ماه در دورهٔ معرفی کاملاً رایگان است.
                            پس از پایان دوره، می‌توانید یکی از پلن‌های شفاف ما را انتخاب کنید یا سرویس را تمدید نمایید.
                        </p>
                    </div>
                </div> -->

                <!-- FAQ Item 3 -->
                <div class="faq__item" data-aos="fade-up" data-aos-delay="100">
                    <button class="faq__question">
                        <span>مهاجرت از میکسین/وردپرس/شاپفا چگونه انجام می‌شود؟</span>
                        <i class="ri-arrow-down-s-line faq__icon"></i>
                    </button>
                    <div class="faq__answer">
                        <p>
                            مهاجرت از فروشگاه های وردپرسی (مبتنی بر PHP
                            )
                            از طریق نصب افزونه صدرهاب و استخراج محصولات انجام می شود همچنین مهاجرت از میکیسین نیز از
                            طریق گزینه ی فراهم شده در این فروشگاه انجام می شود. آموزش انجام این مراحل در بخش آکادمی به
                            طور ویدیویی قرار داده شده و در صورتی که خودتان قادر به انجام مراحل گفته شده نبودید می توانید
                            با صرف هزینه ی اندک از تیم ما بخواهید این مراحل را برای شما انجام دهند.
                        </p>
                    </div>
                </div>

                <!-- FAQ Item 4 -->
                <div class="faq__item" data-aos="fade-up" data-aos-delay="150">
                    <button class="faq__question">
                        <span>آیا امکان فروش از طریق دایرکت اینستاگرام وجود دارد؟</span>
                        <i class="ri-arrow-down-s-line faq__icon"></i>
                    </button>
                    <div class="faq__answer">
                        <p>
                            بله. شما می‌توانید مکالمات دایرکت را به سفارش تبدیل کنید، محصولات را مستقیم
                            ارسال کنید و از پاسخ‌های خودکار برای پیشنهاد محصول استفاده کنید.
                        </p>
                    </div>
                </div>

                <!-- FAQ Item 5 -->
                <div class="faq__item" data-aos="fade-up" data-aos-delay="200">
                    <button class="faq__question">
                        <span> آموزش های لازم برای ساخت فروشگاه را از کجا دریافت کنم؟ </span>
                        <i class="ri-arrow-down-s-line faq__icon"></i>
                    </button>
                    <div class="faq__answer">
                        <p>
                            آکادمی و مجموعهٔ ویدیوهای آموزشی و مقالات
                            راهنما برای شما آماده است و در صورت نیاز مشاورهٔ اختصاصی نیز تیم صدرهاب با در قبال دریافت
                            هزینه انجام خدمات اضافی امور مربوطه در راه اندازی وبسایت شما را به دست می گیرد. .
                        </p>
                    </div>
                </div>
            </div>

            <!-- Tutorial Section -->
<div class="tutorials">
    <h3 class="tutorials__title">آموزش‌های ویدیویی</h3>
    <div class="tutorials__grid">
        
        <!-- Tutorial 1 -->
        <div class="tutorial__card" data-aos="fade-up">
            <div class="tutorial__thumbnail video-wrapper">
                <div id="94798908369">
                    <script type="text/JavaScript" src="https://www.aparat.com/embed/jgi2w1j?data[rnddiv]=94798908369&data[responsive]=yes&muted=false&titleShow=true&recom=self"></script>
                </div>
            </div>
            <div class="tutorial__content">
                <h4 class="tutorial__name">نصب و راه‌اندازی اولیه</h4>
                <p class="tutorial__description">آموزش گام به گام اتصال اکانت و تنظیمات پایه</p>
            </div>
        </div>

        <!-- Tutorial 2 -->
        <div class="tutorial__card" data-aos="fade-up" data-aos-delay="100">
            <div class="tutorial__thumbnail video-wrapper">
                <div id="88076314165">
                    <script type="text/JavaScript" src="https://www.aparat.com/embed/uvaazz1?data[rnddiv]=88076314165&data[responsive]=yes&titleShow=true&recom=self"></script>
                </div>
            </div>
            <div class="tutorial__content">
                <h4 class="tutorial__name"> ورود به پنل ادمین </h4>
                <p class="tutorial__description">راهنمای کامل روش های دسترسی به پنل مدیریت فروشگاه</p>
            </div>
        </div>




                    <!-- Tutorial 3 
                    <div class="tutorial__card" data-aos="fade-up" data-aos-delay="200">
                        <div class="tutorial__thumbnail">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/tutorials/tutorial-3-thumb.jpg" alt="راه‌اندازی ویترین">
                            <div class="tutorial__play">
                                <i class="ri-play-circle-fill"></i>
                            </div>
                            <span class="tutorial__duration">۱۲:۴۵</span>
                        </div>
                        <div class="tutorial__content">
                            <h4 class="tutorial__name">راه‌اندازی ویترین محصولات</h4>
                            <p class="tutorial__description">ساخت کاتالوگ و دریافت سفارش از دایرکت</p>
                        </div>
                    </div> -->
                </div>
                <div class="tutorials__cta">
                    <a href="#" class="btn btn--outline">
                        <i class="ri-video-line"></i>
                        <span>مشاهده همه آموزش‌ها</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <?php get_footer(); ?>
    <?php 
// بررسی می‌کنیم اگر کاربر لاگین نکرده باشد (!) دکمه رندر شود
if ( ! function_exists('sadrhub_is_api_logged_in') || ! sadrhub_is_api_logged_in() ) : 
?>

    <!-- ============================================ -->
    <!-- CTA FLOATING BUTTON -->
    <!-- ============================================ -->
    <a href="#pricing" class="floating-cta" id="floating-cta">
        <i class="ri-rocket-line"></i>
        <span>شروع رایگان</span>
    </a>

<?php endif; ?>
