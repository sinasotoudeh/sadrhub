<?php
/*
Template Name: صفحه پروفایل کاربری
Sadrhub
Author: Sina Sotoudeh
Website: sinasotoudeh.ir
github: github.com/sinasotoudeh
*/
// محافظت امنیتی: فقط کاربران لاگین شده
if ( !sadrhub_is_api_logged_in() ) {
    wp_redirect( home_url('/register/') );
    exit;
}

get_header(); 
?>

<!-- در فایل: C:\xampp\htdocs\wp-content\themes\cuttlas\page-profile.php -->
<!-- این بخش <style> را جایگزین قبلی کنید -->

<style>
    body { background-color: #f8fafc; }
    
    .profile-hero {
        min-height: 100vh;
        padding-top: 100px;
        padding-bottom: 50px;
        position: relative;
    }

    .profile-container {
        width: 100%;
        max-width: 800px;
        margin: 0 auto;
        padding: 0 20px;
        position: relative;
        z-index: 2;
    }

    /* --- هدر پروفایل --- */
    .profile-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #fff;
        padding: 1.5rem 2rem;
        border-radius: 1rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.03);
        margin-bottom: 2rem;
        flex-wrap: wrap;
        gap: 15px;
    }

    .user-welcome h1 { font-size: 1.5rem; color: var(--title-color); margin-bottom: 0.2rem; }
    .user-welcome p { color: #64748b; font-size: 0.9rem; }

    .header-actions { display: flex; gap: 10px; }
    
    .btn-create-new {
        background: var(--first-color);
        color: #fff;
        padding: 0.75rem 1.5rem;
        border-radius: 10px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: 0.3s;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.25);
    }
    .btn-create-new:hover { background: var(--first-color-alt); transform: translateY(-2px); }

    /* --- لیست فروشگاه‌ها --- */
    .stores-list { display: flex; flex-direction: column; gap: 1rem; }

    /* استایل کارت فروشگاه */
    .store-card {
        background: #fff;
        border-radius: 1rem;
        padding: 1rem 2rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border: 1px solid #e2e8f0;
        transition: 0.3s;
        flex-wrap: wrap;
        gap: 15px;
    }
    .store-card:hover { box-shadow: 0 10px 30px rgba(0,0,0,0.05); border-color: #cbd5e1; }

    .store-info { flex: 1; min-width: 200px; display: flex; flex-direction: column; }
    
    /* استایل جدید برای نام فروشگاه */
    .store-name-link { 
        font-weight: 800; /* بولدتر */
        font-size: 1.25rem; /* بزرگتر */
        color: var(--title-color); 
        text-decoration: none; 
        display: inline-block;
        margin-bottom: 2px;
    }
    .store-name-link:hover { color: var(--first-color); }
    
    /* استایل جدید برای آدرس کوچک زیر نام */
    .store-sub-host {
        font-size: 0.85rem;
        color: #94a3b8; /* خاکستری کم‌رنگ */
        display: block;
        margin-bottom: 10px;
        direction: ltr;
        text-align: right; /* یا left بسته به سلیقه */
    }

    .store-meta { display: flex; align-items: center; gap: 10px; font-size: 0.85rem; }

    /* وضعیت‌ها (جدید) */
    .status-badge {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }
    .status-active { background: #dcfce7; color: #166534; /* سبز */ }
    .status-expired { background: #fee2e2; color: #991b1b; /* قرمز */ }

    /* دکمه‌های عملیات */
    .store-actions { 
    display: flex; 
    gap: 15px;            /* فاصله بین متن وضعیت و دکمه */
    align-items: center;  /* تراز عمودی وسط */
    justify-content: flex-end; /* چسبیدن به سمت چپ (در حالت RTL) */
}

    .btn-panel {
        background: #f1f5f9;
        color: #334155;
        padding: 0.7rem 1.4rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.95rem;
        transition: 0.2s;
        text-decoration: none;
        display: flex; align-items: center; gap: 6px;
        border: none;
        cursor: pointer;
    }
    .btn-panel:hover { background: #e2e8f0; color: #0f172a; }

    /* لودینگ و حالت خالی */
    .loading-list, .empty-list { text-align: center; padding: 3rem; color: #64748b; }
    
    @media (max-width: 600px) {
        .store-card { flex-direction: column; align-items: flex-start; }
        .store-actions { 
        width: 100%; 
        margin-top: 15px; 
        justify-content: space-between; /* در موبایل یکی راست یکی چپ */
        flex-direction: row; /* تاکید بر کنار هم بودن در موبایل */
    }
    .btn-panel { 
        flex: 0 0 auto; /* جلوگیری از کش آمدن دکمه */
        width: auto; 
    }        .header-actions { width: 100%; }
        .btn-create-new { flex: 1; justify-content: center; }
        .store-sub-host { text-align: right; }
    }
</style>


<section class="profile-hero">
    <div class="profile-container">
        
        <!-- هدر پروفایل -->
        <div class="profile-header">
            <div class="user-welcome">
                <h1>سلام! 👋</h1>
                <p>به داشبورد مدیریت فروشگاه‌های خود خوش آمدید.</p>
            </div>
            <div class="header-actions">
                <a href="<?php echo home_url('/create/'); ?>" class="btn-create-new">
                    <i class="ri-add-circle-line"></i> ساخت فروشگاه جدید
                </a>
            </div>
        </div>

        <!-- لیست فروشگاه‌ها -->
        <div id="stores-container">
            <!-- لودینگ اولیه -->
            <div class="loading-list">
                <div class="spinner" style="margin: 0 auto 1rem;"></div>
                <p>در حال دریافت لیست فروشگاه‌های شما...</p>
            </div>
        </div>

    </div>

    <div class="hero__bg">
        <div class="gradient-blob gradient-blob--1"></div>
        <div class="gradient-blob gradient-blob--2"></div>
        <div class="gradient-blob gradient-blob--3"></div>
        <div class="gradient-blob gradient-blob--4"></div>
    </div>
</section>

<?php get_footer(); ?>
