@extends('layouts.predavac')

@section('title', 'Dodavanje materijala')
@section('page-title', 'Dodavanje materijala')
@section('subheader-title', 'Novi materijal')

@section('content')
<div class="d-flex justify-content-center">
    <div class="col-md-6 col-lg-5">

        <div class="material-card p-4">
            <form action="{{ route('materijals.store') }}" method="POST">
                @csrf

                <!-- NAZIV -->
                <div class="mb-4">
                    <label class="form-label text-white fw-semibold">
                        Naziv
                    </label>
                    <input
                        type="text"
                        name="naziv"
                        class="form-control custom-input"
                        placeholder="Unesite naziv materijala"
                        required
                    >
                </div>

                <!-- AUTOR -->
                <div class="mb-4">
                    <label class="form-label text-white fw-semibold">
                        Autor
                    </label>
                    <select
                        name="user_id"
                        class="form-select custom-input"
                        required
                    >
                        <option value="" selected disabled>
                            Odaberite autora
                        </option>

                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- BUTTON -->
                <div class="text-center mt-4">
                    <button type="submit" class="btn-save">
                        Sačuvaj
                    </button>
                </div>

            </form>
        </div>

    </div>
</div>
@endsection

@push('styles')
<style>
/* CARD */
.material-card {
    background-color: #004f55;
    border-radius: 24px;
}

/* INPUTS */
.custom-input {
    border-radius: 10px;
    padding: 10px 14px;
    border: none;
    font-size: 14px;
}

.custom-input:focus {
    box-shadow: none;
    outline: none;
}

/* BUTTON */
.btn-save {
    background-color: #008c95;
    color: #ffffff;
    border: none;
    padding: 10px 36px;
    border-radius: 20px;
    font-weight: 600;
    transition: background-color 0.2s ease;
}

.btn-save:hover {
    background-color: #00a4ad;
}
</style>
@endpush
