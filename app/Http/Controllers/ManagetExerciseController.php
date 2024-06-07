<?php

namespace App\Http\Controllers;

use App\Http\Requests\ManagetExerciseRequest;
use App\Models\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ManagetExerciseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exercises = Exercise::getAllExercises();

        return view('docente.manageExercises.index', ['exercises' => $exercises]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('docente.manageExercises.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ManagetExerciseRequest $request)
    {
        $exercise = new Exercise();
        $exercise->desc = $request->desc;
        $exercise->docente_id = auth()->user()->id;
        $exercise->access_code = Str::random(6);

        $exercise->save();

        return redirect()->route('exercise.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $exercise = Exercise::getExerciseById($id);
        return view('docente.manageExercises.show', ['exercise' => $exercise]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exercise $exercise)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exercise $exercise)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exercise $exercise)
    {
        //
    }
}