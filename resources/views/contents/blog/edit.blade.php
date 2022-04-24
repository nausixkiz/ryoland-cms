@extends('layouts/contentLayoutMaster')

@section('title', __('Edit Blog'))

@section('vendor-style')
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/katex.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/monokai-sublime.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/quill.snow.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/quill.bubble.css')) }}">
    <link rel="stylesheet"
          href="{{ asset(mix('vendors/css/jquery-tagsinput-revisited/jquery.tagsinput-revisited.min.css')) }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Inconsolata&family=Roboto+Slab&family=Slabo+27px&family=Sofia&family=Ubuntu+Mono&display=swap"
        rel="stylesheet">
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-quill-editor.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/tags/jquery.tagsinput-revisited.css')) }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-12">
            <form class="form form-vertical" method="POST" action="{{ route('blogs.update', $blog->slug) }}"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-9 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="name">Name</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="name"
                                                   class="form-control @error('name') is-invalid @enderror" name="name"
                                                   value="{{ old('name', $blog->name) }}"/>
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="description">Short Description</label>
                                        </div>
                                        <div class="col-sm-9">
                                              <textarea
                                                  name="description"
                                                  class="form-control @error('description') is-invalid @enderror"
                                                  placeholder="Leave a description here"
                                                  id="description"
                                                  style="height: 100px"
                                              >{{ old('description', $blog->description) }} </textarea>
                                            @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mb-2">
                                    <div class="border rounded p-2">
                                        <h4 class="mb-1">Thumbnail</h4>
                                        <div class="d-flex flex-column flex-md-row">
                                            <img
                                                src="{{ $blog->getThumbnailUrl() }}"
                                                id="thumbnail-preview"
                                                class="rounded me-2 mb-1 mb-md-0"
                                                width="170"
                                                height="110"
                                                alt="{{ $blog->name }} Thumbnail"
                                            />
                                            <div class="featured-info">
                                                <small
                                                    class="@if($errors->has('thumbnail')) text-danger @else text-muted @endif">Required
                                                    image resolution 800x400, image size
                                                    10mb.</small>
                                                <p class="my-50">
                                                    <span id="thumbnail-text"></span>
                                                </p>
                                                <div class="d-inline-block">
                                                    <input class="form-control @error('thumbnail') is-invalid @enderror"
                                                           type="file" id="thumbnail"
                                                           accept="image/*" name="thumbnail"/>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-12">
                                    <input type="hidden" name="contents" id="contents" value="{{ $blog->contents }}"
                                           hidden>
                                    <div class="mb-1">
                                        <div id="full-wrapper">
                                            <div id="full-container">
                                                <div class="editor">
                                                    {!! old('contents', $blog->contents) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-12">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="col-12 offset-sm-1">
                                        <button type="submit" class="btn btn-primary me-1">
                                            <i class="fa-solid fa-floppy-disk"></i>
                                            Save
                                        </button>
                                        <button type="reset" class="btn btn-outline-secondary">
                                            <i class="fa-solid fa-floppy-disk-circle-arrow-right"></i>
                                            Save Draft
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <x-form.select-status-component layoutStyle='ho'
                                                        type="normal"
                                                        statusVal="{{ old('status', $blog->status) }}">
                        </x-form.select-status-component>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Option</h4>
                                </div>
                                <div class="card-body">
                                    <input type="checkbox"
                                           class="form-check-input @error('is_featured') is-invalid @enderror"
                                           id="is_featured" name="is_featured"
                                           @if(old('is_featured') == 'on' || $blog->featured()) checked @endif/>
                                    <label class="form-check-label" for="is_featured">Feature Blog</label>
                                    @error('is_featured')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Categories</h4>
                                </div>
                                <div class="card-body">
                                    <select class="select2 form-select @error('category') is-invalid @enderror"
                                            id="category" name="category" required>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->slug }}"
                                                    data-icon="{{ $category->icon }}"
                                                    @if($blog->category->slug == $category->slug) selected @endif>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Tags</h4>
                                </div>
                                <div class="card-body">
                                    <input type="text" id="tags" data-role="tagsinput"
                                           class="form-control @error('tags') is-invalid @enderror" name="tags"
                                           value="{{ old('tags') }}"/>
                                    @error('tags')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('vendor-script')
    <!-- vendor files -->
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
    <!-- vendor files -->
    <script src="{{ asset(mix('vendors/js/editors/quill/katex.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/editors/quill/highlight.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/editors/quill/quill.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/jquery-tagsinput-revisited/jquery.tagsinput-revisited.min.js')) }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset(mix('js/scripts/forms/form-select2.js'))}}"></script>
    <script src="{{ asset(mix('js/scripts/forms/form-quill-editor.js'))}}"></script>
    <script src="{{ asset(mix('js/scripts/forms/form-thumbnail-preview.js'))}}"></script>
    <script>
        (function (window, document, $) {
            'use strict';

            const tags = $('#tags');
            tags.tagsInput({
                'unique': true,
                'minChars': 2,
                'maxChars': 10,
                'limit': 5,
                'validationPattern': new RegExp('^[a-zA-Z]+$')
            });
            tags.importTags({!! $blog_tags_for_import !!});

        })(window, document, jQuery);
    </script>
@endsection
