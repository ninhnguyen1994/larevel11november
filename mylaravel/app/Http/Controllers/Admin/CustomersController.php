<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customers;

class CustomersController extends Controller
{
    public function index()
    {
        $customers = Customers::orderBy('id', 'desc')->paginate(20);
        return view('admin.Customers.index', ['customers' => $customers]);
    }

    public function search(Request $request)
    {
        $inputData = $request->all();
        $customers = Customers::orderBy('id', 'desc');
        if (isset($inputData['name']) && $inputData['name'] != '') {
            $Customers = $customers->where('name', 'like', '%' . $inputData['name'] . '%');
        }
        if (isset($inputData['email']) && $inputData['email'] != '') {
            $customers = $customers->where('email', 'like', '%' . $inputData['email'] . '%');
        }
        if (isset($inputData['phone']) && $inputData['phone'] != '') {
            $customers = $customers->where('phone', 'like', '%' . $inputData['phone'] . '%');
        }

        $customers->paginate(20);
        return view('admin.Customers.index', ['Customers' => $customers]);
    }

    public function delete($id)
    {
        $customers = Customers::find($id)->delete();
        return redirect()->route('admin.customers');
    }
}
