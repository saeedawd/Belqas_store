document.addEventListener("DOMContentLoaded", function () {

    // حذف منتج
    document.querySelectorAll(".form-delete-product").forEach(function (form) {
        form.addEventListener("submit", function (e) {
            e.preventDefault();
            if (!confirm("هل أنت متأكد من الحذف؟")) return;

            const url = form.getAttribute("action");
            const token = form.querySelector('input[name="_token"]').value;

            fetch(url, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": token,
                    "X-Requested-With": "XMLHttpRequest",
                    "Accept": "application/json",
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ _method: "DELETE" })
            })
                .then(res => res.json())
                .then(data => {
                    $('#dataTable').DataTable().row($(form).closest('tr')).remove().draw();
                    alert("تم حذف المنتج بنجاح");
                })
                .catch(err => {
                    console.error(err);
                    alert("حدث خطأ أثناء الحذف");
                });
        });
    });

    // إضافة منتج
    const formCreate = document.querySelector("#form-create-product");
    if (formCreate) {
        formCreate.addEventListener("submit", function (e) {
            e.preventDefault();

            const url = formCreate.getAttribute("action");
            const formData = new FormData(formCreate);

            fetch(url, {
                method: "POST",
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": formCreate.querySelector('input[name="_token"]').value
                },
                body: formData
            })
                .then(res => res.json())
                .then(data => {
                    alert("تم إضافة المنتج بنجاح");
                    window.location.href = data.redirect || "/vendor/dashboard/products";
                })
                .catch(err => {
                    console.error(err);
                    alert("حدث خطأ أثناء الإضافة");
                });
        });
    }

    // تعديل منتج
    const formEdit = document.querySelector("#form-edit-product");
    if (formEdit) {
        formEdit.addEventListener("submit", function (e) {
            e.preventDefault();

            const url = formEdit.getAttribute("action");
            const formData = new FormData(formEdit);

            fetch(url, {
                method: "POST",
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": formEdit.querySelector('input[name="_token"]').value
                },
                body: formData
            })
                .then(res => res.json())
                .then(data => {
                    alert("تم تحديث المنتج بنجاح");
                    window.location.href = data.redirect || "/vendor/dashboard/products";
                })
                .catch(err => {
                    console.error(err);
                    alert("حدث خطأ أثناء التعديل");
                });
        });
    }

});
