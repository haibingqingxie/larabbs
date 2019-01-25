<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use App\Http\Requests\UserRequest;
use App\Handlers\ImageUploadHandler;

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

    public function update(UserRequest $request, ImageUploadHandler $imageUploadHandler, User $user)
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
        // dd($request->avatar);
         $data = $request->all();
         // dd($data);

        if ($request->avatar) {
            $result = $imageUploadHandler->save($request->avatar, 'avatars', $user->id);
            if ($result) {
                $data['avatar'] = $result['path'];
            }
        }

        $user->update($data);

        return redirect()->route('users.show', [$user->id])->with('success', '个人资料更新成功！');
    }
}
