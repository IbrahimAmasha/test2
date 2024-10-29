<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="{{ route('/') }}">
            <img src="{{ asset('images/logo.svg') }}" alt="logo" />
        </a>
        <a class="navbar-brand brand-logo-mini" href="{{ route('/') }}">
            <img src="{{ asset('images/logo-mini.svg') }}" alt="logo mini" />
        </a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
        </button>

        <ul class="navbar-nav navbar-nav-right">

            @guest
                {{-- login and register --}}
                <div class="nav-item auth-item">
                    <a href="{{ route('login') }}" class="auth-link login-btn button-12" role="button">Login</a>
                </div>
                <div class="nav-item auth-item">
                    <a href="{{ route('register') }}" class="auth-link register-btn button-12" role="button">Register</a>
                </div>
            @else
                {{-- language switch --}}
                <li class="nav-item nav-language dropdown d-none d-md-block">
                    <a class="nav-link dropdown-toggle" id="languageDropdown" href="#" data-toggle="dropdown"
                        aria-expanded="false">
                        <div class="nav-language-icon">
                            <i class="flag-icon flag-icon-{{ App::getLocale() === 'ar' ? 'sa' : 'us' }} " title="us"
                                id="us"></i>
                        </div>
                        <div class="nav-language-text">
                            <p class="mb-1 text-black">{{ App::getLocale() === 'ar' ? 'العربية' : 'English' }}</p>
                        </div>
                    </a>
                    <div class="dropdown-menu navbar-dropdown" aria-labelledby="languageDropdown">
                        <a class="dropdown-item" href="{{ route('language.switch', 'ar') }}">
                            <div class="nav-language-icon mr-2">
                                <i class="flag-icon flag-icon-sa" title="ae" id="ae"></i>
                            </div>
                            <div class="nav-language-text">
                                <p class="mb-1 text-black">Arabic</p>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('language.switch', 'en') }}">
                            <div class="nav-language-icon mr-2">
                                <i class="flag-icon flag-icon-us" title="GB" id="gb"></i>
                            </div>
                            <div class="nav-language-text">
                                <p class="mb-1 text-black">English</p>
                            </div>
                        </a>
                    </div>
                </li>


                {{-- profile --}}
                <li class="nav-item nav-profile dropdown">
                    <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown"
                        aria-expanded="false">
                        <div class="nav-profile-img">
                            @if (auth()->user()->photo)
                                <img src="{{ asset('storage/' . auth()->user()->photo) }}" alt="image">
                            @endif
                        </div>
                        <div class="nav-profile-text">
                            <p class="mb-1 text-black">{{ auth()->user()->name }}</p>
                        </div>
                    </a>
                    <div class="dropdown-menu navbar-dropdown dropdown-menu-right p-0 border-0 font-size-sm"
                        aria-labelledby="profileDropdown" data-x-placement="bottom-end">
                        <div class="p-3 text-center bg-primary">
                            <img class="img-avatar img-avatar48 img-avatar-thumb"
                                src="{{ asset('storage/' . auth()->user()->photo) }}" alt="">
                        </div>
                        <div class="p-2">
                            <h5 class="dropdown-header text-uppercase pl-2 text-dark">@lang('messages.options')</h5>

                            {{-- profile --}}
                            <a class="dropdown-item py-1 d-flex align-items-center justify-content-between"
                                href="{{ route('edit.profile') }}">
                                <span>@lang('messages.profile')</span>
                                <span class="p-0">
                                    <i class="mdi mdi-account-outline ml-1"></i>
                                </span>
                            </a>

                        </div>
                    </div>
                </li>

                {{-- logout --}}
                <div class="nav-item auth-item">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="logout-form">
                        @csrf
                        <button type="submit" class="button-12 logout-btn" role="button">@lang('messages.logout')</button>
                    </form>
                </div>
            @endguest


        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>


    </div>
</nav>
