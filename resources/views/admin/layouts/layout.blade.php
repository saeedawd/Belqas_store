<!DOCTYPE html>
<html lang="en">
<head>
    {{-- الميتا والروابط الخاصة بالرأس --}}
    @include('vendor.layouts.partials.head')
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        {{-- الشريط الجانبي (Sidebar) --}}
        @include('vendor.layouts.partials.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                {{-- الشريط العلوي (Topbar) --}}
                @include('vendor.layouts.partials.topbar')

                {{-- محتوى الصفحة --}}
                <div class="container-fluid py-4">
                    @yield('content')
                </div>

            </div>
            <!-- End of Main Content -->

            {{-- الفوتر --}}
            @include('vendor.layouts.partials.footer')

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    {{-- زر العودة لأعلى الصفحة --}}
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    {{-- نافذة تسجيل الخروج --}}
    @include('vendor.layouts.partials.logout-modal')

    {{-- ملفات الجافاسكريبت --}}
    @include('vendor.layouts.partials.js')
</body>
</html>
