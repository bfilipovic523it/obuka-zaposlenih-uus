@extends('layouts.predavac')

@section('title', 'Moje obuke')
@section('page-title', 'Moje obuke')

@section('subheader-title')
    Prikaz svih obuka predavača
@endsection

@section('content')
<div class="row">
    <div class="col-lg-10">

        <div class="trainer-card p-4">
            <table class="trainer-table w-100">
                <thead>
                    <tr>
                        <th class="text-center">Naziv</th>
                        <th class="text-center">Materijal</th>
                        <th class="text-center">Dodavanje materijala</th>
                        <th class="text-center">Uređivanje materijala</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($obukas as $obuka)
                        <tr>
                            <td class="text-center">
                                {{ $obuka->naziv }}
                            </td>

                            <td class="text-center">
                                {{ $obuka->materijal->naziv ?? 'Nema materijala' }}
                            </td>

                            <td class="text-center">
                                <a href="{{ route('materijals.create', $obuka->id) }}"
                                   class="btn-action">
                                    Dodaj materijal
                                </a>
                            </td>

                            <td class="text-center">
                                @if($obuka->materijal)
                                    <a href="{{ route('materijals.edit', $obuka->id) }}"
                                       class="btn-action">
                                        Uredi materijal
                                    </a>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4">
                                Nema obuka za prikaz.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection

@push('styles')
<style>
/* CARD */
.trainer-card {
    background: #ffffff;
    border-radius: 24px;
    box-shadow: 0 8px 24px rgba(0,0,0,0.06);
}

/* TABLE */
.trainer-table {
    border-collapse: collapse;
}

.trainer-table thead th {
    text-align: left;
    font-weight: 600;
    padding-bottom: 14px;
    color: #006d73;
    border-bottom: 2px solid #e6e6e6;
}

.trainer-table tbody td {
    padding: 16px 0;
    color: #008c95;
    border-bottom: 1px solid #e6e6e6;
}

.trainer-table tbody tr:last-child td {
    border-bottom: none;
}

/* BUTTON */
.btn-action {
    background: #008c95;
    color: #ffffff;
    padding: 6px 18px;
    border-radius: 20px;
    font-size: 14px;
    text-decoration: none;
    transition: background 0.2s ease;
}

.btn-action:hover {
    background: #006d73;
    color: #ffffff;
}

/* ALIGN */
.text-center {
    text-align: center;
}

.fw-semibold {
    font-weight: 600;
}

.text-muted {
    color: #9ca3af;
}
</style>
@endpush
