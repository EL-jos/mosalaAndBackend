@extends('base')

@section('title', 'NOUVELLE DEMANDE')

@section('head')
    <!-- JQUERY DATATABLE -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.12.1/af-2.4.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.css"/>
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
                        <h2 class="el-title">Mes Demandes</h2>
                    </div>
                    <table id="table_id">
                        <thead>
                            <tr>
                                <th>Intitulé</th>
                                <th>Déscription</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($requests as $request)
                                <tr>
                                    <td>{{ $request->title }}</td>
                                    <td>
                                        <p class="el-overflow-text">{{ htmlspecialchars_decode(strip_tags($request->content)) }}</p>
                                    </td>
                                    <td>
                                        <div class="el-controls" style="display: flex; align-items: center; gap: .5rem;">
                                            <a href="{{ route('request.show', $request) }}" class="el-btn el-bg-info"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('request.edit', $request) }}" class="el-btn el-bg-warning"><i class="fas fa-edit"></i></a>
                                            <a href="#" class="el-btn el-bg-danger" onclick="document.getElementById('el-delete').submit()">
                                                <i class="fas fa-trash-alt"></i>
                                                <form id="el-delete" method="POST" action="{{ route('request.destroy', $request) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    @parent
    <!-- JQUERY DATATABLE -->
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/af-2.4.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.js"></script>
    <!-- CKEDITOR -->
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'ckeditor' );
    </script>
    <script>
        $(document).ready( function () {
            $('#table_id').DataTable({
                paging: false,
                searching: true,
                select: false,
                scrollY: 370,
                language: {
                    info: "Horaire de prière pour le mois en cours",
                },
                responsive: true
            });
        } );
    </script>
@endsection

