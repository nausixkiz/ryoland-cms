<?php

namespace App\Http\Controllers\Location;

use App\Http\Controllers\Controller;
use App\Models\Location\Country;
use App\Models\Location\State;
use App\Rules\Status;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class StateController extends Controller
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
            ['name' => "States"],
        ];

        return view('contents.location.state.index', [
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
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:6', 'max:120', 'unique:states'],
            'abbreviation' => ['string', 'min:2', 'max:2', 'unique:states'],
            'status' => ['required', 'string', new Status()],
            'country' => ['required', 'string'],
        ])->validate();

        $country = Country::findBySlugOrFail($request->input('country'));

        try {
            $state = new State();
            $state->name = $request->input('name');
            $state->abbreviation = $request->input('abbreviation');
            $state->status = $request->input('status');
            $state->is_default = $request->has('is_default');
            $state->country()->associate($country);
            $state->save();

            return redirect()->route('location.states.index')->with('toastr-success-message', 'State created successfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('location.states.index')->with('toastr-error-message', __('Something went wrong'));
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(string $slug)
    {
        $breadcrumbs = [
            ['link' => route('home'), 'name' => "Home"],
            ['link' => route('location.states.index'), 'name' => "States"],
            ['name' => "Edit State"],
        ];

        return view('contents.location.state.edit', [
            'breadcrumbs' => $breadcrumbs,
            'countries' => Country::all(),
            'states' => State::all(),
            'state' => State::findBySlugOrFail($slug),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param string $slug
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, string $slug)
    {
        $state = State::findBySlugOrFail($slug);

        Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:6', 'max:120', 'unique:states,id,' . $state->id],
            'abbreviation' => ['string', 'min:2', 'max:2', 'unique:states,id,' . $state->id],
            'status' => ['required', 'string', new Status()],
            'country' => ['required', 'string'],
        ])->validate();

        $country = Country::findBySlugOrFail($request->input('country'));

        try {
            $state->name = $request->input('name');
            $state->abbreviation = $request->input('abbreviation');
            $state->status = $request->input('status');
            $state->is_default = $request->has('is_default');
            $state->country()->associate($country);
            $state->save();

            return redirect()->route('location.states.index')->with('toastr-success-message', 'State updated successfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('location.states.index')->with('toastr-error-message', __('Something went wrong'));
        }
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
            $state = State::findBySlugOrFail($slug);
            $state->delete();

            return redirect()->route('location.states.index')->with('toastr-success-message', __('State has been deleted successfully.'));
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->route('location.states.index')->with('toastr-error-message', __('Something went wrong.'));
        }
    }
}
