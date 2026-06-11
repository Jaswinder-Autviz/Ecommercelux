<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Affiliate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AffiliateController extends Controller
{
    public function index()
    {
        $affiliates = Affiliate::latest()->paginate(15);

        return view('admin.affiliates.index', compact('affiliates'));
    }

    public function create()
    {
        return view('admin.affiliates.create');
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);
        $data['password'] = Hash::make($data['password']);
        $data['coupon_code'] = strtoupper($data['coupon_code']);

        Affiliate::create($data);

        return redirect()->route('admin.affiliates.index')->with('success', 'Affiliator created successfully.');
    }

    public function edit(Affiliate $affiliate)
    {
        return view('admin.affiliates.edit', compact('affiliate'));
    }

    public function update(Request $request, Affiliate $affiliate)
    {
        $data = $this->validatedData($request, $affiliate);
        $data['coupon_code'] = strtoupper($data['coupon_code']);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $affiliate->update($data);

        return redirect()->route('admin.affiliates.index')->with('success', 'Affiliator updated successfully.');
    }

    public function destroy(Affiliate $affiliate)
    {
        $affiliate->delete();

        return back()->with('success', 'Affiliator deleted successfully.');
    }

    public function approve(Affiliate $affiliate)
    {
        $affiliate->update(['status' => 'approved']);

        return back()->with('success', 'Affiliator approved successfully.');
    }

    public function reject(Affiliate $affiliate)
    {
        $affiliate->update(['status' => 'rejected']);

        return back()->with('success', 'Affiliator rejected successfully.');
    }

    private function validatedData(Request $request, ?Affiliate $affiliate = null): array
    {
        $affiliateId = $affiliate?->id;
        $passwordRule = $affiliate ? 'nullable|string|min:8' : 'required|string|min:8';

        return $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('affiliates', 'email')->ignore($affiliateId)],
            'phone' => 'nullable|string|max:30',
            'password' => $passwordRule,
            'coupon_code' => ['required', 'string', 'max:50', Rule::unique('affiliates', 'coupon_code')->ignore($affiliateId)],
            'commission_type' => ['required', Rule::in(['percentage', 'fixed'])],
            'commission_value' => 'required|numeric|min:0',
            'status' => ['required', Rule::in(['pending', 'approved', 'rejected'])],
        ]);
    }
}
