@extends('base')

@section('title', 'CHOIX DE COMPTE')

@section('head')
    <!-- FILEPOND -->
    <link rel="stylesheet" href="{{ asset('css/unpkg.com_filepond@4.30.4_dist_filepond.css') }}">
    <!-- FLATPICKER -->
    <link rel="stylesheet" href="{{ asset('css/cdn.jsdelivr.net_npm_flatpickr_dist_flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/npmcdn.com_flatpickr@4.6.13_dist_themes_dark.css') }}">
    @parent
@endsection

@section('main-content')
    <div id="el-container-section" class="el-column">
        <section id="el-accounts" class="el-center-box">
            <div class="el-content-area">
                <div class="el-grid el-column">
                    <div class="el-container-title">
                        <div class="el-icon el-center-box">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <h2 class="el-title">Informations personnelle</h2>
                    </div>
                    <form action="{{ route('student.update', $student) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="el-row">
                            <div class="el-col"><input type="text" name="lastname" value="{{ $student->entity->lastname }}" placeholder="Prénom" required></div>
                            <div class="el-col"><input type="text" name="firstname" value="{{ $student->entity->firstname }}" placeholder="Nom" required></div>
                        </div>
                        <div class="el-row">
                            <div class="el-col">
                                <select name="gender_id" id="gender_id">
                                    <option value="" selected disabled>Sexe</option>
                                    @foreach($genders as $gender)
                                        @if($student->entity->gender_id === $gender->id)
                                            <option selected value="{{ $gender->id }}">{{ $gender->name }}</option>
                                        @else
                                            <option value="{{ $gender->id }}">{{ $gender->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="el-row">
                            <div class="el-col"><input name="phone" value="{{ $student->entity->phone }}" type="tel" placeholder="Télépone" required></div>
                            <div class="el-col"><input name="email" value="{{ $student->entity->email }}" type="email" placeholder="E-mail" required></div>
                        </div>
                        <div class="el-row">
                            <div class="el-col"><input type="text" name="birth" value="{{ $student->birth }}" placeholder="Anniversaire" id="birth" required></div>
                        </div>
                        <div class="el-row">
                            <div class="el-col">
                                <select name="country_id" id="country_id">
                                    <option value="" selected disabled>Pays</option>
                                    @foreach($countries as $country)
                                        @if($student->entity->country_id === $country->id)
                                            <option selected value="{{ $country->id }}">{{ $country->name }}</option>
                                        @else
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="el-col">
                                <select name="city_id" id="city_id">
                                    <option value="" selected disabled>Ville</option>
                                    @foreach ($countries as $country)
                                        <optgroup label="{{ $country->name }}">
                                            @foreach ($country->states as $state)
                                                @foreach ($state->cities as $city)
                                                    @if($student->entity->city_id === $city->id)
                                                        <option selected value="{{ $city->id }}">{{ $city->name }}</option>
                                                    @else
                                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="el-controls">
                            <button type="submit" class="el-btn el-bg-success">Enregistrer</button>
                            <button type="button" class="el-btn el-bg-warning">Modifier</button>
                        </div>
                    </form>
                    <div class="el-container-title">
                        <div class="el-icon el-center-box">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <h2 class="el-title">Modifier votre photo profile</h2>
                    </div>
                    <div class="el-profil el-drag-drop">
                        <input type="file" id="el-profil" name="photo" accept="image/*">
                    </div>
                    <div class="el-container-title">
                        <div class="el-icon el-center-box">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <h2 class="el-title">Obtention du Bac</h2>
                    </div>
                    <form action="{{ route('uploadBac.form') }}" method="POST">
                        @csrf
                        <div class="el-row">
                            <div class="el-col"><input name="date" value="{{ $student->bac ? $student->bac->date : '' }}" type="text" placeholder="date" class="el-date"></div>
                            <div class="el-col">
                                <select name="category_id" id="category_id">
                                    <option value="" selected disabled>Categorie</option>
                                    @foreach($categories as $category)

                                        @if($student->bac->category_id === $category->id)
                                            <option selected value="{{ $category->id }}">{{ $category->name }}</option>
                                        @else
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="el-row">
                            <div class="el-col">
                                <select name="level_id" id="level_id">
                                    <option value="" disabled selected>Niveau d'étude actuel</option>
                                    @foreach($levels as $level)
                                        @if($student->bac->level_id === $level->id)
                                            <option selected value="{{ $level->id }}">{{ $level->name }}</option>
                                        @else
                                            <option value="{{ $level->id }}">{{ $level->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="el-controls">
                            <button type="submit" class="el-btn el-bg-success">Enregistrer</button>
                            <button type="button" class="el-btn el-bg-warning">Modifier</button>
                        </div>
                    </form>
                    <div class="el-container-title">
                        <div class="el-icon el-center-box">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <h2 class="el-title">Formation(s)</h2>
                    </div>
                    <form action="{{ route('uploadFormation.form') }}" id="el-form-formation" method="POST">
                        @csrf
                        @forelse($student->formations as $formation)
                            <fieldset class="el-grid-input-controls" data-num="{{ $loop->index + 1 }}">
                                <legend>N° {{ $loop->index + 1 }}</legend>
                                <div class="el-row">
                                    <div class="el-col"><input value="{{ $formation->date }}" type="text" name="date[]" placeholder="date" class="el-date" required></div>
                                    <div class="el-col">
                                        <select name="sector_id[]" id="" required>
                                            <option value="" selected disabled>Titre</option>
                                            @foreach($sectors as $sector)
                                                @if($formation->sector_id === $sector->id)
                                                    <option selected value="{{ $sector->id }}"> {!! $sector->name !!}</option>
                                                @else
                                                    <option value="{{ $sector->id }}"> {!! $sector->name !!}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="el-row">
                                    <div class="el-col el-textarea">
                                        <textarea name="content[]" id="" placeholder="description" required>{{ $formation->content }}</textarea>
                                    </div>
                                </div>
                                @if($loop->index !== 0)
                                    <button type="button" class="el-btn el-bg-danger" data-num="{{ $loop->index + 1 }}">Supprimer</button>
                                @endif
                            </fieldset>
                        @empty
                            <fieldset class="el-grid-input-controls" data-num="1">
                                <legend>N° 1</legend>
                                <div class="el-row">
                                    <div class="el-col"><input type="text" name="date[]" placeholder="date" class="el-date" required></div>
                                    <div class="el-col">
                                        <select name="sector_id[]" id="" required>
                                            <option value="" selected disabled>Titre</option>
                                            @foreach($sectors as $sector)
                                                <option value="{{ $sector->id }}"> {!! $sector->name !!}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="el-row">
                                    <div class="el-col el-textarea">
                                        <textarea name="content[]" id="" placeholder="description" required></textarea>
                                    </div>
                                </div>
                            </fieldset>
                        @endforelse


                        <div class="el-controls">
                            <button type="button" class="el-btn el-bg-info">Ajouter</button>
                            <button type="submit" class="el-btn el-bg-success">Enregistrer</button>
                            <button type="button" class="el-btn el-bg-warning">Modifier</button>
                        </div>
                    </form>
                    <div class="el-container-title">
                        <div class="el-icon el-center-box">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <h2 class="el-title">Compétence(s)</h2>
                    </div>
                    <form action="{{ route('uploadCompetency.form') }}" method="POST">
                        @csrf
                        <div class="el-drag-drop">
                            <select name="competency_id[]" id="" multiple>
                                <option value="" selected disabled>Que savez-vous faire</option>
                                @foreach($competencies as $competency)
                                    @if($student->competencies->contains($competency->id))
                                        <option selected value="{{ $competency->id }}">{{ $competency->name }}</option>
                                    @else
                                        <option value="{{ $competency->id }}">{{ $competency->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="el-controls">
                            <button type="submit" class="el-btn el-bg-success">Enregistrer</button>
                            <button type="button" class="el-btn el-bg-warning">Modifier</button>
                        </div>
                    </form>

                    <div class="el-container-title">
                        <div class="el-icon el-center-box">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <h2 class="el-title">Disponibilité(s) journalière</h2>
                    </div>
                    <form action="{{ route('uploadDaily.form') }}" method="POST" id="el-form-day-dispo">
                        @csrf
                        @forelse($student->dailies as $daily)
                            <fieldset class="el-grid-input-controls" data-num="{{ $loop->index + 1 }}">
                                <legend>N° {{ $loop->index + 1 }}</legend>
                                <div class="el-row">
                                    <div class="el-col">
                                        <select name="day_id[]" id="" required>
                                            <option value="" disabled>Jour</option>
                                            @foreach($days as $day)
                                                <option value="{{ $day->id }}" {{ $daily->day_id === $day->id ? 'selected' : '' }}>
                                                    {{ $day->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="el-col"><input value="{{ $daily->time }}" name="time[]" type="text" placeholder="Heure" class="el-time" required></div>
                                </div>
                                @if($loop->index > 0)
                                    <button type="button" class="el-btn el-bg-danger" data-num="{{ $loop->index + 1 }}">Supprimer</button>
                                @endif

                            </fieldset>
                        @empty
                            <fieldset class="el-grid-input-controls" data-num="1">
                                <legend>N° 1</legend>
                                <div class="el-row">
                                    <div class="el-col">
                                        <select name="day_id[]" id="">
                                            <option value="" selected disabled>Jour</option>
                                            @foreach($days as $day)
                                                <option value="{{ $day->id }}">{{ $day->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="el-col"><input name="time[]" type="text" placeholder="Heure" class="el-time"></div>
                                </div>
                            </fieldset>
                        @endforelse

                        <div class="el-controls">
                            <button type="button" class="el-btn el-bg-info">Ajouter</button>
                            <button type="submit" class="el-btn el-bg-success">Enregistrer</button>
                            <button type="button" class="el-btn el-bg-warning">Modifier</button>
                        </div>
                    </form>
                    <div class="el-container-title">
                        <div class="el-icon el-center-box">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <h2 class="el-title">Disponibilité(s) Périodique</h2>
                    </div>
                    <form action="{{ route('uploadPeriodical.form') }}" method="POST" id="el-form-period-dispo">
                        @csrf
                        @forelse($student->periodicals as $periodical)
                            <fieldset class="el-grid-input-controls" data-num="{{ $loop->index + 1 }}">
                                <legend>N° {{ $loop->index + 1 }}</legend>
                                <div class="el-row">
                                    <div class="el-col"><input value="{{ $periodical->start }} au {{ $periodical->end }}" name="periode[]" type="text" placeholder="Période" class="el-period"></div>
                                </div>
                                @if($loop->index > 0)
                                    <button type="button" class="el-btn el-bg-danger" data-num="{{ $loop->index + 1 }}">Supprimer</button>
                                @endif
                            </fieldset>
                        @empty
                            <fieldset class="el-grid-input-controls" data-num="1">
                                <legend>N° 1</legend>
                                <div class="el-row">
                                    <div class="el-col"><input name="periode[]" type="text" placeholder="Période" class="el-period"></div>
                                </div>
                            </fieldset>
                        @endforelse

                        <div class="el-controls">
                            <button type="button" class="el-btn el-bg-info">Ajouter</button>
                            <button type="submit" class="el-btn el-bg-success">Enregistrer</button>
                            <button type="button" class="el-btn el-bg-warning">Modifier</button>
                        </div>
                    </form>
                    <div class="el-container-title">
                        <div class="el-icon el-center-box">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <h2 class="el-title">Modifier votre Curriculum vitæ</h2>
                    </div>
                    <div class="el-cv el-drag-drop">
                        <input name="cv" type="file" id="el-cv">
                    </div>
                    <embed src="{{ asset($student->cv) }}" width="100%" height="500">
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    @parent
    <!-- FLATPICKER -->
    <script src="{{ asset('js/cdn.jsdelivr.net_npm_flatpickr.js') }}"></script>
    <script src="{{ asset('js/npmcdn.com_flatpickr@4.6.13_dist_l10n_fr.js') }}"></script>
    <!-- FILEPOND -->
    <script src="{{ asset('js/unpkg.com_filepond@4.30.4_dist_filepond.js') }}"></script>
    <!-- CKEDITOR -->
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
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
        // Get a reference to the file input element
        const inputPicture = document.querySelector('input#el-profil');
        const inputCV = document.querySelector('input#el-cv');

        // Create a FilePond instance
        const pondPicture = FilePond.create(inputPicture, {
            labelFileProcessingComplete: 'Votre Photo a bien été mise à jour, Veillez actualiser la page',
            labelFileProcessingError: 'Impossible de mettre à jour votre Photo',
            onaddfile: (error, file) => {
                console.log(file);
            },
            server: {
                process: {
                    url: '{{ route("uploadPhoto.page") }}', // Remplacez par l'URL de votre action Laravel pour l'upload
                    method: 'POST',
                    withCredentials: false,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Ajoutez le jeton CSRF dans les headers de la requête
                    }
                },
            }
        });
        const pondCV = FilePond.create(inputCV, {
            labelFileProcessingComplete: 'Votre CV a bien été mise à jour, Veillez actualiser la page',
            labelFileProcessingError: 'Impossible de mettre à jour votre CV',
            onaddfile: (error, file) => {
                console.log(file);
            },
            server: {
                process: {
                    url: '{{ route("uploadCV.page") }}', // Remplacez par l'URL de votre action Laravel pour l'upload
                    method: 'POST',
                    withCredentials: false,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Ajoutez le jeton CSRF dans les headers de la requête
                    }
                },
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var formContainer = document.getElementById('el-form-formation');
            var ajouterFormationBtn = formContainer.querySelector('.el-btn.el-bg-info');
            //var formContainer = document.getElementById('el-form-formations');

            // Compteur pour le numéro des blocs de formulaire
            var count = {{ $student->formations->count() ? $student->formations->count() : 1 }};


            function createFormBlock(num, sectors) {
                var fieldset = document.createElement('fieldset');
                fieldset.className = 'el-grid-input-controls';
                fieldset.dataset.num = num;
                fieldset.innerHTML = `
                    <legend>Nº ${num}</legend>
                    <div class="el-row">
                        <div class="el-col">
                            <input type="text" name="date[]" placeholder="date" class="el-date" required>
                        </div>
                        <div class="el-col">
                            <select name="sector_id[]" id="title-formation-${num}" required>
                                ${createSectorOptions(sectors)}
                            </select>
                        </div>
                    </div>
                    <div class="el-row">
                        <div class="el-col el-textarea">
                            <textarea name="content[]" id="" placeholder="description" required></textarea>
                        </div>
                    </div>
                    <button type="button" class="el-btn el-bg-danger" data-num="${num}">Supprimer</button>
                `;
                return fieldset;
            }

            function createSectorOptions(sectors) {
                var options = '<option value="" selected disabled>Titre</option>';
                sectors.forEach(function(sector) {
                    options += `<option value="${sector.id}">${sector.name}</option>`;
                });
                return options;
            }

            var sectorOptions = {!! json_encode($sectors) !!};

            // Événement de clic sur le bouton "Ajouter"
            ajouterFormationBtn.addEventListener('click', function() {
                count++;
                var newFormBlock = createFormBlock(count, sectorOptions);
                formContainer.insertBefore(newFormBlock, this.parentElement);
                $(".el-date").flatpickr({
                    locale: "fr",
                    dateFormat: "Y-m-d"
                });
            });

            // Événement de clic sur le bouton "Supprimer"
            formContainer.addEventListener('click', function(e) {
                if (e.target.classList.contains('el-bg-danger')) {
                    var num = e.target.dataset.num;
                    if (num > 1) {
                        var formBlock = document.querySelector(`fieldset[data-num="${num}"]`);
                        if (formBlock) {
                            formContainer.removeChild(formBlock);
                        }
                    }
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var formContainerDailies = document.getElementById('el-form-day-dispo');
            var ajouterFormationBtnDailies = formContainerDailies.querySelector('.el-btn.el-bg-info');

            // Compteur pour le numéro des blocs de formulaire
            var countDailies = {{ $student->dailies->count() ? $student->dailies->count() : 1 }};


            function createFormBlockDailies(num, days) {
                var fieldsetDaily = document.createElement('fieldset');
                fieldsetDaily.className = 'el-grid-input-controls';
                fieldsetDaily.dataset.num = num;
                fieldsetDaily.innerHTML = `
                    <legend>Nº ${num}</legend>
                    <div class="el-row">
                        <div class="el-col">
                            <select name="day_id[]" id="day_dispo_${num}">
                                ${createDayOptions(days)}
                            </select>
                        </div>
                        <div class="el-col"><input type="text" name="time[]" placeholder="Heure" class="el-time"></div>
                    </div>
                    <button type="button" class="el-btn el-bg-danger" data-num="${num}">Supprimer</button>
                `;
                return fieldsetDaily;
            }

            function createDayOptions(days) {
                var options = '<option value="" selected disabled>Jour</option>';
                days.forEach(function(day) {
                    options += `<option value="${day.id}">${day.name}</option>`;
                });
                return options;
            }

            var dayOptions = {!! json_encode($days) !!};

            // Événement de clic sur le bouton "Ajouter"
            ajouterFormationBtnDailies.addEventListener('click', function() {
                countDailies++;
                var newFormBlockDailies = createFormBlockDailies(countDailies, dayOptions);
                formContainerDailies.insertBefore(newFormBlockDailies, this.parentElement);
                $(".el-time").flatpickr({
                    locale: "fr",
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: "H:i",
                    minuteIncrement: 30
                });
            });

            // Événement de clic sur le bouton "Supprimer"
            formContainerDailies.addEventListener('click', function(e) {
                if (e.target.classList.contains('el-bg-danger')) {
                    var num = e.target.dataset.num;
                    if (num > 1) {
                        var formBlockDailies = formContainerDailies.querySelector(`fieldset[data-num="${num}"]`);
                        if (formBlockDailies) {
                            formContainerDailies.removeChild(formBlockDailies);
                        }
                    }
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var formContainerPeriodical = document.getElementById('el-form-period-dispo');
            var ajouterFormationBtnPeriodical = formContainerPeriodical.querySelector('.el-btn.el-bg-info');

            // Compteur pour le numéro des blocs de formulaire
            var countPeriodical = {{ $student->periodicals->count() ? $student->periodicals->count() : 1 }};


            function createFormBlock(num) {
                var fieldsetPeriodical = document.createElement('fieldset');
                fieldsetPeriodical.className = 'el-grid-input-controls';
                fieldsetPeriodical.dataset.num = num;
                fieldsetPeriodical.innerHTML = `
                    <legend>Nº ${num}</legend>
                    <div class="el-row">
                        <div class="el-col"><input name="periode[]" type="text" placeholder="Période" class="el-period"></div>
                    </div>
                    <button type="button" class="el-btn el-bg-danger" data-num="${num}">Supprimer</button>
                `;
                return fieldsetPeriodical;
            }

            // Événement de clic sur le bouton "Ajouter"
            ajouterFormationBtnPeriodical.addEventListener('click', function() {
                countPeriodical++;
                var newFormBlockPeriodical = createFormBlock(countPeriodical);
                formContainerPeriodical.insertBefore(newFormBlockPeriodical, this.parentElement);
                $(".el-period").flatpickr({
                    locale: "fr",
                    mode: "range",
                    dateFormat: "Y-m-d"
                });
            });

            // Événement de clic sur le bouton "Supprimer"
            formContainerPeriodical.addEventListener('click', function(e) {
                if (e.target.classList.contains('el-bg-danger')) {
                    var num = e.target.dataset.num;
                    if (num > 1) {
                        var formBlockPeriodical = formContainerPeriodical.querySelector(`fieldset[data-num="${num}"]`);
                        if (formBlockPeriodical) {
                            formContainerPeriodical.removeChild(formBlockPeriodical);
                        }
                    }
                }
            });
        });
    </script>

    <script>
        CKEDITOR.replace( 'ckeditor' );
    </script>
    <script>
        $(document).ready(function() {
            // Désactiver le formulaire par défaut
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

