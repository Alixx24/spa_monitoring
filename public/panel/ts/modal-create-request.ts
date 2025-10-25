document.addEventListener('DOMContentLoaded', () => {

    const modal = document.getElementById('createRequestModal') as HTMLElement;
    const openBtn = document.getElementById('openModalRequestBtn') as HTMLButtonElement;
    const closeBtn = document.getElementById('closeModalBtn') as HTMLSpanElement;
    const form = document.getElementById('createForm') as HTMLFormElement;

    const csrfToken = getCsrfToken();

    // چک کردن وجود المان‌ها
    if (openBtn && closeBtn && modal) {
         openBtn.addEventListener('click', () => modal.style.display = 'block');
    closeBtn.addEventListener('click', () => modal.style.display = 'none');
    }

}); 

function getCsrfToken(): string {
    const tokenMeta = document.querySelector('meta[name="csrf-token"]') as HTMLMetaElement | null;
    return tokenMeta ? tokenMeta.content : '';
}


