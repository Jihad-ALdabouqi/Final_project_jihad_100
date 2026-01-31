<!-- Navbar Start -->
<div class="container-fluid bg-light sticky-top p-0">
    <nav class="navbar navbar-expand-lg navbar-light p-0">
        <a href="{{ route('home') }}" class="navbar-brand me-0 d-flex align-items-center">
            <span class="logo-text" style="font-family: 'Dancing Script', cursive; font-size: 2rem; font-weight: 700; background: linear-gradient(45deg, #d4a574, #8b6f47); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; text-shadow: 2px 2px 4px rgba(0,0,0,0.1); transition: all 0.3s ease;margin-left: 15px;">
                   Luxury Salons
            </span>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse p-3" id="navbarCollapse">
            <div class="navbar-nav mx-auto">
                <a href="{{ route('home') }}" class="nav-item nav-link active">Home</a>
                <a href="#about" class="nav-item nav-link scroll-link">About</a>
                <a href="#salons" class="nav-item nav-link scroll-link">Salons</a>
                @if (Auth::check() && Auth::user()->role == 'salon_owner')
                    <a href="{{ route('salon.owner.dashboard') }}" class="nav-item nav-link">Dashboard</a>
                @endif
                <a href="#contact" class="nav-item nav-link scroll-link">Contact</a>
            </div>
            <div class="d-flex align-items-center">
                @auth
                    <div class="dropdown me-2">
                        <a class="btn btn-outline-secondary rounded-pill dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('profile.show') }}"><i class="fas fa-user me-2"></i>Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-primary me-2 rounded-pill">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-outline-primary rounded-pill">Register</a>
                @endauth
            </div>
        </div>
    </nav>
</div>
<!-- Navbar End -->

<style>
.logo-text:hover {
    transform: scale(1.05);
    letter-spacing: 2px;
}

@keyframes shine {
    0% {
        background-position: -100%;
    }
    100% {
        background-position: 200%;
    }
}

.logo-text {
    background-size: 200% auto;
    animation: shine 3s linear infinite;
}

/* تحسين تمرير الصفحة */
html {
    scroll-behavior: smooth !important;
}
</style>

{{-- JavaScript ذكي للتنقل الفوري --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    // تحديد الروابط الداخلية
    document.querySelectorAll('.scroll-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            
            // إذا كنا في نفس الصفحة (الـ home)
            if (window.location.pathname === '/' || window.location.pathname === '/home') {
                // الانتقال السلس للقسم بدون إعادة تحميل
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80, // تعويض عن الـ navbar
                        behavior: 'smooth'
                    });
                    
                    // إغلاق قائمة الجوال بعد الضغط
                    const navbarCollapse = document.getElementById('navbarCollapse');
                    if (navbarCollapse && navbarCollapse.classList.contains('show')) {
                        const bsCollapse = bootstrap.Collapse.getInstance(navbarCollapse);
                        if (bsCollapse) bsCollapse.hide();
                    }
                }
            } 
            // إذا كنا في صفحة أخرى
            else {
                // إعادة التوجيه مع الحفاظ على الرابط الصحيح
                window.location.href = '{{ route("home") }}' + targetId;
            }
        });
    });
    
    // عند الوصول من صفحة أخرى (مع وجود # في الرابط)
    if (window.location.hash) {
        setTimeout(() => {
            const targetElement = document.querySelector(window.location.hash);
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 80,
                    behavior: 'smooth'
                });
            }
        }, 100);
    }
});
</script>