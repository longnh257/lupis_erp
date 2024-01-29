<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Product;
use App\Models\ProductLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProductPageController extends Controller
{
    public function index(Request $request)
    {

        return view('pages.product.index');
    }

    public function create()
    {
        return view('pages.product.create');
    }


    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|max:191|unique:products,name',
                'quantity' => 'numeric',
                'file' => 'mimes:jpg,png,jpeg|max:4096',
            ],
            trans('productValidation.messages'),
            trans('productValidation.attributes'),
        );

        $fileName = "";

        if ($request->file('file')) {
            $file = $request->file('file');
            $yearMonth = date('Y') . '/' . date('m') . '/';
            $fileName = $yearMonth . uniqid() . '.' . $file->getClientOriginalName();
            Storage::disk('local')->put('public/uploads/' . $fileName, file_get_contents($file));
            $request['thumbnail'] = $fileName;
        }


        $product =  Product::create($request->input());
        ProductLog::create([
            'user_id' => Auth::id(),
            'action' => "import",
            'details' => "Tạo Sản Phẩm",
            'quantity' => $product->quantity,
            'product_id' => $product->id,
        ]);

        return redirect()->route('view.product.index')
            ->with('success', 'Thêm sản phẩm thành công!');
    }

    public function edit(Product $model)
    {
        $roles = Role::orderBy('id', 'DESC')->get();
        return view('pages.product.edit', compact('roles', 'model'));
    }

    public function update(Product $model, Request $request)
    {
        $request->validate(
            [
                'name' => 'required|max:191|unique:products,name,' . $model->id . ',id',
                'quantity' => 'numeric',
                'file' => 'mimes:jpg,png,jpeg|max:4096',
            ],
            trans('productValidation.messages'),
            trans('productValidation.attributes'),
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

        return redirect()->route('view.product.index')
            ->with('success', 'Cập nhật thành công!');
    }


    public function destroy(Product $model)
    {
        $model->delete();

        return redirect()->route('view.product.index')
            ->with('success', 'Xóa Thành Công!');
    }
}
