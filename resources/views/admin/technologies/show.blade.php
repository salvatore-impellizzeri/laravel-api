@extends('layouts.app')

@section('main-content')

<table class="table table-hover">
    <tbody>
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">
                    {{ $technology->name }}
                </h5>
                <div class="d-flex gap-2 mt-4">
                    <a href="{{ route('admin.technologies.edit', ['technology' => $technology->id]) }}" class="btn btn-primary">
                        Modifica
                    </a>
                    <form action="{{ route('admin.technologies.destroy', $technology->id) }}" method="POST" onsubmit="return confirm('Sei sicuro?')">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">
                            Elimina
                        </button>
                    </form>
                </div>
            </div>
        </div>  
    </tbody>
</table>

@endsection