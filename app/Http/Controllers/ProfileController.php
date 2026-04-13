<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Tampilkan form pengaturan profil.
     */
    public function edit(Request $request)
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Memperbarui profil pengguna.
     */
    public function update(Request $request)
    {
        $user = $request->user();

        // Validasi data
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['nullable', 'string', 'max:255', 'alpha_dash', Rule::unique('users')->ignore($user->id)],
            'bio' => ['nullable', 'string', 'max:500'],
            'avatar_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:10240'],
        ]);

        // Proses unggahan foto profil (opsional)
        if ($request->hasFile('avatar_file')) {
            // Hapus avatar lokal yang lama jika ada (dan bukan gambar URL/Google/UI Avatar)
            if ($user->avatar && !str_starts_with($user->avatar, 'http')) {
                // Menyamakan "public/storage/" ke direktori aslinya
                $oldPath = str_replace('/storage/', '', $user->avatar);
                Storage::disk('public')->delete($oldPath);
            }

            // Simpan file gambar baru
            $path = $request->file('avatar_file')->store('avatars', 'public');
            
            // Perbarui URL avatar untuk database
            $user->avatar = '/storage/' . $path;
        }

        // Perbarui atribut lainnya
        $user->name = $request->name;
        $user->username = $request->username;
        $user->bio = $request->bio;
        
        $user->save();

        return back()->with('status', 'Profil berhasil diperbarui!');
    }
}
