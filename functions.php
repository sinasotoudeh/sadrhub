<?php
/*
Sadrhub.com
Author: Sina Sotoudeh
Website: sinasotoudeh.ir
github: github.com/sinasotoudeh
*/
// =================================================================
// تنظیمات و فایل‌های قالب
// =================================================================

function sadrhub_load_assets() {
    $theme_dir = get_template_directory_uri();

    // استایل‌ها
    wp_enqueue_style('remixicon', $theme_dir . '/icons/remixicon.css');
    wp_enqueue_style('fonts', $theme_dir . '/css/fonts.css');
    wp_enqueue_style('aos-css', $theme_dir . '/aos/aos.css');
    wp_enqueue_style('theme-style', get_stylesheet_uri());

    // اسکریپت‌ها
    wp_enqueue_script('jquery'); 
    wp_enqueue_script('aos-js', $theme_dir . '/aos/aos.js', array('jquery'), '1.0', true);
    wp_enqueue_script('main-js', $theme_dir . '/landing.js', array('jquery'), '1.0', true);

    // اسکریپت اختصاصی صفحه ورود
    if ( is_page_template('page-register.php') ) {
        wp_enqueue_script( 'sadrhub-auth', $theme_dir . '/js/auth.js', array('jquery'), '1.0', true );      
        
        wp_localize_script( 'sadrhub-auth', 'sadrhub_auth_obj', array(
            'root_url'     => home_url(),
            'redirect_url' => home_url('/profile/'),
            'ajax_url'     => admin_url( 'admin-ajax.php' ),
            'nonce'        => wp_create_nonce( 'sadrhub_auth_nonce' )
        ));
    }
}
add_action('wp_enqueue_scripts', 'sadrhub_load_assets');

function sadrhub_theme_support() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'sadrhub_theme_support');

// ریدایرکت پس از ورود
function sadrhub_login_redirect( $redirect_to, $request, $user ) {
    if ( isset( $user->roles ) && is_array( $user->roles ) ) {
        if ( in_array( 'administrator', $user->roles ) ) {
            return admin_url();
        }
    }
    return home_url( '/profile/' );
}
add_filter( 'login_redirect', 'sadrhub_login_redirect', 10, 3 );


// =================================================================
// توابع هندلر AJAX (ارتباط با API خارجی sadrhub)
// =================================================================

/**
 * مرحله اول: ارسال درخواست OTP
 */
add_action('wp_ajax_nopriv_sadrhub_send_otp', 'sadrhub_handle_send_otp');
add_action('wp_ajax_sadrhub_send_otp', 'sadrhub_handle_send_otp');

function sadrhub_handle_send_otp() {
    check_ajax_referer('sadrhub_auth_nonce', 'security');

    $mobile = sanitize_text_field($_POST['mobile']);

    // آدرس دقیق طبق cURL اول
    $endpoint = 'https://api.example.com/cl-otp?Phone=' . $mobile;

    $response = wp_remote_post($endpoint,
     array(
        'method'    => 'POST',
        'body'      => null,
        'headers'   => array(
            'Accept'     => 'application/json',
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'
        ),
        'timeout'   => 15,
        'sslverify' => false,
    )
);

    if (is_wp_error($response)) {
        wp_send_json_error('خطا در ارتباط با سرور پیامک');
    }

    $code = wp_remote_retrieve_response_code($response);
    
    if ($code === 200) {
        $body = wp_remote_retrieve_body($response); // get JSON string
        $body = json_decode($body, true); // convert to array
    
        // now $body['Result'] exists
        error_log('OTP Result: ' . print_r($body, true));
    
        if (isset($body['Result']) && $body['Result'] === 'OTPAlreadyExists') {
            wp_send_json_success([
                'status' => 'already_sent',
                'timeLeftInSeconds' => isset($body['TimeLeftInSeconds'])
                    ? intval($body['TimeLeftInSeconds'])
                    : 120
            ]);
        }
    
        // normal OTP sent
        wp_send_json_success([
            'status' => 'sent',
            'timeLeftInSeconds' => 120
        ]);
    } else {
    
        $msg = isset($body['message']) 
            ? $body['message'] 
            : 'خطا در ارسال پیامک';
    
        wp_send_json_error($msg);
    }
    // if ($code === 200) {
    //     wp_send_json_success('کد تایید ارسال شد');
    // } else {
    //     $body = json_decode(wp_remote_retrieve_body($response), true);
    //     $msg = isset($body['message']) ? $body['message'] : 'خطا در ارسال پیامک';
    //     wp_send_json_error($msg);
    // }
}

