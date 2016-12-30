<?php

namespace App\Http\Controllers;


use App\Task;
use App\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return response()->json(User::simplePaginate(15));
    }

    /**
     * Display a listing  of the resource.
     *
     * @return Response
     */
    public function user_tasks($id)
    {
        try {

            $user = User::find($id);

            if (!$user) {

                return response()->json([
                    'message' => 'There is no user with the specified parameters.',
                    'error' => "failure"
                ], 400);
            }

            $this->authorize('user_tasks', $user);

            return response()->json($user->tasks()->simplePaginate(10));


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
    public function assign_task($task_id, $user_id)
    {
        try {

            $user = User::find($user_id);

            if (!$user) {

                return response()->json([
                    'message' => 'There is no user with the specified parameters.',
                    'error' => "failure"
                ], 400);
            }

            $this->authorize('assign_task', $user);

            $task = Task::find($task_id);


            if (!$task) {

                return response()->json([
                    'message' => 'There is no task with the specified parameters.',
                    'error' => "failure"
                ], 400);
            }


            $user->tasks()->sync($task->id);

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
                'lastname' => 'required|string|max:255',
                'firstname' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|min:6',
            );
            $this->validate(Request::instance(), $rules);

            $this->authorize('create', User::class);

            $user = new User();
            $user->email = Input::get('email');
            $user->firstname = Input::get('firstname');
            $user->password = app('hash')->make(Input::get('password'));
            $user->lastname = Input::get('lastname');
            $user->save();

            return response()->json($user);


        } catch (\Exception $e) {
            return response()->json([
                'message' => 'User not create',
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
            $user = User::find($id);
            if (!$user) {

                return response()->json([
                    'message' => 'There is no user with the specified parameters.',
                    'error' => "failure"
                ], 400);
            }

            $this->authorize('show', $user);
            return response()->json($user);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'User not show',
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
                'lastname' => 'required|string|max:255',
                'firstname' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique',
                'password' => 'required|min:6',
            );
            $this->validate(Request::instance(), $rules);

            $user = User::find($id);

            if (!$user) {

                return response()->json([
                    'message' => 'There is no user with the specified parameters.',
                    'error' => "failure"
                ], 400);
            }

            $this->authorize('update', $user);


            $user->email = Input::get('email');
            $user->firstname = Input::get('firstname');
            $user->lastname = Input::get('lastname');
            $user->save();

            return response()->json($user);


        } catch (\Exception $e) {
            return response()->json([
                'message' => 'User not create',
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

            $user = User::find($id);

            if (!$user) {

                return response()->json([
                    'message' => 'There is no user with the specified parameters.',
                    'error' => "failure"
                ], 400);
            }

            $this->authorize('destroy', $user);

            $user->delete();

            return response()->json([
                'message' => 'User delete',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'User not create',
                'error' => $e->getMessage()
            ], 400);
        }
    }

}

?>