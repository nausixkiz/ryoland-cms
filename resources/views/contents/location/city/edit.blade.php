@extends('layouts/contentLayoutMaster')

@section('title',  __('Edit City'))

@section('vendor-style')
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Inconsolata&family=Roboto+Slab&family=Slabo+27px&family=Sofia&family=Ubuntu+Mono&display=swap"
        rel="stylesheet">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-12">
            <form class="form form-vertical" method="POST" action="{{ route('location.cities.update', $city->slug) }}"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-8 col-12">
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
                                                   value="{{ old('name', $city->name) }}" required/>
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-6 col-12">
                                        <label class="form-label" for="country">Country</label>
                                        <select class="select2 form-select @error('country') is-invalid @enderror"
                                                id="country" name="country" required>
                                            @foreach($countries as $country)
                                                <option value="{{ $country->slug }}" @if($city->country->slug == $country->slug) selected @endif>{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('country')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <label class="form-label" for="state">State</label>
                                        <select class="select2 form-select @error('state') is-invalid @enderror"
                                                id="state" name="state">
                                            <option value="none">{{ __('None') }}</option>
                                            @foreach($states as $item)
                                                <option value="{{ $item->slug }}" @if(!empty($city->state) && $city->state->slug == $item->slug) selected @endif>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('state')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 mb-2">
                                    <div class="border rounded p-2">
                                        <h4 class="mb-1">Thumbnail</h4>
                                        <div class="d-flex flex-column flex-md-row">
                                            <img
                                                src="{{ $city->getThumbnailUrl() }}"
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
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-12">
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
                        <x-form.select-status-component layoutStyle='vertical'
                                                        type="normal"
                                                        statusVal="{{ old('status', $city->status) }}">
                        </x-form.select-status-component>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Option</h4>
                                </div>
                                <div class="card-body">
                                    <div class="mb-2">
                                        <input type="checkbox"
                                               class="form-check-input @error('is_featured') is-invalid @enderror"
                                               id="is_featured" name="is_featured"
                                               @if(old('is_featured') == 'on' || $city->isFeatured()) checked @endif/>
                                        <label class="form-check-label" for="is_featured">Is Feature</label>
                                        @error('is_featured')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="mb-2">
                                        <input type="checkbox"
                                               class="form-check-input @error('is_default') is-invalid @enderror"
                                               id="is_default" name="is_default"
                                               @if(old('is_default') == 'on' || $city->isDefault()) checked @endif/>
                                        <label class="form-check-label" for="is_default">Is Default</label>
                                        @error('is_default')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
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
@endsection

@section('page-script')
    <script src="{{ asset(mix('js/scripts/forms/form-thumbnail-preview.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
@endsection