/**
 * مرحله دوم: بررسی کد تایید (Verify) و ست کردن کوکی‌ها
 */
add_action('wp_ajax_nopriv_sadrhub_verify_otp', 'sadrhub_handle_verify_otp');
add_action('wp_ajax_sadrhub_verify_otp', 'sadrhub_handle_verify_otp');

function sadrhub_handle_verify_otp() {
    check_ajax_referer('sadrhub_auth_nonce', 'security');

    $mobile = sanitize_text_field($_POST['mobile']);
    $otp    = sanitize_text_field($_POST['otp']);

    $endpoint = 'https://api.example.com/otp-verify?phone=' . $mobile . '&code=' . $otp;
    error_log('fermi2'.$endpoint);

    // $body_data = json_encode([
    //     'phone'      => $mobile,
    //     'code'       => $otp
    // ]);
    // [LOG] شروع پردازش
    error_log('----------------------------------------------------');

    $response = wp_remote_post($endpoint,
    array(
        'method'    => 'POST',
        'body'      => null,
        'headers'   => array(
            'Accept'     => 'application/json',
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'
        ),
        'timeout'   => 15,
        'sslverify' => false,
    )
);

    if (is_wp_error($response)) {
        wp_send_json_error('خطا در ارتباط با سرور احراز هویت');
    }

    $code = wp_remote_retrieve_response_code($response);
    
    // کد 200 یعنی موفقیت
    if ($code === 200) {
        
        // استخراج کوکی‌ها از هدر پاسخ سرور خارجی
        $headers = wp_remote_retrieve_headers($response);
        
        // گاهی وردپرس کوکی‌ها را در آرایه برمی‌گرداند، گاهی تک رشته
        $server_cookies = isset($headers['set-cookie']) ? $headers['set-cookie'] : [];
        if (!is_array($server_cookies)) {
            $server_cookies = [$server_cookies];
        }

        // لوپ روی کوکی‌های دریافتی (customer_session, token, csrftoken)
        // و ست کردن آن‌ها روی مرورگر کاربر فعلی
        foreach ($server_cookies as $cookie_str) {
            // ساختار کوکی: key=value; path=/; ...
            // جدا کردن نام و مقدار
            $parts = explode(';', $cookie_str);
            $first_part = explode('=', $parts[0], 2);
            
            if (count($first_part) == 2) {
                $name  = trim($first_part[0]);
                $value = trim($first_part[1]);
                
                // ست کردن کوکی در مرورگر کاربر (برای 7 روز طبق لاگ شما)
                // path=/ و httponly=true برای امنیت
                setcookie($name, $value, time() + 604800, "/", "", false, true);
            }
        }
        
        // برای اطمینان شماره موبایل را هم جداگانه ذخیره می‌کنیم
        setcookie('sadr_user_mobile', $mobile, time() + 604800, "/", "", false, false);

        wp_send_json_success([
            'redirect' => home_url('/profile/'),
            'message'  => 'ورود موفقیت آمیز بود'
        ]);

    } else {
        $body = json_decode(wp_remote_retrieve_body($response), true);
        $msg = isset($body['message']) ? $body['message'] : 'کد وارد شده صحیح نیست';
        wp_send_json_error($msg);
    }
}

// =================================================================
// مدیریت نشست کاربران خارجی (SaaS User Session)
// =================================================================

/**
 * بررسی وضعیت لاگین بودن کاربر API
 * بررسی می‌کند که آیا کوکی توکن معتبر وجود دارد یا خیر.
 */
function sadrhub_is_api_logged_in() {
    return isset($_COOKIE['token']) && !empty($_COOKIE['token']);
}

/**
 * دریافت اطلاعات کاربر از کوکی
 * کوکی customer_session را دیکد کرده و به صورت آرایه برمی‌گرداند.
 */
function sadrhub_get_api_user() {
    // if (isset($_COOKIE['customer_session'])) {
    if (isset($_COOKIE['sadr_user_mobile'])) {
        // کوکی معمولاً URL Encoded است، پس اول decode می‌کنیم
        $json_data = urldecode($_COOKIE['sadr_user_mobile']);
        // تبدیل JSON به آرایه
        // $user_data = json_decode($json_data, true);
        $user_data = $json_data;
        return $user_data;
        if (json_last_error() === JSON_ERROR_NONE) {
            return $user_data;
        }
    }
    return false;
}

