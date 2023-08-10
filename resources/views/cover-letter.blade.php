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
                        <h2 class="el-title">Lettre de motivation</h2>
                    </div>
                    <form action="{{ route('coverLetter.student') }}" method="POST">
                        @csrf
                        <div class="el-row">
                            <div class="el-col"><input id="website" name="website" value="{{ $student->about ? $student->about->website :old('website') }}" type="url" placeholder="Site web"></div>
                            <div class="el-col"><input id="link_fb" name="link_fb" value="{{ $student->about ? $student->about->link_fb :old('link_fb') }}" type="url" placeholder="Lien Facebook"></div>
                        </div>
                        <div class="el-row">
                            <div class="el-col"><input id="link_in" name="link_in" value="{{ $student->about ? $student->about->link_in :old('link_in') }}" type="url" placeholder="Lien LinkedIn"></div>
                        </div>
                        <div class="el-row">
                            <textarea class="ckeditor" id="content" name="content">{!! $student->about ? $student->about->content : old('content') !!}</textarea>
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
    <!-- CKEDITOR -->
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
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
