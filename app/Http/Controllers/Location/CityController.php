<?php

namespace App\Http\Controllers\Location;

use App\Http\Controllers\Controller;
use App\Http\Requests\Location\City\CreateNewCityRequest;
use App\Models\Location\City;
use App\Models\Location\Country;
use App\Models\Location\State;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class CityController extends Controller
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
            ['name' => "Cities"],
        ];

        return view('contents.location.city.index', [
            'breadcrumbs' => $breadcrumbs,
            'cities' => City::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $breadcrumbs = [
            ['link' => route('home'), 'name' => "Home"],
            ['link' => route('location.cities.index'), 'name' => "Cities"],
            ['name' => "Create New City"],
        ];

        return view('contents.location.city.create', [
            'breadcrumbs' => $breadcrumbs,
            'countries' => Country::all(),
            'states' => State::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(CreateNewCityRequest $request)
    {
        try {
            $city = new City();
            $city->name = $request->name;
            $city->country()->associate(Country::findBySlugOrFail($request->input('country')));
            if ($request->input('state') && $request->input('state') !== 'none') {
                $city->state()->associate(State::findBySlugOrFail($request->input('state')));
            }
            $city->is_featured = $request->has('is_featured');
            $city->is_default = $request->has('is_default');

            $city->save();

            $city->addMediaFromRequest('thumbnail')->toMediaCollection('thumbnail');

            return redirect()->route('location.cities.index')->with('toastr-success-message', 'City has been created successfully.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('location.cities.index')->with('toastr-error-message', 'Something went wrong.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $slug
     * @return RedirectResponse
     */
    public function destroy(string $slug)
    {
        try {
            $city = City::findBySlugOrFail($slug);
            $city->delete();

            return redirect()->route('location.cities.index')->with('toastr-success-message', 'City has been deleted successfully.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('location.cities.index')->with('toastr-error-message', 'Something went wrong.');
        }
    }
}
