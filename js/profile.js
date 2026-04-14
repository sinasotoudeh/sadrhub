/*
Sadrhub
Author: Sina Sotoudeh
Website: sinasotoudeh.ir
github: github.com/sinasotoudeh
*/
// توابع گلوبال برای دسترسی در HTML
window.loginToPanel = function (storeUrl) {
    const phone = getCookie('sadr_user_mobile');

    if (!phone) {
        alert('شماره موبایل یافت نشد. لطفا مجدد وارد شوید.');
        return;
    }

    const url = `https://api.example.com/login?store=${encodeURIComponent(storeUrl)}&phone=${encodeURIComponent(phone)}`;

    // Opens the URL in a new tab
    window.open(url, '_blank');
};

window.getCookie = function (name) {
    const nameEQ = name + "=";
    const ca = document.cookie.split(';');

    for (let i = 0; i < ca.length; i++) {
        let c = ca[i].trim();
        if (c.indexOf(nameEQ) === 0) {
            return decodeURIComponent(c.substring(nameEQ.length));
        }
    }
    return null;
}

jQuery(document).ready(function ($) {

    // اجرای تابع دریافت لیست به محض لود شدن صفحه
    fetchUserStores();

    function fetchUserStores() {
        $.ajax({
            url: sadrhub_profile_obj.ajax_url,
            type: 'POST',
            data: {
                action: 'sadrhub_get_user_stores',
                security: sadrhub_profile_obj.nonce
            },
            success: function (res) {
                if (res.success) {
                    renderStores(res.data);
                } else {
                    $('#stores-container').html(`
                        <div class="empty-list">
                            <i class="ri-error-warning-line" style="font-size: 3rem; color: #ef4444;"></i>
                            <p>${res.data || 'خطایی رخ داد'}</p>
                            <button onclick="location.reload()" class="link-btn">تلاش مجدد</button>
                        </div>
                    `);
                }
            },
            error: function () {
                $('#stores-container').html(`
                    <div class="empty-list">
                        <p>خطا در برقراری ارتباط با سرور.</p>
                        <button onclick="location.reload()" class="link-btn">تلاش مجدد</button>
                    </div>
                `);
            }
        });
    }

    function renderStores(stores) {
        const container = $('#stores-container');

        // اگر لیستی وجود نداشت
        if (!stores || stores.length === 0) {
            container.html(`
                <div class="empty-list">
                    <i class="ri-store-2-line" style="font-size: 4rem; color: #cbd5e1;"></i>
                    <p>هنوز هیچ فروشگاهی نساخته‌اید!</p>
                    <a href="${sadrhub_profile_obj.home_url}/create/" class="btn-create-new" style="margin-top: 1rem;">
                        ساخت اولین فروشگاه
                    </a>
                </div>
            `);
            return;
        }

        let html = '<div class="stores-list">';


        stores.forEach(store => {
            // دریافت اطلاعات طبق API
            const host = store.host;
            const shopName = store.shopName || host;
            const daysLeft = parseInt(store.daysLeft) || 0;

            const fullUrl = host.startsWith('http') ? host : `https://${host}`;

            let statusBadge = '';

            // منطق وضعیت
            if (daysLeft > 0) {
                statusBadge = `<span class="status-badge status-active">${daysLeft} روز تا پایان اشتراک</span>`;
            } else {
                statusBadge = `<span class="status-badge status-expired">اشتراک فعالی ندارید</span>`;
            }

            const actionButtons = `
        <button class="btn-panel" onclick="loginToPanel('${host}')">
            ورود به پنل <i class="ri-login-box-line"></i>
        </button>
    `;

            // --- تغییر اصلی اینجاست ---
            // statusBadge از store-info حذف شد و به store-actions اضافه شد
            html += `
        <div class="store-card">
            <div class="store-info">
                <a href="${fullUrl}" target="_blank" class="store-name-link">${shopName}</a>
                <span class="store-sub-host">${host}</span>
            </div>
            
            <div class="store-actions">
                ${statusBadge} 
                ${actionButtons}
            </div>
        </div>
    `;
        });


        html += '</div>';
        container.html(html); // نمایش لیست در صفحه
    }
});
