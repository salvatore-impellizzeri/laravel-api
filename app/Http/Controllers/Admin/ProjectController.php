<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with('technologies')->get(); // Eager loading delle tecnologie
        return view("admin.projects.index", compact("projects"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $technologies = Technology::all();
        $types = Type::all();
        return view("admin.projects.create", compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $request->validate([
            "title"=> "required|max:250",
            "description"=> "required|min:20|max:1000",
            "src"=> "nullable|max:2000|url",
            "visible"=> "nullable|in:1,0,true,false",
            'type_id' => 'nullable|exists:types,id',
        ]);

        $project = new Project();
        $project->title = $data["title"];
        $project->description = $data["description"];
        $project->src = $data["src"];
        $project->visible = $request->input('visible') == '1';
        $project->save();

        if (isset($data['technologies'])) {
            foreach ($data['technologies'] as $TechnologyId) {
                $project->technologies()->attach($TechnologyId); 
            }
        }

        return redirect()->route('admin.projects.show', ['project' => $project->id]); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all(); 
        return view('admin.projects.edit', compact('project', 'types', 'technologies')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $data = $request->all();

        $request->validate([
            "title"=> "required|max:250",
            "description"=> "required|min:20|max:1000",
            "src"=> "nullable|max:2000|url",
            "visible"=> "nullable|in:1,0,true,false",
            'type_id' => 'nullable|exists:types,id',
        ]);

        $project->title = $data["title"];
        $project->description = $data["description"];
        $project->src = $data["src"];
        $project->visible = $request->input('visible') == '1';

        $project->save(); // Usa save() invece di update()

        // Aggiorna le tecnologie
        if (isset($data['technologies'])) {
            $project->technologies()->sync($data['technologies']); // Sincronizza le tecnologie
        } else {
            $project->technologies()->sync([]); // Rimuovi le tecnologie se non ne sono state selezionate
        }

        return redirect()->route('admin.projects.show', ['project' => $project->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index');
    }
}
