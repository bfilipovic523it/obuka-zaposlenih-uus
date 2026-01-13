@extends('layouts.zaposleni')

@section('title', 'Moje obuke')
@section('page-title', 'Moje obuke')

@section('subheader-title')
    Prikaz obuka na koje ste prijavljeni
@endsection

@section('content')
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">

    @forelse ($prijave as $prijava)
        <div class="col mb-4">
            <div class="obuka-card text-center">

                <!-- HEADER -->
                <div class="obuka-header">
                    <h3>{{ $prijava->obuka->naziv }}</h3>
                </div>

                <div class="divider"></div>

                <!-- DETAILS -->
                <div class="obuka-details">
                    <p>
                        <strong>Datum prijave:</strong>
                        {{ \Carbon\Carbon::parse($prijava->datum)->format('d.m.Y.') }}
                    </p>

                    <p>
                        <strong>Status:</strong>
                        {{ ucfirst($prijava->status) }}
                    </p>
                </div>

                <div class="divider"></div>

                <!-- ACTIONS -->
                <div class="obuka-actions">
                    @if ($prijava->status === 'Zavrsena')
                        <a href="{{ route('zaposleni.moje_obuke', $prijava->id) }}"
                           class="btn-card">
                            Preuzmi sertifikat
                        </a>
                    @else
                        <span class="status-badge">
                            Obuka u toku
                        </span>
                    @endif
                </div>

            </div>
        </div>
    @empty
        <div class="col-12 text-center py-5">
            <p>Trenutno niste prijavljeni ni na jednu obuku.</p>
        </div>
    @endforelse

</div>
@endsection

@push('styles')
<style>
/* CARD */
.obuka-card {
    background: #008c95;
    color: #ffffff;
    border-radius: 22px;
    padding: 22px 20px;

    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

/* HEADER */
.obuka-header h3 {
    font-size: 22px;
    font-style: italic;
    font-weight: 700;
    margin-bottom: 0;
}

/* DIVIDER */
.divider {
    height: 1px;
    background: rgba(255,255,255,0.35);
    margin: 14px 0;
}

/* DETAILS */
.obuka-details {
    text-align: left;
    font-size: 14px;
}

.obuka-details p {
    margin: 4px 0;
}

/* ACTIONS */
.obuka-actions {
    text-align: center;
}

/* BUTTON */
.btn-card {
    background: #006d74;
    color: #ffffff;
    border-radius: 14px;
    padding: 10px 14px;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    display: inline-block;
}

.btn-card:hover {
    background: #00565c;
}

/* STATUS */
.status-badge {
    display: inline-block;
    background: #004f55;
    padding: 10px 18px;
    border-radius: 14px;
    font-size: 13px;
    font-weight: 600;
}
</style>
@endpush
