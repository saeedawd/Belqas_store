<header>
    <div class="container">
        <h2>متجر بلقاس</h2>
        <div>
            @auth
                <span style="margin-left: 10px;">مرحبًا، {{ auth()->user()->name }}</span>

                <a href="{{ route('logout') }}" 
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                   style="margin-right: 10px; color: red;">
                    تسجيل خروج
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @else
                <a href="{{ route('login') }}" style="margin-right: 10px;">تسجيل دخول</a>
                <a href="{{ route('register') }}">إنشاء حساب</a>
            @endauth
        </div>
    </div>
</header>
