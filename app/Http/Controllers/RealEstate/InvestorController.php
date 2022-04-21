<?php

namespace App\Http\Controllers\RealEstate;

use App\Http\Controllers\Controller;
use App\Http\Requests\RealEstate\Investor\CreateNewInvestorRequest;
use App\Http\Requests\RealEstate\Investor\UpdateInvestorRequest;
use App\Models\RealEstate\Investor;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class InvestorController extends Controller
{
    private string $indexRoute = 'real-estate.investors.index';

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): Factory|View|Application
    {
        $breadcrumbs = [
            ['link' => route('home'), 'name' => __('Home')],
            ['name' => __('Investors')],
        ];

        return view('contents.real-estate.investor.index', [
            'breadcrumbs' => $breadcrumbs,
            'investors' => Investor::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateNewInvestorRequest $request
     * @return RedirectResponse
     */
    public function store(CreateNewInvestorRequest $request): RedirectResponse
    {
        try {
            $investor = new Investor();
            $investor->name = $request->input('name');
            $investor->status = $request->input('status');
            $investor->save();

            return redirect()->route($this->indexRoute)->with('toastr-success-message', 'Investor created successfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route($this->indexRoute)->with('toastr-error-message', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $slug
     * @return Application|Factory|View
     */
    public function edit(string $slug): Factory|View|Application
    {
        $investor = Investor::findBySlugOrFail($slug);

        $breadcrumbs = [
            ['link' => route('home'), 'name' => __('Home')],
            ['link' => route($this->indexRoute), 'name' => __('Investors')],
            ['name' => __('Edit Investor')],
        ];

        return view('contents.real-estate.investor.edit', [
            'breadcrumbs' => $breadcrumbs,
            'investors' => Investor::all(),
            'investor' => $investor,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateInvestorRequest $request
     * @param string $slug
     * @return RedirectResponse
     */
    public function update(UpdateInvestorRequest $request, string $slug): RedirectResponse
    {
        $investor = Investor::findBySlugOrFail($slug);

        try {
            $investor->name = $request->input('name');
            $investor->status = $request->input('status');
            $investor->save();

            return redirect()->route($this->indexRoute)->with('toastr-success-message', 'Investor created successfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route($this->indexRoute)->with('toastr-error-message', $e->getMessage());
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
            $investor = Investor::findBySlugOrFail($slug);
            $investor->delete();

            return redirect()->route($this->indexRoute)->with('toastr-success-message', 'Investor deleted successfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route($this->indexRoute)->with('toastr-error-message', $e->getMessage());
        }
    }
}
