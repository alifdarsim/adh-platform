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

</head>

<body class="nk-body npc-default pg-auth">
<div class="nk-app-root">
    <!-- main @s -->
    <div class="nk-main ">
        <!-- wrap @s -->
        <div class="nk-wrap nk-wrap-nosidebar">
            <!-- content @s -->
            <div class="nk-content ">
                <div class="nk-split nk-split-page nk-split-lg">
                    <div
                        class="nk-split-content nk-split-stretch bg-lighter d-flex toggle-break-lg toggle-slide toggle-slide-right"
                        data-toggle-body="true" data-content="athPromo" data-toggle-screen="lg"
                        data-toggle-overlay="true">
                        <div class="slider-wrap w-100 w-max-550px p-3 p-sm-5 m-auto">
                            <div class="slider-init" data-slick='{"dots":true, "arrows":false}'>
                                <div class="slider-item">
                                    <div class="nk-feature nk-feature-center">
                                        <div class="nk-feature-img">
                                            <img class="round" src="/images/slides/promo-a.png"
                                                 srcset="/images/slides/promo-a2x.png 2x" alt="">
                                        </div>
                                        <div class="nk-feature-content py-4 p-sm-5">
                                            <h4>AsiaDealHub</h4>
                                            <p>You can start to create your products easily with its user-friendly
                                                design & most completed responsive layout.</p>
                                        </div>
                                    </div>
                                </div><!-- .slider-item -->
                                <div class="slider-item">
                                    <div class="nk-feature nk-feature-center">
                                        <div class="nk-feature-img">
                                            <img class="round" src="/images/slides/promo-b.png"
                                                 srcset="/images/slides/promo-b2x.png 2x" alt="">
                                        </div>
                                        <div class="nk-feature-content py-4 p-sm-5">
                                            <h4>AsiaDealHub</h4>
                                            <p>You can start to create your products easily with its user-friendly
                                                design & most completed responsive layout.</p>
                                        </div>
                                    </div>
                                </div><!-- .slider-item -->
                                <div class="slider-item">
                                    <div class="nk-feature nk-feature-center">
                                        <div class="nk-feature-img">
                                            <img class="round" src="/images/slides/promo-c.png"
                                                 srcset="/images/slides/promo-c2x.png 2x" alt="">
                                        </div>
                                        <div class="nk-feature-content py-4 p-sm-5">
                                            <h4>AsiaDealHub</h4>
                                            <p>You can start to create your products easily with its user-friendly
                                                design & most completed responsive layout.</p>
                                        </div>
                                    </div>
                                </div><!-- .slider-item -->
                            </div><!-- .slider-init -->
                            <div class="slider-dots"></div>
                            <div class="slider-arrows"></div>
                        </div><!-- .slider-wrap -->
                    </div>
                    <div class="nk-split-content nk-block-area nk-block-area-column nk-auth-container bg-white">
                        <div class="absolute-top-right d-lg-none p-3 p-sm-5">
                            <a href="#" class="toggle btn-white btn btn-icon btn-light" data-target="athPromo"><em
                                    class="icon ni ni-info"></em></a>
                        </div>
                        <div class="nk-block nk-block-middle nk-auth-body">
                            <div class="brand-logo pb-5 tw-flex tw-items-center">
                                <a href="/" class="logo-link">
                                    <img class="logo-light logo-img logo-img-lg" src="/images/logo.png"
                                         srcset="/images/logo2x.png 2x" alt="logo">
                                    <img class="logo-dark logo-img logo-img-lg" src="/images/logo-dark.png"
                                         srcset="/images/logo-dark2x.png 2x" alt="logo-dark">
                                </a>
                            </div>
                            <div class="nk-block-head">
                                <div class="nk-block-head-content"><h5 class="nk-block-title">Password for Admin
                                        Account</h5>
                                    <div class="nk-block-des">
                                        <p>Please confirm your password to login to your AsiaDealHub account.</p>
                                        <p class="fs-16px">Login Email: {{$user->email}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-label-group">
                                    <label class="form-label" for="password1">Password</label>
                                </div>
                                <div class="form-control-wrap">
                                    <input type="password" class="form-control form-control-lg" id="password1"
                                           placeholder="Enter your password">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-label-group">
                                    <label class="form-label" for="password2">Confirm Password</label>
                                </div>
                                <div class="form-control-wrap">
                                    <input type="password" class="form-control form-control-lg" id="password2"
                                           placeholder="Confirm your password">
                                </div>
                            </div>
                            <div class="form-group">
                                <button onclick="register()" class="btn btn-lg btn-primary btn-block">Login Admin</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- wrap @e -->
        </div>
        <!-- content @e -->
    </div>
    <!-- main @e -->
</div>
<!-- app-root @e -->
<!-- JavaScript -->
<script src="/assets/js/bundle.js?ver=3.2.2"></script>
<script src="/assets/js/scripts.js?ver=3.2.2"></script>

<script>
    const getToken = () => window.location.href.split('/').pop();

    function register() {
        $.ajax({
            url: "{{route('admin.password-invitation')}}",
            type: 'POST',
            data: {
                "password": $('#password1').val(),
                "password_confirmation": $('#password2').val(),
                "token": getToken(),
                "_token": "{{ csrf_token() }}",
            },
            success: function (data) {
                Swal.fire('Success', data.message, 'success').then(e => {
                    window.location.href = "{{route('login.show')}}";
                });
            },
            error: function (data) {
                Swal.fire('Error!', data.responseJSON.message, 'error')
            }
        });
    }

    function quick_view(id) {
        $.ajax({
            url: "{{route('post.quick_view')}}",
            type: 'GET',
            data: {
                "id": id,
                "_token": "{{ csrf_token() }}",
            },
            success: function (data) {
                $('#modalLarge').modal('show')
                $('#modalLarge .modal-body').html(data);
            }
        });
    }
</script>
</body>
</html>
