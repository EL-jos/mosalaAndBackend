@extends('base')

@section('title', 'DETAILS')

@section('head')
    <!-- JQUERY DATATABLE -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.12.1/af-2.4.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.css"/>
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
                    <div class="el-boxImg"><img src="https://source.unsplash.com/random/100×100/?company" alt="" class="el-img"></div>
                    <div class="el-name-and-sector">
                        <h2 class="el-name">Nom complet</h2>
                        <p class="el-sector">Secteur ou profession</p>
                    </div>
                    <div class="el-biography">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus cumque blanditiis, eius harum delectus voluptates voluptas, id nihil qui, doloribus quidem aliquid at dolor facere accusamus eos? Obcaecati, sapiente perferendis?</p>
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
                        <i class="fas fa-user"></i>
                    </div>
                    <h2 class="el-title">Profil</h2>
                </div>
                <div class="el-grid-profil-demande">
                    <table id="table_id">
                        <thead>
                        <tr>
                            <th>Intitulé</th>
                            <th>Déscription</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <section id="el-details" class="el-center-box">
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
    </section>
@endsection

@section('scripts')
    @parent
    <!-- JQUERY DATATABLE -->
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/af-2.4.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.js"></script>
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
@endsection

