<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partner;

class AdminPartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::orderBy('created_at','desc')->get();
        return view('admin.partners.index', compact('partners'));
    }

    public function create()
    {
        return view('admin.partners.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=>'required|string|max:255',
            'description'=>'nullable|string',
            'website'=>'nullable|url',
            'logo'=>'nullable|string',
        ]);
        Partner::create($data);
        return redirect()->route('admin.partners.index')->with('success','Partenaire créé');
    }

    public function edit(Partner $partner)
    {
        return view('admin.partners.edit', compact('partner'));
    }

    public function update(Request $request, Partner $partner)
    {
        $data = $request->validate([
            'name'=>'required|string|max:255',
            'description'=>'nullable|string',
            'website'=>'nullable|url',
            'logo'=>'nullable|string',
        ]);
        $partner->update($data);
        return redirect()->route('admin.partners.index')->with('success','Partenaire mis à jour');
    }

    public function destroy(Partner $partner)
    {
        $partner->delete();
        return redirect()->route('admin.partners.index')->with('success','Partenaire supprimé');
    }
}
