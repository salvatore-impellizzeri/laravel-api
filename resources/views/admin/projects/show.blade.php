@extends('layouts.app')

@section('main-content')

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
            @if(isset($project->type))
                {{ $project->type->name }}
            @else
                Tipo non specificato
            @endif
        </p>
        <p class="card-text">
            @if ($project->technologies()->count() > 0)
                @foreach ($project->technologies as $technology)
                    <a href="{{ route('admin.technologies.show', ['technology' => $technology->id]) }}" class="badge rounded-pill text-bg-primary">
                        {{ $technology->name }}
                    </a>
                @endforeach
        @else
            -
        @endif
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

@endsection
