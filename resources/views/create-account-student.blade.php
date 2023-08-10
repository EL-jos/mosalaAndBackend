@extends('base')

@section('title', 'COMPTE ETUDIANT')

@section('head')
    <!-- FLATPICKER -->
    <link rel="stylesheet" href="{{ asset('css/cdn.jsdelivr.net_npm_flatpickr_dist_flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/npmcdn.com_flatpickr@4.6.13_dist_themes_dark.css') }}">
    @parent
@endsection

@section('main-content')
    <section id="el-accounts" class="el-center-box">
        <div class="el-content-area">
            <div class="el-grid el-column">
                <div class="el-container-title">
                    <div class="el-icon el-center-box">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <h2 class="el-title">Informations personnelle</h2>
                </div>
                <form action="{{ route('student.store') }}" method="POST">
                    @csrf
                    <div class="el-row">
                        <div class="el-col"><input id="lastname" name="lastname" value="{{ old('lastname') }}" type="text" placeholder="Prénom" required></div>
                        <div class="el-col"><input id="firstname" name="firstname" value="{{ old('firstname') }}" type="text" placeholder="Nom" required></div>
                    </div>
                    <div class="el-row">
                        <div class="el-col">
                            <select name="gender_id" id="gender_id">
                                <option value="" selected disabled>Sexe</option>
                                @foreach($genders as $gender)
                                    @if(old('gender_id') === $gender->id)
                                        <option selected value="{{ $gender->id }}">{{ $gender->name }}</option>
                                    @else
                                        <option value="{{ $gender->id }}">{{ $gender->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="el-row">
                        <div class="el-col"><input value="{{ old('phone') }}" name="phone" id="phone" type="tel" placeholder="Télépone" required></div>
                        <div class="el-col"><input value="{{ old('email') }}" name="email" id="email" type="email" placeholder="E-mail" required></div>
                    </div>
                    <div class="el-row">
                        <div class="el-col"><input value="{{ old('birth') }}" name="birth" type="text" placeholder="Anniversaire" id="birth" required></div>
                    </div>
                    <div class="el-row">
                        <div class="el-col"><input value="{{ old('password') }}" name="password" id="password" type="password" placeholder="Mot de passe" required></div>
                        <div class="el-col"><input name="password_confirmation" type="password" placeholder="Confirmez le Mot de passe" required></div>
                    </div>
                    <button type="submit" class="el-btn el-bg-success">S'inscrire</button>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    @parent
    <!-- FLATPICKER -->
    <script src="{{ asset('js/cdn.jsdelivr.net_npm_flatpickr.js') }}"></script>
    <script src="{{ asset('js/npmcdn.com_flatpickr@4.6.13_dist_l10n_fr.js') }}"></script>
    <script>
        $("#birth").flatpickr({
            locale: "fr",
            //dateFormat: "d/m/Y"
        });
    </script>
@endsection
