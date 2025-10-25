"use strict";
document.addEventListener('DOMContentLoaded', function () {
    var modal = document.getElementById('createRequestModal');
    var openBtn = document.getElementById('openModalRequestBtn');
    var closeBtn = document.getElementById('closeModalBtn');
    var form = document.getElementById('createForm');
    var csrfToken = getCsrfToken();
    // چک کردن وجود المان‌ها
    if (openBtn && closeBtn && modal) {
        openBtn.addEventListener('click', function () { return modal.style.display = 'block'; });
        closeBtn.addEventListener('click', function () { return modal.style.display = 'none'; });
    }
});
function getCsrfToken() {
    var tokenMeta = document.querySelector('meta[name="csrf-token"]');
    return tokenMeta ? tokenMeta.content : '';
}
