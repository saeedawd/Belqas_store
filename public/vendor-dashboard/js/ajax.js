document.addEventListener('DOMContentLoaded', function () {
    const contentContainer = document.getElementById('products-content');

    function loadContent(url) {
        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if (!response.ok) throw new Error('Network error');
            return response.text();
        })
        .then(html => {
            contentContainer.innerHTML = html;
        })
        .catch(error => {
            contentContainer.innerHTML = `<div class="alert alert-danger">حدث خطأ أثناء تحميل البيانات</div>`;
        });
    }

    document.querySelectorAll('a[data-ajax="true"]').forEach(tab => {
        tab.addEventListener('click', function (e) {
            e.preventDefault();

            document.querySelectorAll('#product-tabs a').forEach(t => t.classList.remove('active'));
            this.classList.add('active');

            const url = this.getAttribute('href');
            history.pushState(null, '', url);
            loadContent(url);
        });
    });

    // دعم زر الرجوع
    window.addEventListener('popstate', function () {
        loadContent(location.href);
    });
});
