<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserPageController extends Controller
{
    public function index(Request $request)
    {

        return view('pages.user.index');
    }

    public function create()
    {
        $roles = Role::orderBy('id', 'DESC')->get();
        return view('pages.user.create', compact('roles'));
    }


    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|max:191',
                'email' => 'email|required|max:191|unique:users,email',
                'password' => 'required|confirmed|min:8|max:191',
                'role_id' => 'required',
                'address' => 'max:191',
            ],
            trans('userValidation.messages'),
            trans('userValidation.attributes'),
        );

        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "role_id" => $request->role_id,
            "address" => $request->address,
            "gender" => $request->gender,
            "birthday" => $request->birthday,
            "password" => bcrypt($request->password),
        ]);

        return redirect()->route('view.user.index')
            ->with('success', 'Thêm Nhân Viên thành công!');
    }

    public function edit(User $model)
    {
        $roles = Role::orderBy('id', 'DESC')->get();
        return view('pages.user.edit', compact('roles', 'model'));
    }

    public function update(User $model, Request $request)
    {
        if (!$request->password) {
            $request['password'] = "";
        }
        $request->validate(
            [
                'name' => 'required|max:191',
                'email' => 'email|required|max:191|unique:users,email,' . $model->id . ',id',
                'phone' => 'regex:/^\d{10}$/|max:12',
                'password' => 'confirmed|min:8|max:191',
                'role_id' => 'required',
                'address' => 'max:191',
            ],
            trans('userValidation.messages'),
            trans('userValidation.attributes'),
        );

        $cred = [
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "role_id" => $request->role_id,
            "address" => $request->address,
            "gender" => $request->gender,
            "birthday" => $request->birthday,
        ];

        if ($request->password) {
            $cred["password"] = bcrypt($request->password);
        }

        $model->update($cred);

        return redirect()->route('view.user.index')
            ->with('success', 'Cập nhật thành công!');
    }

    public function profile()
    {
        $model = User::find(Auth::id());
        return view('pages.user.profile', compact('model'));
    }
    public function update_profile(Request $request)
    {
        $model = User::find(Auth::id());
        $validations = [
            'name' => 'required|max:191',
            'phone' => 'regex:/^\d{10}$/|max:12',
            'address' => 'max:191',
        ];



        $cred = [
            "name" => $request->name,
            "phone" => $request->phone,
            "address" => $request->address,
            "gender" => $request->gender,
            "birthday" => $request->birthday,
        ];

        if ($request->old_password) {
            $validations['password'] = 'required|confirmed|min:8|max:191';
            if (!Hash::check($request->old_password, $model->password)) {
                return redirect()->back()->with('error', 'Mật khẩu cũ không chính xác.');
            } else {
                $cred["password"] = bcrypt($request->password);
            }
        }

        $request->validate(
            $validations,
            trans('userValidation.messages'),
            trans('userValidation.attributes'),
        );

        $model->update($cred);

        return redirect()->back()->with('success', 'Cập nhật thành công!');
    }

    public function destroy(User $model)
    {
        $model->delete();

        return redirect()->route('view.user.index')
            ->with('success', 'Xóa Thành Công!');
    }
}
