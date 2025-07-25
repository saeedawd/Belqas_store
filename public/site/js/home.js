
    // Select2
    $(".selection-1").select2({
        minimumResultsForSearch: 20,
        dropdownParent: $('#dropDownSelect1')
    });

    $(".selection-2").select2({
        minimumResultsForSearch: 20,
        dropdownParent: $('#dropDownSelect2')
    });

    // Parallax
    $('.parallax100').parallax100();

    // SweetAlert for Cart
    $('.block2-btn-addcart').each(function() {
        var nameProduct = $(this).closest('.block2').find('.block2-name').html();
        $(this).on('click', function() {
            swal(nameProduct, "is added to cart!", "success");
        });
    });

    // SweetAlert for Wishlist
    $('.block2-btn-addwishlist').each(function() {
        var nameProduct = $(this).closest('.block2').find('.block2-name').html();
        $(this).on('click', function() {
            swal(nameProduct, "is added to wishlist!", "success");
        });
    });

    // NoUi Slider
    if (document.getElementById('filter-bar')) {
        var filterBar = document.getElementById('filter-bar');

        noUiSlider.create(filterBar, {
            start: [50, 200],
            connect: true,
            range: {
                'min': 50,
                'max': 200
            }
        });

        var skipValues = [
            document.getElementById('value-lower'),
            document.getElementById('value-upper')
        ];

        filterBar.noUiSlider.on('update', function(values, handle) {
            skipValues[handle].innerHTML = Math.round(values[handle]);
        });
    }
