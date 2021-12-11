<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Products;
use App\Image;
use App\Http\Requests\Admin\ProductsRequest;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class ProductsController extends Controller
{
    public function index()
    {
        $categorys = Category::get();
        $products = Products::with('category')->orderBy('id', 'desc')->paginate(20);
        return view('admin.products.index', ['categorys' => $categorys, 'products' => $products]);
    }

    public function search(Request $request)
    {
        $inputData = $request->all();
        $products = Products::select(['products.*', 'categorys.name as category_name'])
            ->join('categorys', 'categorys.id', '=', 'products.category_id');
        if (isset($inputData['code']) && $inputData['code'] != '') {
            $products = $products->where('products.code', 'like', '%' . $inputData['code'] . '%');
        }
        if (isset($inputData['name']) && $inputData['name'] != '') {
            $products = $products->where('products.name', 'like', '%' . $inputData['name'] . '%');
        }
        if (isset($inputData['price']) && $inputData['price'] != '') {
            $products = $products->where(function ($query) use ($inputData) {
                $query->where('products.price', '>=', $inputData['price']);
                $query->where('products.price', '<=', $inputData['price']);
            });
        }
        if (isset($inputData['status']) && $inputData['status'] != '') {
            $products = $products->where('products.status', $inputData['status']);
        }
        if (isset($inputData['status_hight_light']) && $inputData['status_hight_light'] != '') {
            $products = $products->where('products.status_hight_light', $inputData['status_hight_light']);
        }
        if (isset($inputData['category_id']) && $inputData['category_id'] != '') {
            $products = $products->where('categorys.id', $inputData['category_id']);
        }
        $categorys = Category::get();
        $products = $products->orderBy('id', 'desc')->paginate(20);
        return view('admin.products.index', ['categorys' => $categorys, 'products' => $products]);
    }

    public function add(Request $request)
    {
        $categorys = Category::get();
        return view('admin.products.add', ['categorys' => $categorys]);
    }

    public function store(ProductsRequest $request)
    {
        $inputData = $request->all();
        DB::beginTransaction();
        try {
            $products = new Products();
            $products->code = $this->generateRandomString();
            $products->name = $inputData['name'];
            $products->slug = Str::slug($inputData['name'], '-');
            $products->status = '1';
            $products->category_id = $inputData['category_id'];
            $products->number = $inputData['number'];
            $products->price = $inputData['price'];
            $products->status_hight_light = isset($inputData['status_hight_light']) ? $inputData['status_hight_light'] : 2;
            $products->description = $inputData['description'];
            $products->user_id = auth()->user()->id;
            $res = $products->save();
            $id = $products->id;
            $data = [];
            if ($request->hasfile('img')) {
                foreach ($inputData['img'] as $file) {
                    $name = time() . '.' . $file->getClientOriginalName();
                    $file->move(public_path() . '/uploads/products/', $name);
                    $data[] = [
                        'product_id' => $id,
                        'name' => $name
                    ];
                }
            }
            $img = Image::insert($data);
            if ($res && $img) {
                DB::commit();
                return redirect()->route('admin.products');
            }
            abort(500);
        } catch (Exception $e) {
            DB::rollback();
        }
    }
    public function generateRandomString($length = 10)
    {
        $characters = '0123456789abcefghiklmasdfghj';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return '#' . strtoupper($randomString);
    }
    public function detail($id)
    {
        $categorys = Category::get();
        $products = Products::with('images')->find($id);
        return view('admin.products.edit', ['products' => $products, 'categorys' => $categorys]);
    }

    public function update(ProductsRequest $request, $id)
    {
        $inputData = $request->all();
        DB::beginTransaction();
        try {
            $products = Products::find($id);
            $products->name = $inputData['name'];
            $products->slug = Str::slug($inputData['name'], '-');
            $products->category_id = $inputData['category_id'];
            $products->number = $inputData['number'];
            $products->price = $inputData['price'];
            $products->status_hight_light = isset($inputData['status_hight_light']) ? $inputData['status_hight_light'] : 2;
            $products->description = $inputData['description'];
            $products->user_id = auth()->user()->id;
            $res = $products->save();
            $data = [];
            if ($request->hasfile('img')) {
                Image::where('product_id',$id)->delete();
                foreach ($inputData['img'] as $file) {
                    $name = time() . '.' . $file->getClientOriginalName();
                    $file->move(public_path() . '/uploads/products/', $name);
                    $data[] = [
                        'product_id' => $id,
                        'name' => $name
                    ];
                }
            }
            $img = Image::insert($data);
            if ($res && $img) {
                DB::commit();
                return redirect()->route('admin.products');
            }
            abort(500);
        } catch (Exception $e) {
            DB::rollback();
        }
    }
    public function delete($id)
    {
        $product = Products::where('id',$id)->delete();
        return redirect()->route('admin.products');
    }
}
