<?php

namespace App\Http\Controllers\RealEstate;

use App\Http\Controllers\Controller;
use App\Http\Requests\RealEstate\Feature\CreateNewFeatureRequest;
use App\Http\Requests\RealEstate\Feature\UpdateFeatureRequest;
use App\Models\RealEstate\Feature;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class FeatureController extends Controller
{
    private string $indexRoute = 'real-estate.features.index';

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $breadcrumbs = [
            ['link' => route('home'), 'name' => __('Home')],
            ['name' => __('Real Estate')],
            ['name' => __('Features')],
        ];

        return view('contents.real-estate.feature.index', [
            'breadcrumbs' => $breadcrumbs,
            'features' => Feature::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateNewFeatureRequest $request
     * @return RedirectResponse
     */
    public function store(CreateNewFeatureRequest $request): RedirectResponse
    {
        try {
            $feature = new Feature();
            $feature->name = $request->input('name');
            $feature->icon = $request->input('icon');
            $feature->save();

            return redirect()->route($this->indexRoute)->with('toastr-success-message', 'Feature created successfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route($this->indexRoute)->with('toastr-error-message', $e->getMessage());
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id): Factory|View|Application
    {
        $breadcrumbs = [
            ['link' => route('home'), 'name' => "Home"],
            ['name' => __('Real Estate')],
            ['link' => route($this->indexRoute), 'name' => "Features"],
            ['name' => __('Edit Feature')],
        ];

        return view('contents.real-estate.feature.edit', [
            'breadcrumbs' => $breadcrumbs,
            'features' => Feature::all(),
            'feature' => Feature::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateFeatureRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(UpdateFeatureRequest $request, int $id): RedirectResponse
    {
        $feature = Feature::findOrFail($id);

        try {
            $feature->name = $request->input('name');
            $feature->icon = $request->input('icon');
            $feature->save();

            return redirect()->route($this->indexRoute)->with('toastr-success-message', 'Feature updated successfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route($this->indexRoute)->with('toastr-error-message', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        try {
            Feature::destroy($id);

            return redirect()->route($this->indexRoute)->with('toastr-success-message', 'Feature deleted successfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route($this->indexRoute)->with('toastr-error-message', $e->getMessage());
        }
    }
}
