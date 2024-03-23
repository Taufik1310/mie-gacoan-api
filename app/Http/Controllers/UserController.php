<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Show the currently authenticated user.
     */
    public function show(): UserResource
    {
        return new UserResource(Auth::user());
    }

    /**
     * Update the currently authenticated user.
     */
    public function update(UpdateUserRequest $request)
    {
        $user = $request->user();

        $userData = $request->validated();

        if ($user->isDirty('email')) {
            $userData['email_verified_at'] = null;
            $user->sendEmailVerificationNotification();
        }

        $user->update($userData);

        return
            new UserResource($user->fresh());
    }

    /**
     * Update the password of the currently authenticated user.
     */
    public function changePassword(Request $request): JsonResponse
    {
        // Validasi permintaan
        $data = $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()]
        ]);

        // Perbarui password pengguna
        $request->user()->update([
            'password' => Hash::make($data['password'])
        ]);

        // Respon sukses
        return response()->json([
            'status' => 'Password updated.'
        ]);
    }
}
