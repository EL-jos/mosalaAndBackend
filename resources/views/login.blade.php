@extends('base')

@section('title', 'SE CONNECTER')

@section('main-content')
    <section id="el-accounts" class="el-center-box">
        <div class="el-content-area">
            <div class="el-grid el-column">
                <div class="el-container-title">
                    <div class="el-icon el-center-box">
                        <i class="fas fa-building"></i>
                    </div>
                    <h2 class="el-title">Informations de connexion</h2>
                </div>
                <form action="{{ route('login.form') }}" method="POST">
                    @csrf
                    <div class="el-row">
                        <!--<div class="el-col">
                            <select name="" id="">
                                <option value="" selected disabled>Type de compte</option>
                                <option value="1">Entreprise</option>
                                <option value="2">Etudiant</option>
                            </select>
                        </div>-->
                        <div class="el-col"><input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="E-mail" required></div>
                    </div>
                    <div class="el-row">
                        <div class="el-col">
                            <input type="password" id="password" name="password" value="{{ old('password') }}" placeholder="Mot de passe" required>
                        </div>
                    </div>
                    <button type="submit" class="el-btn el-bg-success">Connexion</button>
                </form>
            </div>
        </div>
    </section>
@endsection