/**
 * محافظت از صفحات (Redirect Logic)
 * 1. اگر کاربر لاگین نکرده و می‌خواهد به پروفایل برود -> ریدایرکت به ثبت‌نام
 * 2. اگر کاربر لاگین کرده و می‌خواهد به ثبت‌نام برود -> ریدایرکت به پروفایل
 * 3. هندل کردن خروج (Logout)
 */
function sadrhub_protect_pages() {
    // آدرس صفحات (اسلاگ‌ها را چک کنید)
    $profile_slug = 'profile';
    $login_slug   = 'register'; // یا هر صفحه‌ای که قالب page-register.php دارد

    // الف) خروج از حساب کاربری
    if ( isset($_GET['action']) && $_GET['action'] === 'sadrhub_logout' ) {
        // حذف تمام کوکی‌های مربوطه
        setcookie('token', '', time() - 3600, '/');
        setcookie('customer_session', '', time() - 3600, '/');
        setcookie('csrftoken', '', time() - 3600, '/');
        setcookie('sadr_user_mobile', '', time() - 3600, '/');
        
        // ریدایرکت به صفحه اصلی
        wp_redirect(home_url());
        exit;
    }

    // ب) محافظت از پروفایل (فقط لاگین شده‌ها)
    if ( is_page($profile_slug) && !sadrhub_is_api_logged_in() ) {
        wp_redirect( home_url('/' . $login_slug . '/') );
        exit;
    }

    // ج) جلوگیری از ورود مجدد (اگر لاگین است، صفحه ورود را نبیند)
    if ( is_page($login_slug) && sadrhub_is_api_logged_in() ) {
        wp_redirect( home_url('/' . $profile_slug . '/') );
        exit;
    }
}
add_action('template_redirect', 'sadrhub_protect_pages');


// =================================================================
// تنظیمات صفحه ساخت فروشگاه (Create Store)
// =================================================================

// 1. فراخوانی فایل JS مخصوص این صفحه
function sadrhub_enqueue_create_assets() {

    if ( is_page_template('page-create.php') ) {
        $theme_dir = get_template_directory_uri();
        
        wp_enqueue_script( 'sadrhub-create', $theme_dir . '/js/create-store.js', array('jquery'), '1.1', true );
        
        wp_localize_script( 'sadrhub-create', 'sadrhub_create_obj', array(
            'ajax_url'     => admin_url( 'admin-ajax.php' ),
            'redirect_url' => home_url('/profile/'),
            'nonce'        => wp_create_nonce( 'sadrhub_create_nonce' )
        ));
    }
}
add_action('wp_enqueue_scripts', 'sadrhub_enqueue_create_assets');

function sadrhub_enqueue_lottie_script() {
    if ( is_page_template('page-create.php') ) {
        wp_enqueue_script(
            'lottie-player-js', 
            get_stylesheet_directory_uri() . '/js/lottie-player.js', 
            array(), 
            '1.0.0', 
            true 
        );
    }
}
add_action( 'wp_enqueue_scripts', 'sadrhub_enqueue_lottie_script' );

add_action('wp_ajax_sadrhub_check_domain', 'sadrhub_handle_check_domain');
add_action('wp_ajax_nopriv_sadrhub_check_domain', 'sadrhub_handle_check_domain');

function sadrhub_handle_check_domain() {
    $domain = isset($_POST['domain']) ? sanitize_text_field($_POST['domain']) : '';
    error_log("--- START DOMAIN CHECK: " . $domain . " ---");
    $domain = $domain . '.sadrhub.ir';

    $endpoint = 'https://api.example.com/dom-lookup?domain=' . $domain;
    error_log("Request URL: " . $endpoint);

    $response = wp_remote_get($endpoint, array(
        'headers'   => array('Accept' => 'application/json'),
        'timeout'   => 15,
        'sslverify' => false,
    ));

    if (is_wp_error($response)) {
        wp_send_json_error('خطا در ارتباط با سرور: ' . $response->get_error_message());
    }

    $body = wp_remote_retrieve_body($response);
    $clean_body = trim($body);
    $json_body = json_decode($clean_body, true);

    if ($clean_body === 'true' || $json_body === true || $clean_body === '1') {
        wp_send_json_success('دامنه آزاد است');
    } else {
        wp_send_json_error('دامنه‌ی مورد نظر تکراریست لطفا نام دیگری انتخاب کنید');
    }
}

add_action('wp_ajax_sadrhub_create_store', 'sadrhub_handle_create_store');
add_action('wp_ajax_nopriv_sadrhub_create_store', 'sadrhub_handle_create_store');

