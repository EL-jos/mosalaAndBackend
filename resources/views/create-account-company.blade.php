@extends('base')

@section('title', 'COMPTE ENTREPRISE')

@section('main-content')
    <section id="el-accounts" class="el-center-box">
        <div class="el-content-area">
            <div class="el-grid el-column">
                <div class="el-container-title">
                    <div class="el-icon el-center-box">
                        <i class="fas fa-building"></i>
                    </div>
                    <h2 class="el-title">Informations générales</h2>
                </div>
                <form action="{{ route('company.store') }}" method="POST">
                    @csrf
                    <div class="el-row">
                        <div class="el-col"><input type="text" id="lastname" name="lastname" value="{{ old('lastname') }}" placeholder="Prénom" required></div>
                        <div class="el-col"><input type="text" id="firstname" name="firstname" value="{{ old('firstname') }}" placeholder="Nom" required></div>
                    </div>
                    <div class="el-row">
                        <div class="el-col">
                            <select name="gender_id" id="gender_id">
                                <option value="" selected disabled>Sexe</option>
                                @foreach($genders as $gender)
                                    <option @if(old('gender_id') == $gender->id) selected @endif value="{{ $gender->id }}">{{ $gender->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="el-row">
                        <div class="el-col"><input type="tel" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Télépone" required></div>
                        <div class="el-col"><input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="E-mail" required></div>
                    </div>
                    <div class="el-row">
                        <div class="el-col"><input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Nom de la société" required></div>
                    </div>
                    <div class="el-row">
                        <div class="el-col"><input type="password" id="password" name="password" value="{{ old('password') }}" placeholder="Mot de passe" required></div>
                        <div class="el-col"><input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirmez le Mot de passe" required></div>
                    </div>
                    <button type="submit" class="el-btn el-bg-success">S'inscrire</button>
                </form>
            </div>
        </div>
    </section>
@endsection

