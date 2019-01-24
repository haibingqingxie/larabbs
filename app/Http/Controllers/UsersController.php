<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'password' => 'nullable|confirmed|min:6'
        ]);

        $user->name = $request->name;
        if ($request->password) {
            $user->password = bcypt($request->password);
        }

        $user->save();

        return redirect()->route('users.show', [$user->id]);
    }
}
