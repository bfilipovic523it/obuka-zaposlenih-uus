@extends('layouts.admin')

@section('title', 'Obuke')
@section('page-title', 'Obuke')

@section('subheader-title')
    Prikaz svih obuka
@endsection

@section('subheader-action')
    <a href="{{ route('obukas.create') }}" class="btn-add">
        Dodaj obuku
    </a>
@endsection

@section('content')
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
    @forelse($obukas as $obuka)
        <div class="col mb-4">
            <div class="training-card d-flex flex-column p-3 h-100">

                <!-- NASLOV -->
                <h3 class="training-title mb-2 text-center">
                    {{ $obuka->naziv }}
                </h3>

                <!-- OPIS -->
                <p class="training-desc mb-3 text-center">
                    {{ $obuka->opis ?? 'Bez opisa' }}
                </p>

                <!-- INFO -->
                <div class="training-info mt-auto">
                    <div>
                        <strong>Sektor:</strong>
                        {{ $obuka->sektor->naziv ?? '-' }}
                    </div>

                    <div>
                        <strong>Predavač:</strong>
                        {{ $obuka->user->name ?? '-' }}
                    </div>

                    <div>
                        <strong>Datum početka:</strong>
                        {{ \Carbon\Carbon::parse($obuka->datum_pocetka)->format('d.m.Y.') }}
                    </div>

                    <div>
                        <strong>Datum završetka:</strong>
                        {{ \Carbon\Carbon::parse($obuka->datum_zavrsetka)->format('d.m.Y.') }}
                    </div>
                </div>

                <!-- AKCIJE -->
                <div class="mt-3 d-flex justify-content-between">
                    <a href="{{ route('obukas.edit', $obuka->id) }}"
                       class="btn btn-warning btn-sm">
                        Izmeni
                    </a>

                    <form action="{{ route('obukas.destroy', $obuka->id) }}"
                          method="POST"
                          onsubmit="return confirm('Da li ste sigurni da želite da obrišete ovu obuku?');">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger btn-sm">
                            Obriši
                        </button>
                    </form>
                </div>

            </div>
        </div>
    @empty
        <div class="col-12 text-center py-5">
            <p>Nema dostupnih obuka.</p>
        </div>
    @endforelse
</div>
@endsection

@push('styles')
<style>
/* CARD */
.training-card {
    background: #008c95;
    color: #ffffff;
    border-radius: 22px;
    padding: 22px 20px;

    display: flex;
    flex-direction: column;
    height: 100%; /* KLJUČNO */
}

/* TITLE */
.training-title {
    font-size: 20px;
    font-weight: 700;
    font-style: italic;
    margin-bottom: 8px;
    text-align: center;
}

/* DESCRIPTION */
.training-desc {
    font-size: 14px;
    opacity: 0.9;
    border-bottom: 1px solid rgba(255,255,255,0.5);
    padding-bottom: 6px;
    margin-bottom: 12px;
    text-align: center;
}

/* INFO */
.training-info {
    font-size: 14px;
    text-align: left;
    margin-top: auto;
}

.training-info div {
    display: flex;
    gap: 6px;
    margin-bottom: 6px;
}

.training-info strong {
    font-weight: 600;
}

/* BUTTONS */
.btn-sm {
    padding: 4px 10px;
    font-size: 0.8rem;
}

.training-card .btn-warning,
.training-card .btn-danger {
    background: #006f77;
    border: none;
    border-radius: 14px;
    color: #ffffff;
    font-size: 13px;
    padding: 6px 14px;
}

.training-card .btn-warning:hover,
.training-card .btn-danger:hover {
    background: #005c63;
    color: #ffffff;
}

.training-card .d-flex.justify-content-between {
    gap: 10px;
}
</style>
@endpush
