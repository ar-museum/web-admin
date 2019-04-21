<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="CRM for driving school">
    <meta name="author" content="Eugen Zaharia">
    <meta name="keyword" content="CRM, driving, school">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>AR Museum - Panou administrare</title>

    <!-- Bootstrap core CSS -->
    <link href="{!! asset('/css/app.css') !!}" rel="stylesheet">
@yield('css')

<!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="{!! asset('/js/core/respond.min') !!}"></script>
    <![endif]-->
</head>

<body class="boxed-page">
<div class="container">
    <section id="container" class="">
        <!-- header start -->
        <header class="header white-bg">
            <div class="container">
                <div class="sidebar-toggle-box">
                    <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Comutator meniu"></div>
                </div>

                <!-- logo start -->
                <a href="{!! route('dashboard') !!}" class="logo"><span>AR</span>Museum</a>
                <!-- logo end -->

                <div class="top-nav">
                    <ul class="nav pull-right top-menu">
                        <li>
                            <form method="GET" action="#">
                                <input type="text" name="q" class="form-control search" placeholder="Cauta">
                            </form>
                        </li>
                        <!-- user login dropdown start -->
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA?text=fara+poza" alt="">
                                <span class="username">{!! $staff->full_name !!}</span>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu extended logout">
                                <div class="log-arrow-up"></div>
                                <li><a href="{!! route('profile') !!}"><i class=" fa fa-suitcase"></i>Profil</a></li>
                                <li><a href="{!! route('settings') !!}"><i class="fa fa-cog"></i> Setari</a></li>
                                <li><a href="{!! route('logout') !!}"><i class="fa fa-power-off"></i> Iesire</a></li>
                            </ul>
                        </li>
                        <!-- user login dropdown end -->
                    </ul>
                </div>
            </div>
        </header>
        <!-- header end -->
        <!-- sidebar start -->
        <aside>
            <div id="sidebar"  class="nav-collapse ">
                <!-- sidebar menu start -->
                <ul class="sidebar-menu" id="nav-accordion">
                    <li>
                        <a href="{!! route('dashboard') !!}" @if (in_array($route->getName(), ['dashboard', 'settings_view', 'profile'])) class="active" @endif>
                            <i class="fa fa-bar-chart-o"></i> <span>Acasa</span>
                        </a>
                    </li>
                    <li>
                        <a href="{!! route('exposition') !!}">
                            <i class="fa fa-camera-retro"></i> <span>Expozitii</span>
                        </a>
                    </li>
                    <li>
                        <a href="{!! route('exhibit') !!}">
                            <i class="fa fa-picture-o"></i> <span>Exponate</span>
                        </a>
                    </li>
                    <li>
                        <a href="{!! route('author') !!}">
                            <i class="fa fa-male"></i> <span>Autori</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-tasks"></i> <span>Categorii</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-tags"></i> <span>Etichete</span>
                        </a>
                    </li>
                    <li>
                        <a href="{!! route('media') !!}">
                            <i class="fa fa-film"></i> <span>Media</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-users"></i> <span>Activitati vizitatori</span>
                        </a>
                    </li>
                </ul>
                <!-- sidebar menu end -->
            </div>
        </aside>
        <!-- sidebar end -->
        <!-- main content start -->
        <section id="main-content">
            <section class=" wrapper">
                @yield('content')
            </section>
        </section>
        <!-- main content end -->
        <!-- footer start -->
        <footer class="site-footer">
            <div class="text-center">
                AR Museum WebAdmin &copy; 2019
                <a href="javascript:void(0);" class="go-top">
                    <i class="fa fa-angle-up"></i>
                </a>
            </div>
        </footer>
        <!-- footer end -->
    </section>
</div>

<!-- js placed at the end of the document so the pages load faster -->
<script src="{!! asset('/js/core/jquery.min.js') !!}"></script>
<script src="{!! asset('/js/core/bootstrap.min.js') !!}"></script>
<script src="{!! asset('/js/core/jquery.dcjqaccordion.2.7.min.js') !!}"></script>
<script src="{!! asset('/js/core/jquery.scrollTo.min.js') !!}"></script>
<script src="{!! asset('/js/core/jquery.nicescroll.min.js') !!}"></script>
<script src="{!! asset('/js/core/respond.min.js') !!}"></script>
<script src="{!! asset('/js/core/bootbox.min.js') !!}"></script>
<script src="{!! asset('/js/core/toastr.min.js') !!}"></script>
<script src="{!! asset('/js/core/jquery.dataTables.min.js') !!}"></script>
<script src="{!! asset('/js/core/DT_bootstrap.min.js') !!}"></script>
<script src="{!! asset('/js/main.js') !!}"></script>
<script>
    @if (request()->session()->has('success'))
    setTimeout(function() {
        toastr['success']('', '{!! request()->session()->pull('success') !!}');
    }, 800);
    @endif

    @if (request()->session()->has('error'))
    setTimeout(function() {
        toastr['error']('', '{!! request()->session()->pull('error') !!}');
    }, 800);
    @endif
</script>
@yield('js')
</body>
</html>