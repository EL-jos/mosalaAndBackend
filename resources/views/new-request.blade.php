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
                        <h2 class="el-title">Nouvelle Demande</h2>
                    </div>
                    <form action="{{ route($request->exists ? 'request.update' : 'request.store', $request) }}" method="POST">
                        @csrf
                        @method($request->exists ? 'PUT' : 'POST')
                        <input type="hidden" name="student_id" value="{{ $student->id }}" />
                        <div class="el-row">
                            <div class="el-col">
                                <input id="title" name="title" value="{{ $request->exists ? $request->title :old('title') }}" type="text" placeholder="Titre" />
                            </div>
                        </div>
                        <div class="el-row">
                            <div class="el-col">
                                <select name="city_id[]" id="city_id" multiple>
                                    <option value="" disabled selected>Ville</option>
                                    @foreach ($cities as $city)
                                        @php
                                            $cityIds = $request->cities->pluck('id')->toArray();
                                        @endphp
                                        @if(in_array($city->id, old('city_id', [])) || ($request->exists && in_array($city->id, $cityIds) ))
                                            <option selected value="{{ $city->id }}">{{ $city->name }}</option>
                                        @else
                                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="el-col">
                                <select name="type_id[]" id="type_id" multiple>
                                    <option value="" disabled selected>Type</option>
                                    @foreach($types as $type)
                                        @php
                                            $typeIds = $request->types->pluck('id')->toArray();
                                        @endphp
                                        @if(in_array($type->id, old('type_id', [])) || ($request->exists && in_array($type->id, $typeIds)))
                                            <option selected value="{{ $type->id }}">{{ $type->name }}</option>
                                        @else
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="el-row">
                            <div class="el-col">
                                <select name="sector_id" id="sector_id">
                                    <option value="" disabled selected>Secteur</option>
                                    @foreach($sectors as $sector)
                                        @if(old('sector_id') === $sector->id || ($request->exists && $request->sector->id === $sector->id))
                                            <option selected value="{{ $sector->id }}"> {!! $sector->name !!} </option>
                                        @else
                                            <option value="{{ $sector->id }}"> {!! $sector->name !!} </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="el-row">
                            <textarea class="ckeditor" id="content" name="content">{!! $request->exists ? $request->content :old('content') !!}</textarea>
                        </div>
                        <div class="el-controls">
                            <button type="submit" class="el-btn el-bg-success">{{ $request->exists ? 'Mettre à jour' : 'Enregistrer'}}</button>
                            <button type="reset" class="el-btn el-bg-danger">Annuler</button>
                        </div>
                    </form>
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

