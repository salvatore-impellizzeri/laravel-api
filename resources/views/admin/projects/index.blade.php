@extends('layouts.app')

@section('main-title', 'Tutti i progetti')

@section('main-content')

<a href="{{ route('admin.projects.create') }}" class="w-100 btn btn-success my-3">
    Aggiungi
</a>

@foreach ($projects as $project)
    <div class="card mb-3">
        <img src="{{ $project->src }}" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">
                {{ $project->title }}
            </h5>
            <p class="card-text">
                {{ $project->description }}
            </p>
            <p class="card-text">
                @if (isset($project->type))
                    {{ $project->type->name }}
                @else
                    -
                @endif
            </p>
            <p class="card-text">
                @forelse($project->technologies as $technology)
                    <a href="{{ route('admin.technologies.show', ['technology' => $technology->id]) }}" class="badge rounded-pill text-bg-primary">
                        {{ $technology->name }}
                    </a>
                @empty
                    -
                @endforelse
            </p>
            <p class="card-text">
                <small class="text-body-secondary">
                    @if($project->visible == true)
                        Pubblicato
                    @else
                        Privato
                    @endif
                </small>
            </p>
            <div class="d-flex gap-2 mt-4">
                <a href="{{ route('admin.projects.edit', ['project' => $project->id]) }}" class="btn btn-primary">
                    Modifica
                </a>
                <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Sei sicuro?')">
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

@endsection
