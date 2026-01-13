@extends('layouts.zaposleni')

@section('title', 'Dostupne obuke')
@section('page-title', 'Dostupne obuke')

@section('subheader-title')
    Prikaz svih dostupnih obuka
@endsection

@section('content')
<div class="row">
    <div class="col-12">

        <div class="obuke-wrapper">

            @forelse ($obuke as $obuka)
                <div class="obuka-card">

                    <h3 class="obuka-title">
                        {{ $obuka->naziv }}
                    </h3>

                    <p class="obuka-desc">
                        {{ $obuka->opis ?? 'Bez opisa obuke.' }}
                    </p>

                    <div class="obuka-dates">
                        <div>
                            <strong>Datum početka:</strong>
                            {{ \Carbon\Carbon::parse($obuka->datum_pocetka)->format('d.m.Y.') }}
                        </div>

                        <div>
                            <strong>Datum završetka:</strong>
                            {{ \Carbon\Carbon::parse($obuka->datum_zavrsetka)->format('d.m.Y.') }}
                        </div>
                    </div>

                    <hr class="divider">

                    <form action="{{ route('zaposleni.prijave.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="obuka_id" value="{{ $obuka->id }}">

                        <button type="submit" class="btn-prijava">
                            Prijavi se
                        </button>
                    </form>

                </div>
            @empty
                <div class="text-center py-5">
                    <p class="text-muted">
                        Trenutno nema dostupnih obuka za vaš sektor.
                    </p>
                </div>
            @endforelse

        </div>

    </div>
</div>
@endsection

@push('styles')
<style>
/* GRID */
.obuke-wrapper {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
    gap: 32px;
    max-width: 900px;
}

/* CARD */
.obuka-card {
    background: #008c95;
    color: #ffffff;
    border-radius: 22px;
    padding: 26px 22px;
    text-align: center;
}

/* TITLE */
.obuka-title {
    font-size: 22px;
    font-weight: 700;
    font-style: italic;
    margin-bottom: 12px;
}

/* DESCRIPTION */
.obuka-desc {
    font-size: 14px;
    opacity: 0.95;
    margin-bottom: 18px;
}

/* DATES */
.obuka-dates {
    font-size: 14px;
    text-align: left;
}

.obuka-dates div {
    margin-bottom: 6px;
}

/* DIVIDER */
.divider {
    margin: 18px 0;
    border: none;
    border-top: 1px solid rgba(255,255,255,0.35);
}

/* BUTTON */
.btn-prijava {
    background-color: #006d74;
    color: #ffffff;
    border: none;
    padding: 6px 22px;
    border-radius: 14px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.2s ease;
}

.btn-prijava:hover {
    background-color: #00565c;
}
</style>
@endpush
