@extends('layouts.app')

@section('content')
    <form action="{{ route('admin.ticket.update', $ticket) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Titolo (Disabilitato) -->
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingTitle" name="title" placeholder="Titolo"
                value="{{ old('title', $ticket->title) }}" disabled>
            <label for="floatingTitle">Titolo</label>
            <!-- Campo nascosto per inviare il valore -->
            <input type="hidden" name="title" value="{{ $ticket->title }}">
        </div>

        <!-- Descrizione (Disabilitato) -->
        <div class="form-floating mb-3">
            <textarea class="form-control" placeholder="Descrizione" id="floatingDescription" name="description" disabled>{{ old('description', $ticket->description) }}</textarea>
            <label for="floatingDescription">Descrizione</label>
            <!-- Campo nascosto per inviare il valore -->
            <input type="hidden" name="description" value="{{ $ticket->description }}">
        </div>

        <!-- Operatore (Disabilitato) -->
        <div class="form-floating mb-3">
            <select class="form-select" id="floatingOperator" name="operator_id" disabled>
                @foreach ($operators as $operator)
                    <option value="{{ $operator->id }}"
                        {{ old('operator_id', $ticket->operator_id) == $operator->id ? 'selected' : '' }}>
                        {{ $operator->name }}
                    </option>
                @endforeach
            </select>
            <label for="floatingOperator">A quale operatore vuoi assegnare questo ticket?</label>
            <!-- Campo nascosto per inviare il valore -->
            <input type="hidden" name="operator_id" value="{{ $ticket->operator_id }}">
        </div>

        <!-- Categoria (Disabilitato) -->
        <div class="form-floating mb-3">
            <select class="form-select" id="floatingCategory" name="category_id" disabled>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id', $ticket->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            <label for="floatingCategory">A quale categoria fa parte questo ticket?</label>
            <!-- Campo nascosto per inviare il valore -->
            <input type="hidden" name="category_id" value="{{ $ticket->category_id }}">
        </div>

        <!-- Stato (Abilitato) -->
        <div class="mb-3">
            <label class="form-label">Stato</label>
            <div class="form-check">
                <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status"
                    id="statusAssigned" value="Assegnato"
                    {{ old('status', $ticket->status) == 'Assegnato' ? 'checked' : '' }}>
                <label class="form-check-label" for="statusAssigned">
                    Assegnato
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status"
                    id="statusInProgress" value="In lavorazione"
                    {{ old('status', $ticket->status) == 'In lavorazione' ? 'checked' : '' }}>
                <label class="form-check-label" for="statusInProgress">
                    In lavorazione
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status"
                    id="statusClosed" value="Chiuso" {{ old('status', $ticket->status) == 'Chiuso' ? 'checked' : '' }}>
                <label class="form-check-label" for="statusClosed">
                    Chiuso
                </label>
            </div>
            @error('status')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Aggiorna</button>
    </form>
@endsection
