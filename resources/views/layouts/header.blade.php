    <!--====== HEADER PART START ======-->

    <header class="header-area">
        <div class="navbar-area navbar-two">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg">
                            <a class="navbar-brand" href="index.html">
                                <img src="assets/images/logo.png" alt="Logo">
                            </a>

                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTwo" aria-controls="navbarTwo" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarTwo">
                                <ul class="navbar-nav m-auto">
                                  @guest
                                    <li class="nav-item active">
                                        <a class="page-scroll" href="#home">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#event">Schedules</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#team">Speakers</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#gallery">Gallery</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#pricing">Pricing</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#contact">Contact</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>

                                    @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                  @endif
                                @else
                                  <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                              @endguest
                               </ul>
                            </div>

                            <div class="navbar-btn d-none d-sm-inline-block">
                                <a class="main-btn" href="#">Get a Ticket</a>
                            </div>
                        </nav> <!-- navbar -->
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
        </div>

        <div id="home" class="header-content-area bg_cover d-flex align-items-center" style="background-image: url(assets/images/header-bg.jpg)">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div data-countdown="2020/10/01"></div>

                        <div class="header-content text-center">
                            <h2 class="header-title">25 <sup>th</sup> Designers Meetup</h2>
                            <h3 class="sub-title">25 September, 2022 in New York</h3>

                            <ul class="header-btn">
                                <li><a class="main-btn main-btn-2" href="{{ route('register') }}">Register Now</a></li>
                                <li><a class="main-btn" href="#">Learn More</a></li>
                            </ul>
                        </div>  <!-- header content -->
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
        </div> <!-- header content -->
    </header>

    <!--====== HEADER PART ENDS ======-->
