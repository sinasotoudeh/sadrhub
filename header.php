<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

    <!-- ============================================ -->
    <!-- SECTION 1: HEADER / NAVIGATION -->
    <!-- ============================================ -->
    <header class="header" id="header">
        <nav class="nav container">
            <!-- Logo -->
            <div class="nav__logo">
                <a href="<?php echo home_url(); ?>" class="nav__logo-link" style="display: flex; align-items: center; gap: 0.5rem; text-decoration: none; color: inherit;">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/logo.png" alt="<?php bloginfo('name'); ?>" class="nav__logo-img">
                    <span class="nav__logo-text">صدرهاب</span>
                </a>
            </div>

            <!-- Navigation Menu -->
            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <?php 
                    $link_prefix = is_front_page() ? '' : home_url( '/' ); 
                    ?>

                    <li class="nav__item">
                        <!-- لینک امکانات -->
                        <a href="<?php echo $link_prefix; ?>#features" class="nav__link">امکانات</a>
                    </li>
                    <li class="nav__item">
                        <!-- لینک تعرفه‌ها -->
                        <a href="<?php echo $link_prefix; ?>#pricing" class="nav__link">تعرفه‌ها</a>
                    </li>
                    <li class="nav__item">
                        <!-- لینک سوالات متداول -->
                        <a href="<?php echo $link_prefix; ?>#faq" class="nav__link">سوالات</a>
                    </li>
                    <li class="nav__item">
                        <a href="<?php echo home_url('/blog'); ?>" class="nav__link">بلاگ</a>
                    </li> 
                    <li class="nav__item">
                        <a href="<?php echo home_url('/portfolio'); ?>" class="nav__link">نمونه ها</a>
                    </li> 
                    
                </ul>

                <!-- Close button for mobile -->
                <div class="nav__close" id="nav-close">
                    <i class="ri-close-line"></i>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="nav__actions" style="display: flex; align-items: left; gap: 5px;">
                
                <?php if ( sadrhub_is_api_logged_in() ): ?>
                    <!-- حالت ۱: کاربر لاگین کرده است -->
                    <?php 
                        $user_data = sadrhub_get_api_user(); 
                        $display_name ='پنل کاربری';
                        if ( isset($user_data)  && !empty($user_data)){
                            $display_name = $user_data;
                        }
                        // دریافت نام یا شماره
                        if ( is_array($user_data) ) {
                            if ( !empty($user_data['firstName']) ) {
                                $display_name = $user_data['firstName'];
                            } elseif ( !empty($user_data['name']) ) {
                                $display_name = $user_data['name'];
                            }
                            // اگر هیچکدام نبود، شاید شماره موبایل در کوکی جداگانه باشد یا در دیتای یوزر
                            elseif ( isset($_COOKIE['sadr_user_mobile']) ) {
                                $display_name = $_COOKIE['sadr_user_mobile'];
                            }
                        }

                        // === تبدیل اعداد انگلیسی به فارسی ===
                        $en_num = array('0','1','2','3','4','5','6','7','8','9');
                        $fa_num = array('۰','۱','۲','۳','۴','۵','۶','۷','۸','۹');
                        $display_name = str_replace($en_num, $fa_num, $display_name);
                    ?>

                    <!-- دکمه پروفایل -->
                    <a href="<?php echo home_url('/profile/'); ?>" class="btn btn--secondary" style="padding: 10px; display: flex; align-items: center;">
                        <i class="ri-user-line"></i>
                        <!-- نمایش نام با فونت فارسی -->
                        <span style="font-family: inherit; direction: ltr; unicode-bidi: embed;"><?php echo esc_html($display_name); ?></span>
                    </a>

                    <a href="<?php echo home_url('/create/'); ?>" class="btn btn--primary hide-on-mobile" style=" padding: 10px; display: flex; align-items: center;">
                      
                        ساخت فروشگاه</a>
                    
                    <!-- دکمه خروج -->
                    <a href="?action=sadrhub_logout" class="btn btn--secondary" style="color: #ef4444; padding: 3px 10px; display: flex; align-items: center;" title="خروج از حساب">
                        <i class="ri-logout-box-r-line" style="font-size: 1.4rem;"></i>
                    </a>
                    
                <?php else: ?>
                    <!-- حالت ۲: کاربر مهمان است -->
                    <a href="<?php echo home_url('/register/'); ?>" class="btn btn--secondary"style="padding: 10px; display: flex; align-items: center;">ورود</a>
                    <a href="<?php echo home_url('#pricing'); ?>" class="btn btn--primary hide-on-mobile"style=" padding: 10px; display: flex; align-items: center;">شروع رایگان</a>
                <?php endif; ?>

            </div>


            <!-- Mobile Toggle -->
            <div class="nav__toggle" id="nav-toggle">
                <i class="ri-menu-line"></i>
            </div>
        </nav>
    </header>