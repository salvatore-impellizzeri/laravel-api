<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('technologies', 'type')->paginate(6); 

        return response()->json([
            'success' => true,
            'code' => 200,
            'message' => 'OK',
            'projects' => $projects 
        ]);
    }

    public function show(string $slug)
    {
        $project = Project::where('slug', $slug)->first();

        if ($project) {
            return response()->json([
                'success' => true,
                'code' => 200,
                'message' => 'OK',
                'project' => $project 
            ]);
        }

        return response()->json([
            'success' => false,
            'code' => 404,
            'message' => 'Project not found'
        ], 404);
    }
}
