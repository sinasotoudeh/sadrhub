/*
Sadrhub
Author: Sina Sotoudeh
Website: sinasotoudeh.ir
github: github.com/sinasotoudeh
*/
// --- توابع عمومی (Global) را بیرون از document.ready تعریف کنید ---

// انتخاب قالب (مرحله 1)
window.selectCategory = function (element, value) {
    // چون اینجا $ ممکن است شناخته نشود، از jQuery استفاده کنید یا $ را در دسترس قرار دهید
    jQuery('.cat-card').removeClass('selected');
    jQuery(element).addClass('selected');
    jQuery('#selected-template').val(value);
    jQuery('#btn-step-1').prop('disabled', false);
};

// انتخاب پلتفرم (مرحله 2 جدید)
window.togglePlatform = function (element) {
    // تاگل کردن کلاس selected برای انتخاب چندگانه
    jQuery(element).toggleClass('selected');

    // اگر کلاسی انتخاب شد و اینپوت دارد، فوکوس کنیم (اختیاری)
    if (jQuery(element).hasClass('selected')) {
        jQuery(element).find('input').focus();
    }
};

// --- شروع کد اصلی ---
jQuery(document).ready(function ($) {

    // --- متغیرهای اصلی ---
    let currentStep = 1;
    let isDomainValid = false;
    let domainCheckTimeout;

    // --- متغیرهای لودینگ ---
    let loadingInterval;
    let animationInterval;
    let isStoreReady = false;
    let redirectUrl = '';

    const animSequences = [
        "https://sadrhub.com/wp-content/uploads/2026/02/1-server.json",
        "https://sadrhub.com/wp-content/uploads/2026/02/2-Developer.json",
        "https://sadrhub.com/wp-content/uploads/2026/02/3-website.json",
        "https://sadrhub.com/wp-content/uploads/2026/02/4-Web-Development.json",
        "https://sadrhub.com/wp-content/uploads/2026/02/6-final-check.json"
    ];

    const loadingMessages = [
        "در حال آماده‌سازی محیط سرور...",
        "بررسی نام دامنه و تنظیمات اولیه...",
        "در حال ساخت دیتابیس اختصاصی...",
        "بهینه‌سازی جداول محصولات...",
        "آماده سازی جهت طراحی پوسه اختصاصی...",
        "شروع کدنویسی قالب فروشگاه...",
        "طراحی هدر و فوتر اختصاصی...",
        "ایجاد صفحات اصلی وب‌سایت...",
        "بهینه‌سازی برای گوگل (SEO)...",
        "ریسپانسیو سازی برای موبایل...",
        "اتصال به درگاه‌های بانکی...",
        "پیکربندی سیستم‌های امنیتی...",
        "نصب گواهی SSL...",
        "تست سرعت و عملکرد...",
        "رفع باگ‌های احتمالی...",
        "بازبینی نهایی فروشگاه...",
        "تقریباً تمام شده است...",
        "ذخیره‌سازی تنظیمات نهایی...",
        "🚀تبریک! فروشگاه شما آماده است"
    ];

    // --- 1. توابع UI (سایر توابع که نیاز نیست عمومی باشند اینجا بمانند) ---

    // بررسی ولیدیشن نام (مرحله 3)
    window.checkStep3 = function () {
        const fname = $('#first_name').val() ? $('#first_name').val().trim() : '';
        const lname = $('#last_name').val() ? $('#last_name').val().trim() : '';
        if (fname.length > 0 && lname.length > 0) {
            $('#btn-step-3').prop('disabled', false);
        } else {
            $('#btn-step-3').prop('disabled', true);
        }
    };

    $('#first_name, #last_name').on('input change paste keyup', function () {
        checkStep3();
    });

    // مدیریت مراحل
    window.nextStep = function (step) {

        // رفتن از مرحله 1 به 2
        if (step === 2) {
            if ($('#selected-template').val() === '') return;
        }

        // رفتن از مرحله 2 به 3 (ولیدیشن پیشرفته)
        if (step === 3) {
            let isValidStep2 = true;

            // ریست کردن استایل‌های خطا قبل از بررسی جدید
            $('.platform-card.selected').find('input').css('border-color', '#cbd5e1');
            $('.platform-card.selected').find('.validation-msg').hide().text('');

            $('.platform-card.selected').each(function () {
                const input = $(this).find('input');

                // اگر کارتی اینپوت داشت وارد بررسی شود
                if (input.length > 0) {
                    const val = input.val().trim();
                    const inputId = input.attr('id');
                    // پیدا کردن باکس خطا در زیر همین اینپوت
                    const errorBox = $(this).find('.validation-msg');

                    // 1. بررسی خالی بودن
                    if (val === '') {
                        isValidStep2 = false;
                        input.css('border-color', 'red');
                        if (errorBox.length) errorBox.text('این فیلد نمی‌تواند خالی باشد.').show();

                        // حذف خطا هنگام تایپ کردن کاربر
                        input.one('input', function () {
                            $(this).css('border-color', '#cbd5e1');
                            errorBox.hide();
                        });
                        return; // رفتن به آیتم بعدی لوپ
                    }

                    // 2. بررسی حروف فارسی (برای وب‌سایت، تلگرام و اینستاگرام)
                    // شامل حروف الفبای فارسی و عربی
                    const persianRegex = /[\u0600-\u06FF]/;
                    if (inputId === 'inp_website' || inputId === 'inp_telegram' || inputId === 'inp_instagram') {
                        if (persianRegex.test(val)) {
                            isValidStep2 = false;
                            input.css('border-color', 'red');
                            if (errorBox.length) errorBox.text('لطفاً فقط از حروف انگلیسی و اعداد استفاده کنید.').show();

                            input.one('input', function () {
                                $(this).css('border-color', '#cbd5e1');
                                errorBox.hide();
                            });
                            return;
                        }
                    }

                    // 3. بررسی فرمت وب‌سایت (داشتن نقطه)
                    if (inputId === 'inp_website') {
                        if (!val.includes('.')) {
                            isValidStep2 = false;
                            input.css('border-color', 'red');
                            if (errorBox.length) errorBox.text('آدرس وب‌سایت باید شامل نقطه (.) باشد (مثال: domain.com).').show();

                            input.one('input', function () {
                                $(this).css('border-color', '#cbd5e1');
                                errorBox.hide();
                            });
                            return;
                        }
                    }
                }
            });

            if (!isValidStep2) {
                // اینجا دیگر آلرت نمی‌دهیم چون زیر هر فیلد خطا نوشته شده است
                return;
            }
            setTimeout(function () { checkStep3(); }, 100);
        }


        // رفتن از مرحله 3 به 4
        if (step === 4) {
            const fname = $('#first_name').val().trim();
            const lname = $('#last_name').val().trim();
            if (fname === '' || lname === '') return;
            $('#dynamic-name').text(fname);
        }

        $('.step-content').removeClass('active');
        $('#step-' + step).addClass('active');
        currentStep = step;
        updateUI(step);
    };

    function updateUI(step) {
        let percent = '25%';
        let title = 'انتخاب زمینه کاری';

        if (step === 2) {
            percent = '50%';
            title = 'مشخصات سایت یا شاپ قبلی';
        }
        else if (step === 3) {
            percent = '75%';
            title = 'مشخصات فردی';
        }
        else if (step === 4) {
            percent = '100%';
            title = 'انتخاب آدرس فروشگاه';
        }

        $('#progress-bar').css('width', percent);
        $('#step-title').text(title);
        $('#step-number').text(step);
    }

    // --- 2. بررسی دامنه ---
    $('#domain-input').on('input', function () {
        const val = $(this).val().trim();
        const msgBox = $('#domain-msg');
        const submitBtn = $('#btn-submit');

        isDomainValid = false;
        submitBtn.prop('disabled', true);
        msgBox.removeClass('text-success text-error').text('');

        const regex = /^[a-zA-Z0-9]+$/;
        if (val.length < 3) return;

        if (!regex.test(val)) {
            msgBox.addClass('text-error').text('فقط حروف انگلیسی و اعداد مجاز است');
            return;
        }

        clearTimeout(domainCheckTimeout);
        msgBox.text('در حال بررسی...').css('color', '#888');

        domainCheckTimeout = setTimeout(function () {
            checkDomainAvailability(val);
        }, 500);
    });

    function checkDomainAvailability(domain) {
        $.ajax({
            url: sadrhub_create_obj.ajax_url,
            type: 'POST',
            data: {
                action: 'sadrhub_check_domain',
                security: sadrhub_create_obj.nonce,
                domain: domain
            },
            success: function (res) {
                const msgBox = $('#domain-msg');
                if (res.success) {
                    isDomainValid = true;
                    msgBox.removeClass('text-error').addClass('text-success').text('این دامنه آزاد است');
                    $('#btn-submit').prop('disabled', false);
                } else {
                    isDomainValid = false;
                    msgBox.removeClass('text-success').addClass('text-error').text(res.data);
                    $('#btn-submit').prop('disabled', true);
                }
            },
            error: function () {
                $('#domain-msg').text('خطا در ارتباط با سرور').addClass('text-error');
            }
        });
    }

    // --- 3. ثبت نهایی (Updated) ---
    window.submitStore = function () {
        if (!isDomainValid) return;

        $('#create-store-form').fadeOut(300, function () {
            $('#final-loading').css('display', 'flex').hide().fadeIn(300);
            startCreativeLoading();
        });

        const data = {
            action: 'sadrhub_create_store',
            security: sadrhub_create_obj.nonce,
            themeKey: $('#selected-template').val(),
            shopName: $('#shop_name').val(),
            domain: $('#domain-input').val(),
            first_name: $('#first_name').val(),
            last_name: $('#last_name').val(),
            prev_website: $('#inp_website').val(),
            instagram_id: $('#inp_instagram').val(),
            telegram_channel: $('#inp_telegram').val(),
            digikala_link: $('#inp_digikala').val(),
            basalam_link: $('#inp_basalam').val()
        };

        $('.platform-card:not(.selected)').find('input').val('');

        data.prev_website = $('#inp_website').val();
        data.instagram_id = $('#inp_instagram').val();
        data.telegram_channel = $('#inp_telegram').val();
        data.digikala_link = $('#inp_digikala').val();
        data.basalam_link = $('#inp_basalam').val();

        $.ajax({
            url: sadrhub_create_obj.ajax_url,
            type: 'POST',
            data: data,
            success: function (res) {
                if (res.success) {
                    isStoreReady = true;
                    redirectUrl = sadrhub_create_obj.redirect_url;
                } else {
                    stopLoadingAndShowError(res.data);
                }
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                stopLoadingAndShowError('خطای ارتباط با وردپرس (Server Error)');
            }
        });
    };

    // --- 4. انیمیشن لودینگ ---
    function startCreativeLoading() {
        const animationCount = animSequences.length;
        const timePerAnim = 8000;
        const totalDuration = animationCount * timePerAnim;
        const msgCount = loadingMessages.length;
        const intervalTime = totalDuration / msgCount;

        let currentMsgIndex = 0;
        let currentAnimIndex = 0;

        const textElement = $('#loading-text');
        const progressBar = $('#final-progress-bar');
        const percentText = $('#progress-percent');
        const lottiePlayer = document.getElementById('lottie-anim-player');

        textElement.text(loadingMessages[0]);
        if (lottiePlayer) lottiePlayer.setAttribute('src', animSequences[0]);

        animationInterval = setInterval(() => {
            currentAnimIndex++;
            if (currentAnimIndex < animationCount && lottiePlayer) {
                const newSrc = animSequences[currentAnimIndex];
                lottiePlayer.setAttribute('src', newSrc);
                if (typeof lottiePlayer.load === 'function') lottiePlayer.load(newSrc);
                if (typeof lottiePlayer.play === 'function') lottiePlayer.play();
            }
        }, timePerAnim);

        loadingInterval = setInterval(function () {
            currentMsgIndex++;
            let percent = Math.round((currentMsgIndex / msgCount) * 100);
            if (percent > 100) percent = 100;

            progressBar.css('width', percent + '%');
            percentText.text(percent + '%');

            if (currentMsgIndex < msgCount) {
                textElement.css('opacity', 0);
                setTimeout(() => {
                    textElement.text(loadingMessages[currentMsgIndex]);
                    textElement.css('opacity', 1);
                }, 200);
            } else {
                clearInterval(loadingInterval);
                clearInterval(animationInterval);
                finishLoadingSequence();
            }
        }, intervalTime);
    }

    function finishLoadingSequence() {
        const textElement = $('#loading-text');

        if (isStoreReady) {
            textElement.text("در حال انتقال به پنل مدیریت...");
            $('#final-progress-bar').css('width', '100%');
            $('#progress-percent').text('100%');
            setTimeout(function () { window.location.href = redirectUrl; }, 1000);
        } else {
            textElement.text("در انتظار تأیید نهایی سرور...");
            let checkReady = setInterval(() => {
                if (isStoreReady) {
                    clearInterval(checkReady);
                    window.location.href = redirectUrl;
                }
            }, 1000);
        }
    }

    function stopLoadingAndShowError(msg) {
        clearInterval(loadingInterval);
        clearInterval(animationInterval);
        $('#loading-text').css('color', '#ef4444').text('خطا: ' + msg);
        $('#final-progress-bar').css('background', '#ef4444');
        alert('خطا: ' + msg);
        location.reload();
    }
});
