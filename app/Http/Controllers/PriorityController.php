<?php

namespace App\Http\Controllers;

use App\Priority;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;

class PriorityController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return response()->json(Priority::simplePaginate(15));
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
                'name' => 'required|max:60'
            );
            $this->validate(Request::instance(), $rules);

            $this->authorize('create', Priority::class);

            $priority = new Priority();
            $priority->description = Input::get('description', '');
            $priority->name = Input::get('name');
            $priority->save();

            return response()->json($priority);


        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Priority not create',
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
            $priority = Priority::find($id);
            if (!$priority) {

                return response()->json([
                    'message' => 'There is no task with the specified parameters.',
                    'error' => "failure"
                ], 400);
            }

            $this->authorize('show', $priority);

            return response()->json($priority);
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
                'name' => 'required|max:60'
            );
            $this->validate(Request::instance(), $rules);

            $priority = Priority::find($id);

            if (!$priority) {

                return response()->json([
                    'message' => 'There is no priority with the specified parameters.',
                    'error' => "failure"
                ], 400);
            }

            $this->authorize('create', Priority::class);

            $priority->description = Input::get('description', '');
            $priority->name = Input::get('name');
            $priority->save();

            return response()->json($priority);


        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Priority not create',
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
            $priority = Priority::find($id);

            if (!$priority) {

                return response()->json([
                    'message' => 'There is no priority with the specified parameters.',
                    'error' => "failure"
                ], 400);
            }

            $this->authorize('destroy', $priority);

            $priority->delete();

            return response()->json([
                'message' => 'Priority delete',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Priority not create',
                'error' => $e->getMessage()
            ], 400);
        }
    }

}

?>