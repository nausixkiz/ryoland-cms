<?php

namespace App\Http\Controllers;

use App\Http\Requests\Blog\Category\CreateNewCategoryRequest;
use App\Http\Requests\Blog\Category\UpdateCategoryRequest;
use App\Models\Category;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use function route;
use function view;

class CategoryController extends Controller
{
    protected string $indexRoute = 'categories.index';

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $breadcrumbs = [
            ['link' => route('home'), 'name' => __('Home')],
            ['link' => route($this->indexRoute), 'name' => __('Categories')],
        ];

        return view('contents.blog.category.index', [
            'breadcrumbs' => $breadcrumbs,
            'categories' => Category::all(),
        ]);
    }

    public function create(): View|Factory|Application
    {
        $breadcrumbs = [
            ['link' => route('home'), 'name' => "Home"],
            ['link' => route($this->indexRoute), 'name' => "Categories"],
            ['name' => __('Create New Category')],
        ];

        return view('contents.blog.category.create', [
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
            $category->is_featured = $request->has('is_featured');
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
            ['link' => route($this->indexRoute), 'name' => "Categories"],
            ['name' => __('Edit Category')],
        ];

        return view('contents.blog.category.edit', [
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
            $category->is_featured = $request->has('is_featured');
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