function sadrhub_handle_create_store() {
    error_log("--- START CREATE STORE (Updated Step 2) ---");

    // 1. دریافت داده‌های پایه
    $body_data = array(
        'mobile'     => isset($_COOKIE['sadr_user_mobile']) ? sanitize_text_field($_COOKIE['sadr_user_mobile']) : '',
        'themeKey'   => isset($_POST['themeKey']) ? sanitize_text_field($_POST['themeKey']) : '',
        'shopName'   => isset($_POST['shopName']) ? sanitize_text_field($_POST['shopName']) : '',
        'domain'     => sanitize_text_field($_POST['domain']) . '.sadrhub.ir',
        // افزودن نام و نام خانوادگی به درخواست
        'firstName' => isset($_POST['first_name']) ? sanitize_text_field($_POST['first_name']) : '',
        'lastName'  => isset($_POST['last_name']) ? sanitize_text_field($_POST['last_name']) : '',
    );

    $prevData = array();

    $social_fields = [
        'prev_website'     => 'prevWebsite',
        'instagram_id'     => 'instagramId',
        'telegram_channel' => 'telegramChannel',
        'digikala_link'    => 'digikalaLink',
        'basalam_link'     => 'basalamLink'
    ];


    // پر کردن آرایه prevData در صورت وجود مقادیر
    foreach ($social_fields as $post_key => $api_key) {
        if (isset($_POST[$post_key]) && !empty($_POST[$post_key])) {
            $prevData[$api_key] = sanitize_text_field($_POST[$post_key]);
        }
    }

    // اضافه کردن آبجکت prevData به بدنه اصلی درخواست
    // نکته: اگر هیچکدام پر نشده باشند، این مقدار یک آرایه خالی [] ارسال می‌شود
    // که در فرمت JSON معادل آبجکت خالی یا لیست خالی است.
    // اگر آرایه خالی بود، آن را به آبجکت تبدیل کن تا خروجی {} شود
if (empty($prevData)) {
    $body_data['prevData'] = (object)[]; 
} else {
    $body_data['prevData'] = $prevData;
}


    // --- لاگ و ارسال ---

    // تبدیل به JSON (با حفظ کاراکترهای فارسی)
    $json_payload = json_encode($body_data, JSON_UNESCAPED_UNICODE);

    error_log(">>> FINAL JSON PAYLOAD TO API: " . $json_payload);

    $endpoint = 'https://api.example.com/new';

    $response = wp_remote_post($endpoint, array(
        'method'    => 'POST',
        'body'      => json_encode($body_data), // استفاده از json_encode استاندارد برای ارسال
        'headers'   => array(
            'Content-Type'  => 'application/json',
            'Accept'        => 'application/json',
        ),
        'timeout'   => 45,
        'sslverify' => false,
    ));

    if (is_wp_error($response)) {
        error_log("Connection Error: " . $response->get_error_message());
        wp_send_json_error('خطای ارتباط با سرور: ' . $response->get_error_message());
    }

    $raw_body = wp_remote_retrieve_body($response);
    error_log("API Response Raw: " . $raw_body);
    $json_body = json_decode($raw_body, true);

    $is_success = false;
    if (trim($raw_body) === 'true') $is_success = true;
    elseif ($json_body === true) $is_success = true;
    elseif (isset($json_body['message']) && $json_body['message'] === 'done') $is_success = true;
    elseif (isset($json_body['status']) && $json_body['status'] === 'done') $is_success = true;

    if ($is_success) {
        wp_send_json_success( 'فروشگاه با موفقیت ساخته شد');
    } else {
        $error_msg = 'خطا در ساخت فروشگاه';
        if (isset($json_body['message']) && !empty($json_body['message'])) {
            $error_msg = $json_body['message'];
        } elseif (!empty($raw_body)) {
            $error_msg = strip_tags($raw_body);
        }
        error_log("Store Creation Failed. Msg: " . $error_msg);
        wp_send_json_error($error_msg);
    }
}

// =================================================================
// تنظیمات صفحه پروفایل (Profile)
// =================================================================

