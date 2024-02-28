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
<!-- app-root @e -->
<!-- select region modal -->
{{--<div class="modal fade" tabindex="-1" role="dialog" id="region">--}}
{{--    <div class="modal-dialog modal-lg" role="document">--}}
{{--        <div class="modal-content">--}}
{{--            <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>--}}
{{--            <div class="modal-body modal-body-md">--}}
{{--                <h5 class="title mb-4">Select Your Country</h5>--}}
{{--                <div class="nk-country-region">--}}
{{--                    <ul class="country-list text-center gy-2">--}}
{{--                        <li>--}}
{{--                            <a href="#" class="country-item">--}}
{{--                                <img src="./images/flags/arg.png" alt="" class="country-flag">--}}
{{--                                <span class="country-name">Argentina</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="#" class="country-item">--}}
{{--                                <img src="./images/flags/aus.png" alt="" class="country-flag">--}}
{{--                                <span class="country-name">Australia</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="#" class="country-item">--}}
{{--                                <img src="./images/flags/bangladesh.png" alt="" class="country-flag">--}}
{{--                                <span class="country-name">Bangladesh</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="#" class="country-item">--}}
{{--                                <img src="./images/flags/canada.png" alt="" class="country-flag">--}}
{{--                                <span class="country-name">Canada <small>(English)</small></span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="#" class="country-item">--}}
{{--                                <img src="./images/flags/china.png" alt="" class="country-flag">--}}
{{--                                <span class="country-name">Centrafricaine</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="#" class="country-item">--}}
{{--                                <img src="./images/flags/china.png" alt="" class="country-flag">--}}
{{--                                <span class="country-name">China</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="#" class="country-item">--}}
{{--                                <img src="./images/flags/french.png" alt="" class="country-flag">--}}
{{--                                <span class="country-name">France</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="#" class="country-item">--}}
{{--                                <img src="./images/flags/germany.png" alt="" class="country-flag">--}}
{{--                                <span class="country-name">Germany</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="#" class="country-item">--}}
{{--                                <img src="./images/flags/iran.png" alt="" class="country-flag">--}}
{{--                                <span class="country-name">Iran</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="#" class="country-item">--}}
{{--                                <img src="./images/flags/italy.png" alt="" class="country-flag">--}}
{{--                                <span class="country-name">Italy</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="#" class="country-item">--}}
{{--                                <img src="./images/flags/mexico.png" alt="" class="country-flag">--}}
{{--                                <span class="country-name">México</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="#" class="country-item">--}}
{{--                                <img src="./images/flags/philipine.png" alt="" class="country-flag">--}}
{{--                                <span class="country-name">Philippines</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="#" class="country-item">--}}
{{--                                <img src="./images/flags/portugal.png" alt="" class="country-flag">--}}
{{--                                <span class="country-name">Portugal</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="#" class="country-item">--}}
{{--                                <img src="./images/flags/s-africa.png" alt="" class="country-flag">--}}
{{--                                <span class="country-name">South Africa</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="#" class="country-item">--}}
{{--                                <img src="./images/flags/spanish.png" alt="" class="country-flag">--}}
{{--                                <span class="country-name">Spain</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="#" class="country-item">--}}
{{--                                <img src="./images/flags/switzerland.png" alt="" class="country-flag">--}}
{{--                                <span class="country-name">Switzerland</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="#" class="country-item">--}}
{{--                                <img src="./images/flags/uk.png" alt="" class="country-flag">--}}
{{--                                <span class="country-name">United Kingdom</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="#" class="country-item">--}}
{{--                                <img src="./images/flags/english.png" alt="" class="country-flag">--}}
{{--                                <span class="country-name">United State</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div><!-- .modal-content -->--}}
{{--    </div><!-- .modla-dialog -->--}}
{{--</div><!-- .modal -->--}}
<!-- JavaScript -->
<script src="/assets/js/bundle.js?ver=3.2.2"></script>
<script src="/assets/js/scripts.js?ver=3.2.2"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.0/moment.min.js"></script>
@stack('scripts')

<script>
    let dark_mode = localStorage.getItem('dark') || 'light';
    console.log(dark_mode)
    if (dark_mode === 'true') {
        $('.nk-body').addClass('dark-mode');
    }
</script>
</body>

</html>
