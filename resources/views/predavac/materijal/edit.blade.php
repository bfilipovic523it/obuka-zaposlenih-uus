@extends('layouts.predavac')

@section('title', 'Izmena materijala')
@section('page-title', 'Izmena materijala')
@section('subheader-title', 'Izmeni materijal')

@section('content')
<div class="d-flex justify-content-center">
    <div class="col-md-6 col-lg-5">

        <div class="material-card p-4">
            <form action="{{ route('materijals.update', $materijal->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- NAZIV -->
                <div class="mb-4">
                    <label class="form-label text-white fw-semibold">
                        Naziv
                    </label>
                    <input
                        type="text"
                        name="naziv"
                        class="form-control custom-input @error('naziv') is-invalid @enderror"
                        value="{{ old('naziv', $materijal->naziv) }}"
                        required
                    >

                    @error('naziv')
                        <div class="text-danger mt-1 small">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- AUTOR -->
                <div class="mb-4">
                    <label class="form-label text-white fw-semibold">
                        Autor
                    </label>
                    <select
                        name="user_id"
                        class="form-select custom-input @error('user_id') is-invalid @enderror"
                        required
                    >
                        <option value="" disabled>
                            Odaberite autora
                        </option>

                        @foreach ($users as $user)
                            <option
                                value="{{ $user->id }}"
                                {{ old('user_id', $materijal->user_id) == $user->id ? 'selected' : '' }}
                            >
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('user_id')
                        <div class="text-danger mt-1 small">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- BUTTON -->
                <div class="text-center mt-4">
                    <button type="submit" class="btn-save">
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
/* CARD */
.material-card {
    background-color: #004f55;
    border-radius: 24px;
    width: 100%;
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
