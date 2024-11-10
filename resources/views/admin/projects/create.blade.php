@extends('layouts.app')

@section('main-content')

@if ($errors->any())
    <div class="alert alert-danger mb-4">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>
                    {{ $error }}
                </li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.projects.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="title" class="form-label">Titolo: <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Inserisci il titolo del progetto..." required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Descrizione: <span class="text-danger">*</span></label>
        <textarea class="form-control" id="description" name="description" placeholder="Inserisci la descrizione del progetto..." required></textarea>
    </div>
    
    <div class="mb-3">
        <label for="src" class="form-label">Immagine:</label>
        <input type="textarea" class="form-control" id="src" name="src" placeholder="Inserisci un'immagine per il progetto...">
    </div>

    <div class="mb-3">
        <label for="type_id" class="form-label">Genere:</label>
        <select type="textarea" class="form-control" id="type_id" name="type_id" placeholder="Inserisci il genere per il progetto...">
            <option
            @if (old('type_id') == null)
                selected
            @endif value="">Selezionare un genere...</option>
            @foreach ($types as $type)
                <option 
                @if (old('type_id') == $type->id)
                    selected
                @endif value="{{ $type->id }}">{{ $type->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <div class="form-label" for="technology">Tecnologie:</div>
        @foreach ($technologies as $technology)
            <div class="me-4 d-inline-block">
                <input
                @if(in_array($technology->id, old('technologies', [])))
                    checked
                @endif
                type="checkbox" class="form-check-input" id="technology-{{ $technology->id }}" name="technologies[]" value="{{ $technology->id }}">
                <label for="technology-{{ $technology->id }}">
                    {{ $technology->name }}
                </label>
            </div>
        @endforeach
    </div>
    
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="visible" name="visible" value="0"       
        @if (old('published') !== null)
            checked
        @endif>
        <label class="form-check-label" for="visible">Pubblicato</label>
    </div>
        
    <button type="submit" class="btn btn-primary">Aggiungi</button>

</form>

@endsection