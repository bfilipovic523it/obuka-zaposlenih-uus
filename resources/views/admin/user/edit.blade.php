@extends('layouts.admin')

@section('title', 'Izmena korisnika')
@section('page-title', 'Izmena korisnika')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="training-card p-4">

            <h3 class="training-title mb-3 text-center">
                Izmenite korisnika
            </h3>

            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Ime -->
                <div class="mb-3">
                    <label for="name" class="form-label"><strong>Ime:</strong></label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $user->name) }}"
                        required
                    >
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label"><strong>Email:</strong></label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email', $user->email) }}"
                        required
                    >
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Lozinka (opciono) -->
                <div class="mb-3">
                    <label for="password" class="form-label">
                        <strong>Nova lozinka (opciono):</strong>
                    </label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Ostavi prazno ako ne menjaš lozinku"
                    >
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Potvrda lozinke -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">
                        <strong>Potvrda lozinke:</strong>
                    </label>
                    <input
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        class="form-control"
                    >
                </div>

                <!-- Uloga -->
                <div class="mb-3">
                    <label for="uloga_id" class="form-label"><strong>Uloga:</strong></label>
                    <select
                        name="uloga_id"
                        id="uloga_id"
                        class="form-select @error('uloga_id') is-invalid @enderror"
                        required
                    >
                        <option value="">-- Izaberite ulogu --</option>
                        @foreach($ulogas as $uloga)
                            <option
                                value="{{ $uloga->id }}"
                                {{ old('uloga_id', $user->uloga_id) == $uloga->id ? 'selected' : '' }}
                            >
                                {{ $uloga->naziv }}
                            </option>
                        @endforeach
                    </select>
                    @error('uloga_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Sektor -->
                <div class="mb-3">
                    <label for="sektor_id" class="form-label"><strong>Sektor:</strong></label>
                    <select
                        name="sektor_id"
                        id="sektor_id"
                        class="form-select @error('sektor_id') is-invalid @enderror"
                        required
                    >
                        <option value="">-- Izaberite sektor --</option>
                        @foreach($sektors as $sektor)
                            <option
                                value="{{ $sektor->id }}"
                                {{ old('sektor_id', $user->sektor_id) == $sektor->id ? 'selected' : '' }}
                            >
                                {{ $sektor->naziv }}
                            </option>
                        @endforeach
                    </select>
                    @error('sektor_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Dugmad -->
                <div class="d-flex justify-content-center mt-4">
                    <button type="submit" class="btn btn-primary">
                        Sačuvaj izmene
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .training-card {
        background: #018790;
        color: #ffffff;
        border-radius: 22px;
        width: 100%;
    }

    .training-title {
        font-size: 22px;
        font-weight: 700;
        font-style: italic;
    }

    .form-label {
        font-weight: 300;
        color: #ffffff;
    }

    .form-control,
    .form-select {
        border-radius: 8px;
    }

    .btn-primary {
        background-color: #005f63;
        border-color: #005f63;
        border-radius: 8px;
        padding: 8px 20px;
    }

    .btn-secondary {
        border-radius: 8px;
        padding: 8px 20px;
    }
</style>
@endpush