// 1. فراخوانی فایل JS مخصوص پروفایل
function sadrhub_enqueue_profile_assets() {
    if ( is_page_template('page-profile.php') ) {
        $theme_dir = get_template_directory_uri();
        
        wp_enqueue_script( 'sadrhub-profile', $theme_dir . '/js/profile.js', array('jquery'), '1.0', true );
        
        wp_localize_script( 'sadrhub-profile', 'sadrhub_profile_obj', array(
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'nonce'    => wp_create_nonce( 'sadrhub_profile_nonce' ),
            'home_url' => home_url() // برای لینک خروج
        ));
    }
}
add_action('wp_enqueue_scripts', 'sadrhub_enqueue_profile_assets');

// 2. هندلر AJAX دریافت لیست فروشگاه‌ها
add_action('wp_ajax_sadrhub_get_user_stores', 'sadrhub_handle_get_user_stores');
add_action('wp_ajax_nopriv_sadrhub_get_user_stores', 'sadrhub_handle_get_user_stores'); // برای کاربران مهمان

//=========
// profile
// ========

function sadrhub_handle_get_user_stores() {
    // check_ajax_referer('sadrhub_profile_nonce', 'security');

    $mobile = isset($_COOKIE['sadr_user_mobile']) ? $_COOKIE['sadr_user_mobile'] : '';
    $token  = isset($_COOKIE['token']) ? $_COOKIE['token'] : '';

    // آدرس API
    $endpoint = 'https://api.example.com/dom-lst'; 
    
    // ۱. آماده‌سازی کوکی‌ها
    $cookies_str = '';
    if (!empty($_COOKIE)) {
        foreach ($_COOKIE as $name => $value) {
             $cookies_str .= $name . '=' . $value . '; ';
        }
    }

    // ۲. ارسال درخواست
    $response = wp_remote_get($endpoint, array(
        'headers'   => array(
            'Accept'        => 'application/json',
            'Authorization' => 'Bearer ' . $token,
            'Cookie'        => $cookies_str,
        ),
        'timeout'   => 20,
        'sslverify' => false,
    ));

    if (is_wp_error($response)) {
        wp_send_json_error('خطا در ارتباط با سرور');
    }

    $code = wp_remote_retrieve_response_code($response);
    $body = json_decode(wp_remote_retrieve_body($response), true);

    if ($code === 200) {
        // داده‌ها را همانطور که هست می‌فرستیم تا در JS پردازش شوند
        $list = isset($body['data']) ? $body['data'] : $body;
        wp_send_json_success($list);
    } else {
        wp_send_json_error('مشکلی در دریافت لیست فروشگاه‌ها پیش آمد.');
    }
}


/**
 * Allow JSON & SVG Uploads (Fixing "Sorry, this file type is not permitted")
 */

// 1. اضافه کردن فرمت به لیست مجاز
function sadrhub_mime_types($mimes) {
    $mimes['json'] = 'application/json';
    $mimes['svg']  = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'sadrhub_mime_types');

// 2. اصلاح بررسی نوع واقعی فایل (Real File Type Check) - بخش حیاتی
function sadrhub_fix_json_mime_type($data, $file, $filename, $mimes) {
    $ext = isset($data['ext']) ? $data['ext'] : '';
    
    // اگر وردپرس نتوانست فرمت را تشخیص دهد، خودمان چک می‌کنیم
    if ( !$ext ) {
        $exploded = explode('.', $filename);
        $ext = strtolower(end($exploded));
    }

    if ( $ext === 'json' ) {
        $data['ext']  = 'json';
        $data['type'] = 'application/json';
    }
    
    return $data;
}
add_filter('wp_check_filetype_and_ext', 'sadrhub_fix_json_mime_type', 10, 4);

function sadrhub_enqueue_blog_assets() {
    
    if ( is_page_template('blog-category.php') ) {
        
        $theme_dir = get_template_directory_uri();
        
        wp_enqueue_script( 'cuttlas-blog-hero', $theme_dir . '/js/blog-category.js', array(), '1.0', true );
        
         wp_enqueue_style( 'cuttlas-blog-css', $theme_dir . '/css/blog-category.css' );
    }
}
add_action('wp_enqueue_scripts', 'sadrhub_enqueue_blog_assets');
function cuttlas_single_scripts() {
    // فقط اگر در صفحه نوشته تکی هستیم
    if ( is_single() ) {
        // فایل CSS
        wp_enqueue_style( 'cuttlas-single-style', get_template_directory_uri() . '/css/single-post.css', array(), '1.0' );
        
        // فایل JS
        wp_enqueue_script( 'cuttlas-single-script', get_template_directory_uri() . '/js/single-post.js', array(), '1.0', true );
    }
}
add_action( 'wp_enqueue_scripts', 'cuttlas_single_scripts' );

?>
