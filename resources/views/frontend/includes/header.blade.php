<header class="header-section">
    <div class="top-header">
        <div class="container">
            <div class="top-content">
                <a href="tel:+9660505426859" class="top-phone">
                    <i class="las la-phone-volume"></i>
                    <span class="en">{{ app('settings')->find('site-phone', '+9660505426859') }}</span>
                </a>
                <ul class="top-links">
                    <li><a href="{{ route('auth.login') }}" class="top-link"> تسجيل الدخول </a></li>
                    <li><a href="#!" class="top-link">العربية</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="header">
            <button class="menu-btn header-icon">
                <i class="las la-bars"></i>
            </button>
            <a href="#!" class="logo">
                <img src="{{ asset('assets') }}/frontend/images/logo.svg" alt="logo" class="img-contain" />
            </a>
            <div class="overlay"></div>
            <nav class="header-nav">
                <div class="nav-content">
                    <div class="nav-head">
                        <div class="nav_top-links">
                            <ul class="top-links">
                                <li><a href="{{ route('auth.login') }}" class="top-link"> تسجيل الدخول </a></li>
                                <li><a href="#!" class="top-link">العربية</a></li>
                            </ul>
                        </div>
                        <button class="close-btn">
                            <i class="las la-times"></i>
                        </button>
                    </div>
                    <ul class="header-list">
                        <li>
                            <a href="{{ route('home') }}"
                                class="{{ request()->routeIs('home') ? 'active' : '' }}">الرئيسية</a>
                        </li>
                        <li>
                            <a href="{{ route('project.index') }}"
                                class="{{ request()->routeIs('project.index') ? 'active' : '' }}">المشاريع</a>
                        </li>
                        <li>
                            <a href="{{ route('news.index') }}"
                                class="{{ request()->routeIs('news.index') ? 'active' : '' }}">التقارير</a>
                        </li>
                        <li>
                            <a href="{{ route('library.index') }}"
                                class="{{ request()->routeIs('library.index') ? 'active' : '' }}">الملفات</a>
                        </li>
                        {{-- <li>
                <a href="#!">تواصل معنا</a>
              </li> --}}
                    </ul>
                    <div class="nav-foot">
                        <a href="tel:+9660505426859" class="top-phone">
                            <i class="las la-phone-volume"></i>
                            <span class="en">{{ app('settings')->find('site-phone', '+9660505426859') }}</span>
                        </a>
                    </div>
                </div>
            </nav>
            <div class="header-tools">
                <div class="search-content">
                    <button class="header-search header-icon">
                        <i class="las la-search"></i>
                    </button>
                    <div class="search-body">
                        <div class="search-form">
                            <input type="search" placeholder="ابحث هنا" class="search-input" />
                            <button class="search-btn">
                                <i class="las la-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <a href="#!" class="header-cart header-icon">
                    <i class="las la-shopping-cart"></i>
                </a>
                <a href="{{ route('auth.login') }}" class="header-btn">تبرع الان</a>
            </div>
        </div>
    </div>
</header>
