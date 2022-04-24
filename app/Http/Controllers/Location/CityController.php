<?php

namespace App\Http\Controllers\Location;

use App\Http\Controllers\Controller;
use App\Http\Requests\Location\City\CreateNewCityRequest;
use App\Http\Requests\Location\City\UpdateCityRequest;
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
    protected string $indexRoute = 'location.cities.index';

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
    public function create(): Factory|View|Application
    {
        $breadcrumbs = [
            ['link' => route('home'), 'name' => "Home"],
            ['link' => route($this->indexRoute), 'name' => "Cities"],
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
     * @param CreateNewCityRequest $request
     * @return RedirectResponse
     */
    public function store(CreateNewCityRequest $request): RedirectResponse
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
     * Show the form for editing the specified resource.
     *
     * @param string $slug
     * @return Application|Factory|View
     */
    public function edit(string $slug): View|Factory|Application
    {
        $breadcrumbs = [
            ['link' => route('home'), 'name' => "Home"],
            ['link' => route($this->indexRoute), 'name' => "Cities"],
            ['name' => __('Edit City')],
        ];

        return view('contents.location.city.edit', [
            'breadcrumbs' => $breadcrumbs,
            'countries' => Country::all(),
            'states' => State::all(),
            'city' => City::findBySlugOrFail($slug),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCityRequest $request
     * @param string $slug
     * @return RedirectResponse
     */
    public function update(UpdateCityRequest $request, string $slug)
    {
        $city = City::findBySlugOrFail($slug);
        try {
            $city->name = $request->name;

            $city->country()->associate(Country::findBySlugOrFail($request->input('country')));

            if ($request->input('state') && $request->input('state') !== 'none') {
                $city->state()->associate(State::findBySlugOrFail($request->input('state')));
            }

            $city->is_featured = $request->has('is_featured');
            $city->is_default = $request->has('is_default');

            $city->save();

            if($request->has('thumbnail') && $request->file('thumbnail')->isValid()) {
                $city->clearMediaCollection('thumbnail');
                $city->addMediaFromRequest('thumbnail')->toMediaCollection('thumbnail');
            }


            return redirect()->route('location.cities.index')->with('toastr-success-message', 'City has been updated successfully.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('location.cities.index')->with('toastr-error-message', 'Something went wrong.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $slug
     * @return RedirectResponse
     */
    public function destroy(string $slug): RedirectResponse
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
