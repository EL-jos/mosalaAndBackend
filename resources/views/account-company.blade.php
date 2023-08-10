@extends('base')

@section('title', 'CHOIX DE COMPTE')

@section('head')
    <!-- FILEPOND -->
    <link rel="stylesheet" href="{{ asset('css/unpkg.com_filepond@4.30.4_dist_filepond.css') }}">
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
                        <h2 class="el-title">Informations générales</h2>
                    </div>
                    <form id="companyForm" disabled action="{{ route('company.update', $company) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="el-row">
                            <div class="el-col"><input name="lastname" id="lastname" value="{{ $company->entity->lastname }}" type="text" placeholder="Prénom" required></div>
                            <div class="el-col"><input name="firstname" id="firstname" value="{{ $company->entity->firstname }}" type="text" placeholder="Nom" required></div>
                        </div>
                        <div class="el-row">
                            <div class="el-col">
                                <select name="gender_id" id="gender_id">
                                    <option value="" disabled @if($company->entity->gender_id === null) selected @endif>Sexe</option>
                                    @foreach($genders as $gender)
                                        <option @if($company->entity->gender_id == $gender->id) selected @endif value="{{ $gender->id }}">{{ $gender->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="el-row">
                            <div class="el-col"><input name="phone" id="phone" value="{{ $company->entity->phone }}" type="tel" placeholder="Télépone" required></div>
                            <div class="el-col"><input name="email" id="email" value="{{ $company->entity->email }}" type="email" placeholder="E-mail" required></div>
                        </div>
                        <div class="el-row">
                            <div class="el-col"><input name="name" id="name" value="{{ $company->name }}" type="text" placeholder="Nom de la société" required></div>
                            <div class="el-col">
                                <select name="sector_id" id="sector_id">
                                    @foreach($sectors as $sector)
                                        @if($company->sector_id === $sector->id)
                                            <option selected value="{{ $sector->id }}"> {!! $sector->name !!} </option>
                                        @else
                                            <option value="{{ $sector->id }}">{!! $sector->name !!}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="el-row">
                            <div class="el-col">
                                <select name="country_id" id="country_id">
                                    <option value="" @if($company->entity->country_id === null) selected @endif disabled>Pays</option>
                                    @foreach($countries as $country)
                                        <option @if($company->entity->country_id == $country->id) selected @endif value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="el-col">
                                <select name="city_id" id="city_id">
                                    <option value="" @if($company->entity->city_id === null) selected @endif disabled>Ville</option>
                                    @foreach ($countries as $country)
                                        <optgroup label="{{ $country->name }}">
                                            @foreach ($country->states as $state)
                                                @foreach ($state->cities as $city)
                                                    <option @if($company->entity->city_id == $city->id) selected @endif value="{{ $city->id }}">{{ $city->name }}</option>
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
                        <h2 class="el-title">Modifier votre Logo</h2>
                    </div>
                    <div class="el-logo el-drag-drop">
                        <input type="file" id="el-logo" name="logo" accept="image/*">
                    </div>
                    <div class="el-container-title">
                        <div class="el-icon el-center-box">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <h2 class="el-title">Présentation</h2>
                    </div>
                    <form action="{{ route('addAbout.company') }}" method="POST">
                        @csrf
                        <div class="el-row">
                            <div class="el-col"><input id="website" name="website" value="{{ $company->about ? $company->about->website :old('website') }}" type="url" placeholder="Site web"></div>
                            <div class="el-col"><input id="link_fb" name="link_fb" value="{{ $company->about ? $company->about->link_fb :old('link_fb') }}" type="url" placeholder="Lien Facebook"></div>
                        </div>
                        <div class="el-row">
                            <div class="el-col"><input id="link_in" name="link_in" value="{{ $company->about ? $company->about->link_in :old('link_in') }}" type="url" placeholder="Lien LinkedIn"></div>
                        </div>
                        <div class="el-row">
                            <textarea class="ckeditor" id="content" name="content">{!! $company->about ? $company->about->content : '' !!}</textarea>
                        </div>
                        <div class="el-controls">
                            <button type="submit" class="el-btn el-bg-success">Enregistrer</button>
                            <button type="button" class="el-btn el-bg-warning">Modifier</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    @parent
    <!-- FILEPOND -->
    <script src="{{ asset('js/unpkg.com_filepond@4.30.4_dist_filepond.js') }}"></script>
    <!-- CKEDITOR -->
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        // Get a reference to the file input element
        const inputLogo = document.querySelector('input#el-logo');

        // Create a FilePond instance
        const pondLogo = FilePond.create(inputLogo, {
            labelFileProcessingComplete: 'Votre logo a bien été mise à jour',
            labelFileProcessingError: 'Impossible de mettre à jour votre logo',
            onaddfile: (error, file) => {
                console.log(file);
            },
            server: {
                process: {
                    url: '{{ route("uploadLogo.page") }}', // Remplacez par l'URL de votre action Laravel pour l'upload
                    method: 'POST',
                    withCredentials: false,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Ajoutez le jeton CSRF dans les headers de la requête
                    }
                },
                /*revert: {
                    url: '', // Remplacez par l'URL de votre action Laravel pour supprimer l'image (optionnel)
                    method: 'DELETE',
                    withCredentials: false,
                },*/
            }
        });
        // ...
        /*pondLogo.on('processfileprogress', (file, progress) => {
            const progressPercentage = Math.round(progress * 100);
            console.log(progress, parseInt(progress), progressPercentage)
            if (progressPercentage === 100) {
                // Le téléchargement est terminé, on peut maintenant vérifier le message du serveur
                const serverResponse = file.serverData;

                if (serverResponse && serverResponse.code === 0) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Valide',
                        text: serverResponse.message
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur',
                        text: serverResponse.message || 'Une erreur inconnue s\'est produite.'
                    });
                }
            }
        });*/

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
