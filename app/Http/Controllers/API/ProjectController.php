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
        $projects = Project::with('technologies', 'type')->paginate(3);

        return response()->json([
            'success' => true,
            'code' => 200,
            'message' => 'OK',
            'data' => [
                'projects' => $projects
            ]
        ]);
    }

    public function show(string $slug)
    {
        $project = Project::where('slug', $slug)->first();

        return response()->json([
            'success' => true,
            'code' => 200,
            'message' => 'OK',
            'data' => [
                'projects' => $project
            ]
        ]);
    }
}
