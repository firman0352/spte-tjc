<?php

namespace App\Http\Controllers;

use App\Models\Inspektur;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Jabatan;
use App\Models\Role;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;


class InspekturController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {    
        $inspekturs = Inspektur::join('users', 'users.id', '=', 'inspekturs.user_id')
        ->join('jabatans', 'jabatans.id', '=', 'inspekturs.jabatan_id')
        ->select('users.name', 'users.email', 'jabatans.jabatan', 'inspekturs.*')
        ->get();

    return view('inspektur.index', compact('inspekturs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('inspektur.create', [
            'jabatan' => Jabatan::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'jabatan' => ['required', 'exists:jabatans,id'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => 3,
            'password' => Hash::make($request->password),
        ]);

        Inspektur::create([
            'user_id' => $user->id,
            'jabatan_id' => $request->jabatan,
        ]);

        return redirect()->route('inspektur.index')->with('success', 'Inspektur berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inspektur $inspektur)
    {
        $jabatan = Jabatan::select('jabatan', 'id')->get();

        return view ('inspektur.edit', [
            'inspektur' => $inspektur,
            'jabatan' => $jabatan,
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inspektur $inspektur)
    {
        $validated = $request->validate([
            'jabatan' => ['required', 'exists:jabatans,id'],
        ]);

        $inspektur->update([
            'jabatan_id' => $request->input('jabatan'),
        ]);

        return redirect()->route('inspektur.index')->with('success', 'Inspektur berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inspektur $inspektur)
    {
        $inspektur->user()->delete();


        return redirect()->route('inspektur.index')->with('success', 'Inspektur berhasil dihapus');
    }
}
