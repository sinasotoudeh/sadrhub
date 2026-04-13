/*
Sadrhub
Author: Sina Sotoudeh
Website: sinasotoudeh.ir
github: github.com/sinasotoudeh
*/
document.addEventListener('DOMContentLoaded', function () {
    // --- ارجاعات به عناصر DOM ---
    const step1Form = document.getElementById('auth-step-1');
    const step2Form = document.getElementById('auth-step-2');
    const editMobileBtn = document.getElementById('edit-mobile');
    const msgBox = document.getElementById('auth-message'); // باکس پیام کلی پایین
    const mobileErrorMsg = document.getElementById('mobile-error-msg'); // باکس پیام خطای اختصاصی موبایل

    // عناصر مربوط به فرم موبایل جدید
    const mobileDisplay = document.getElementById('mobile-display'); // ورودی نمایشی
    const finalMobileInput = document.getElementById('final-mobile'); // ورودی مخفی نهایی
    const countryWrapper = document.querySelector('.custom-select-wrapper');
    const countryTrigger = document.getElementById('country-trigger');
    const countryOptions = document.querySelectorAll('.custom-option');
    const selectedFlag = document.getElementById('selected-flag');
    const selectedCode = document.getElementById('selected-code');
    const hiddenCodeInput = document.getElementById('country-code-input');

    // عناصر مربوط به OTP
    const otpInputs = document.querySelectorAll('.otp-input');
    const finalOtpInput = document.getElementById('final-otp');
    const timerText = document.getElementById('timer-text');
    const countdownSpan = document.getElementById('countdown');
    const resendBtn = document.getElementById('resend-otp');

    // متغیرهای وضعیت
    let userMobile = '';
    let countdownInterval;
    const OTP_TIME_LIMIT = 120; // ثانیه

    // ==========================================
    // بخش ۱: منطق دراپ‌داون و ورودی موبایل (جدید)
    // ==========================================

    if (countryTrigger) {
        // باز و بسته کردن منو
        countryTrigger.addEventListener('click', function (e) {
            e.stopPropagation();
            countryWrapper.classList.toggle('open');
        });

        // انتخاب گزینه از لیست
        countryOptions.forEach(option => {
            option.addEventListener('click', function () {
                // حذف کلاس انتخاب شده از همه
                countryOptions.forEach(opt => opt.classList.remove('selected'));
                this.classList.add('selected');

                // دریافت داده‌ها
                const flag = this.getAttribute('data-flag');
                const code = this.getAttribute('data-value');

                // بروزرسانی ظاهر
                selectedFlag.textContent = flag;
                selectedCode.textContent = code;
                hiddenCodeInput.value = code;

                // بستن منو
                countryWrapper.classList.remove('open');

                // فوکوس روی اینپوت موبایل برای راحتی کاربر
                mobileDisplay.focus();
            });
        });

        // بستن منو با کلیک بیرون
        document.addEventListener('click', function (e) {
            if (countryWrapper && !countryWrapper.contains(e.target)) {
                countryWrapper.classList.remove('open');
            }
        });
    }

    // فیلتر ورودی موبایل (فقط عدد)
    if (mobileDisplay) {
        mobileDisplay.addEventListener('input', function (e) {
            this.value = this.value.replace(/[^0-9]/g, '');
            // مخفی کردن ارور هنگام تایپ
            if (mobileErrorMsg) mobileErrorMsg.style.display = 'none';
        });
    }

    // ==========================================
    // بخش ۲: توابع کمکی AJAX و تایمر (مشابه قبل)
    // ==========================================

    async function sendRequest(action, data) {
        // چک کردن وجود آبجکت امنیتی
        if (typeof sadrhub_auth_obj === 'undefined') {
            console.error('sadrhub_auth_obj is not defined.');
            return { success: false, data: 'خطای پیکربندی اسکریپت' };
        }

        const formData = new FormData();
        formData.append('action', action);
        formData.append('security', sadrhub_auth_obj.nonce);
        for (const key in data) {
            formData.append(key, data[key]);
        }

        try {
            const response = await fetch(sadrhub_auth_obj.ajax_url, {
                method: 'POST',
                body: formData
            });
            return await response.json();
        } catch (e) {
            return { success: false, data: 'خطای ارتباط با سرور' };
        }
    }

    function startTimer(duration) {
        let timer = duration, minutes, seconds;
        if (timerText) timerText.style.display = 'inline';
        if (resendBtn) resendBtn.style.display = 'none';

        if (countdownInterval) clearInterval(countdownInterval);

        countdownInterval = setInterval(function () {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);
            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            if (countdownSpan) countdownSpan.textContent = minutes + ":" + seconds;

            if (--timer < 0) {
                clearInterval(countdownInterval);
                if (timerText) timerText.style.display = 'none';
                if (resendBtn) resendBtn.style.display = 'inline-block';
            }
        }, 1000);
    }

    // ==========================================
    // بخش ۳: مدیریت OTP Inputs (بدون تغییر عمده)
    // ==========================================
    if (otpInputs.length > 0) {
        otpInputs.forEach((input, index) => {
            input.addEventListener('input', (e) => {
                input.value = input.value.replace(/[^0-9]/g, '');
                if (input.value.length === 1 && index < otpInputs.length - 1) {
                    otpInputs[index + 1].focus();
                }
                updateFinalOtp();
            });

            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace') {
                    if (input.value === '' && index > 0) {
                        otpInputs[index - 1].focus();
                    }
                    updateFinalOtp(); // آپدیت مهم است حتی در بک‌اسپیس
                } else if (e.key === 'ArrowLeft' && index > 0) {
                    otpInputs[index - 1].focus();
                } else if (e.key === 'ArrowRight' && index < otpInputs.length - 1) {
                    otpInputs[index + 1].focus();
                }
            });

            // مدیریت Paste کردن کد
            input.addEventListener('paste', (e) => {
                e.preventDefault();
                const pasteData = (e.clipboardData || window.clipboardData).getData('text').replace(/[^0-9]/g, '');

                // پر کردن خانه‌ها
                const chars = pasteData.split('');
                otpInputs.forEach((inp, i) => {
                    if (chars[i]) inp.value = chars[i];
                });

                // فوکوس روی آخرین خانه پر شده
                const lastIndex = Math.min(chars.length, otpInputs.length) - 1;
                if (lastIndex >= 0 && otpInputs[lastIndex]) {
                    otpInputs[lastIndex].focus();
                }
                updateFinalOtp();
            });
        });
    }

    function updateFinalOtp() {
        let code = '';
        otpInputs.forEach(input => code += input.value);
        if (finalOtpInput) finalOtpInput.value = code;
    }

    // ==========================================
    // بخش ۴: سابمیت فرم‌ها (اصلاح شده)
    // ==========================================

    // --- فرم شماره موبایل (مرحله ۱) ---
    if (step1Form) {
        step1Form.addEventListener('submit', async function (e) {
            e.preventDefault();

            // 1. دریافت مقادیر
            const countryCode = hiddenCodeInput ? hiddenCodeInput.value : '+98';
            let rawNumber = mobileDisplay.value.trim();
            let finalNumber = '';

            // پاک کردن پیام‌های قبلی
            if (mobileErrorMsg) mobileErrorMsg.style.display = 'none';
            msgBox.innerText = '';
            msgBox.className = 'auth-message';

            // 2. منطق ولیدیشن (ایران vs خارجی)
            if (countryCode === '+98') {
                if (rawNumber === '') {
                    showMobileError('لطفا شماره موبایل خود را وارد کنید.');
                    return;
                }

                // نرمال‌سازی: اگر کاربر 912... زد تبدیل به 0912... شود
                if (rawNumber.length === 10 && rawNumber.startsWith('9')) {
                    rawNumber = '0' + rawNumber;
                }

                // regex دقیق ایران (شروع با 09 و 9 رقم دیگر)
                const iranRegex = /^09[0-9]{9}$/;

                if (!iranRegex.test(rawNumber)) {
                    if (rawNumber.length < 11) showMobileError('شماره موبایل باید ۱۱ رقم باشد.');
                    else if (rawNumber.length > 11) showMobileError('شماره موبایل معتبر نیست (تعداد ارقام زیاد).');
                    else if (!rawNumber.startsWith('09')) showMobileError('شماره موبایل باید با 09 شروع شود.');
                    else showMobileError('فرمت شماره موبایل صحیح نیست.');
                    return;
                }

                // فرمت نهایی برای ایران: همان شماره کامل (0912...)
                finalNumber = rawNumber;

            } else {
                // برای کشورهای خارجی
                if (rawNumber.length < 5) {
                    showMobileError('شماره وارد شده معتبر نیست.');
                    return;
                }
                // فرمت نهایی: کد کشور + شماره (مثلا +15551234)
                finalNumber = countryCode + rawNumber;
            }

            // ذخیره مقدار نهایی در متغیر گلوبال و اینپوت مخفی
            userMobile = finalNumber;
            if (finalMobileInput) finalMobileInput.value = finalNumber;

            // 3. ارسال درخواست به سرور
            msgBox.innerText = 'در حال بررسی شماره...';

            // غیرفعال کردن دکمه برای جلوگیری از کلیک مجدد
            const btn = step1Form.querySelector('button[type="submit"]');
            if (btn) btn.disabled = true;

            try {
                const result = await sendRequest('sadrhub_send_otp', { mobile: finalNumber });

                if (result.success) {
                    // موفقیت: تغییر مرحله
                    step1Form.style.display = 'none';
                    step2Form.style.display = 'block';

                    if (result.data.status === "already_sent") {
                        msgBox.innerText = 'کد قبلاً ارسال شده است.';
                        const remaining = result.data.timeLeftInSeconds || OTP_TIME_LIMIT;
                        startTimer(remaining);
                    } else {
                        msgBox.innerText = 'کد تایید پیامک شد.';
                        startTimer(OTP_TIME_LIMIT);
                    }

                    msgBox.classList.add('success');
                    // فوکوس خودکار روی اولین خانه OTP
                    setTimeout(() => { if (otpInputs[0]) otpInputs[0].focus(); }, 100);

                } else {
                    // خطای بک‌اند (مثلا محدودیت تعداد درخواست)
                    msgBox.innerText = result.data || 'خطایی در ارسال کد رخ داد.';
                    msgBox.classList.add('error');
                }
            } catch (error) {
                console.error(error);
                msgBox.innerText = 'خطای شبکه یا سرور';
                msgBox.classList.add('error');
            } finally {
                if (btn) btn.disabled = false;
            }
        });
    }

    // تابع نمایش خطای اختصاصی موبایل
    function showMobileError(text) {
        if (mobileErrorMsg) {
            mobileErrorMsg.textContent = text;
            mobileErrorMsg.style.display = 'block';
            // انیمیشن لرزش (اختیاری)
            const group = document.querySelector('.mobile-input-group');
            if (group) {
                group.style.animation = "shake 0.3s ease-in-out";
                setTimeout(() => group.style.animation = "none", 300);
            }
        } else {
            // اگر باکس اختصاصی نبود، در باکس اصلی نمایش بده
            msgBox.innerText = text;
            msgBox.classList.add('error');
        }
    }

    // --- فرم بررسی کد تایید (مرحله ۲) ---
    if (step2Form) {
        step2Form.addEventListener('submit', async function (e) {
            e.preventDefault();

            // اطمینان از اینکه مقدار نهایی OTP آپدیت شده است
            updateFinalOtp();
            const otpValue = finalOtpInput.value;

            if (otpValue.length < 6) {
                msgBox.innerText = 'لطفا کد ۶ رقمی را کامل وارد کنید';
                msgBox.classList.add('error');
                return;
            }

            msgBox.innerText = 'در حال اعتبارسنجی...';
            msgBox.className = 'auth-message';
            const btn = step2Form.querySelector('button[type="submit"]');
            if (btn) btn.disabled = true;

            try {
                const result = await sendRequest('sadrhub_verify_otp', {
                    mobile: userMobile, // شماره‌ای که در مرحله ۱ تایید شد
                    otp: otpValue
                });

                if (result.success) {
                    msgBox.innerText = 'ورود موفق! در حال انتقال...';
                    msgBox.classList.add('success');

                    // ریدایرکت نهایی
                    const target = (result.data && result.data.redirect) ? result.data.redirect : (typeof sadrhub_auth_obj !== 'undefined' ? sadrhub_auth_obj.redirect_url : '/');
                    window.location.href = target;
                } else {
                    msgBox.innerText = 'کد وارد شده اشتباه است.';
                    msgBox.classList.add('error');
                    // خالی کردن ورودی‌ها
                    otpInputs.forEach(inpt => inpt.value = '');
                    updateFinalOtp();
                    if (otpInputs[0]) otpInputs[0].focus();
                }
            } catch (error) {
                console.error(error);
                msgBox.innerText = 'خطای سرور';
                msgBox.classList.add('error');
            } finally {
                if (btn) btn.disabled = false;
            }
        });
    }

    // --- دکمه ارسال مجدد کد ---
    if (resendBtn) {
        resendBtn.addEventListener('click', async function () {
            msgBox.innerText = 'در حال ارسال مجدد...';
            msgBox.className = 'auth-message';

            try {
                const result = await sendRequest('sadrhub_send_otp', { mobile: userMobile });

                if (result.success) {
                    msgBox.innerText = 'کد جدید ارسال شد.';
                    msgBox.classList.add('success');

                    // ریست کردن اینپوت‌های کد
                    otpInputs.forEach(inpt => inpt.value = '');
                    updateFinalOtp();
                    if (otpInputs[0]) otpInputs[0].focus();

                    startTimer(OTP_TIME_LIMIT);
                } else {
                    msgBox.innerText = result.data || 'خطا در ارسال مجدد';
                    msgBox.classList.add('error');
                }
            } catch (error) {
                msgBox.innerText = 'خطای شبکه';
                msgBox.classList.add('error');
            }
        });
    }

    // --- دکمه اصلاح شماره موبایل ---
    if (editMobileBtn) {
        editMobileBtn.addEventListener('click', function () {
            // مخفی کردن مرحله ۲ و نمایش مرحله ۱
            step2Form.style.display = 'none';
            step1Form.style.display = 'block';

            // پاک کردن پیام‌ها
            msgBox.innerText = '';
            msgBox.className = 'auth-message';
            if (mobileErrorMsg) mobileErrorMsg.style.display = 'none';

            // توقف تایمر
            if (countdownInterval) clearInterval(countdownInterval);

            // فوکوس روی اینپوت موبایل برای ویرایش راحت‌تر
            if (mobileDisplay) mobileDisplay.focus();
        });
    }
});
