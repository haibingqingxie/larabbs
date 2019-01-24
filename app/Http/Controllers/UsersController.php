<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use App\Http\Requests\UserRequest;

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

    public function update(UserRequest $request, User $user)
    {
        // $this->validate($request, [
        //     'name' => 'required|max:255',
        //     'password' => 'nullable|confirmed|min:6'
        // ]);

        // $user->name = $request->name;
        // if ($request->password) {
        //     $user->password = bcypt($request->password);
        // }

        // $user->save();

        $user->update($request->all());

        return redirect()->route('users.show', [$user->id])->with('success', '个人资料更新成功！');
    }
}
