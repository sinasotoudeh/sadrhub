/*
Sadrhub
Author: Sina Sotoudeh
Website: sinasotoudeh.ir
github: github.com/sinasotoudeh
*/
document.addEventListener('DOMContentLoaded', function () {

    // --- 1. نوار پیشرفت مطالعه ---
    const progressBar = document.getElementById('cuttlas-scroll-progress');

    window.addEventListener('scroll', function () {
        const scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
        const scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        const scrolled = (scrollTop / scrollHeight) * 100;

        if (progressBar) {
            progressBar.style.width = scrolled + "%";
        }
    });

    // --- 2. تولید خودکار فهرست مطالب (TOC) ---
    const articleBody = document.getElementById('cuttlas-article-body');
    const tocList = document.getElementById('cuttlas-toc-list');
    const tocWidget = document.querySelector('.cuttlas-toc-widget');

    if (articleBody && tocList && tocWidget) {
        // پیدا کردن تمام تگ‌های h2 و h3
        const headers = articleBody.querySelectorAll('h2, h3');

        if (headers.length === 0) {
            // مخفی کردن کل ویجت اگر هدینگی نیست
            tocWidget.style.display = 'none';
        } else {
            headers.forEach((header, index) => {
                // اختصاص ID برای لینک‌دهی
                if (!header.id) {
                    header.id = 'section-' + index;
                }

                // ساخت آیتم لیست
                const li = document.createElement('li');
                const a = document.createElement('a');
                a.href = '#' + header.id;
                a.textContent = header.textContent;

                // کلاس خاص برای استایل متفاوت H3
                if (header.tagName === 'H3') {
                    a.style.paddingRight = '20px'; // تو رفتگی
                    a.style.fontSize = '0.9em';
                }

                // اسکرول نرم
                a.addEventListener('click', function (e) {
                    e.preventDefault();
                    // اکتیو کردن لینک کلیک شده
                    document.querySelectorAll('.cuttlas-toc-widget a').forEach(el => el.classList.remove('active'));
                    this.classList.add('active');

                    document.getElementById(header.id).scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                });

                li.appendChild(a);
                tocList.appendChild(li);
            });
        }

        // --- هایلایت کردن آیتم منو هنگام اسکرول ---
        window.addEventListener('scroll', function () {
            let current = '';
            headers.forEach(header => {
                const sectionTop = header.offsetTop;
                if (pageYOffset >= sectionTop - 100) {
                    current = header.getAttribute('id');
                }
            });

            document.querySelectorAll('.cuttlas-toc-widget a').forEach(a => {
                a.classList.remove('active');
                if (a.getAttribute('href').includes(current) && current !== '') {
                    a.classList.add('active');
                }
            });
        });
    }
});
