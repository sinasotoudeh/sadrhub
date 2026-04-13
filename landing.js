/*
Sadrhub
Author: Sina Sotoudeh
Website: sinasotoudeh.ir
github: github.com/sinasotoudeh
*/
/* ============================================ */
/* 1. INITIALIZATION & SETUP */
/* ============================================ */
document.addEventListener('DOMContentLoaded', () => {
    // Initialize AOS Animation Library
    AOS.init({
        duration: 800, // Animation duration in ms
        easing: 'ease-in-out',
        once: true, // Whether animation should happen only once
        mirror: false,
        offset: 100, // Offset (in px) from the original trigger point
    });

    // Initialize logic
    initMobileMenu();
    initHeaderScroll();
    initPricingToggle();
    initFAQ();
    initScrollTop();
    initStatsCounter();
    initActiveLink();
});

/* ============================================ */
/* 2. MOBILE MENU TOGGLE */
/* ============================================ */
const initMobileMenu = () => {
    const navMenu = document.getElementById('nav-menu'),
        navToggle = document.getElementById('nav-toggle'),
        navClose = document.getElementById('nav-close');

    // Show Menu
    if (navToggle) {
        navToggle.addEventListener('click', () => {
            navMenu.classList.add('show-menu');
        });
    }

    // Hide Menu
    if (navClose) {
        navClose.addEventListener('click', () => {
            navMenu.classList.remove('show-menu');
        });
    }

    // Close menu when a link is clicked
    const navLinks = document.querySelectorAll('.nav__link');
    navLinks.forEach(n => n.addEventListener('click', () => {
        navMenu.classList.remove('show-menu');
    }));
};

/* ============================================ */
/* 3. HEADER BACKGROUND CHANGE ON SCROLL */
/* ============================================ */
const initHeaderScroll = () => {
    const header = document.getElementById('header');

    window.addEventListener('scroll', () => {
        // Add class if scroll is greater than 50 viewport height
        if (window.scrollY >= 50) {
            header.classList.add('scroll-header');
        } else {
            header.classList.remove('scroll-header');
        }
    });
};

/* ============================================ */
/* 4. PRICING TOGGLE (MONTHLY / YEARLY) */
/* ============================================ */
const initPricingToggle = () => {
    const toggleInput = document.getElementById('billing-toggle');
    const monthlyPrices = document.querySelectorAll('.monthly-price');
    const yearlyPrices = document.querySelectorAll('.yearly-price');
    const monthlyPeriods = document.querySelectorAll('.monthly-period');
    const yearlyPeriods = document.querySelectorAll('.yearly-period');

    if (!toggleInput) return;

    toggleInput.addEventListener('change', () => {
        const isYearly = toggleInput.checked;

        if (isYearly) {
            // Show Yearly
            monthlyPrices.forEach(el => el.style.display = 'none');
            yearlyPrices.forEach(el => el.style.display = 'inline-block');
            monthlyPeriods.forEach(el => el.style.display = 'none');
            yearlyPeriods.forEach(el => el.style.display = 'inline-block');
        } else {
            // Show Monthly
            monthlyPrices.forEach(el => el.style.display = 'inline-block');
            yearlyPrices.forEach(el => el.style.display = 'none');
            monthlyPeriods.forEach(el => el.style.display = 'inline-block');
            yearlyPeriods.forEach(el => el.style.display = 'none');
        }
    });
};

/* ============================================ */
/* 5. FAQ ACCORDION */
/* ============================================ */
const initFAQ = () => {
    const faqItems = document.querySelectorAll('.faq__item');

    faqItems.forEach((item) => {
        const header = item.querySelector('.faq__question');

        header.addEventListener('click', () => {
            const isOpen = item.classList.contains('faq-open');

            // Close all other items (Optional: remove this loop to allow multiple open)
            faqItems.forEach((otherItem) => {
                closeFAQItem(otherItem);
            });

            // If it wasn't open, open it now
            if (!isOpen) {
                openFAQItem(item);
            }
        });
    });

    function openFAQItem(item) {
        const content = item.querySelector('.faq__answer');
        item.classList.add('faq-open');
        content.style.height = content.scrollHeight + 'px';
    }

    function closeFAQItem(item) {
        const content = item.querySelector('.faq__answer');
        item.classList.remove('faq-open');
        content.style.height = '0';
    }
};

