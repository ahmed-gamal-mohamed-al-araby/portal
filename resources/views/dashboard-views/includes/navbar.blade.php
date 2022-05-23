@php
$profileImage = Auth::user()->profile ? Auth::user()->profile : 'user_profile.png';
@endphp
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark navbar-success sticky-top text-sm border-bottom-0">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav   @if (app()->getLocale() == 'ar') mr-auto-navbav @else
        ml-auto @endif ">

        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <img class="profile-photo-nav" src="{{ asset('uploaded-files/users/profile/' . $profileImage) }}" alt="user profile">
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <img class="profile-photo-dropdown" src="{{ asset('uploaded-files/users/profile/' . $profileImage) }}"
                    alt="user profile">
                <p class="profile-name-dropdown"> {{ Auth::user()->username }} </p>
                <a class="dropdown-item text-center" href="{{route('change_password')}}" >
                <i
                            class="fas fa-key ml-2"></i> <span
                        class=" float-right0 text-muted text-sm">@lang('site.change_password')</span>
                </a>
                <div class="dropdown-divider"></div>

                {{-- <p class="m-2 text-center"><a href="{{ route('users.show_reset_password') }}"> <i
                            class="fas fa-key"></i> @lang('site.reset_password')</a></p> --}}
                {{-- <div class="dropdown-divider"></div>
                  <p class="m-2 text-center"><a href="{{ route('users.show_reset_password', Auth::user()->id) }}"> <i class="fas fa-image"></i> @lang('site.edit_user_profile')</a></p> --}}

                <div class="dropdown-divider"></div>

                <a class="dropdown-item text-center" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                    <i class="user-nav-icon float-right0 fas fa-sign-out-alt mr-2"></i> <span
                        class=" float-right0 text-muted text-sm">@lang('site.Logout')</span>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                <div class="dropdown-divider"></div>
            </div>

        </li>

        <!--language -->
        <li class="nav-item dropdown">
            @if (LaravelLocalization::getCurrentLocale() == 'en')
                <a class="nav-link" data-toggle="dropdown" href="#">
                    English <i class="far fa-flag"> </i>
                </a>
            @elseif(LaravelLocalization::getCurrentLocale() == 'ar')
                <a class="nav-link" data-toggle="dropdown" href="#">
                    العربية <i class="far fa-flag"></i>
                </a>
            @endif

            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                @foreach (array_reverse(LaravelLocalization::getSupportedLocales()) as $localeCode => $properties)
                    <a rel="alternate" hreflang="{{ $localeCode }}"
                        href="{{ LaravelLocalization::getLocalizedURL($localeCode) }}"
                        class="dropdown-item language-flag-container">
                        <span class=" text-muted text-sm d-block">{{ $properties['native'] }}</span>

                        <img class="language-flag d-block"
                            src="{{ asset('dist/img/flag_img/' . $localeCode . '.png') }}" />

                    </a>
                    <div class="dropdown-divider"></div>
                @endforeach
            </div>
        </li>
        {{-- <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <img class="profile-photo-nav" src="{{ asset('Images/user_profile.png') }}">
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <img class="profile-photo-dropdown" src="{{ asset('Images/user_profile.png') }}">
                <p class="profile-name-dropdown"> {{ Auth::user()->name }} </p>
                <div class="dropdown-divider"></div>


                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <i class="user-nav-icon float-right fas fa-sign-out-alt mr-2"></i> <span
                        class=" float-right text-muted text-sm"> تسجيل خروج</span>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                <div class="dropdown-divider"></div>
            </div>

        </li> --}}

        {{-- <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li> --}}
    </ul>
</nav>
