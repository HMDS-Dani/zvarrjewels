<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Get all tasks for the logged in user
     */
    public function index()
    {
        // Only get tasks belonging to the logged in user
        $tasks = Task::where('user_id', Auth::id())->latest()->get();

        return response()->json([
            'success' => true,
            'data' => $tasks,
        ]);
    }

    /**
     * Get a specific task
     */
    public function show($id)
    {
        $task = Task::where('user_id', Auth::id())->find($id);

        if (! $task) {
            return response()->json([
                'success' => false,
                'message' => 'Task not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $task,
        ]);
    }

    /**
     * Create a new task for the logged in user
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:pending,completed',
        ]);

        // Attach logged in user id
        $validated['user_id'] = Auth::id();

        $task = Task::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Task created successfully',
            'data' => $task,
        ], 201);
    }

    /**
     * Update task status / details
     */
    public function update(Request $request, $id)
    {
        $task = Task::where('user_id', Auth::id())->find($id);

        if (! $task) {
            return response()->json([
                'success' => false,
                'message' => 'Task not found',
            ], 404);
        }

        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'status' => 'sometimes|in:pending,completed',
        ]);

        $task->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Task updated successfully',
            'data' => $task,
        ]);
    }

    /**
     * Delete a task
     */
    public function destroy($id)
    {
        $task = Task::where('user_id', Auth::id())->find($id);

        if (! $task) {
            return response()->json([
                'success' => false,
                'message' => 'Task not found',
            ], 404);
        }

        $task->delete();

        return response()->json([
            'success' => true,
            'message' => 'Task deleted successfully',
        ]);
    }
}
