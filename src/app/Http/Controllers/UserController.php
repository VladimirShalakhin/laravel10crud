<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserCreateRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function store(UserCreateRequest $request): JsonResponse
    {
        if ($request->hasFile('avatar')) {
            $fileName = $request->file('avatar')->getFilename();
            $request->avatar->move(public_path('avatars'), $fileName.'.'.$request->file('avatar')->Extension());
            User::create([
                'first_name' => $request->safe()->input('first_name'),
                'surname' => $request->safe()->input('surname'),
                'phone_number' => $request->safe()->input('phone_number'),
                'avatar' => $fileName,
            ]);
        } else {
            User::create($request->safe()->input());
        }

        return response()->json();
    }

    public function update(User $user, UserUpdateRequest $request): JsonResponse
    {
        if ($request->hasFile('avatar')) {
            Storage::delete($user->avatar);
            $fileName = $request->file('avatar')->getFilename();
            $request->avatar->move(public_path('avatars'), $fileName.'.'.$request->file('avatar')->Extension());
            $user->update([
                'first_name' => $request->safe()->input('first_name'),
                'surname' => $request->safe()->input('surname'),
                'phone_number' => $request->safe()->input('phone_number'),
                'avatar' => $fileName,
            ]);
        } else {
            $user->update($request->safe()->input());
        }

        return response()->json();
    }

    public function destroy(User $user): JsonResponse
    {
        $user->delete();

        return response()->json();
    }
}
