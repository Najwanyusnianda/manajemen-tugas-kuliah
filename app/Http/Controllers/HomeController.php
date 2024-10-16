<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index(Request $request)
{
    // Retrieve only the projects belonging to the authenticated user
    $projects = Project::where('user_id', auth()->id())->get();
    
    // Retrieve all tasks, but filter tasks by the user's projects
    $tasks = Task::whereIn('project', $projects->pluck('id'))->get();

    // Get filters from request
    $projectFilter = $request->input('projectFilter', 0);
    $statusFilter = $request->input('statusFilter', '');

    // Apply filters if provided
    if ($projectFilter != 0 || $statusFilter != '') {
        $tasksFilter = [];

        // Apply project filter if not set to all
        if ($projectFilter != 'all') {
            $tasksFilter['project'] = $projectFilter;
        }

        // Apply status filter if not set to all
        if ($statusFilter != 'all') {
            $tasksFilter['is_completed'] = ($statusFilter == 'completed') ? 1 : 0;
        }

        // Get tasks with applied filters
        $tasks = Task::getAllTasksWithFilters($tasksFilter)->whereIn('project', $projects->pluck('id'));
    }

    // Return view with data
    return view('home.home')->with([
        'projects' => $projects,
        'tasks' => $tasks,
        'projectFilter' => $projectFilter,
        'statusFilter' => $statusFilter,
    ]);
}
}
