@extends('layouts.admin')

@section('title', 'Praćenje napretka')
@section('page-title', 'Praćenje napretka')

@section('subheader-title')
    {{ $test->prijava->user->name }}
@endsection

@section('content')
<div class="row">
    <div class="col-md-10 col-lg-8">

        <div class="card-progress p-4">
            <table class="progress-table">
                <thead>
                    <tr>
                        <th>Obuka</th>
                        <th>Status</th>
                        <th>Ocena sa testa</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $test->obuka->naziv ?? '-' }}</td>
                        <td>{{ ucfirst($test->prijava->status) }}</td>
                        <td class="fw-bold">{{ $test->ocena ?? '-' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection

@push('styles')
<style>
.card-progress {
    background: #ffffff;
    border-radius: 20px;
    padding: 30px;
}

.progress-table {
    width: 100%;
    border-collapse: collapse;
    text-align: center;
}

.progress-table th {
    padding-bottom: 14px;
    font-weight: 600;
    color: #0a6c74;
    border-bottom: 2px solid #e6e6e6;
}

.progress-table td {
    padding: 16px 0;
    color: #008c95;
    border-bottom: 1px solid #e6e6e6;
}
</style>
@endpush