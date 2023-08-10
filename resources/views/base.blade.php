<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', env('APP_NAME'))</title>
    @section('head')
        <!-- TOM SELECT -->
        <link href="{{ asset('css/tom-select.css') }}" rel="stylesheet">
        <script src="{{ asset('js/tom-select.complete.min.js') }}"></script>
        <!-- FONT AWESOME -->
        <link rel="stylesheet" href="{{ asset('css/font-awesome-all.min.css') }}">
        <!-- CUSTOM STYLE -->
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    @show
</head>
<body>

    <main id="el-page">

        <header id="el-header-page" class="el-center-box">
            <div class="el-content-area">
                <ul>
                    <li class="el-logo"><a href="{{ route('home.page') }}"><img src="{{ asset('assets/svg/logo.svg') }}" alt="Logo"></a></li>
                    <li id="el-open-menu-phone"><button class="el-btn"><i class="fas fa-bars"></i></button></li>
                    @if(session()->has('user'))
                        <li>
                            <a href="#" onclick="document.getElementById('logout-form').submit()">
                                <form action="{{ route('logout.form') }}" method="POST" id="logout-form">@csrf</form>
                                <i class="fas fa-sign-out-alt"></i> Se déconnecter
                            </a>
                        </li>

                        <li>
                            <a href="{{ route(
                                \App\Models\Entity::where(
                                'entityable_id', '=', session()->get('user')['id'])->first()->entityable_type === 'App\\Models\\Company'
                                ? 'newOffer.page'
                                : 'request.create') }}" class="el-btn">
                                <i class="fas fa-plus"></i>
                                {{ \App\Models\Entity::where(
                                    'entityable_id', '=', session()->get('user')['id'])->first()->entityable_type === 'App\\Models\\Company'
                                    ? 'Ajouter une offre'
                                    : 'Ajouter une demande'
                                }}
                            </a>
                        </li>
                    @else
                        <li><a href="{{ route('login.page') }}"><i class="fas fa-sign-in-alt"></i> Se connecter</a></li>
                        <li><a href="{{ route('register.page') }}"><i class="fas fa-address-card"></i> Créer un compte</a></li>
                    @endif
                </ul>
            </div>
        </header>

        <main id="el-content-page">
            <nav id="el-navbar">
                @include('layouts.navbar')
            </nav>
            <div id="el-container-section" class="el-column">
                @yield('main-content')
            </div>
        </main>

        <footer id="el-footer-page" class="el-center-box">
            <p>Copyright © 2023, MOSALA. Tous droits réservés.</p>
        </footer>

        <div id="el-menu-phone">
            <button class="el-btn el-center-box"><i class="fas fa-times"></i></button>
            <nav>
                @include('layouts.navbar')
            </nav>
        </div>

    </main>

    @section('scripts')
        <!-- JQUERY -->
        <script src="{{ asset('js/cdnjs.cloudflare.com_ajax_libs_jquery_1.12.0_jquery.min.js') }}"></script>
        <script src="{{ asset('js/jquery-migrate-1.2.1.min.js') }}"></script>
        <!-- FONT AWESOME -->
        <script src="{{ asset('js/font-awesome-all.min.js') }}"></script>
        <!-- SWEET ALERT -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            const selectsMultiple = document.querySelectorAll("select[multiple], seclect#city_id");
            selectsMultiple.forEach(select => {
                new TomSelect(select, {plugins: {remove_button: {title: 'Supprimer'}}})
            });
        </script>
        <script>
            const el_open_menu_phone = document.querySelector('#el-open-menu-phone .el-btn');
            const el_menu_phone = document.querySelector('#el-menu-phone');
            const el_close_menu_phone = document.querySelector('#el-menu-phone .el-btn');
            el_open_menu_phone.addEventListener('click', () => {
                el_menu_phone.classList.add('el-active');
            });
            el_close_menu_phone.addEventListener('click', () => {
                el_menu_phone.classList.remove('el-active');
            });
        </script>
        @if(session()->has('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Valide',
                    text: "{!! session('success') !!}"
                });
            </script>
        @elseif(session()->has('error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: "{!! session('error') !!}"
                });
            </script>
        @elseif(session()->has('warning'))
            <script>
                Swal.fire({
                    icon: 'warning',
                    title: 'Votre attention',
                    text: "{!! session('warning') !!}"
                });
            </script>
        @elseif(session()->has('info'))
            <script>
                Swal.fire({
                    icon: 'info',
                    title: 'Information',
                    text: "{!! session('info') !!}"
                });
            </script>
        @elseif($errors->any())
            <script>
                var errorMessages = "<ul>";
                @foreach ($errors->all() as $error)
                    errorMessages += "<li>{{ $error }}</li>";
                @endforeach
                    errorMessages += "</ul>";

                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    html: errorMessages
                });
            </script>
        @endif
    @show
</body>
</html>
