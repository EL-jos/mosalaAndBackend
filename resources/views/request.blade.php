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
                    <div class="el-boxImg"><img src="{{ asset( $request->student->image ? $request->student->image->url : 'assets/img/user.jpg') }}" alt="{{ $request->student->entity->lastname .' '. $request->student->entity->firstname }}" class="el-img"></div>
                    <div class="el-name-and-sector">
                        <h2 class="el-name">{{ $request->title }}</h2>
                        <p class="el-sector">
                            {!! $request->sector->name !!} <br>
                             en
                            @foreach($request->types as $type)
                                @if($loop->index === $request->types->count())
                                    {{ $type->name }}
                                @else
                                    {{ $type->name }},
                                @endif
                            @endforeach
                             sur
                            @foreach($request->cities as $city)
                                @if($loop->index === $request->cities->count())
                                    {{ $city->name }}
                                @else
                                    {{ $city->name }},
                                @endif
                            @endforeach
                        </p>
                    </div>
                    <div class="el-biography">
                        <p>{!! $request->content !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="el-details" class="el-center-box">
        <div class="el-content-area">
            <div class="el-grid el-column">

                <a href="{{ route('student.show', $request->student->id) }}" class="el-btn el-apply"><i class="fas fa-eye"></i> Voir le profil</a>
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

