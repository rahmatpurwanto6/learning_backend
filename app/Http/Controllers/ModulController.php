<?php

namespace App\Http\Controllers;

use App\Models\Modul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ModulController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modul = Modul::all();
        return response()->json($modul);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kelas' => 'required',
            'deskripsi' => 'required',
            'no_modul' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        $modul = Modul::create($request->all());

        if ($modul) {
            return response()->json(['message' => 'Modul created successfully'], 201);
        } else {
            return response()->json(['message' => 'Failed to create modul', 'errors' => $modul->errors()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Modul  $modul
     * @return \Illuminate\Http\Response
     */
    public function show(Modul $modul)
    {
        $modul = Modul::find($modul->id);
        return response()->json($modul);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Modul  $modul
     * @return \Illuminate\Http\Response
     */
    public function edit(Modul $modul)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Modul  $modul
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Modul $modul)
    {
        $validator = Validator::make($request->all(), [
            'kelas' => 'required',
            'deskripsi' => 'required',
            'no_modul' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        $updated = $modul->update([
            'kelas' => $request->kelas,
            'deskripsi' => $request->deskripsi,
            'no_modul' => $request->no_modul,
        ]);

        if ($updated) {
            return response()->json(['message' => 'Modul updated successfully'], 200);
        } else {
            return response()->json(['message' => 'Failed to update modul'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Modul  $modul
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $modul = Modul::find($id);
        if ($modul) {
            $modul->delete();
            return response()->json(['message' => 'Modul deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Failed to delete modul', 'errors' => $modul->errors()], 500);
        }
    }
}
