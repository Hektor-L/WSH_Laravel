<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function index()
    {
        return view('profile.edit');
    }
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        try {
            //Armazena a atualização da post.
            $request->user()->name = $request->input('name');
            $request->user()->email = $request->input('email');
            $request->user()->birth_date = $request->input('birth_date');
            $request->user()->description = $request->input('description');
            if($request->file('image') != null) {
            $request->user()->profile_picture_path = $request->file('image') ?->store('profile_pictures', 'public');
            }
            if ($request->user()->isDirty('email')) {
                $request->user()->email_verified_at = null;
            }
            $request->user()->save();
            //mensagem de êxito.
            session()->flash('msg', 'Atualizado com sucesso!');
            return Redirect::route('profile.edit')->with('status', 'profile-updated');
            //Mensagem de erro.
        } catch (\Exception $e) {
            session()->flash('error', 'Erro ao atualizar: ' . $e->getMessage());
            return Redirect::route('profile.edit');
        }
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

        $user->comments()->forceDelete();
        $user->posts()->forceDelete();
        $user->forceDelete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
