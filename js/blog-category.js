/*
Sadrhub
Author: Sina Sotoudeh
Website: sinasotoudeh.ir
github: github.com/sinasotoudeh
*/
/* ========================================
 * CUTTLAS BLOG HERO - FINAL FIXED VERSION
 * ======================================== */
document.addEventListener('DOMContentLoaded', function () {

    // 1. انتخاب المنت‌ها بر اساس کلاس‌های موجود در PHP
    const navItems = document.querySelectorAll('.cuttlas-nav-item');
    const mainItems = document.querySelectorAll('.cuttlas-main-item');
    const heroContainer = document.querySelector('.cuttlas-blog-hero-container');

    // اگر المنت‌ها پیدا نشدند، اجرا نکن (جلوگیری از ارور)
    if (navItems.length === 0 || mainItems.length === 0) return;

    let currentIndex = 0;
    let autoRotateTimer;
    let progressTimer;
    const duration = 5000; // زمان چرخش: 5 ثانیه
    const step = 50; // سرعت آپدیت پراگرس بار (میلی ثانیه)

    // 2. تابع تغییر اسلاید
    function switchSlide(index) {
        // جلوگیری از ایندکس نامعتبر
        if (index >= navItems.length) index = 0;
        if (index < 0) index = navItems.length - 1;

        // ریست کردن کلاس‌های active
        navItems.forEach(el => {
            el.classList.remove('active');
            // ریست کردن عرض نوار پیشرفت
            const bar = el.querySelector('.cuttlas-progress-bar');
            if (bar) bar.style.width = '0%';
        });

        mainItems.forEach(el => el.classList.remove('active'));

        // فعال کردن آیتم جدید
        navItems[index].classList.add('active');
        mainItems[index].classList.add('active');

        // اسکرول نرم سایدبار در موبایل اگر آیتم خارج از کادر بود
        navItems[index].scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });

        currentIndex = index;

        // ریست کردن تایمرها
        resetTimers();
    }

    // 3. مدیریت تایمر و نوار پیشرفت (Progress Bar)
    function startAutoRotate() {
        let currentProgress = 0;
        const activeNav = navItems[currentIndex];
        const progressBar = activeNav.querySelector('.cuttlas-progress-bar');

        // تایمر اصلی برای تغییر اسلاید
        autoRotateTimer = setTimeout(() => {
            switchSlide(currentIndex + 1);
        }, duration);

        // تایمر برای انیمیشن نوار پرشونده
        if (progressBar) {
            clearInterval(progressTimer); // اطمینان از پاک شدن تایمر قبلی
            progressTimer = setInterval(() => {
                currentProgress += (step / duration) * 100;
                progressBar.style.width = Math.min(currentProgress, 100) + '%';

                if (currentProgress >= 100) clearInterval(progressTimer);
            }, step);
        }
    }

    function resetTimers() {
        clearTimeout(autoRotateTimer);
        clearInterval(progressTimer);
        // سریعا نوارهای پیشرفت را صفر کن
        document.querySelectorAll('.cuttlas-progress-bar').forEach(bar => bar.style.width = '0');

        startAutoRotate();
    }

    function stopAutoRotate() {
        clearTimeout(autoRotateTimer);
        clearInterval(progressTimer);
        // نوار فعلی را فریز کن یا صفر کن (اینجا صفر می‌کنیم)
        const activeBar = navItems[currentIndex].querySelector('.cuttlas-progress-bar');
        if (activeBar) activeBar.style.width = '0%';
    }

    // 4. رویدادهای کلیک (Click Events)
    navItems.forEach((item, index) => {
        item.addEventListener('click', function () {
            // اگر روی آیتم فعلی کلیک شد کاری نکن
            if (currentIndex === index) return;
            switchSlide(index);
        });
    });

    // 5. توقف چرخش وقتی موس روی هیرو است
    if (heroContainer) {
        heroContainer.addEventListener('mouseenter', stopAutoRotate);
        heroContainer.addEventListener('mouseleave', startAutoRotate);
    }

    // 6. شروع اولیه
    startAutoRotate();
});
