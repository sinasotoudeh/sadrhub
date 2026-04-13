<?php
/*
Template Name: صفحه ورود و ثبت نام
Sadrhub
Author: Sina Sotoudeh
Website: sinasotoudeh.ir
github: github.com/sinasotoudeh
*/
// اگر کاربر لاگین است، او را به پروفایل هدایت کن
if ( is_user_logged_in() ) {
    wp_redirect( home_url('/profile/') );
    exit;
}

get_header(); 
?>
    <section class="hero" id="home">
    <div class="auth-container">
        <div class="auth-box">
            <!-- لوگو یا عنوان -->
            <div class="auth-header">
                <h2>ورود یا ثبت‌نام</h2>
                <p>برای ادامه شماره موبایل خود را وارد کنید</p>
            </div>

<!-- فرم شماره موبایل (مرحله ۱) - نسخه حرفه‌ای -->
<form id="auth-step-1" class="auth-form">
    <div class="form-group">
        <label for="mobile-display">شماره موبایل</label>
        
        <!-- کانتینر گروهی برای انتخاب کشور و ورودی موبایل -->
        <div class="mobile-input-group" dir="ltr">
            
            <!-- دراپ‌داون سفارشی انتخاب کشور -->
            <div class="custom-select-wrapper">
                <div class="custom-select-trigger" id="country-trigger">
                    <span id="selected-flag">🇮🇷</span>
                    <span id="selected-code">+98</span>
                    <i class="ri-arrow-down-s-line arrow"></i>
                </div>
                <div class="custom-options">
                    <!-- گزینه پیش‌فرض: ایران -->
                    <div class="custom-option selected" data-value="+98" data-flag="🇮🇷" data-country="iran">
                        <span class="option-flag">🇮🇷</span>
                        <span class="option-text">ایران (+98)</span>
                    </div>
                    <!-- سایر کشورها (مثال) -->
                    <div class="custom-option" data-value="+49" data-flag="🇩🇪" data-country="germany">
                        <span class="option-flag">🇩🇪</span>
                        <span class="option-text">آلمان (+49)</span>
                    </div>
                    <div class="custom-option" data-value="+1" data-flag="🇺🇸" data-country="usa">
                        <span class="option-flag">🇺🇸</span>
                        <span class="option-text">آمریکا (+1)</span>
                    </div>
                    <div class="custom-option" data-value="+90" data-flag="🇹🇷" data-country="turkey">
                        <span class="option-flag">🇹🇷</span>
                        <span class="option-text">ترکیه (+90)</span>
                    </div>
                </div>
                <!-- اینپوت مخفی برای نگهداری کد کشور انتخاب شده -->
                <input type="hidden" id="country-code-input" value="+98">
            </div>

            <!-- ورودی شماره موبایل (نمایشی) -->
            <input type="tel" id="mobile-display" placeholder="912 345 6789" inputmode="numeric">
        </div>
        
        <!-- اینپوت مخفی نهایی که برای سرور ارسال می‌شود (فرمت استاندارد 0912...) -->
        <input type="hidden" id="final-mobile" name="mobile">
    </div>

    <!-- محل نمایش خطاهای اختصاصی موبایل -->
    <div id="mobile-error-msg" class="auth-message error" style="display:none; text-align: right; margin-bottom: 10px;"></div>

    <button type="submit" class="button button--flex auth-btn">
        دریافت کد تایید
        <i class="ri-arrow-left-line button__icon"></i>
    </button>
</form>


            <!-- فرم کد تایید (مرحله ۲) - پیش‌فرض مخفی است -->
            <form id="auth-step-2" class="auth-form" style="display: none;">
                <div class="form-group">
                    <label>کد تایید پیامک شده</label>
                    <!-- کانتینر ورودی‌های ۶ رقمی (LTR باشد تا ترتیب اعداد درست بماند) -->
                    <div class="otp-group" dir="ltr">
                    <input type="text" class="otp-input" maxlength="1" inputmode="numeric" pattern="[0-9]*">
                    <input type="text" class="otp-input" maxlength="1" inputmode="numeric" pattern="[0-9]*">
                    <input type="text" class="otp-input" maxlength="1" inputmode="numeric" pattern="[0-9]*">
                    <input type="text" class="otp-input" maxlength="1" inputmode="numeric" pattern="[0-9]*">
                    <input type="text" class="otp-input" maxlength="1" inputmode="numeric" pattern="[0-9]*">
                    <input type="text" class="otp-input" maxlength="1" inputmode="numeric" pattern="[0-9]*">
                    </div>
                    <!-- اینپوت مخفی برای ارسال نهایی مقدار یکپارچه -->
                    <input type="hidden" id="final-otp" name="otp">
                </div>
                
                <!-- محل نمایش پیام‌های خطا یا موفقیت -->
                <div id="auth-message" class="auth-message"></div>
                
                <!-- بخش تایمر و ارسال مجدد -->
                <div class="timer-box">
                    <span id="timer-text">
                        زمان باقی‌مانده: <span id="countdown">02:00</span>
                    </span>
                    <!-- دکمه ارسال مجدد (ابتدا مخفی است) -->
                    <button type="button" id="resend-otp" class="link-btn" style="display: none;">
                        ارسال مجدد کد
                    </button>
                </div>

                <button type="submit" class="button button--flex auth-btn">
                    ورود به حساب
                    <i class="ri-login-box-line button__icon"></i>
                </button>
                
                <button type="button" id="edit-mobile" class="link-btn">
                    اصلاح شماره موبایل
                </button>
            </form>

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

<?php get_footer(); ?>
