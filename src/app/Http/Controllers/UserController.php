<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPostRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function store(UserPostRequest $request): JsonResponse
    {
        if ($request->hasFile('avatar')) {
            $fileName = $request->file('avatar')->getFilename();
            $request->avatar->move(public_path('avatars'), $fileName.$request->file('avatar')->getExtension());
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
}
