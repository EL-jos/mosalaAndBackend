@extends('base')

@section('title', 'OFFRES D\'IMPLOI')


@section('head')
    <!-- FLATPICKER -->
    <link rel="stylesheet" href="{{ asset('css/cdn.jsdelivr.net_npm_flatpickr_dist_flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/npmcdn.com_flatpickr@4.6.13_dist_themes_dark.css') }}">
    @parent
@endsection

@section('main-content')
    <section id="el-search-job" class="el-center-box">
        <div class="el-content-area">
            <div class="el-grid el-column">
                <div class="el-container-title">
                    <div class="el-icon el-center-box">
                        <i class="fas fa-search"></i>
                    </div>
                    <h2 class="el-title">Trouver un job en un clic</h2>
                </div>
                <form action="">
                    <div class="el-row">
                        <div class="el-col"><input type="text" placeholder="Mot clef" required></div>
                    </div>
                    <div class="el-row">
                        <div class="el-col">
                            <select name="" id="" multiple required>
                                <option value="" disabled selected>Ville</option>
                                @foreach($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="el-col">
                            <select name="" id="" multiple>
                                <option value="" disabled selected>Type</option>
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="el-row">
                        <div class="el-col">
                            <select name="" id="" multiple required>
                                <option value="" disabled selected>Contrat</option>
                                @foreach($contracts as $contract)
                                    <option value="{{ $contract->id }}">{{ $contract->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="el-col">
                            <select name="" id="" multiple>
                                <option value="" disabled selected>Niveau d'étude</option>
                                @foreach($levels as $level)
                                    <option value="{{ $level->id }}">{{ $level->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="el-row">
                        <div class="el-col">
                            <select name="" id="" multiple required>
                                <option value="" disabled selected>Formation</option>
                                @foreach($sectors as $sector)
                                    <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="el-row">
                        <div class="el-col">
                            <select name="" id="" required>
                                <option value="" disabled selected>Disponibilité</option>
                                @foreach($availabilities as $availability)
                                    <option value="{{ $availability->id }}">{{ $availability->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="el-row">
                        <div class="el-col">
                            <select name="" id="" required>
                                <option value="" disabled selected>Jour</option>
                                <option value="1">Lundi</option>
                                <option value="2">Mardi</option>
                            </select>
                        </div>
                        <div class="el-col">
                            <input type="text" id="available_time" placeholder="Sélectionnez une Heure" required>
                        </div>
                    </div>
                    <div class="el-row">
                        <div class="el-col">
                            <input type="text" id="available_period" placeholder="Sélectionnez une Période" required>
                        </div>
                    </div>
                    <button type="submit" class="el-btn el-bg-success">Chercher</button>
                </form>
            </div>
        </div>
    </section>
    <section id="el-jobs" class="el-center-box">
        <div class="el-content-area">
            <div class="el-grid el-column">
                <div class="el-container-title">
                    <div class="el-icon el-center-box">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <h2 class="el-title">Dernières d’offres d’emploi</h2>
                </div>
                <div class="el-grid-jobs">
                    <a href="" class="el-offre">
                        <div class="el-container-date el-center-box">
                            <div>
                                <h2 class="el-date">24</h2>
                                <span class="el-month">Juin</span>
                            </div>
                        </div>
                        <div class="el-content">
                            <h2 class="el-title-job el-overflow-text">Titre du job</h2>
                            <p class="el-overflow-text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolorum dolor voluptatem recusandae eligendi at, est non ipsa a ut libero nesciunt totam atque tenetur fuga ratione aliquam commodi. Iste, similique?</p>
                            <h2 class="el-company">Nom entreprise</h2>
                        </div>
                    </a>
                    <a href="" class="el-offre">
                        <div class="el-container-date el-center-box">
                            <div>
                                <h2 class="el-date">24</h2>
                                <span class="el-month">Juin</span>
                            </div>
                        </div>
                        <div class="el-content">
                            <h2 class="el-title-job el-overflow-text">Titre du job</h2>
                            <p class="el-overflow-text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolorum dolor voluptatem recusandae eligendi at, est non ipsa a ut libero nesciunt totam atque tenetur fuga ratione aliquam commodi. Iste, similique?</p>
                            <h2 class="el-company">Nom entreprise</h2>
                        </div>
                    </a>
                    <a href="" class="el-offre">
                        <div class="el-container-date el-center-box">
                            <div>
                                <h2 class="el-date">24</h2>
                                <span class="el-month">Juin</span>
                            </div>
                        </div>
                        <div class="el-content">
                            <h2 class="el-title-job el-overflow-text">Titre du job</h2>
                            <p class="el-overflow-text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolorum dolor voluptatem recusandae eligendi at, est non ipsa a ut libero nesciunt totam atque tenetur fuga ratione aliquam commodi. Iste, similique?</p>
                            <h2 class="el-company">Nom entreprise</h2>
                        </div>
                    </a>
                </div>
                <a href="" class="el-btn el-next">Suivant</a>
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
        $("#available_time").flatpickr({
            locale: "fr",
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            minuteIncrement: 1
        });
        $("#available_period").flatpickr({
            locale: "fr",
            mode: "range",
            dateFormat: "d/m/Y"
        });
    </script>
@endsection
