<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class OrderPageController extends Controller
{
    public function index(Request $request)
    {

        return view('pages.order.index');
    }

    public function create()
    {

        $driver = User::where('role_id', 3)->get();
        $product = Product::where('quantity', '>', 0)->get();
        return view('pages.order.create', compact('driver', 'product'));
    }


    public function store(Request $request)
    {
        return $request->input();
        $request->validate(
            [
                'name' => 'required|max:191|unique:orders,name',
                'quantity' => 'numeric',
                'file' => 'mimes:jpg,png,jpeg|max:4096',
            ],
            trans('orderValidation.messages'),
            trans('orderValidation.attributes'),
        );


        $file = $request->file('file');
        $yearMonth = date('Y') . '/' . date('m') . '/';
        $fileName = $yearMonth . uniqid() . '.' . $file->getClientOriginalName();
        Storage::disk('local')->put('public/uploads/' . $fileName, file_get_contents($file));

        $request['thumbnail'] = $fileName;

        Order::create($request->input());

        return redirect()->route('view.order.index')
            ->with('success', 'Thêm nguyên liệu thành công!');
    }

    public function edit(Order $model)
    {
        $roles = Role::orderBy('id', 'DESC')->get();
        return view('pages.order.edit', compact('roles', 'model'));
    }

    public function update(Order $model, Request $request)
    {
        $request->validate(
            [
                'name' => 'required|max:191|unique:orders,name,' . $model->id . ',id',
                'quantity' => 'numeric',
                'file' => 'mimes:jpg,png,jpeg|max:4096',
            ],
            trans('orderValidation.messages'),
            trans('orderValidation.attributes'),
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

        return redirect()->route('view.order.index')
            ->with('success', 'Cập nhật thành công!');
    }


    public function destroy(Order $model)
    {
        $model->delete();

        return redirect()->route('view.order.index')
            ->with('success', 'Xóa Thành Công!');
    }
}
