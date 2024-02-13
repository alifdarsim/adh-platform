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

    @vite('resources/scss/app.scss')
    @vite('resources/css/app.css')
    <link id="skin-theme" rel="stylesheet" href="/assets/css/red.css?ver=3.2.3">
</head>

<body class="nk-body bg-lighter npc-default has-sidebar ">
<div class="nk-app-root">

    @yield('content')

</div>

@include('language_modal')

<!-- JavaScript -->
<script src="/assets/js/bundle.js?ver=3.2.2"></script>
<script src="/assets/js/scripts.js?ver=3.2.2"></script>
@stack('scripts')

</body>
</html>
