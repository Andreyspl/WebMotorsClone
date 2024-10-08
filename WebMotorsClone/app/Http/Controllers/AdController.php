<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdController extends Controller
{
    public function index(Request $request)
    {
        $query = Ad::query();

        // Aplicar filtros básicos
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Aplicar filtros avançados
        if ($request->filled('min_year')) {
            $query->where('year', '>=', $request->min_year);
        }
        if ($request->filled('max_year')) {
            $query->where('year', '<=', $request->max_year);
        }
        if ($request->filled('min_mileage')) {
            $query->where('mileage', '>=', $request->min_mileage);
        }
        if ($request->filled('max_mileage')) {
            $query->where('mileage', '<=', $request->max_mileage);
        }
        if ($request->filled('transmission')) {
            $query->where('transmission', $request->transmission);
        }
        if ($request->filled('single_owner')) {
            $query->where('single_owner', $request->single_owner);
        }
        if ($request->filled('color')) {
            $query->where('color', 'like', '%' . $request->color . '%');
        }

        $ads = $query->where('is_approved', true)->get();

        return view('ads.index', compact('ads'));
    }

    public function create()
    {
        return view('ads.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'vehicle_type' => 'required|string',
            'price' => 'required|numeric',
            'mileage' => 'nullable|integer',
            'year' => 'nullable|integer',
            'license_plate_start' => 'nullable|string|max:3',
            'transmission' => 'required|string',
            'single_owner' => 'required|boolean',
            'color' => 'nullable|string',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('photos')) {
            $photos = [];
            foreach ($request->file('photos') as $photo) {
                $photos[] = $photo->store('ads_photos', 'public');
            }
            $data['photos'] = json_encode($photos);
        }

        $data['user_id'] = Auth::id();

        Ad::create($data);

        return redirect()->route('ads.index')->with('success', 'Anúncio criado com sucesso!');
    }


    public function userAds()
    {
        $ads = Auth::user()->ads;
        return view('ads.user_ads', compact('ads'));
    }

    public function adminReview()
    {
        $ads = Ad::where('is_approved', false)->get();
        return view('ads.admin_review', compact('ads'));
    }

    public function approve($id)
    {
        $ad = Ad::find($id);
        $ad->is_approved = true;
        $ad->save();

        return redirect()->route('ads.admin_review')->with('success', 'Anúncio aprovado com sucesso!');
    }

    public function reject($id)
    {
        $ad = Ad::find($id);
        $ad->delete();

        return redirect()->route('ads.admin_review')->with('success', 'Anúncio rejeitado e removido.');
    }
}
