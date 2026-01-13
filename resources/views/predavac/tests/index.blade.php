@extends('layouts.predavac')

@section('title', 'Praćenje napretka')
@section('page-title', 'Praćenje napretka')

@section('subheader-title')
    Prikaz svih zaposlenih
@endsection

@section('content')
<div class="row">
    <div class="col-auto">

        <div class="card-progress p-4">
            <table class="progress-table">
                <thead>
                    <tr>
                        <th>Zaposleni</th>
                        <th>Email</th>
                        <th class="text-center">Praćenje napretka</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tests as $test)
                        <tr>
                            <td>
                                {{ $test->prijava->user->name ?? '-' }}
                            </td>

                            <td>
                                {{ $test->prijava->user->email ?? '-' }}
                            </td>

                            <td class="text-center">
                                <a href="{{ route('predavac.tests.show', $test->id) }}"
                                   class="btn-prikazi">
                                    Prikaži
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-4">
                                Nema dostupnih testova.
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
.card-progress {
    background: #ffffff;
    border-radius: 22px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.05);
}

/* TABLE */
.progress-table {
    border-collapse: collapse;
}

.progress-table th {
    text-align: left;
    font-weight: 600;
    padding: 0 40px 12px 0;
    color: #0a6c74;
    border-bottom: 2px solid #e6e6e6;
}

.progress-table td {
    padding: 14px 40px 14px 0;
    color: #008c95;
    border-bottom: 1px solid #e6e6e6;
    vertical-align: middle;
}

.progress-table td.text-center,
.progress-table th.text-center {
    text-align: center;
    padding-right: 0;
}

/* BUTTON — IDENTIČAN KAO NA SLICI */
.btn-prikazi {
    display: inline-block;
    background-color: #008c95;
    color: #ffffff;
    padding: 6px 16px;
    border-radius: 18px;
    font-size: 13px;
    font-weight: 500;
    text-decoration: none;
}

.btn-prikazi:hover {
    background-color: #00757d;
    color: #ffffff;
}
</style>
@endpush
