@extends('base')

@section('title', 'DETAILS')

@section('head')
    <!-- JQUERY DATATABLE -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.12.1/af-2.4.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.css"/>
    <!-- FLATPICKER -->
    <link rel="stylesheet" href="{{ asset('css/cdn.jsdelivr.net_npm_flatpickr_dist_flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/npmcdn.com_flatpickr@4.6.13_dist_themes_dark.css') }}">
    @parent
@endsection

@section('main-content')
    <section id="el-author" class="el-center-box">
        <div class="el-content-area">
            <div class="el-grid el-column">
                <div class="el-container-title">
                    <div class="el-icon el-center-box">
                        <i class="fas fa-at"></i>
                    </div>
                    <h2 class="el-title">Auteur</h2>
                </div>
                <div class="el-grid-author">
                    <div class="el-boxImg"><img src="{{ asset( $student->image ? $student->image->url : 'assets/img/user.jpg') }}" alt="" class="el-img"></div>
                    <div class="el-name-and-sector">
                        <h2 class="el-name">{{ $student->entity->lastname .' '. $student->entity->firstname }}</h2>
                        <p class="el-sector">{{ $student->bac ? $student->bac->category->name : 'Profession inconnue' }}</p>
                    </div>
                    <div class="el-biography">
                        <p> {!! $student->about->content !!} </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="el-profil-demande" class="el-center-box">
        <div class="el-content-area">
            <div class="el-grid el-column">
                <div class="el-container-title">
                    <div class="el-icon el-center-box">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <h2 class="el-title">Disponibilité(s) journalière</h2>
                </div>
                <form>
                    @forelse($student->dailies as $daily)
                        <fieldset class="el-grid-input-controls">
                            <legend>N° {{ $loop->index + 1 }}</legend>
                            <div class="el-row">
                                <p>Le {{ $daily->day->name }} à {{ \Carbon\Carbon::parse($daily->time)->format('H:i A') }}</p>
                            </div>
                        </fieldset>
                    @empty
                        <p class="el-message el-bg-info"> Pas d'informations disponible pour cette section! </p>
                    @endforelse
                </form>
                <div class="el-container-title">
                    <div class="el-icon el-center-box">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <h2 class="el-title">Disponibilité(s) Périodique</h2>
                </div>
                <form>
                    @forelse($student->periodicals as $periodical)
                        <fieldset class="el-grid-input-controls">
                            <legend>N° {{ $loop->index + 1 }}</legend>
                            <div class="el-row">
                                <p>
                                    Du {{ \Carbon\Carbon::parse($periodical->start)->format('d/m/Y') }}
                                    au {{ \Carbon\Carbon::parse($periodical->end)->format('d/m/Y') }}
                                </p>
                            </div>
                        </fieldset>
                    @empty
                        <p class="el-message el-bg-info"> Pas d'informations disponible pour cette section! </p>
                    @endforelse
                </form>
                <div class="el-container-title">
                    <div class="el-icon el-center-box">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <h2 class="el-title">Compétence(s)</h2>
                </div>
                <div class="el-container-competences">
                    @forelse($student->competencies as $competency)
                        <div class="el-competence">
                            <label for="competence-{{ $loop->index + 1 }}">
                                <input type="checkbox" checked id="competence-{{ $loop->index + 1 }}">
                                <span>{{ $competency->name }}</span>
                            </label>
                        </div>
                    @empty
                        <p class="el-message el-bg-info"> Pas d'informations disponible pour cette section! </p>
                    @endforelse
                </div>
                <div class="el-container-title">
                    <div class="el-icon el-center-box">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <h2 class="el-title">Curriculum vitæ</h2>
                </div>
                <embed src="{{ asset($student->cv) }}" width="100%" height="500">
            </div>
        </div>
    </section>
    {{--<section id="el-details" class="el-center-box">
        <div class="el-content-area">
            <div class="el-grid el-column">
                <div class="el-container-title">
                    <div class="el-icon el-center-box">
                        <i class="fas fa-file-signature"></i>
                    </div>
                    <h2 class="el-title">Déscription</h2>
                </div>
                <div class="el-details-mission">
                    <h2>Titre</h2>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ea adipisci quos suscipit inventore, nesciunt quia itaque unde commodi recusandae natus consequatur perferendis, eveniet sunt. Veniam voluptas iusto ad exercitationem tempora.</p>
                </div>
                <a href="" class="el-btn el-apply"><i class="fas fa-check-circle"></i> Postuler à cette offre</a>
            </div>
        </div>
    </section> --}}
@endsection

@section('scripts')
    @parent
    <!-- JQUERY DATATABLE -->
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/af-2.4.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.js"></script>
    <!-- FLATPICKER -->
    <script src="{{ asset('js/cdn.jsdelivr.net_npm_flatpickr.js') }}"></script>
    <script src="{{ asset('js/npmcdn.com_flatpickr@4.6.13_dist_l10n_fr.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('#table_id').DataTable({
                paging: false,
                searching: false,
                select: true,
                scrollY: 370,
                language: {
                    info: "Horaire de prière pour le mois en cours",
                },
                responsive: true
            });
        } );
    </script>
    <script>
        $("#birth, .el-date").flatpickr({
            locale: "fr",
            dateFormat: "Y-m-d"
        });
        $(".el-time").flatpickr({
            locale: "fr",
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            minuteIncrement: 30
        });
        $(".el-period").flatpickr({
            locale: "fr",
            mode: "range",
            dateFormat: "Y-m-d"
        });
    </script>
    <script>
        $(document).ready(function() {
            // Désactiver le formulaire par défaut

            //$("form").addClass("el-disabled");
            $("form input, form select").prop("disabled", true);
            $("form .el-controls button:not(.el-bg-warning)").prop("disabled", true);

            $(".el-controls button.el-bg-warning").on("click", function() {
                // Activer le formulaire (à l'exception des boutons)
                //$(".el-controls :input:not(:button)").prop("disabled", false);
                $("form :input").prop("disabled", false);

                // Désactiver le bouton "Modifier"
                $(this).prop("disabled", true);

                // Activer le bouton "Enregistrer"
                //$("#btnEnregistrer").prop("disabled", false);
            });
        });

    </script>
@endsection

