@extends('layouts.app')

@section('main-title', 'Tutti i generi')

@section('main-content')

<table class="table table-hover">
    <a href="{{ route('admin.types.create') }}" class="w-100 btn btn-success my-3">
        Aggiungi
    </a>
    @foreach ($types as $type)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">
                    {{ $type->name }}
                </h5>
                <div class="d-flex gap-2 mt-4">
                    <a href="{{ route('admin.types.edit', ['type' => $type->id]) }}" class="btn btn-primary">
                        Modifica
                    </a>
                    <form action="{{ route('admin.types.destroy', $type->id) }}" method="POST" onsubmit="return confirm('Sei sicuro?')">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">
                            Elimina
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
        
      
    </tbody>
  </table>

@endsection