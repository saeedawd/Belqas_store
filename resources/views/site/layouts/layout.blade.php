<!DOCTYPE html>
<html lang="ar">
<head>
    @include('site.layouts.head') {{-- استدعاء ملف head --}}
</head>

<body class="animsition">

    {{-- الهيدر الثابت --}}
    @include('site.layouts.header')

    {{-- محتوى الصفحة --}}
    @yield('content')

    {{-- الفوتر --}}
    @include('site.layouts.footer')

    {{-- زر الرجوع للأعلى --}}
    <div class="btn-back-to-top bg0-hov" id="myBtn">
        <span class="symbol-btn-back-to-top">
            <i class="fa fa-angle-double-up" aria-hidden="true"></i>
        </span>
    </div>

    {{-- إضافات أخرى للصفحات إن وجدت --}}
    <div id="dropDownSelect1"></div>
    <div id="dropDownSelect2"></div>

    {{-- ملفات الـ JS --}}
    @include('site.layouts.js')

</body>
</html>
