<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ option('site_name') }}</title>
    {!! bs_favicon() !!}
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- App Styles -->
    <?php
        if (function_exists('bs_header')) {
            bs_header('index');
        }
    ?>
    @unless (function_exists('bs_header'))
        @include('common.dependencies.style', ['module' => 'index'])
    @endunless
    <style>
        .content-wrapper {
            min-height: 83%;
        }
        .splash {
            top: 0
        }
        @media (min-width: 48em) {
            .splash {
                height: 55%
            }
        }
    </style>
</head>

<body class="hold-transition {{ option('color_scheme') }} layout-top-nav">

    <div class="wrapper">

        <header class="main-header transparent">
            <nav class="navbar navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <a href="{{ option('site_url') }}" class="navbar-brand">{{ option('site_name') }}</a>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                        <ul class="nav navbar-nav" id="navbar-unordered-list">
                            <li class="active"><a href="{{ url('/') }}">{{ trans('general.index') }}</a></li>
                            <li><a href="{{ url('skinlib') }}">{{ trans('general.skinlib') }}</a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            @if (view()->exists('common.language'))
                                @include('common.language')
                            @else
                                @include('vendor.language')
                            @endif

                            @if (!is_null($user))
                            <!-- User Account Menu -->
                                @if (view()->exists('common.user-menu'))
                                    @include('common.user-menu')
                                @else
                                <li class="dropdown user user-menu">
                                    <!-- Menu Toggle Button -->
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <!-- The user image in the navbar-->
                                        <img src="{{ avatar($user, 25) }}" class="user-image" alt="User Image">
                                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                        <span class="hidden-xs nickname">{{ bs_nickname($user) }}</span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <!-- The user image in the menu -->
                                        <li class="user-header">
                                            <img src="{{ avatar($user, 128) }}" alt="User Image">
                                            <p>{{ $user->email }}</p>
                                        </li>
                                        <!-- Menu Footer-->
                                        <li class="user-footer">
                                            <div class="pull-left">
                                                <a href="{{ url('user') }}" class="btn btn-default btn-flat">{{ trans('general.user-center') }}</a>
                                            </div>
                                            <div class="pull-right">
                                                <a href="javascript:logout();" class="btn btn-default btn-flat">{{ trans('general.logout') }}</a>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                @endif
                            @else {{-- Anonymous User --}}
                            <!-- User Account Menu -->
                            <li class="dropdown user user-menu">
                                <a href="{{ url('auth/login') }}" class="btn btn-login">{{ trans('general.login') }}</a>
                            </li>
                            @endif
                        </ul>
                    </div><!-- /.navbar-custom-menu -->
                </div><!-- /.container-fluid -->
            </nav>
        </header>

        <!-- Full Width Column -->
        <div class="content-wrapper">
            <div class="container">
                <div class="splash">
                    <h1 class="splash-head">{{ option('site_name') }}</h1>
                    <p class="splash-subhead">
                        {{ option('site_description') }}
                    </p>
                    <p>
                        @if (is_null($user))
                            @if (option('user_can_register'))
                            <a href="{{ url('auth/register') }}" id="btn-register" class="button">{{ trans('general.register') }}</a>
                            @else
                            <a href="{{ url('auth/login') }}" id="btn-close-register" class="button">{{ trans('general.login') }}</a>
                            @endif
                        @else
                        <a href="{{ url('user') }}" class="button">{{ trans('general.user-center') }}</a>
                        @endif
                    </p>
                </div>
            </div>
        </div><!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <div class="container text-center" id="copyright-text">
                  {!! bs_copyright() !!}
            </div>
            @if (option('website_approve'))
            <div class="container text-center" id="website_approve">     
                <a class="hidden-xs" href="http://www.miitbeian.gov.cn/" target="_blank">
                    {{ option('website_approve') }}
                </a>
            </div>
            @endif
        </footer>

    </div><!-- ./wrapper -->

    <!-- App Scripts -->
    <?php
        if (function_exists('bs_footer')) {
            bs_footer();
        }
    ?>
    @unless (function_exists('bs_footer'))
        @include('common.dependencies.script')
    @endunless

    <!-- Quick fix for logging out at homepage when installed to a subdir -->
    <script>base_url = ".";</script>
</body>
</html>
