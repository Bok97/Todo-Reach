<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ApiController;
use App\Http\Requests\TodoCreateRequest;
use App\Http\Requests\TodoUpdateRequest;
use App\Http\Resources\TodoCollection;
use App\Http\Resources\TodoResource;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = Auth::user()->todos;
        return $this->successResponse('Successfully retrieved todo list', new TodoCollection($todos));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TodoCreateRequest $request)
    {
        Todo::create([
            'text' => $request['text'],
            "user_id" => Auth::user()->id,
        ]);
        return $this->successResponseWithMessageOnly('Successfully created todo');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $todo = Auth::user()->todos->find($id);

        if ($todo) {
            return $this->successResponse('Successfully retrieved todo item', new TodoResource($todo));
        }
        return $this->notFoundResponse('Failed! no todo found.', true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TodoUpdateRequest $request, $id)
    {
        $todo = Auth::user()->todos->find($id);

        if ($todo) {
            $todo->update([
                'text' => $request['text'],
            ]);
            return $this->successResponse('Successfully updated text', new TodoResource($todo));
        }
        return $this->notFoundResponse('Failed! no todo found.', true);
    }

    public function updateCompleted($id)
    {
        $todo = Auth::user()->todos->find($id);

        if ($todo) {
            $isCompleted = $todo->completed ? 0 : 1;
            $todo->update([
                'completed' => $isCompleted,
            ]);
            return $this->successResponse('Todo Completed', new TodoResource($todo));
        }
        return $this->notFoundResponse('Failed! no todo found.', true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $todo = Auth::user()->todos->find($id);
        if ($todo) {
            $todo->delete();
            return $this->successResponseWithMessageOnly('Successfully removed todo item');
        }
        return $this->notFoundResponse('Failed! no todo found.', true);
    }
}
