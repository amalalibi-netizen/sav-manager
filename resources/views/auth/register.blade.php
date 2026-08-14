@extends('layouts.guest')

@section('title', 'Inscription')

@section('content')
    <div class="container">
        <div class="row justify-content-center py-5">
            <div class="col-md-6">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-primary text-white py-4">
                        <h3 class="mb-0 text-center">Créer un compte</h3>
                        <p class="text-center text-white-50 mt-2 mb-0">Rejoignez l'équipe SAV Manager</p>
                    </div>
                    <div class="card-body p-4">
                        @include('partials.flash')

                        <form action="{{ route('register') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Nom complet *</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" required>
                                @error('name')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email *</label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required>
                                @error('email')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Mot de passe *</label>
                                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                                @error('password')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirmer le mot de passe *</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" required>
                                @error('password_confirmation')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mb-3">S'inscrire</button>
                        </form>

                        <hr>

                        <p class="text-center text-muted mb-0">
                            Vous avez un compte ? <a href="{{ route('login') }}" class="fw-bold">Se connecter ici</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
