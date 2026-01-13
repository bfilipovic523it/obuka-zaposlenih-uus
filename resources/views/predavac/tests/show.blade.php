@extends('layouts.predavac')

@section('title', 'Praćenje napretka')
@section('page-title', 'Praćenje napretka')

@section('subheader-title')
    {{ $test->prijava->user->name }}
@endsection

@section('content')
<div class="row">
    <div class="col-12">

        <div class="card-progress p-4">
            <table class="progress-table">
                <thead>
                    <tr>
                        <th>Obuka</th>
                        <th>Status</th>
                        <th class="text-center">Ocena sa testa</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            {{ $test->obuka->naziv ?? '-' }}
                        </td>

                        <td>
                            {{ ucfirst($test->prijava->status) }}
                        </td>

                        <td class="text-center fw-semibold">
                            {{ $test->ocena ?? '-' }}
                        </td>
                    </tr>
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
    max-width: 900px;
}

/* TABLE */
.progress-table {
    border-collapse: collapse;
    width: 100%;
}

.progress-table th {
    text-align: left;
    font-weight: 600;
    padding-bottom: 12px;
    color: #0a6c74;
    border-bottom: 2px solid #e6e6e6;
}

.progress-table td {
    padding: 14px 0;
    color: #008c95;
    border-bottom: 1px solid #e6e6e6;
    vertical-align: middle;
}

.progress-table td.text-center {
    text-align: center;
}
</style>
@endpush
