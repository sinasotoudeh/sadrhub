<?php
/*
Template Name: صفحه ساخت فروشگاه
Sadrhub
Author: Sina Sotoudeh
Website: sinasotoudeh.ir
github: github.com/sinasotoudeh
*/

if ( !sadrhub_is_api_logged_in() ) {
    wp_redirect( home_url('/register/') );
    exit;
}

get_header(); 
?>

<style>
    .hero {
        min-height: 100vh;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        padding-top: 80px;
    }
    .create-container {
        width: 100%;
        max-width: 700px;
        background: #fff;
        border-radius: 1.5rem;
        padding: 2.5rem;
        box-shadow: 0 10px 40px rgba(0,0,0,0.08);
        position: relative;
        z-index: 2;
        margin: 20px;
        min-height: 600px; /* تغییر ارتفاع به min-height برای انعطاف پذیری مرحله 2 */
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .step-content { display: none; animation: fadeIn 0.4s ease-out; }
    .step-content.active { display: block; }

    /* --- Grid دسته بندی (مرحله 1) --- */
    .categories-grid { 
        display: grid; 
        grid-template-columns: repeat(2, 1fr); 
        gap: 0.75rem; 
        margin-top: 1.5rem; 
    }
    .cat-card { 
        border: 2px solid #f1f5f9; 
        border-radius: 12px; 
        padding: 0.8rem; 
        text-align: center; 
        cursor: pointer; 
        transition: 0.2s; 
        font-size: 0.9rem;
        font-weight: 500;
        background: #fff;
    }
    .cat-card:last-child { grid-column: span 2; }
    .cat-card:hover { border-color: var(--first-color-light); background: #f8fafc; }
    .cat-card.selected { border-color: var(--first-color); background: var(--first-color-lighten); color: var(--first-color); font-weight: bold; box-shadow: 0 4px 12px rgba(99, 102, 241, 0.15); }

    /* --- Grid پلتفرم‌ها (مرحله 2 جدید) --- */
    .platform-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 0.75rem;
        margin-top: 1rem;
    }
    .platform-card {
        border: 2px solid #f1f5f9;
        border-radius: 12px;
        padding: 0.8rem;
        cursor: pointer;
        transition: 0.2s;
        background: #fff;
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }
    .platform-card:hover { border-color: #cbd5e1; }
    /* حالت انتخاب شده */
    .platform-card.selected {
        border-color: var(--first-color);
        background: #fdfdfd;
    }
    .platform-card.selected::after {
        content: '✔';
        position: absolute;
        top: 8px;
        left: 8px; /* سمت چپ چون فارسی است */
        font-size: 0.8rem;
        color: var(--first-color);
        font-weight: bold;
    }
    /* استایل اینپوت داخل کارت */
    .platform-input {
        width: 100%;
        margin-top: 10px;
        padding: 8px;
        border: 1px solid #cbd5e1;
        border-radius: 6px;
        font-size: 0.85rem;
        display: none; /* پیش فرض مخفی */
    }
    .platform-card.selected .platform-input {
        display: block; /* نمایش وقتی انتخاب شد */
        animation: fadeIn 0.3s;
    }
    .platform-card:last-child { grid-column: span 2; }


    /* --- فرم‌ها --- */
    .create-form-group { margin-bottom: 1.5rem; }
    .create-form-group label { display: block; margin-bottom: 0.6rem; font-weight: 600; font-size: 0.95rem; color: var(--title-color); }
    .create-form-group input { width: 100%; padding: 14px; border: 2px solid #e2e8f0; border-radius: 10px; font-family: inherit; transition: 0.3s; }
    .create-form-group input:focus { border-color: var(--first-color); background: #fff; }
    
    /* --- بخش دامنه --- */
    .domain-input-wrapper { 
        display: flex; align-items: center; direction: ltr; 
        border: 2px solid #e2e8f0; border-radius: 10px; padding: 0 15px; 
        background: #fff; transition: 0.3s;
    }
    .domain-input-wrapper:focus-within { border-color: var(--first-color); }
    .domain-input-wrapper input { 
        border: none !important; background: transparent !important; flex: 1; 
        text-align: left; outline: none; padding: 12px 0;
        font-weight: 600; font-family: sans-serif; color: var(--title-color);
    }
    .domain-suffix { color: var(--first-color); font-weight: 700; padding-left: 10px; user-select: none; font-size: 1rem; letter-spacing: 0.5px; }
    .validation-msg { font-size: 0.85rem; margin-top: 8px; min-height: 24px; font-weight: 500;}
    .text-success { color: #10b981 !important; }
    .text-error { color: #ef4444 !important; }

    /* --- دکمه‌ها --- */
    .actions { margin-top: 2.5rem; display: flex; justify-content: space-between; align-items: center;}
    button:disabled { background-color: #cbd5e1 !important; color: #64748b !important; cursor: not-allowed !important; transform: none !important; box-shadow: none !important; border-color: transparent !important; }

    /* --- لودینگ --- */
    .loading-screen { display: none; position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255,255,255,0.98); z-index: 10; flex-direction: column; justify-content: center; align-items: center; border-radius: 1.5rem; text-align: center;}
    .spinner { width: 50px; height: 50px; border: 4px solid #f1f5f9; border-top: 4px solid var(--first-color); border-radius: 50%; animation: spin 1s linear infinite; margin-bottom: 1.5rem; }
    @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
</style>

<section class="hero" id="home">
    <div class="create-container">
        
        <!-- لودینگ نهایی -->
        <div class="loading-screen" id="final-loading">
            <div class="loading-content-wrapper">
                <div class="speech-bubble">
                    <div class="typing-indicator"><span></span><span></span><span></span></div>
                    <p id="loading-text">در حال آماده‌سازی محیط فروشگاه شما...</p>
                </div>
                <lottie-player id="lottie-anim-player" src="https://sadrhub.com/wp-content/uploads/2026/02/1-server.json" background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay></lottie-player>
                <div class="loading-progress-container">
                    <div class="loading-progress-bar" id="final-progress-bar"></div>
                </div>
                <p class="progress-percentage" id="progress-percent">0%</p>
            </div>
        </div>

        <!-- هدر مراحل -->
        <div style="margin-bottom: 2.5rem;">
            <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 10px;">
                <h2 id="step-title" style="font-size: 1.25rem; margin: 0;">انتخاب زمینه کاری فروشگاه</h2>
                <span style="font-size: 0.85rem; color: #94a3b8;">مرحله <span id="step-number">1</span> از 4</span>
            </div>
            <div style="height: 6px; background: #f1f5f9; border-radius: 10px; overflow: hidden;">
                <!-- عرض پیش فرض 25% برای مرحله 1 -->
                <div id="progress-bar" style="height: 100%; width: 25%; background: var(--first-color); border-radius: 10px; transition: 0.4s cubic-bezier(0.4, 0, 0.2, 1);"></div>
            </div>
        </div>

        <form id="create-store-form" autocomplete="off">
            
            <!-- مرحله ۱: انتخاب زمینه کاری -->
            <div class="step-content active" id="step-1">
                <div class="categories-grid">
                    <?php 
                    $cats = [
                        'digital' => 'لوازم دیجیتال',
                        'beauty'  => 'زیبایی و سلامت',
                        'home'    => 'خانه و آشپزخانه',
                        'fashion' => 'مد و پوشاک',
                        'other'   => 'سایر'
                    ];
                    foreach($cats as $slug => $label): ?>
                        <div class="cat-card" onclick="selectCategory(this, '<?php echo $slug; ?>')">
                            <?php echo $label; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <input type="hidden" name="template" id="selected-template" required>
                
                <div class="actions" style="justify-content: flex-end;">
                    <button type="button" class="btn btn--primary" id="btn-step-1" disabled onclick="nextStep(2)">
                        مرحله بعد <i class="ri-arrow-left-s-line"></i>
                    </button>
                </div>
            </div>

            <!-- مرحله ۲ جدید: مشخصات سایت یا شاپ قبلی -->
            <div class="step-content" id="step-2">
                <h4 style="font-size: 1rem; color: var(--title-color); margin-bottom: 1rem;">در حال حاضر محصولات خود را به چه طریقی معرفی کرده و می‌فروشید؟</h4>
                <div class="platform-grid">
                    <!-- گزینه 1: فروشگاه حضوری (بدون اینپوت) -->
                    <div class="platform-card" onclick="togglePlatform(this)">
                        <span>فروشگاه حضوری</span>
                    </div>

                    <!-- گزینه 2: وب‌سایت (اینپوت دار) -->
                    <div class="platform-card" onclick="togglePlatform(this)">
                        <span>وب‌سایت</span>
                        <input type="text" class="platform-input" id="inp_website" name="prev_website" placeholder="آدرس سایت قبلی (مثال: example.com)" onclick="event.stopPropagation()">
                        <div class="validation-msg" style="color: red; font-size: 12px; margin-top: 5px; display: none;"></div>
                    </div>

                    <!-- گزینه 3: اینستاگرام (اینپوت دار) -->
                    <div class="platform-card" onclick="togglePlatform(this)">
                        <span>اینستاگرام</span>
                        <input type="text" class="platform-input" id="inp_instagram" name="instagram_id" placeholder="آی دی صفحه اینستاگرام (مثال: my_shop_id)" onclick="event.stopPropagation()">
                        <div class="validation-msg" style="color: red; font-size: 12px; margin-top: 5px; display: none;"></div>
                    </div>

                    <!-- گزینه 4: کانال تلگرام (اینپوت دار) -->
                    <div class="platform-card" onclick="togglePlatform(this)">
                        <span>کانال تلگرام</span>
                        <input type="text" class="platform-input" id="inp_telegram" name="telegram_channel" placeholder="آدرس کانال (مثال: t.me/myshop)" onclick="event.stopPropagation()">
                        <div class="validation-msg" style="color: red; font-size: 12px; margin-top: 5px; display: none;"></div>

                    </div>

                    <!-- گزینه 5: واتس‌اپ (بدون اینپوت) -->
                    <div class="platform-card" onclick="togglePlatform(this)">
                        <span>واتس‌اپ</span>
                    </div>

                    <!-- گزینه 6: فروشنده در دیوار (بدون اینپوت) -->
                    <div class="platform-card" onclick="togglePlatform(this)">
                        <span>فروشنده در دیوار</span>
                    </div>

                    <!-- گزینه 7: فروشنده در دیجی‌کالا (اینپوت دار) -->
                    <div class="platform-card" onclick="togglePlatform(this)">
                        <span>فروشنده در دیجی‌کالا</span>
                        <input type="text" class="platform-input" id="inp_digikala" name="digikala_link" placeholder="لینک فروشنده در دیجی کالا" onclick="event.stopPropagation()">
                        <div class="validation-msg" style="color: red; font-size: 12px; margin-top: 5px; display: none;"></div>
                    </div>

                    <!-- گزینه 8: غرفه در باسلام (اینپوت دار) -->
                    <div class="platform-card" onclick="togglePlatform(this)">
                        <span>غرفه در باسلام</span>
                        <input type="text" class="platform-input" id="inp_basalam" name="basalam_link" placeholder="لینک فروشنده در باسلام" onclick="event.stopPropagation()">
                        <div class="validation-msg" style="color: red; font-size: 12px; margin-top: 5px; display: none;"></div>

                    </div>

                    <!-- گزینه 9: سایر (بدون اینپوت) -->
                    <div class="platform-card" onclick="togglePlatform(this)">
                        <span>سایر</span>
                    </div>
                </div>

                <div class="actions">
                    <button type="button" class="btn btn--secondary" onclick="nextStep(1)">بازگشت</button>
                    <!-- دکمه مرحله بعد همیشه فعال است مگر اینکه اعتبارسنجی شکست بخورد -->
                    <button type="button" class="btn btn--primary" onclick="nextStep(3)">
                        مرحله بعد <i class="ri-arrow-left-s-line"></i>
                    </button>
                </div>
            </div>

            <!-- مرحله ۳ (قبلاً مرحله ۲): مشخصات فردی -->
            <div class="step-content" id="step-3">
                <div class="create-form-group">
                    <label for="first_name">نام</label>
                    <input type="text" name="first_name" id="first_name" required placeholder="مثال: علی" autocomplete="given-name">
                </div>
                <div class="create-form-group">
                    <label for="last_name">نام خانوادگی</label>
                    <input type="text" name="last_name" id="last_name" required placeholder="مثال: علوی" autocomplete="family-name">
                </div>

                <div class="actions">
                    <button type="button" class="btn btn--secondary" onclick="nextStep(2)">بازگشت</button>
                    <button type="button" class="btn btn--primary" id="btn-step-3" disabled onclick="nextStep(4)">
                        مرحله بعد <i class="ri-arrow-left-s-line"></i>
                    </button>
                </div>
            </div>

            <!-- مرحله ۴ (قبلاً مرحله ۳): انتخاب دامنه -->
            <div class="step-content" id="step-4">
                <div style="background: #eef2ff; padding: 1.25rem; border-radius: 12px; margin-bottom: 2rem; border: 1px solid #c7d2fe;">
                    <p style="color: #3730a3; font-weight: bold; margin-bottom: 0.5rem; font-size: 1.1rem;">
                        <span id="dynamic-name">کاربر</span> عزیز!
                    </p>
                    <p style="font-size: 0.9rem; color: #4338ca;">اطلاعات شما ثبت شد. حالا یک آدرس اینترنتی موقت برای فروشگاهت انتخاب کن.</p>
                </div>
                <div class="create-form-group">
                    <label for="shop_name">نام فروشگاه</label>
                    <input type="text" name="shop_name" id="shop_name" required placeholder="مثال: صدرشاپ" autocomplete="company">
                </div>
                <div class="create-form-group">
                    <label>آدرس موقتی فروشگاه (اجباری):</label>
                    <div class="domain-input-wrapper">
                        <input type="text" id="domain-input" placeholder="mybrandtest123" autocomplete="off" maxlength="30">
                        <span class="domain-suffix">.sadrhub.ir</span>
                    </div>
                    <div id="domain-msg" class="validation-msg"></div>
                    <p style="font-size: 0.8rem; color: #666; margin-top: 10px;">
                        در روزهای آینده با دریافت دامنه دلخواه، می توانید آدرس اصلی فروشگاه خود را مشخص کنید.
                    </p>
                </div>

                <div class="actions">
                    <button type="button" class="btn btn--secondary" onclick="nextStep(3)">بازگشت</button>
                    <button type="button" class="btn btn--primary" id="btn-submit" disabled onclick="submitStore()">
                        تایید و ساخت فروشگاه
                    </button>
                </div>
            </div>

        </form>
    </div>
    <div class="hero__bg">
        <div class="gradient-blob gradient-blob--1"></div>
        <div class="gradient-blob gradient-blob--2"></div>
        <div class="gradient-blob gradient-blob--3"></div>
        <div class="gradient-blob gradient-blob--4"></div>
    </div>
</section>

<?php get_footer(); ?>
