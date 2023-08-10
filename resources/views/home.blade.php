@extends('base')

@section('title', 'ACCUEIL')

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
                        <div class="el-col"><input type="text" placeholder="Mot clef"></div>
                    </div>
                    <div class="el-row">
                        <div class="el-col">
                            {{--<select name="city_id" id="city_id">
                                <option selected disabled>Ville</option>
                                @foreach ($countries as $country)
                                    <optgroup label="{{ $country->name }}">
                                        @foreach ($country->states as $state)
                                            @foreach ($state->cities as $city)
                                                <option>{{ $city->name }}</option>
                                            @endforeach
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>--}}
                            <select name="city_id" id="city_id" multiple>
                                <option value="" disabled selected>Ville</option>
                                @foreach ($cities as $city)
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
                            <select name="entityable_id" id="entityable_id">
                                <option value="" selected disabled>Que checrchez-vous ?</option>
                                <option value="1">Offre d'emploi</option>
                                <option value="2">Demande d'emploi</option>
                            </select>
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
                    <h2 class="el-title">Dernières demandes d’emploi</h2>
                </div>
                <div class="el-grid-jobs">
                    @forelse($requests as $request)
                        <a href="{{ route('request.show', $request) }}" class="el-offre">
                            <div class="el-container-date el-center-box">
                                <div class="el-boxImg">
                                    <img src="{{ asset($request->student->image ? $request->student->image->url : 'asstes/img/user.jpg') }}" alt="{{ $request->title }}" class="el-img">
                                </div>
                            </div>
                            <div class="el-content">
                                <h2 class="el-title-job el-overflow-text">{{ $request->title }}</h2>
                                <p class="el-overflow-text">{{ htmlspecialchars_decode(strip_tags($request->content)) }}</p>
                                <h2 class="el-company">{{ $request->student->entity->lastname .' '. $request->student->entity->firstname}}</h2>
                            </div>
                        </a>
                    @empty
                        <p class="el-message el-bg-info"> Pas d'informations disponible pour cette section! </p>
                    @endforelse

                </div>
                <a href="" class="el-btn el-next">Suivant</a>
            </div>
        </div>
    </section>
    <section id="el-cvtheques" class="el-center-box">
        <div class="el-content-area">
            <div class="el-grid el-column">
                <div class="el-container-title">
                    <div class="el-icon el-center-box">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <h2 class="el-title">CVthèque</h2>
                </div>
                <div class="el-grid-cv">
                    @forelse($students as $student)
                        <a href="{{ route('student.show', $student->id) }}" class="el-personne">
                            <div class="el-box-img">
                                <img class="el-img" src="{{ asset( $student->image ? $student->image->url : 'assets/img/user.jpg') }}" alt="{{ $student->entity->lastname .' '. $student->entity->firstname }}">
                            </div>
                            <div class="el-content">
                                <h3 class="el-nom-personne">{{ $student->entity->lastname .' '. $student->entity->firstname }}</h3>
                                <legend class="el-poste-personne">{{ $student->bac ? $student->bac->category->name : 'Profession inconnue' }}</legend>
                            </div>
                        </a>
                    @empty
                        <p class="el-message el-bg-info"> Pas d'informations disponible pour cette section! </p>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
@endsection
