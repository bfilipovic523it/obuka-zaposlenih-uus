@extends('layouts.admin')

@section('title', 'Izmeni Obuku')
@section('page-title', 'Izmena obuke')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="training-card p-4">

            <h3 class="training-title mb-3 text-center">Izmenite obuku</h3>

            <form action="{{ route('obukas.update', $obuka->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Naziv -->
                <div class="mb-3">
                    <label for="naziv" class="form-label"><strong>Naziv obuke:</strong></label>
                    <input type="text" name="naziv" id="naziv"
                        class="form-control @error('naziv') is-invalid @enderror"
                        value="{{ old('naziv', $obuka->naziv) }}" required>
                    @error('naziv')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Opis -->
                <div class="mb-3">
                    <label for="opis" class="form-label"><strong>Opis:</strong></label>
                    <textarea name="opis" id="opis"
                        class="form-control @error('opis') is-invalid @enderror"
                        rows="4">{{ old('opis', $obuka->opis) }}</textarea>
                    @error('opis')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Broj mesta -->
                <div class="mb-3">
                    <label for="broj_mesta" class="form-label"><strong>Broj mesta:</strong></label>
                    <input type="number" name="broj_mesta" id="broj_mesta"
                        class="form-control @error('broj_mesta') is-invalid @enderror"
                        value="{{ old('broj_mesta', $obuka->broj_mesta) }}" min="1" required>
                    @error('broj_mesta')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Sektor -->
                <div class="mb-3">
                    <label for="sektor_id" class="form-label"><strong>Sektor:</strong></label>
                    <select name="sektor_id" id="sektor_id"
                        class="form-select @error('sektor_id') is-invalid @enderror" required>
                        <option value="">-- Izaberite sektor --</option>
                        @foreach($sektors as $sektor)
                            <option value="{{ $sektor->id }}"
                                {{ old('sektor_id', $obuka->sektor_id) == $sektor->id ? 'selected' : '' }}>
                                {{ $sektor->naziv }}
                            </option>
                        @endforeach
                    </select>
                    @error('sektor_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Predavač -->
                <div class="mb-3">
                    <label for="user_id" class="form-label"><strong>Predavač:</strong></label>
                    <select name="user_id" id="user_id"
                        class="form-select @error('user_id') is-invalid @enderror" required>
                        <option value="">-- Izaberite predavača --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}"
                                {{ old('user_id', $obuka->user_id) == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Materijal -->
                <div class="mb-3">
                    <label for="materijal_id" class="form-label"><strong>Materijal:</strong></label>
                    <select name="materijal_id" id="materijal_id"
                        class="form-select @error('materijal_id') is-invalid @enderror" required>
                        <option value="">-- Izaberite materijal --</option>
                        @foreach($materijals as $materijal)
                            <option value="{{ $materijal->id }}"
                                {{ old('materijal_id', $obuka->materijal_id) == $materijal->id ? 'selected' : '' }}>
                                {{ $materijal->naziv }}
                            </option>
                        @endforeach
                    </select>
                    @error('materijal_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Datum početka -->
                <div class="mb-3">
                    <label for="datum_pocetka" class="form-label"><strong>Datum početka:</strong></label>
                    <input type="date" name="datum_pocetka" id="datum_pocetka"
                        class="form-control @error('datum_pocetka') is-invalid @enderror"
                        value="{{ old('datum_pocetka', $obuka->datum_pocetka->format('Y-m-d')) }}" required>
                    @error('datum_pocetka')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Datum završetka -->
                <div class="mb-3">
                    <label for="datum_zavrsetka" class="form-label"><strong>Datum završetka:</strong></label>
                    <input type="date" name="datum_zavrsetka" id="datum_zavrsetka"
                        class="form-control @error('datum_zavrsetka') is-invalid @enderror"
                        value="{{ old('datum_zavrsetka', $obuka->datum_zavrsetka->format('Y-m-d')) }}" required>
                    @error('datum_zavrsetka')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Sačuvaj izmene</button>
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

    .form-control, .form-select {
        border-radius: 8px;
    }

    .btn-primary {
        background-color: #005f63;
        border-color: #005f63;
        border-radius: 8px;
        padding: 8px 20px;
    }
</style>
@endpush
