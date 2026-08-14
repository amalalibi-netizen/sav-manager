@extends('layouts.guest')

@section('title', 'Accueil')

@section('content')
    <div class="container">
        <div class="row justify-content-center py-5">
            <div class="col-md-6 text-center">
                <div class="mb-4">
                    <h1 class="display-4 fw-bold text-white mb-3">SAV Manager</h1>
                    <p class="lead text-white-50 mb-4">Système de gestion professionnel pour le service après-vente</p>
                </div>

                <div class="d-flex gap-3 justify-content-center">
                    @if (auth()->check())
                        <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg">Aller au tableau de bord</a>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-light btn-lg">Se déconnecter</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Se connecter</a>
                        <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg">S'inscrire</a>
                    @endif
                </div>

                <hr class="bg-white-50 my-5">

                <div class="text-white-50">
                    <p class="small mb-0">© 2026 SAV Manager. Tous droits réservés.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
