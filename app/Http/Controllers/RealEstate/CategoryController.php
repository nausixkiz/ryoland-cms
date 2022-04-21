<?php

namespace App\Http\Controllers\RealEstate;

use App\Http\Controllers\Controller;
use App\Http\Requests\RealEstate\Cateogry\CreateNewCategoryRequest;
use App\Http\Requests\RealEstate\Cateogry\UpdateCategoryRequest;
use App\Models\RealEstate\Category;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    private string $indexRoute;

    public function __construct()
    {
        $this->indexRoute = 'real-estate.categories.index';
    }

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
            ['name' => __('Categories')],
        ];

        return view('contents.real-estate.category.index', [
            'breadcrumbs' => $breadcrumbs,
            'categories' => Category::all(),
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
            ['link' => route('home'), 'name' => "Home"],
            ['name' => __('Real Estate')],
            ['link' => route($this->indexRoute), 'name' => __('Categories')],
            ['name' => __('Create New Category')],
        ];

        return view('contents.real-estate.category.create', [
            'breadcrumbs' => $breadcrumbs,
            'categories' => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateNewCategoryRequest $request
     * @return RedirectResponse
     */
    public function store(CreateNewCategoryRequest $request): RedirectResponse
    {
        try {
            $category = new Category();
            $category->name = $request->input('name');
            $category->description = $request->input('description');
            $category->is_default = $request->has('is_default');
            $category->status = $request->input('status');
            $category->save();

            return redirect()->route($this->indexRoute)->with('toastr-success-message', __('Category has been created successfully.'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route($this->indexRoute)->with('toastr-error-message', __('Something went wrong.'));
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
            ['name' => __('Real Estate')],
            ['link' => route($this->indexRoute), 'name' => "Categories"],
            ['name' => __('Edit Category')],
        ];

        return view('contents.real-estate.category.edit', [
            'breadcrumbs' => $breadcrumbs,
            'category' => Category::findBySlugOrFail($slug),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCategoryRequest $request
     * @param string $slug
     * @return RedirectResponse
     */
    public function update(UpdateCategoryRequest $request, string $slug): RedirectResponse
    {
        $category = Category::findBySlugOrFail($slug);

        try {
            $category->name = $request->input('name');
            $category->description = $request->input('description');
            $category->is_default = $request->has('is_default');
            $category->status = $request->input('status');
            $category->save();

            return redirect()->route($this->indexRoute)->with('toastr-success-message', __('Category has been updated successfully.'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route($this->indexRoute)->with('toastr-error-message', __('Something went wrong.'));
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
            $category = Category::findBySlugOrFail($slug);
            $category->delete();

            return redirect()->route($this->indexRoute)->with('toastr-success-message', __('Category has been deleted successfully.'));
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->route($this->indexRoute)->with('toastr-error-message', __('Something went wrong.'));
        }
    }
}
