@extends('base')

@section('title', 'CHOIX DE COMPTE')

@section('main-content')
    <section id="el-accounts" class="el-center-box">
        <div class="el-content-area">
            <div class="el-grid el-column">
                <div class="el-container-title">
                    <div class="el-icon el-center-box">
                        <i class="fas fa-plus"></i>
                    </div>
                    <h2 class="el-title">Créer un compte</h2>
                </div>
                <div class="el-grid-accounts">
                    <div class="el-account">
                        <a href="{{ route('createCompany.page') }}" class="el-center-box">
                            <img src="{{ asset('assets/svg/entreprise.svg') }}" alt="créer un compte entrepreneur ou entréprise">
                        </a>
                        <h2 class="el-name">compte entrepreneur ou<br>entréprise</h2>
                    </div>

                    <div class="el-account">
                        <a href="{{ route('createStudent.page') }}" class="el-center-box">
                            <img src="{{ asset('assets/svg/etudiant.svg') }}" alt="créer un compte étudiant ou autodidact">
                        </a>
                        <h2 class="el-name">compte étudiant ou <br> autodidact</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

