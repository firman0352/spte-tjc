<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Database\QueryException;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jabatan = Jabatan::all();

        return view('jabatan.index', compact('jabatan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jabatan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['jabatan' => 'required']);

        Jabatan::create($request->all());

        return redirect()->route('jabatan.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jabatan $jabatan)
    {
        return view('jabatan.edit', compact('jabatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jabatan $jabatan)
    {
        $request->validate(['jabatan' => 'required']);

        $jabatan->update($request->all());

        return redirect()->route('jabatan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jabatan $jabatan)
    {
        try {
            $jabatan->delete();
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1451) {
                return redirect()->back()->with('error', 'Cannot delete inspektur because it is associated with other records.');
            }
        }

        $jabatan->delete();

        return redirect()->route('jabatan.index');
    }
}
