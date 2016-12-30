<?php

namespace App\Http\Controllers;

use App\Priority;
use App\Task;
use App\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;

class TaskController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return response()->json(Task::simplePaginate(15));
    }

    /**
     * Display a listing  of the resource.
     *
     * @return Response
     */
    public function task_users($id)
    {
        try {

            $task = Task::find($id);

            if (!$task) {

                return response()->json([
                    'message' => 'There is no user with the specified parameters.',
                    'error' => "failure"
                ], 400);
            }

            $this->authorize('task_users', $task);

            return response()->json($task->users()->simplePaginate(10));


        } catch (\Exception $e) {
            return response()->json([
                'message' => 'User not show',
                'error' => $e->getMessage()
            ], 400);
        }
    }


    /**
     * @return Response msg.
     */
    public function assign_user($task_id, $user_id)
    {
        try {

            $user = User::find($user_id);

            if (!$user) {

                return response()->json([
                    'message' => 'There is no user with the specified parameters.',
                    'error' => "failure"
                ], 400);
            }

            $this->authorize('assign_user', $user);

            $task = Task::find($task_id);

            if (!$task) {

                return response()->json([
                    'message' => 'There is no task with the specified parameters.',
                    'error' => "failure"
                ], 400);
            }

            $task->users()->attach($user_id);

            return response()->json([
                'message' => 'Task assing',
            ], 200);


        } catch (\Exception $e) {
            return response()->json([
                'message' => 'User not show',
                'error' => $e->getMessage()
            ], 400);
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        try {
            $rules = array(
                'title' => 'required|max:60',
                'description' => 'required|max:255',
                'due_date' => 'required',
                'priority_id' => 'required',
            );
            $this->validate(Request::instance(), $rules);

            $this->authorize('create', Task::class);

            $task = new Task();

            $priority = Priority::find(Input::get('priority_id', ''));
            if ($priority) {
                $task->priorities()->associate($priority);
            }

            $task->title = Input::get('title');
            $task->description = Input::get('description');
            $task->due_date = Input::get('due_date');
            $task->save();

            return response()->json($task);


        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Task not create',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        try {

            $task = Task::find($id);

            if (!$task) {
                return response()->json([
                    'message' => 'There is no task with the specified parameters.',
                    'error' => "failure"
                ], 400);
            }

            $this->authorize('show', $task);

            return response()->json($task);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'task not show',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        try {
            $rules = array(
                'title' => 'required|max:60',
                'description' => 'required|string|max:255',
                'due_date' => 'required',
                'priority_id' => 'required',
            );
            $this->validate(Request::instance(), $rules);

            $this->authorize('update', Task::class);

            $task = Task::find($id);

            if (!$task) {
                return response()->json([
                    'message' => 'There is no task with the specified parameters.',
                    'error' => "failure"
                ], 400);
            }

            $priority = Priority::find(Input::get('priority_id', ''));
            if ($priority) {
                $task->priorities()->associate($priority);
            }

            $task->title = Input::get('title');
            $task->description = Input::get('description');
            $task->due_date = Input::get('due_date');
            $task->save();

            return response()->json($task);


        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Task not create',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        try {

            $task = Task::find($id);

            if (!$task) {

                return response()->json([
                    'message' => 'There is no task with the specified parameters.',
                    'error' => "failure"
                ], 400);
            }

            $this->authorize('destroy', $task);

            $task->delete();

            return response()->json([
                'message' => 'Task delete',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Task not create',
                'error' => $e->getMessage()
            ], 400);
        }
    }

}

?>