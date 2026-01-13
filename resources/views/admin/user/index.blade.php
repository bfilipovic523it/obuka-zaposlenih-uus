@extends('layouts.admin')

@section('title', 'Korisnici')
@section('page-title', 'Korisnici')

@section('subheader-title')
    Prikaz svih korisnika
@endsection

@section('subheader-action')
    <a href="{{ route('users.create') }}" class="btn-add">
        Dodaj korisnika
    </a>
@endsection

@section('content')
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
    @forelse($users as $user)
        <div class="col mb-4">
            <div class="user-card text-center">

                <div class="user-header">
                    <h3>{{ $user->name }}</h3>
                    <p class="user-email">{{ $user->email }}</p>
                </div>

                <div class="divider"></div>

                <div class="user-details">
                    <p><strong>Sektor:</strong> {{ $user->sektor->naziv ?? '-' }}</p>
                    <p><strong>Uloga:</strong> {{ $user->uloga->naziv ?? '-' }}</p>
                </div>

                <div class="divider"></div>

                <div class="user-actions">
                    <a href="{{ route('users.edit', $user->id) }}" class="btn-card">
                        Izmeni korisnika
                    </a>

                    <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                          onsubmit="return confirm('Da li ste sigurni da želite da obrišete ovog korisnika?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-card danger">
                            Obriši korisnika
                        </button>
                    </form>
                </div>

            </div>
        </div>
    @empty
        <div class="col-12 text-center py-5">
            <p>Nema korisnika.</p>
        </div>
    @endforelse
</div>
@endsection

@push('styles')
<style>
/* CARD */
.user-card {
    background: #0b8f97;
    color: #fff;
    border-radius: 22px;
    padding: 22px 20px;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

/* HEADER */
.user-header h3 {
    font-size: 22px;
    font-style: italic;
    font-weight: 700;
    margin-bottom: 4px;
}

.user-email {
    font-size: 14px;
    text-decoration: underline;
    margin-bottom: 12px;
}

/* DIVIDER LINE */
.divider {
    height: 1px;
    background: #005157;
    margin: 12px 0;
    border-radius: 1px;
}

/* DETAILS */
.user-details {
    text-align: left;
    font-size: 15px;
}

.user-details p {
    margin: 4px 0;
}

.user-details strong {
    font-weight: 600;
}

/* ACTIONS */
.user-actions {
    display: flex;
    gap: 12px;
}

.btn-card {
    flex: 1;
    background: #006c73;
    color: #fff;
    border-radius: 14px;
    padding: 10px 12px;
    font-size: 14px;
    font-weight: 600;
    border: none;
    text-align: center;
    transition: 0.2s ease;
}

.btn-card:hover {
    background: #005a60;
    color: #fff;
}

.btn-card.danger {
    background: #005157;
}

.btn-card.danger:hover {
    background: #003e42;
}

.user-actions form {
    flex: 1;
}
</style>
@endpush
