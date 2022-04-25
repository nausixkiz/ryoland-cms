<?php

namespace App\Http\Controllers\RealEstate;

use App\Http\Controllers\Controller;
use App\Http\Requests\RealEstate\Property\CreateNewPropertyRequest;
use App\Http\Requests\RealEstate\Property\UpdatePropertyRequest;
use App\Models\Location\City;
use App\Models\RealEstate\Category;
use App\Models\RealEstate\Facility;
use App\Models\RealEstate\Feature;
use App\Models\RealEstate\Investor;
use App\Models\RealEstate\Project;
use App\Models\RealEstate\Property;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class PropertyController extends Controller
{
    protected string $indexRoute = 'real-estate.properties.index';

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        if(auth()->user()->hasRole('Administrator') || auth()->user()->hasRole('Super Administrator')) {
            $properties = Property::all();
        } else {
            $properties = auth()->user()->properties()->with('investor', 'project', 'category', 'city')->get();
        }

        $breadcrumbs = [
            ['link' => route('home'), 'name' => __('Home')],
            ['name' => __('Properties')],
        ];

        return view('contents.real-estate.property.index', [
            'breadcrumbs' => $breadcrumbs,
            'properties' => $properties,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|RedirectResponse
     */
    public function create()
    {
        if(!auth()->user()->subscribedToOneOfTheSubscription()){
            return redirect()->route('profile.subscription');
        }

        $breadcrumbs = [
            ['link' => route('home'), 'name' => __('Home')],
            ['link' => route($this->indexRoute), 'name' => __('Properties')],
            ['name' => __('Create New Property')],
        ];

        return view('contents.real-estate.property.create', [
            'breadcrumbs' => $breadcrumbs,
            'categories' => Category::all(),
            'investors' => Investor::all(),
            'features' => Feature::all(),
            'cities' => City::all(),
            'projects' => Project::all(),
            'facilities' => Facility::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateNewPropertyRequest $request
     * @return RedirectResponse
     */
    public function store(CreateNewPropertyRequest $request): RedirectResponse
    {
        try {
            $property = new Property();
            $property->fill($request->only([
                'name', 'description', 'location', 'latitude', 'longitude',
                'number_bedroom', 'number_bathroom', 'number_floor', 'square', 'price',
                'contents', 'status', 'moderation_status', 'type'
            ]));

            $property->is_featured = $request->has('is_featured');
            $property->never_expired = $request->has('never_expired');
            $property->price_unit = app('currency')->config('default');

            $property->city()->associate(City::findBySlugOrFail($request->input('city')));
            $property->user()->associate(auth()->user());
            $property->project()->associate(Project::findBySlugOrFail($request->input('project')));

            $property->save();

            $property->categories()->sync(Category::whereIn('slug', $request->input('category'))->select('id')->get());
            $property->features()->sync($request->input('feature'));

            $pivotData = [];

            foreach ($request->input('facility') as $facility) {
                if ($facility['distance'] == null || $facility['id'] == null) {
                    continue;
                }

                $pivotData[$facility['id']] = ['distance' => $facility['distance']];
            }

            if (!empty($pivotData)) {
                $property->facilities()->sync($pivotData);
            }

            $property->addMediaFromRequest('thumbnail')
                ->toMediaCollection('thumbnail');

            if ($request->hasFile('gallery')) {
                foreach ($request->file('gallery') as $gallery) {
                    $property->addMedia($gallery)->toMediaCollection('gallery');
                }
            }

            return redirect()->route($this->indexRoute)->with('toastr-success-message', __('Property created successfully'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('toastr-error-message', __('Something went wrong'));
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
        $property = Property::findBySlugOrFail($slug);
        $breadcrumbs = [
            ['link' => route('home'), 'name' => __('Home')],
            ['link' => route($this->indexRoute), 'name' => __('Properties')],
            ['name' => __('Edit Property')],
        ];

        return view('contents.real-estate.property.edit', [
            'breadcrumbs' => $breadcrumbs,
            'property' => $property,
            'categories' => Category::all(),
            'investors' => Investor::all(),
            'features' => Feature::all(),
            'cities' => City::all(),
            'projects' => Project::all(),
            'facilities' => Facility::all(),
            'property_feature' => $property->features->map(function ($feature) {
                return $feature->id;
            })->toArray(),
            'property_category' => $property->categories->map(function ($category) {
                return $category->slug;
            })->toArray(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePropertyRequest $request
     * @param string $slug
     * @return RedirectResponse
     */
    public function update(UpdatePropertyRequest $request, string $slug): RedirectResponse
    {
        $property = Property::findBySlugOrFail($slug);
        try {
            $property->fill($request->only([
                'name', 'description', 'location', 'latitude', 'longitude',
                'number_bedroom', 'number_bathroom', 'number_floor', 'square', 'price',
                'contents', 'status', 'moderation_status', 'type'
            ]));

            $property->is_featured = $request->has('is_featured');
            $property->never_expired = $request->has('never_expired');
            $property->price_unit = app('currency')->config('default');

            $property->city()->associate(City::findBySlugOrFail($request->input('city')));
            $property->user()->associate(auth()->user());
            $property->project()->associate(Project::findBySlugOrFail($request->input('project')));

            $property->save();

            $property->categories()->sync(Category::whereIn('slug', $request->input('category'))->select('id')->get());
            $property->features()->sync($request->input('feature'));

            $pivotData = [];

            foreach ($request->input('facility') as $facility) {
                if ($facility['distance'] == null || $facility['id'] == null) {
                    continue;
                }

                $pivotData[$facility['id']] = ['distance' => $facility['distance']];
            }

            if (!empty($pivotData)) {
                $property->facilities()->sync($pivotData);
            }

            if ($request->hasFile('thumbnail')) {
                $property->clearMediaCollection('thumbnail');
                $property->addMediaFromRequest('thumbnail')
                    ->toMediaCollection('thumbnail');
            }
            if ($request->hasFile('gallery')) {
                $property->clearMediaCollection('gallery');

                foreach ($request->file('gallery') as $gallery) {
                    $property->addMedia($gallery)->toMediaCollection('gallery');
                }
            }

            return redirect()->route($this->indexRoute)->with('toastr-success-message', __('Property updated successfully'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('toastr-error-message', __('Something went wrong'));
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
            $property = Property::findBySlugOrFail($slug);
            $property->delete();

            return redirect()->route($this->indexRoute)->with('toastr-success-message', __('Property deleted successfully'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('toastr-error-message', __('Something went wrong'));
        }
    }
}
