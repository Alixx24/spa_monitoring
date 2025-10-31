document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('createRequestModal') as HTMLElement;
    const openBtn = document.getElementById('openModalRequestBtn') as HTMLButtonElement;
    const closeBtn = document.getElementById('closeModalBtn') as HTMLSpanElement;
    const form = document.getElementById('createForm') as HTMLFormElement;

    const csrfToken = getCsrfToken();

    // باز و بسته کردن مودال
    if (openBtn && closeBtn && modal) {
        openBtn.addEventListener('click', () => modal.style.display = 'block');
        closeBtn.addEventListener('click', () => modal.style.display = 'none');
    }

    // هندل کردن ارسال فرم
    if (form) {
        form.addEventListener('submit', async (e) => {
            e.preventDefault(); // جلوگیری از رفرش شدن صفحه
            const formData = new FormData(form);

            try {
                const response = await fetch(form.getAttribute('action') || '', {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': csrfToken },
                    body: formData,
                    credentials: 'same-origin',
                });

                const data = await response.json();

                if (data.success && data.data) {
                    modal.style.display = 'none';
                    form.reset();

                    // اضافه کردن ردیف جدید به جدول
                    const tbody = document.querySelector('table tbody');
                    if (tbody) {
                        const newRow = document.createElement('tr');
                        newRow.setAttribute('data-row-id', data.data.id);
                        newRow.innerHTML = `
                            <td>${tbody.children.length + 1}</td>
                            <td>${data.data.url}</td>
                            <td>${data.data.email}</td>
                            <td>${data.data.name}</td>
                            <td>${data.data.duration}</td>
                            <td>${data.data.created_at}</td>
                            <td>
                                <button class="deleteBtn btn btn-danger" data-id="${data.data.id}">Delete</button>
                            </td>
                        `;
                        tbody.appendChild(newRow);
                    }
                } else {
                    alert('❌ Failed to create request!');
                    console.error(data);
                }
            } catch (error) {
                console.error(error);
                alert('⚠️ Something went wrong!');
            }
        });
    }
});

function getCsrfToken(): string {
    const tokenMeta = document.querySelector('meta[name="csrf-token"]') as HTMLMetaElement | null;
    return tokenMeta ? tokenMeta.content : '';
}
