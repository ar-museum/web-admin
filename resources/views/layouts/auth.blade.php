<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="-">
    <meta name="author" content="Eugen Zaharia">
    <meta name="keyword" content="museum, ar">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>AR Museum - Autentificare</title>

    <!-- Bootstrap core CSS -->
    <link href="{!! asset('/css/app.css') !!}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="{!! asset('/js/core/respond.min') !!}"></script>
    <![endif]-->
</head>

<body class="login-body">
<div class="container">
    @yield('content')
</div>

<!-- js placed at the end of the document so the pages load faster -->
<script src="{!! asset('/js/core/jquery.min.js') !!}"></script>
<script src="{!! asset('/js/core/bootstrap.min.js') !!}"></script>
<script src="{!! asset('/js/core/toastr.js') !!}"></script>
@yield('js')
</body>
</html>