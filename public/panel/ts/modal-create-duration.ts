document.addEventListener('DOMContentLoaded', () => {

    /** ---------- MODAL CREATE DURATION ---------- **/
    const modal = document.getElementById('createModal') as HTMLElement;
    const openBtn = document.getElementById('openModalBtn') as HTMLButtonElement;
    const closeBtn = document.getElementById('closeModalBtn') as HTMLSpanElement;
    const form = document.getElementById('createForm') as HTMLFormElement;

    const csrfToken = getCsrfToken();

    // باز و بسته کردن مودال
    openBtn.addEventListener('click', () => modal.style.display = 'block');
    closeBtn.addEventListener('click', () => modal.style.display = 'none');
    window.addEventListener('click', (e) => {
        if (e.target === modal) modal.style.display = 'none';
    });

    // Submit فرم
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
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

                // اضافه کردن ردیف به جدول
                const tbody = document.querySelector('table tbody');
                if (tbody) {
                    const newRow = document.createElement('tr');
                    newRow.setAttribute('data-row-id', data.data.id);
                    newRow.innerHTML = `
                        <td>${tbody.children.length + 1}</td>
                        <td>${data.data.duration}</td>
                        <td>${data.data.user_id}</td>
                        <td>${data.data.created_at}</td>
                        <td>
                            <button class="deleteBtn btn btn-danger" data-id="${data.data.id}">Delete</button>
                        </td>
                    `;
                    tbody.appendChild(newRow);
                }

            } else {
                alert('❌ Failed to create duration!');
                console.error(data);
            }
        } catch (error) {
            console.error(error);
            alert('⚠️ Something went wrong!');
        }
    });

    /** ---------- DELETE DURATION ---------- **/
    const tbody = document.querySelector('table tbody');
    if (tbody) {
        tbody.addEventListener('click', async (event) => {
            const target = event.target as HTMLElement;
            if (!target || !target.classList.contains('deleteBtn')) return;

            const id = target.getAttribute('data-id');
            if (!id) return;

            if (!confirm('آیا از حذف این مورد مطمئنی؟')) return;

            try {
                const response = await fetch(`/panel/duration/delete/${id}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    },
                    credentials: 'same-origin',
                });

                const data = await response.json();

                if (data.success) {
                  
                    const row = document.querySelector(`tr[data-row-id="${id}"]`);
                    if (row) row.remove();
                } 
            } catch (error) {
                console.error(error);
                alert('⚠️ Error during delete request');
            }
        });
    }

    /** ---------- HELPER ---------- **/
    function getCsrfToken(): string {
        const tokenMeta = document.querySelector('meta[name="csrf-token"]') as HTMLMetaElement | null;
        return tokenMeta ? tokenMeta.content : '';
    }
});
