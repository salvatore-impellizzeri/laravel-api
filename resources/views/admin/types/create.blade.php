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

<form action="{{ route('admin.types.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Nome: <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Inserisci il nome del genere..." required>
    </div>
        
    <button type="submit" class="btn btn-primary">Aggiungi</button>

</form>

@endsection