<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    public function index(): View
    {
        return view('profile.index', [
            'user' => Auth::user(),
        ]);
    }

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi input dari form
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'string', 'max:255', 'unique:users,email,' . Auth::id()],
            'current_password' => 'required|string',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Mendapatkan pengguna yang sedang login
        $user = Auth::user();

        // Cek apakah password lama sesuai
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Password lama tidak sesuai']);
        }

        // Mengupdate data pengguna
        $user->name = $request->name;
        $user->email = $request->email;

        // Jika password baru tidak kosong, update password
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Redirect dengan status berhasil
        return redirect('/profil')->with("status", "Data berhasil diperbarui");
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
