@extends('layouts.app')

@section('content')
    <form action="{{ route('admin.ticket.store') }}" method="POST">
        @csrf

        <div class="form-floating mb-3">
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="floatingTitle" name="title"
                placeholder="Titolo" value="{{ old('title') }}">
            <label for="floatingTitle">Titolo</label>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <textarea class="form-control @error('description') is-invalid @enderror" placeholder="Descrizione"
                id="floatingDescription" name="description">{{ old('description') }}</textarea>
            <label for="floatingDescription">Descrizione</label>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <select class="form-select @error('operator_id') is-invalid @enderror" id="floatingOperator" name="operator_id">
                <option selected disabled>Seleziona un operatore</option>
                @foreach ($operators as $operator)
                    <option value="{{ $operator->id }}" {{ old('operator_id') == $operator->id ? 'selected' : '' }}>
                        {{ $operator->name }}
                    </option>
                @endforeach
            </select>
            <label for="floatingOperator">A quale operatore vuoi assegnare questo ticket?</label>
            @error('operator_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <select class="form-select @error('category_id') is-invalid @enderror" id="floatingCategory" name="category_id">
                <option selected disabled>Seleziona una categoria</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            <label for="floatingCategory">A quale categoria fa parte questo ticket?</label>
            @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Stato</label>
            <div class="form-check">
                <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status"
                    id="statusAssigned" value="Assegnato" {{ old('status') == 'Assegnato' ? 'checked' : '' }}>
                <label class="form-check-label" for="statusAssigned">
                    Assegnato
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status"
                    id="statusInProgress" value="In lavorazione" {{ old('status') == 'In lavorazione' ? 'checked' : '' }}>
                <label class="form-check-label" for="statusInProgress">
                    In lavorazione
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status"
                    id="statusClosed" value="Chiuso" {{ old('status') == 'Chiuso' ? 'checked' : '' }}>
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


        <button type="submit" class="btn btn-primary">Crea</button>
    </form>
@endsection
