<?php

namespace App\Http\Controllers;

use App\Constants\StatusConst;
use App\Http\Requests\Blog\CreateNewBlogRequest;
use App\Http\Requests\Blog\UpdateBlogRequest;
use App\Models\Blog;
use App\Models\Category;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use function back;
use function route;
use function view;

class BlogController extends Controller
{
    protected string $indexRoute = 'blogs.index';

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $breadcrumbs = [
            ['link' => route('home'), 'name' => __('Home')],
            ['link' => route($this->indexRoute), 'name' => __('Blog')],
        ];

        return view('contents.blog.index', [
            'breadcrumbs' => $breadcrumbs,
            'blogs' => Blog::all(),
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
            ['link' => route('home'), 'name' => __('Home')],
            ['link' => route($this->indexRoute), 'name' => __('Blogs')],
            ['name' => __('Create New Blog')],
        ];

        return view('contents.blog.create', [
            'breadcrumbs' => $breadcrumbs,
            'categories' => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateNewBlogRequest $request
     * @return RedirectResponse
     */
    public function store(CreateNewBlogRequest $request): RedirectResponse
    {
        try {
            $user = Auth::user();
            $category = Category::findBySlugOrFail($request->input('category'));

            $blog = new Blog();
            $blog->name = $request->input('name');
            $blog->description = $request->input('description');
            $blog->contents = $request->input('contents');
            $blog->status = $request->input('status');
            $blog->is_featured = $request->has('is_featured');

            $blog->user()->associate($user);
            $blog->category()->associate($category);

            $blog->save();

            $blog->tag(explode(',', $request->input('tags')));
            $blog->addMediaFromRequest('thumbnail')->toMediaCollection('thumbnail');

            Session::flash('toastr-success-message', $blog->name . ' created successfully');
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            Session::flash('toastr-error-message', 'Something went wrong');
        }

        return redirect()->route($this->indexRoute);
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
            ['link' => route('home'), 'name' => __('Home')],
            ['link' => route('blogs.index'), 'name' => __('Blogs')],
            ['name' => __('Edit Blog')],
        ];

        $blog = Blog::findBySlugOrFail($slug);
        $blog_tags_for_import = '';

        foreach ($blog->tags as $tag) {
            $blog_tags_for_import .= "$tag->name" . ", ";
        }
        $blog_tags_for_import = rtrim($blog_tags_for_import, ', ');


        return view('contents.blog.edit', [
            'breadcrumbs' => $breadcrumbs,
            'blog' => Blog::findBySlugOrFail($slug),
            'blog_tags_for_import' => "'$blog_tags_for_import'",
            'categories' => Category::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBlogRequest $request
     * @param string $slug
     * @return RedirectResponse
     */
    public function update(UpdateBlogRequest $request, string $slug): RedirectResponse
    {
        try {
            $blog = Blog::findBySlugOrFail($slug);
            $category = Category::findBySlugOrFail($request->input('category'));

            $blog->name = $request->input('name');
            $blog->description = $request->input('description');
            $blog->contents = $request->input('contents');
            $blog->status = $request->input('status');
            $blog->is_featured = $request->has('is_featured');

            $blog->category()->associate($category);

            $blog->save();

            $blog->untag();
            $blog->tag(explode(',', $request->input('tags')));

            if ($request->hasFile('thumbnail')) {
                $blog->clearMediaCollection('thumbnail');
                $blog->addMediaFromRequest('thumbnail')->toMediaCollection('thumbnail');
            }

            Session::flash('toastr-success-message', $blog->name . ' created successfully');
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            Session::flash('toastr-error-message', 'Something went wrong');
        }

        return redirect()->route($this->indexRoute);
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
            $blog = Blog::findBySlugOrFail($slug);
            $blog->delete();
            Session::flash('toastr-success-message', $blog->name . ' deleted successfully');
        } catch (Exception $e) {
            Session::flash('toastr-error-message', $e->getMessage());
        }

        return redirect()->route($this->indexRoute);
    }
}
