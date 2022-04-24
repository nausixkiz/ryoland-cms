<?php

namespace App\Http\Controllers\RealEstate;

use App\Http\Controllers\Controller;
use App\Http\Requests\RealEstate\Project\CreateNewProjectRequest;
use App\Http\Requests\RealEstate\Project\UpdateProjectRequest;
use App\Http\Requests\RealEstate\Property\CreateNewPropertyRequest;
use App\Models\Location\City;
use App\Models\RealEstate\Category;
use App\Models\RealEstate\Facility;
use App\Models\RealEstate\Feature;
use App\Models\RealEstate\Investor;
use App\Models\RealEstate\Project;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{
    protected string $indexRoute = 'real-estate.projects.index';

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $breadcrumbs = [
            ['link' => route('home'), 'name' => __('Home')],
            ['link' => route($this->indexRoute), 'name' => __('Projects')],
        ];

        return view('contents.real-estate.project.index', [
            'breadcrumbs' => $breadcrumbs,
            'projects' => Project::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        $breadcrumbs = [
            ['link' => route('home'), 'name' => __('Home')],
            ['link' => route($this->indexRoute), 'name' => __('Projects')],
            ['name' => __('Create New Project')],
        ];

        return view('contents.real-estate.project.create', [
            'breadcrumbs' => $breadcrumbs,
            'categories' => Category::all(),
            'investors' => Investor::all(),
            'features' => Feature::all(),
            'cities' => City::all(),
            'facilities' => Facility::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateNewProjectRequest $request
     * @return RedirectResponse
     */
    public function store(CreateNewProjectRequest $request): RedirectResponse
    {
        try {
            $project = new Project();
            $project->fill($request->only([
                'name', 'description', 'location', 'latitude', 'longitude',
                'number_block', 'number_floor', 'number_flat', 'price_from', 'price_to',
                'contents', 'status', 'date_sell', 'date_finish'
            ]));

            $project->is_featured = $request->has('is_featured');
            $project->investor()->associate(Investor::findOrFail($request->input('investor')));
            $project->city()->associate(City::findBySlugOrFail($request->input('city')));
            $project->user()->associate(auth()->user());

            $project->save();

            $categories = Category::whereIn('slug', $request->input('category'))->select('id')->get();
            $project->categories()->sync($categories);
            $project->features()->sync($request->input('feature'));

            $project->addMediaFromRequest('thumbnail')
                ->toMediaCollection('thumbnail');

            if ($request->hasFile('gallery')) {
                foreach ($request->file('gallery') as $gallery) {
                    $project->addMedia($gallery)->toMediaCollection('gallery');
                }
            }

            return redirect()->route($this->indexRoute)->with('toastr-success-message', __('Project created successfully'));
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
        $project = Project::findBySlugOrFail($slug);

        $breadcrumbs = [
            ['link' => route('home'), 'name' => __('Home')],
            ['link' => route($this->indexRoute), 'name' => __('Projects')],
            ['name' => __('Edit Project')],
        ];

        return view('contents.real-estate.project.edit', [
            'breadcrumbs' => $breadcrumbs,
            'project' => $project,
            'categories' => Category::all(),
            'investors' => Investor::all(),
            'features' => Feature::all(),
            'project_feature' => $project->features->map(function ($feature) {
                return $feature->id;
            })->toArray(),
            'project_category' => $project->categories->map(function ($category) {
                return $category->slug;
            })->toArray(),
            'cities' => City::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProjectRequest $request
     * @param string $slug
     * @return RedirectResponse
     */
    public function update(UpdateProjectRequest $request, string $slug)
    {
        $project = Project::findBySlugOrFail($slug);

        try {
            $project->fill($request->only([
                'name', 'description', 'location', 'latitude', 'longitude',
                'number_block', 'number_floor', 'number_flat', 'price_from', 'price_to',
                'contents', 'status', 'date_sell', 'date_finish'
            ]));

            $project->is_featured = $request->has('is_featured');
            $project->investor()->associate(Investor::findOrFail($request->input('investor')));
            $project->city()->associate(City::findBySlugOrFail($request->input('city')));
            $project->user()->associate(auth()->user());

            $project->save();

            $categories = Category::whereIn('slug', $request->input('category'))->select('id')->get();
            $project->categories()->sync($categories);
            $project->features()->sync($request->input('investor'));

            if ($request->hasFile('thumbnail')) {
                $project->clearMediaCollection('thumbnail');
                $project->addMediaFromRequest('thumbnail')
                    ->toMediaCollection('thumbnail');
            }

            if ($request->hasFile('gallery')) {
                $project->clearMediaCollection('gallery');

                foreach ($request->file('gallery') as $gallery) {
                    $project->addMedia($gallery)->toMediaCollection('gallery');
                }
            }

            return redirect()->route($this->indexRoute)->with('toastr-success-message', __('Project updated successfully'));
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
            $project = Project::findBySlugOrFail($slug);
            $project->delete();

            return redirect()->route($this->indexRoute)->with('toastr-success-message', __('Project deleted successfully'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('toastr-error-message', __('Something went wrong'));
        }
    }
}
