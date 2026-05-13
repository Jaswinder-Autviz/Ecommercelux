<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::withCount(['orders', 'addresses'])->latest()->paginate(10);
        return view('admin.customers.index', compact('customers'));
    }

    public function show($id)
    {
        $customer = Customer::with(['orders', 'addresses'])->findOrFail($id);
        return view('admin.customers.show', compact('customer'));
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return back()->with('success', 'Customer record deleted successfully.');
    }
}
