@extends('layouts/contentLayoutMaster')

@section('title', 'Edit Property')

@section('vendor-style')
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/katex.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/monokai-sublime.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/quill.snow.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/quill.bubble.css')) }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Inconsolata&family=Roboto+Slab&family=Slabo+27px&family=Sofia&family=Ubuntu+Mono&display=swap"
        rel="stylesheet">
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-quill-editor.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/tags/jquery.tagsinput-revisited.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-multiple-file-input.css')) }}">
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12 col-12">
            <form class="form form-vertical repeater" method="POST" action="{{ route('real-estate.properties.update', $property->slug) }}"
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
                                                   value="{{ old('name', $property->name) }}"/>
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
                                              >{{ old('description', $property->description) }} </textarea>
                                            @error('description')
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
                                            <label class="col-form-label" for="location">Location</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="location"
                                                   class="form-control @error('location') is-invalid @enderror"
                                                   name="location"
                                                   value="{{ old('location', $property->location) }}"/>
                                            @error('location')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mb-2">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <label class="form-label" for="latitude">Latitude</label>
                                            <input class="form-control @error('latitude') is-invalid @enderror"
                                                   type="text" id="latitude"
                                                   name="latitude" value="{{ old('latitude', $property->latitude) }}" required/>
                                            <a href="https://www.latlong.net/convert-address-to-lat-long.html"
                                               class="text-end mt-1">
                                                <small class="fst-italic text-info">Click here to get this
                                                    information</small>
                                            </a>
                                            @error('latitude')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <label class="form-label" for="longitude">Longitude</label>
                                            <input class="form-control @error('longitude') is-invalid @enderror"
                                                   type="text" id="longitude"
                                                   name="longitude" value="{{ old('longitude', $property->longitude) }}" required/>
                                            <a href="https://www.latlong.net/convert-address-to-lat-long.html"
                                               class="text-end mt-1">
                                                <small class="fst-italic text-info">Click here to get this
                                                    information</small>
                                            </a>
                                            @error('longitude')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mb-2">
                                    <div class="row">
                                        <div class="col-md-2 col-12">
                                            <label class="form-label" for="number_bedroom">Number Bedrooms</label>
                                            <input class="form-control @error('number_bedroom') is-invalid @enderror"
                                                   type="number" id="number_bedroom"
                                                   name="number_bedroom" value="{{ old('number_bedroom', $property->number_bedroom) }}" required/>
                                            @error('number_bedroom')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2 col-12">
                                            <label class="form-label" for="number_bathroom">Number Bathrooms</label>
                                            <input class="form-control @error('number_bathroom') is-invalid @enderror"
                                                   type="number" id="number_bathroom"
                                                   name="number_bathroom" value="{{ old('number_bathroom', $property->number_bathroom) }}" required/>
                                            @error('number_bathroom')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2 col-12">
                                            <label class="form-label" for="number_floor">Number Floors</label>
                                            <input class="form-control @error('number_floor') is-invalid @enderror"
                                                   type="number" id="number_floor"
                                                   name="number_floor" value="{{ old('number_floor', $property->number_floor) }}" required/>
                                            @error('number_floor')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2 col-12">
                                            <label class="form-label" for="square">Square (m²)</label>
                                            <input class="form-control @error('square') is-invalid @enderror"
                                                   type="number" id="square"
                                                   name="square" value="{{ old('square', $property->square) }}" required/>
                                            @error('square')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <label class="form-label" for="price">Price</label>
                                            <div class="input-group mb-2">
                                                <span class="input-group-text">$</span>
                                                <input class="form-control @error('price') is-invalid @enderror"
                                                       type="number" id="price"
                                                       name="price" value="{{ old('price', $property->price) }}" required/>
                                                <span class="input-group-text">.00</span>
                                                @error('price')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mb-2">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="border rounded p-2">
                                                <h4 class="mb-1">Thumbnail</h4>
                                                <div class="d-flex flex-column flex-md-row">
                                                    <img
                                                        src="{{ $property->getThumbnailUrl() }}"
                                                        id="thumbnail-preview"
                                                        class="rounded me-2 mb-1 mb-md-0"
                                                        width="170"
                                                        height="110"
                                                        alt="Thumbnail"
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

                                        <div class="col-6">
                                            <div class="border rounded p-2">
                                                <h4 class="mb-1">Distance Key Between Facilities (km)</h4>
                                                @error('facilities')
                                                <div class="alert alert-primary" role="alert">
                                                    <div class="alert-body"><strong>{{ $message }}</strong></div>
                                                </div>
                                                @enderror
                                                <div class="source-item">
                                                    <div data-repeater-list="facility">
                                                        <div class="repeater-wrapper" data-repeater-item>
                                                            <div class="row">
                                                                <div class="col-md-6 col-12 mb-2">
                                                                    <select class="form-select"
                                                                            name="id">
                                                                        @foreach($facilities as $facility)
                                                                            <option value="{{ $facility->id }}">{{ $facility->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6 col-12">
                                                                    <div class="input-group">
                                                                        <input class="form-control"
                                                                               type="number"
                                                                               name="distance" aria-describedby="button-delete"/>
                                                                        <button class="btn btn-outline-danger" data-repeater-delete id="button-delete" type="button">Delete</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row text-center mt-2">
                                                    <div class="col-12 px-0">
                                                        <button type="button" class="btn btn-primary btn-sm btn-add-new" data-repeater-create>
                                                            <i data-feather="plus" class="me-25"></i>
                                                            <span class="align-middle">Add Item</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mb-2">
                                    <div class="border rounded p-2">
                                        <h4 class="mb-1">Image Gallery</h4>
                                        <div class="file-loading">
                                            @error('documents[]')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <input class="form-control" type="file" id="gallery" name="gallery[]"
                                                   multiple>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <input type="hidden" name="contents" id="contents" value="{{ old('contents', $property->contents) }}"
                                           hidden>
                                    <div class="mb-1">
                                        <div id="full-wrapper">
                                            <div id="full-container">
                                                <div class="editor">
                                                    {!! old('contents', $property->contents) !!}
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
                                            <em class="fa-solid fa-floppy-disk"></em>
                                            Save
                                        </button>
                                        <button type="reset" class="btn btn-outline-secondary">
                                            <em class="fa-solid fa-floppy-disk-circle-arrow-right"></em>
                                            Save Draft
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <x-form.select-status-component layoutStyle='vertical' type="real-estate"
                                                        statusVal="{{ old('status', $property->status ) }}">
                        </x-form.select-status-component>
                        <x-form.select-status-component layoutStyle='vertical' type="moderation-status"
                                                        statusVal="{{ old('moderation-status', $property->moderation_status) }}">
                        </x-form.select-status-component>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Type</h4>
                                </div>
                                <div class="card-body">
                                    <select class="select2 form-select @error('type') is-invalid @enderror"
                                            id="type" name="type" required>
                                        <option value="rent">Rent</option>
                                        <option value="sell">Sell</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Option</h4>
                                </div>
                                <div class="card-body">
                                    <div class="mb-2">
                                        <x-form.feature-option-component isChecked="{{old('is_featured') == 'on' || $property->isFeatured() ? 'true' : 'false'}}">
                                        </x-form.feature-option-component>
                                    </div>
                                    <div class="">
                                        <x-form.never-expired-option-component isChecked="{{old('never_expired') == 'on' || $property->isNeverExpired() ? 'true' : 'false'}}">
                                        </x-form.never-expired-option-component>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Categories</h4>
                                    @error('category')
                                    <p class="card-text text-danger">
                                        <strong>{{ $message }}</strong>
                                    </p>
                                    @enderror
                                </div>
                                <div class="card-body">
                                    <select class="select2 form-select @error('category') is-invalid @enderror"
                                            id="category" name="category[]" required multiple>
                                        @foreach($categories as $item)
                                            <option value="{{ $item->slug }}"
                                                    @if(old('category', $property_category) !== null && in_array($item->slug, old('category', $property_category))) selected @endif>
                                            {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Project</h4>
                                    @error('project')
                                    <p class="card-text text-danger">
                                        <strong>{{ $message }}</strong>
                                    </p>
                                    @enderror
                                </div>
                                <div class="card-body">
                                    <select class="select2 form-select @error('investor') is-invalid @enderror"
                                            id="project" name="project" required>
                                        @foreach($projects as $item)
                                            <option value="{{ $item->slug }}"
                                                    @if(old('project') == $item->slug || $property->project->slug) selected @endif>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Features</h4>
                                    @error('feature')
                                    <p class="card-text text-danger">
                                        <strong>{{ $message }}</strong>
                                    </p>
                                    @enderror
                                </div>
                                <div class="card-body">
                                    <select class="select2 form-select @error('feature') is-invalid @enderror"
                                            id="feature" name="feature[]" required multiple>
                                        @foreach($features as $item)
                                            <option value="{{ $item->id }}"
                                                    @if(old('feature', $property_feature) !== null && in_array($item->id, old('feature', $property_feature))) selected @endif>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">City</h4>
                                    @error('city')
                                    <p class="card-text text-danger">
                                        <strong>{{ $message }}</strong>
                                    </p>
                                    @enderror
                                </div>
                                <div class="card-body">
                                    <select class="select2 form-select @error('city') is-invalid @enderror"
                                            id="city" name="city" required>
                                        @foreach($cities as $item)
                                            <option value="{{ $item->slug }}"
                                                    @if(old('city', $property->city->slug) == $item->slug) selected @endif>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
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
    <script src="{{ asset(mix('vendors/js/editors/quill/katex.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/editors/quill/highlight.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/editors/quill/quill.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/bootstrap-fileinput/plugins/piexif.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/bootstrap-fileinput/plugins/sortable.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/bootstrap-fileinput/fileinput.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/bootstrap-fileinput/locales/LANG.js')) }}"></script>
    <script src="{{ asset('vendors/js/forms/repeater/jquery.repeater.min.js')}}"></script>
@endsection

@section('page-script')
    <script src="{{ asset(mix('js/scripts/forms/form-thumbnail-preview.js'))}}"></script>
    <script src="{{ asset(mix('js/scripts/forms/form-quill-editor.js'))}}"></script>
    <script src="{{ asset(mix('js/scripts/forms/form-select2.js'))}}"></script>
    <script src="{{ asset(mix('js/scripts/forms/form-select2-icon.js'))}}"></script>
    <script src="{{ asset(mix('js/scripts/forms/form-gallery.js'))}}"></script>
    <script>
        (function (window, document, $) {
            'use strict';

            const repeaterForm = $('.repeater');
            if (repeaterForm.length) {
                repeaterForm.repeater({
                    show: function () {
                        $(this).slideDown();
                    },
                    hide: function (e) {
                        $(this).slideUp();
                    }
                });
            }

            const btnAddNewSource = $('.btn-add-new ');
            if (btnAddNewSource.length) {
                btnAddNewSource.on('click', function () {
                    if (feather) {
                        // featherSVG();
                        feather.replace({ width: 14, height: 14 });
                    }
                    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                        return new bootstrap.Tooltip(tooltipTriggerEl);
                    });
                });
            }
        })(window, document, jQuery);
    </script>
@endsection
