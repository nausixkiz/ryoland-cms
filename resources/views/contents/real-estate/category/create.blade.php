@extends('layouts/contentLayoutMaster')
@section('title', __('Create New Category'))

@section('vendor-style')
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/jstree.min.css'))}}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection

@section('content')
    <div class="row justify-content-center center-layout">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ __('Create new category for real estate') }}</h4>
                </div>
                <div class="card-body">
                    <form class="form form-horizontal" method="POST"
                          action="{{ route('real-estate.categories.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="name">Name</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="name"
                                               class="form-control @error('name') is-invalid @enderror" name="name"
                                               placeholder="Name" value="{{ old('name') }}" required/>
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
                                        <label class="col-form-label" for="description">Description</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <textarea
                                            name="description"
                                            class="form-control @error('description') is-invalid @enderror"
                                            placeholder="Leave a description here"
                                            id="description"
                                            style="height: 100px" required
                                        >{{ old('description') }}</textarea>
                                        @error('description')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-9 offset-sm-3">
                                <div class="mb-1">
                                    <div class="form-check form-switch">
                                        <input type="checkbox"
                                               class="form-check-input @error('is_default') is-invalid @enderror"
                                               id="is_default" name="is_default"
                                               @if(old('is_default')  == 'on') checked @endif/>
                                        <label class="form-check-label" for="is_default">Is default</label>
                                    </div>
                                </div>
                            </div>
                            <x-form.select-status-component layoutStyle='vertical' type="real-estate"
                                                            statusVal="{{ old('status') }}"></x-form.select-status-component>

                            <div class="col-sm-9 offset-sm-3">
                                <button type="submit" class="btn btn-primary me-1">Save</button>
                                <button type="reset" class="btn btn-outline-secondary">Save And Edit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('vendor-script')
    <!-- vendor files -->
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
@endsection
@section('page-script')
    <script>
        (function (window, document, $) {
            'use strict';

            $('.select2').each(function () {
                const $this = $(this);
                $this.wrap('<div class="position-relative"></div>');
                $this.select2({
                    dropdownAutoWidth: true,
                    width: '100%',
                    dropdownParent: $this.parent()
                });
            });
        })(window, document, jQuery);
    </script>
@endsection