/* ============================================ */
/* 6. SCROLL TO TOP BUTTON */
/* ============================================ */
const initScrollTop = () => {
    const scrollTop = document.getElementById('scroll-top');

    if (!scrollTop) return;

    window.addEventListener('scroll', () => {
        // Show button if page is scrolled down 400px
        if (window.scrollY >= 400) {
            scrollTop.classList.add('show-scroll');
        } else {
            scrollTop.classList.remove('show-scroll');
        }
    });

    scrollTop.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
};

/* ============================================ */
/* 7. SCROLL ACTIVE LINK HIGHLIGHT */
/* ============================================ */
const initActiveLink = () => {
    const sections = document.querySelectorAll('section[id]');

    window.addEventListener('scroll', () => {
        const scrollY = window.pageYOffset;

        sections.forEach(current => {
            const sectionHeight = current.offsetHeight;
            const sectionTop = current.offsetTop - 100; // Adjust offset
            const sectionId = current.getAttribute('id');
            const navLink = document.querySelector('.nav__menu a[href*=' + sectionId + ']');

            if (navLink) {
                if (scrollY > sectionTop && scrollY <= sectionTop + sectionHeight) {
                    navLink.classList.add('active-link');
                } else {
                    navLink.classList.remove('active-link');
                }
            }
        });
    });
};

/* ============================================ */
/* 8. STATS COUNTER ANIMATION */
/* ============================================ */
const initStatsCounter = () => {
    const statsSection = document.querySelector('.benefits__stats');
    const counters = document.querySelectorAll('.stat__value');
    let started = false; // Flag to ensure animation runs once

    if (!statsSection || counters.length === 0) return;

    const startCounting = () => {
        counters.forEach(counter => {
            const target = +counter.getAttribute('data-target');
            const duration = 2000; // Animation duration in ms
            const increment = target / (duration / 16); // 60fps

            const updateCount = () => {
                const c = +counter.innerText;

                if (c < target) {
                    counter.innerText = Math.ceil(c + increment);
                    requestAnimationFrame(updateCount);
                } else {
                    counter.innerText = target;
                }
            };
            updateCount();
        });
    };

    // Intersection Observer to trigger when scrolled into view
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !started) {
                startCounting();
                started = true;
            }
        });
    }, { threshold: 0.5 }); // Trigger when 50% visible

    observer.observe(statsSection);
};
document.addEventListener('DOMContentLoaded', function () {

    const featureImages = document.querySelectorAll('.feature__image img');

    featureImages.forEach(img => {

        // 1. لاجیک تعویض جایگاه (The Logic Swap)
        img.addEventListener('mouseleave', function () {
            const container = this.closest('.feature__image');
            const allImages = container.querySelectorAll('img');

            // عکس جاری (که موس از روش رفته) باید بیاد جلو
            this.classList.remove('pos-back');
            this.classList.add('pos-front');

            // بقیه عکس‌ها (در اینجا عکس دیگر) باید برن عقب
            allImages.forEach(sibling => {
                if (sibling !== this) {
                    sibling.classList.remove('pos-front');
                    sibling.classList.add('pos-back');
                }
            });
        });

        // 2. لاجیک باز کردن لایت‌باکس (کلیک)
        img.addEventListener('click', function () {
            openLightbox(this.src, this.alt);
        });
    });

    // --- توابع لایت‌باکس (بدون تغییر نسبت به قبل) ---
    const lightbox = document.getElementById('image-lightbox'); // مطمئن شوید HTML لایت باکس در فوتر است
    const lightboxImg = document.getElementById('lightbox-img');
    const closeBtn = document.querySelector('.lightbox__close');

    function openLightbox(src, alt) {
        if (!lightbox) return;
        lightbox.style.display = "block";
        lightboxImg.src = src;
        lightboxImg.alt = alt;
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        if (!lightbox) return;
        lightbox.style.display = "none";
        document.body.style.overflow = 'auto';
    }

    if (closeBtn) closeBtn.addEventListener('click', closeLightbox);

    if (lightbox) {
        lightbox.addEventListener('click', (e) => {
            if (e.target === lightbox) closeLightbox();
        });
    }

    document.addEventListener('keydown', (e) => {
        if (e.key === "Escape" && lightbox && lightbox.style.display === "block") {
            closeLightbox();
        }
    });
});
