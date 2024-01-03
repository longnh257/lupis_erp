<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class MaterialPageController extends Controller
{
    public function index(Request $request)
    {

        return view('pages.material.index');
    }

    public function create()
    {
        $roles = Role::orderBy('id', 'DESC')->get();
        return view('pages.material.create', compact('roles'));
    }


    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|max:191|unique:materials,name',
                'file' => 'mimes:jpg,png,jpeg|max:4096',
            ],
            trans('materialValidation.messages'),
            trans('materialValidation.attributes'),
        );


        $file = $request->file('file');
        $yearMonth = date('Y') . '/' . date('m') . '/';
        $fileName = $yearMonth . uniqid() . '.' . $file->getClientOriginalName();
        Storage::disk('local')->put('public/uploads/' . $fileName, file_get_contents($file));

        $request['thumbnail'] = $fileName;

        Material::create($request->input());

        return redirect()->route('view.material.index')
            ->with('success', 'Thêm nguyên liệu thành công!');
    }

    public function edit(Material $model)
    {
        $roles = Role::orderBy('id', 'DESC')->get();
        return view('pages.material.edit', compact('roles', 'model'));
    }

    public function update(Material $model, Request $request)
    {
        $request->validate(
            [
                'name' => 'required|max:191|unique:materials,name,' . $model->id . ',id',
                'file' => 'mimes:jpg,png,jpeg|max:4096',
            ],
            trans('materialValidation.messages'),
            trans('materialValidation.attributes'),
        );

        $cred = [
            "name" => $request->name,
            "quantity" => $request->quantity,
            "description" => $request->description,
        ];

        if ($request->file) {
            $file = $request->file('file');
            $yearMonth = date('Y') . '/' . date('m') . '/';
            $fileName = $yearMonth . uniqid() . '.' . $file->getClientOriginalName();
            Storage::disk('local')->put('public/uploads/' . $fileName, file_get_contents($file));
            $cred['thumbnail'] = $fileName;
        }

        $model->update($cred);

        return redirect()->route('view.material.index')
            ->with('success', 'Cập nhật thành công!');
    }


    public function destroy(Material $model)
    {
        $model->delete();

        return redirect()->route('view.material.index')
            ->with('success', 'Xóa Thành Công!');
    }
}
