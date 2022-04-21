<?php

namespace App\Http\Controllers\RealEstate;

use App\Http\Controllers\Controller;
use App\Http\Requests\RealEstate\Facility\CreateNewFacilityRequest;
use App\Http\Requests\RealEstate\Facility\UpdateFacilityRequest;
use App\Models\RealEstate\Facility;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class FacilityController extends Controller
{
    private string $indexRoute = 'real-estate.facilities.index';

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
            ['name' => __('Facilities')],
        ];

        return view('contents.real-estate.facility.index', [
            'breadcrumbs' => $breadcrumbs,
            'facilities' => Facility::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateNewFacilityRequest $request
     * @return RedirectResponse
     */
    public function store(CreateNewFacilityRequest $request): RedirectResponse
    {
        try {
            $facility = new Facility();
            $facility->name = $request->input('name');
            $facility->icon = $request->input('icon');
            $facility->status = $request->input('status');
            $facility->save();

            return redirect()->route($this->indexRoute)->with('toastr-success-message', 'Facility created successfully');
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
    public function edit($id)
    {
        $breadcrumbs = [
            ['link' => route('home'), 'name' => "Home"],
            ['name' => __('Real Estate')],
            ['link' => route($this->indexRoute), 'name' => "Facilities"],
            ['name' => __('Edit Facility')],
        ];

        return view('contents.real-estate.facility.edit', [
            'breadcrumbs' => $breadcrumbs,
            'facilities' => Facility::all(),
            'facility' => Facility::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateFacilityRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(UpdateFacilityRequest $request, int $id): RedirectResponse
    {
        $facility = Facility::findOrFail($id);

        try {
            $facility->name = $request->input('name');
            $facility->icon = $request->input('icon');
            $facility->status = $request->input('status');
            $facility->save();

            return redirect()->route($this->indexRoute)->with('toastr-success-message', 'Facility updated successfully');
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
            Facility::destroy($id);

            return redirect()->route($this->indexRoute)->with('toastr-success-message', 'Facility deleted successfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route($this->indexRoute)->with('toastr-error-message', $e->getMessage());
        }
    }
}
