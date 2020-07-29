<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentsRequest;
use App\Models\Students;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try {
            return response()->json(Students::all(), 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StudentsRequest $request
     * @return JsonResponse
     */
    public function store(StudentsRequest $request)
    {
        DB::beginTransaction();
        try {
            $student = Students::create($request->all());
            DB::commit();
            return response()->json($student, 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return JsonResponse
     */
    public function show($id)
    {
        try {
            return response()->json(Students::findOrFail($id), 200);
        } catch (ModelNotFoundException $e) {
            return response()->json($e->getMessage(), 404);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function edit(Students $students)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StudentsRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function update(StudentsRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $student = Students::findOrFail($id);
            $student->fill($request->all())->save();
            DB::commit();
            return response()->json($student, 200);
        } catch (ModelNotFoundException $e) {
            DB::rollback();
            return response()->json($e->getMessage(), 404);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        try {
            $client = Students::findOrFail($id);
            $client->delete();
            return response()->json('success', 204);
        } catch (ModelNotFoundException $e) {
            DB::rollback();
            return response()->json($e->getMessage(), 404);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json($e->getMessage(), 500);
        }
    }
}
