@extends('layouts.admin')

@section('title', 'Praćenje napretka')
@section('page-title', 'Praćenje napretka')
@section('subheader-title', 'Prikaz svih zaposlenih')

@section('content')

<div class="table-wrapper">
    <table class="custom-table">
        <thead>
            <tr>
                <th>Zaposleni</th>
                <th>Email</th>
                <th>Praćenje napretka</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tests as $test)
                <tr>
                    <td class="text-center">
                        {{ $test->prijava->user->name ?? 'N/A' }}
                    </td>
                    <td class="text-center">
                        {{ $test->prijava->user->email ?? 'N/A' }}
                    </td>
                    <td class="text-center">
                        <a href="{{ route('tests.show', $test->id) }}" class="btn-show">
                            Prikaži
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">
                        Nema dostupnih testova.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection

@push('styles')
<style>
    .page-heading {
        font-size: 26px;
        font-weight: 700;
        margin-bottom: 24px;
        color: #0a5d63;
    }

    .table-wrapper {
        background: #ffffff;
        border-radius: 22px;
        padding: 24px;
        max-width: 900px;
    }

    .custom-table {
        width: 100%;
        border-collapse: collapse;
    }

    .custom-table thead th {
        text-align: center; /* Centrirano horizontalno */
        vertical-align: middle; /* Centrirano vertikalno */
        padding: 12px 0;
        border-bottom: 2px solid #e0e0e0;
        color: #0a5d63;
        font-weight: 600;
    }

    .custom-table tbody td {
        text-align: center; /* Centrirano horizontalno */
        vertical-align: middle; /* Centrirano vertikalno */
        padding: 14px 0;
        border-bottom: 1px solid #e0e0e0;
        color: #0a5d63;
    }

    .custom-table tbody tr:last-child td {
        border-bottom: none;
    }

    .btn-show {
        background: #008c95;
        color: #ffffff;
        padding: 6px 14px;
        border-radius: 20px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        transition: background 0.2s ease;
        display: inline-block;
    }

    .btn-show:hover {
        background: #007079;
    }

    .text-center {
        text-align: center;
        color: #777;
        padding: 20px 0;
    }
</style>
@endpush
