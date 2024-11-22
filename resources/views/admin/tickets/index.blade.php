@extends('layouts.app')

@section('content')
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        @if (session('success'))
            <div id="deletedToast" class="toast show bg-toast" role="alert" aria-live="assertive" aria-atomic="true"
                data-bs-autohide="true" data-bs-delay="5000">
                <div class="toast-header">
                    <strong class="me-auto">Notifica</strong>
                    <small class="text-muted">Ora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ session('success') }}
                </div>
            </div>
        @endif
        @if (session('error'))
            <div id="deletedToast" class="toast show bg-toast" role="alert" aria-live="assertive" aria-atomic="true"
                data-bs-autohide="true" data-bs-delay="5000">
                <div class="toast-header">
                    <strong class="me-auto">Notifica</strong>
                    <small class="text-muted">Ora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ session('error') }}
                </div>
            </div>
        @endif
    </div>
    {{-- Filtro --}}
    <form method="GET" action="{{ route('admin.ticket.index') }}" class="mb-4">
        <div class="row g-3 align-items-center">
            <!-- Filtro Stato -->
            <div class="col-auto">
                <select name="status" class="form-select">
                    <option value="">Filtra per Stato</option>
                    <option value="Assegnato" {{ request('status') == 'Assegnato' ? 'selected' : '' }}>Assegnato</option>
                    <option value="In lavorazione" {{ request('status') == 'In lavorazione' ? 'selected' : '' }}>In
                        lavorazione</option>
                    <option value="Chiuso" {{ request('status') == 'Chiuso' ? 'selected' : '' }}>Chiuso</option>
                </select>
            </div>

            <!-- Filtro Categoria -->
            <div class="col-auto">
                <select name="category" class="form-select">
                    <option value="">Filtra per Categoria</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Pulsante Filtra -->
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Filtra</button>
            </div>
        </div>
    </form>
    <table class="table table-white table-hover">
        <thead>
            <tr>
                <th scope="col">Titolo</th>
                <th scope="col">Stato</th>
                <th scope="col">Categoria</th>
                <th scope="col">Data</th>
                <th scope="col">Azioni</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($tickets as $ticket)
                <tr class="align-middle">
                    <td>{{ $ticket->title }}</td>
                    <td>{{ $ticket->status }}</td>
                    <td>{{ $ticket->category->name }}</td>
                    <td>{{ $ticket->created_at }}</td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('admin.ticket.edit', $ticket) }}" role="button">Info</a>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $tickets->links('pagination::bootstrap-4') }}
    </div>

    {{-- Script per nascondere notifica toast dopo 5 secondi --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var toastElements = document.querySelectorAll('.toast');
            toastElements.forEach(function(toastElement) {
                var toast = new bootstrap.Toast(toastElement);
                toast.show(); // Mostra la Toast
            });
        });
    </script>
@endsection
