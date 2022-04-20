<?php

namespace App\Http\Controllers\Admin;

use App\Constants\StatusConst;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Transformers\Blog\CategoryTransformer;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use function back;
use function route;
use function view;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $breadcrumbs = [
            ['link' => route('home'), 'name' => "Home",],
            ['link' => route('home'), 'name' => "Blog",],
            ['name' => "Categories",],
        ];

        return view('contents.blog.category.index', [
            'breadcrumbs' => $breadcrumbs,
            'categories' =>  fractal(Category::all())->transformWith(new CategoryTransformer())->toArray(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'icon' => ['required', 'string'],
            'status' => ['required', 'string', Rule::in(StatusConst::LIST_STATUS)],
        ])->validate();


        $user = Auth::user();

        $category = new Category();
        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->icon = $request->input('icon');
        $category->is_featured = $request->input('is_featured') === 'on';
        $category->is_default = $request->input('is_default') === 'on';
        $category->status = $request->input('status');
        $category->user()->associate($user);
        $category->save();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
