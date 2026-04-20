document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('detail-modal');
    const deleteIdInput = document.getElementById('modal-delete-id');

    // 詳細ボタンクリックイベント
    document.querySelectorAll('.js-modal-open').forEach(button => {
        button.addEventListener('click', () => {
            const d = button.dataset;

            // JSでタグを書かず、HTML側のIDに対してテキスト（中身）だけを入れる
            // これにより「HTMLとJSの分離」が完璧になります
            document.getElementById('mdl-name').textContent     = `${d.firstName}　${d.lastName}`;
            document.getElementById('mdl-gender').textContent   = d.gender;
            document.getElementById('mdl-email').textContent    = d.email;
            document.getElementById('mdl-tel').textContent      = d.tel;
            document.getElementById('mdl-address').textContent  = d.address.replace(/^[0-9０-９-ー\s]+/, '');
            document.getElementById('mdl-building').textContent = d.building || '';
            document.getElementById('mdl-category').textContent = d.category;
            document.getElementById('mdl-detail').textContent   = d.detail;

            document.getElementById('modal-delete-id').value = d.id;

            modal.classList.add('is-show');
        });
    });

    // 閉じるボタンイベント
    document.querySelectorAll('.js-modal-close').forEach(btn => {
        btn.addEventListener('click', () => {
            modal.classList.remove('is-show');
        });
    });
});
