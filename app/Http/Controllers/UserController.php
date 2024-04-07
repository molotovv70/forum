<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Intervention\Image\Laravel\Facades\Image;

class UserController extends Controller
{
    public function personal()
    {
        $user = UserResource::make(auth()->user())->resolve();
        return Inertia::render('User/Personal', ['user' => $user]);
    }

    public function update(UpdateRequest $request)
    {
        $data = $request->validated();

        $path = Storage::disk('public')->put('/avatars', $data['avatar']);

        if (auth()->user()->avatar) {
            Storage::disk('public')->delete(auth()->user()->avatar);
        }

        $fullPathURL = Storage::url($path);
        $fullPathURL = Str::ltrim($fullPathURL, $fullPathURL[0]);

        auth()->user()->update([
            'avatar' => $path
        ]);

        Image::read($fullPathURL)->resize(100, 100)->save();

        return UserResource::make(auth()->user())->resolve();
    }
}
