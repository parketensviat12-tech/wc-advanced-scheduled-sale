document.addEventListener('DOMContentLoaded', function () {

    const previewBtn = document.getElementById('wc-ass-preview-btn');
    const applyBtn   = document.getElementById('wc-ass-apply-btn');
    const outputDiv  = document.getElementById('wc-ass-output');

    if (!previewBtn || !applyBtn || !outputDiv) return;

    const nonce = wc_ass_vars.nonce;
    const restUrl = wc_ass_vars.rest_url + 'wc-ass/v1/preview';

    function showMessage(msg, type = 'info') {
        outputDiv.innerHTML = `<div class="${type}">${msg}</div>`;
    }

    previewBtn.addEventListener('click', function (e) {
        e.preventDefault();
        outputDiv.innerHTML = 'Зареждане...';

        const categories = Array.from(document.querySelectorAll('select[name="categories[]"]:checked')).map(el => parseInt(el.value));
        const manufacturers = Array.from(document.querySelectorAll('select[name="manufacturers[]"]:checked')).map(el => parseInt(el.value));
        const percent = parseInt(document.querySelector('input[name="percent"]').value);
        const start = document.querySelector('input[name="start"]').value;
        const end = document.querySelector('input[name="end"]').value;

        fetch(restUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-WP-Nonce': nonce
            },
            body: JSON.stringify({categories, manufacturers, percent, start, end})
        })
        .then(res => res.json())
        .then(data => {
            if (data.preview && data.preview.length > 0) {
                let html = `<p>Общо продукти: ${data.total_products}</p><table><tr><th>ID</th><th>Продукт</th><th>Редовна цена</th><th>Отстъпка</th></tr>`;
                data.preview.forEach(p => {
                    html += `<tr><td>${p.id}</td><td>${p.title}</td><td>${p.regular_price}</td><td>${p.sale_price}</td></tr>`;
                });
                html += '</table>';
                outputDiv.innerHTML = html;
            } else {
                showMessage('Няма намерени продукти за избраните критерии.', 'warning');
            }
        })
        .catch(err => {
            console.error(err);
            showMessage('Грешка при preview.', 'error');
        });
    });

    // TODO: Apply / Rollback логика, ако е нужна интерактивно
});
