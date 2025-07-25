<!-- Core Libraries -->
<script src="{{ asset('site/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('site/vendor/animsition/js/animsition.min.js') }}"></script>
<script src="{{ asset('site/vendor/bootstrap/js/popper.js') }}"></script>
<script src="{{ asset('site/vendor/bootstrap/js/bootstrap.min.js') }}"></script>

<!-- Plugins -->
<script src="{{ asset('site/vendor/select2/select2.min.js') }}"></script>
<script src="{{ asset('site/vendor/noui/nouislider.min.js') }}"></script>
<script src="{{ asset('site/vendor/daterangepicker/moment.min.js') }}"></script>
<script src="{{ asset('site/vendor/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('site/vendor/slick/slick.min.js') }}"></script>
<script src="{{ asset('site/js/slick-custom.js') }}"></script>
<script src="{{ asset('site/vendor/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('site/vendor/countdowntime/countdowntime.js') }}"></script>
<script src="{{ asset('site/vendor/lightbox2/js/lightbox.min.js') }}"></script>
<script src="{{ asset('site/vendor/parallax100/parallax100.js') }}"></script>

<!-- Main Script -->
<script src="{{ asset('site/js/main.js') }}"></script>
<script src="{{ asset('site/js/home.js') }}"></script>

<!-- Yield for page-specific scripts -->
@yield('custom-js')
