<!DOCTYPE html>
<html lang="en" class="js">

<head>
    <base href="./">
    <meta charset="utf-8">
    <meta name="author" content="AsiaDealHub">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
          content="Connecting Asia Through Digital Deal Matchmaking.We Made It Faster and Easier For You.">
    <meta name="keywords"
          content="B2B Matching, Carbon neutral , R&D, AI, M&A, Partnership, Procurement, Sourcing, and Cross-border">
    <meta name="author" content="Asia Deal Hub">
    <meta name="website" content="https://asiadealhub.com">
    <meta name="email" content="support@dealhub.com">
    <meta name="version" content="1.0.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="/images/favicon.png">
    <!-- Page Title  -->
    <title>AsiaDealHub Dashboard</title>
    <link href="https://ka-f.fontawesome.com/releases/v6.4.2/css/pro.min.css" rel="stylesheet">
    @stack('stylesheet')
    @vite('resources/scss/admin/app.scss')
    @vite('resources/css/app.css')
    <link id="skin-theme" rel="stylesheet" href="/assets/css/red.css?ver=3.2.3">
</head>

<body class="nk-body bg-lighter npc-general has-sidebar ">
<div class="nk-app-root">
    <div class="nk-main ">
        @include('layouts.admin.sidebar')
        <div class="nk-wrap ">
            @include('layouts.admin.header')
            <div class="nk-content ">
                <div class="container-fluid">
                    <div class="nk-content-inner">
                        <div class="nk-content-body">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.admin.footer')
        </div>
    </div>
</div>

<!-- JavaScript -->
<script src="/assets/js/bundle.js?ver=3.2.2"></script>
<script src="/assets/js/scripts.js?ver=3.2.2"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.0/moment.min.js"></script>
@stack('scripts')

<script>
    let dark_mode = localStorage.getItem('dark') || 'light';
    if (dark_mode === 'true') {
        $('.nk-body').addClass('dark-mode');
    }
</script>
</body>

</html>
