<?php

namespace App\Http\Controllers\Location;

use App\Http\Controllers\Controller;
use App\Models\Location\Country;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use League\ISO3166\ISO3166;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $breadcrumbs = [
            ['link' => route('home'), 'name' => "Home"],
            ['name' => "Countries"],
        ];

        return view('contents.location.country.index', [
            'breadcrumbs' => $breadcrumbs,
            'countries' => Country::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        if (Country::all()->count() === 249) {
            return redirect()->back()->with('flash-message-success', 'All countries are available in the system.');
        }

        $countries = (new ISO3166)->all();

//        Country::truncate();

        foreach ($countries as $country) {
            Country::create([
                'name' => $country['name'],
                'alpha2' => $country['alpha2'],
                'alpha3' => $country['alpha3'],
                'numeric' => $country['numeric'],
                'currency' => $country['currency'][0],
            ]);
        }

        return redirect()->back()->with('flash-success-message', 'All countries added to the system successfully.');
    }
}
