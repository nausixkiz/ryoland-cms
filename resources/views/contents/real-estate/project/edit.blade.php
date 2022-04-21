@extends('layouts/contentLayoutMaster')

@section('title', __('Edit Project'))

@section('vendor-style')
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/katex.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/monokai-sublime.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/quill.snow.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/quill.bubble.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
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
            <form class="form form-vertical" method="POST"
                  action="{{ route('real-estate.projects.update', $project->slug) }}"
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
                                                   value="{{ old('name', $project->name) }}"/>
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
                                              >{{ old('description', $project->description) }} </textarea>
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
                                                   value="{{ old('location', $project->location) }}"/>
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
                                                   name="latitude" value="{{ old('latitude', $project->latitude) }}"
                                                   required/>
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
                                                   name="longitude" value="{{ old('longitude', $project->longitude) }}"
                                                   required/>
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
                                        <div class="col-md-4 col-12">
                                            <label class="form-label" for="number_block">Number blocks</label>
                                            <input class="form-control @error('number_block') is-invalid @enderror"
                                                   type="number" id="number_block"
                                                   name="number_block"
                                                   value="{{ old('number_block', $project->number_block) }}" required/>
                                            @error('number_block')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <label class="form-label" for="number_floor">Number floors</label>
                                            <input class="form-control @error('number_floor') is-invalid @enderror"
                                                   type="number" id="number_floor"
                                                   name="number_floor"
                                                   value="{{ old('number_floor', $project->number_block) }}" required/>
                                            @error('number_floor')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <label class="form-label" for="number_flat">Number flats</label>
                                            <input class="form-control @error('number_flat') is-invalid @enderror"
                                                   type="number" id="number_flat"
                                                   name="number_flat"
                                                   value="{{ old('number_flat', $project->number_flat) }}" required/>
                                            @error('number_flat')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mb-2">
                                    <div class="row">
                                        <div class="col-md-4 col-12">
                                            <label class="form-label" for="price_from">Lowest price</label>
                                            <div class="input-group mb-2">
                                                <span class="input-group-text">$</span>
                                                <input class="form-control @error('price_from') is-invalid @enderror"
                                                       type="number" id="price_from"
                                                       name="price_from"
                                                       value="{{ old('price_from', $project->price_from) }}" required/>
                                                <span class="input-group-text">.00</span>
                                            </div>
                                            @error('price_from')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <label class="form-label" for="price_to">Max price</label>
                                            <div class="input-group mb-2">
                                                <span class="input-group-text">$</span>
                                                <input class="form-control @error('price_to') is-invalid @enderror"
                                                       type="number" id="price_to"
                                                       name="price_to" value="{{ old('price_to', $project->price_to) }}"
                                                       required/>
                                                <span class="input-group-text">.00</span>
                                            </div>
                                            @error('price_to')
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
                                                src="{{ $project->getThumbnailUrl() }}"
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
                                    <input type="hidden" name="contents" id="contents"
                                           value="{{ old('contents', $project->contents) }}" hidden>
                                    <div class="mb-1">
                                        <div id="full-wrapper">
                                            <div id="full-container">
                                                <div class="editor">
                                                    {!! old('contents', $project->contents) !!}
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
                                                        statusVal="{{ old('status', $project->status) }}"/>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Open sell date</h4>
                                </div>
                                <div class="card-body">
                                    <input
                                        type="text"
                                        id="date_sell"
                                        class="form-control flatpickr-human-friendly @error('date_finish') is-date_sell @enderror"
                                        name="date_sell" value="{{ old('date_sell', $project->date_sell) }}" required/>
                                    @error('date_sell')
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
                                    <h4 class="card-title">Finish date</h4>
                                </div>
                                <div class="card-body">
                                    <input
                                        type="text"
                                        id="date_finish"
                                        class="form-control flatpickr-human-friendly @error('date_finish') is-invalid @enderror"
                                        name="date_finish" value="{{ old('date_finish', $project->date_sell) }}"
                                        required/>
                                    @error('date_finish')
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
                                    <h4 class="card-title">Option</h4>
                                </div>
                                <div class="card-body">
                                    <input type="checkbox"
                                           class="form-check-input @error('is_featured') is-invalid @enderror"
                                           id="is_featured" name="is_featured"
                                           @if(old('is_featured') == 'on' || $project->isFeatured()) checked @endif/>
                                    <label class="form-check-label" for="is_featured">Is Feature</label>
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
                                                    @if(old('category', $project_category) !== null && in_array($item->slug, old('category', $project_category))) selected @endif>
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
                                    <h4 class="card-title">Investor</h4>
                                    @error('investor')
                                    <p class="card-text text-danger">
                                        <strong>{{ $message }}</strong>
                                    </p>
                                    @enderror
                                </div>
                                <div class="card-body">
                                    <select class="select2 form-select @error('investor') is-invalid @enderror"
                                            id="investor" name="investor" required>
                                        @foreach($investors as $investor)
                                            <option value="{{ $investor->id }}"
                                                    @if(old('investor', $project->investor->id) == $investor->id) selected @endif>{{ $investor->name }}</option>
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
                                                    @if(old('feature', $project_feature) !== null && in_array($item->id, old('feature', $project_feature))) selected @endif>
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
                                                    @if(old('city', $project->city->slug) == $item->slug) selected @endif>{{ $item->name }}</option>
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
    <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
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

            const Font = Quill.import('formats/font');
            Font.whitelist = ['sofia', 'slabo', 'roboto', 'inconsolata', 'ubuntu'];
            Quill.register(Font, true);

            const contentEditor = new Quill('#full-container .editor', {
                bounds: '#full-container .editor',
                modules: {
                    formula: true,
                    syntax: true,
                    toolbar: [
                        [
                            {
                                font: []
                            },
                            {
                                size: []
                            }
                        ],
                        ['bold', 'italic', 'underline', 'strike'],
                        [
                            {
                                color: []
                            },
                            {
                                background: []
                            }
                        ],
                        [
                            {
                                script: 'super'
                            },
                            {
                                script: 'sub'
                            }
                        ],
                        [
                            {
                                header: '1'
                            },
                            {
                                header: '2'
                            },
                            'blockquote',
                            'code-block'
                        ],
                        [
                            {
                                list: 'ordered'
                            },
                            {
                                list: 'bullet'
                            },
                            {
                                indent: '-1'
                            },
                            {
                                indent: '+1'
                            }
                        ],
                        [
                            'direction',
                            {
                                align: []
                            }
                        ],
                        ['link', 'image', 'video', 'formula'],
                        ['clean']
                    ]
                },
                theme: 'snow'
            });

            contentEditor.on('text-change', function () {
                document.getElementById("contents").value = contentEditor.root.innerHTML;
            });

            $('.select2-icon').each(function () {
                const $this = $(this);
                $this.wrap('<div class="position-relative"></div>');
                $this.select2({
                    dropdownAutoWidth: true,
                    width: '100%',
                    minimumResultsForSearch: Infinity,
                    dropdownParent: $this.parent(),
                    templateResult: iconFormat,
                    templateSelection: iconFormat,
                    escapeMarkup: function (es) {
                        return es;
                    },
                    allowHtml: true
                });
            });

            function iconFormat(icon) {
                const originalOption = icon.element;
                return $('<span><i class="fa ' + $(originalOption).data('icon') + '"></i> ' + icon.text + '</span>');
            }

            const humanFriendlyPickr = $('.flatpickr-human-friendly')
            if (humanFriendlyPickr.length) {
                humanFriendlyPickr.flatpickr({
                    altInput: true,
                    altFormat: 'F j, Y',
                    dateFormat: 'Y-m-d'
                });
            }

            const thumbnail = $('#thumbnail');
            if (thumbnail.length) {
                thumbnail.change(function () {
                    const files = !!this.files ? this.files : [];
                    if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

                    if (/^image/.test(files[0].type)) { // only image file
                        const reader = new FileReader(); // instance of the FileReader
                        reader.readAsDataURL(files[0]); // read the local file

                        reader.onloadend = function () {
                            $('#thumbnail-text').text(thumbnail.val());
                            $('#thumbnail-preview').attr('src', event.target.result);
                        }
                    }
                });

            }
            $('#gallery').fileinput({
                showUpload: false,
                showCaption: false,
                overwriteInitial: false,
                maxFileSize: 50000,
                showCancel: true,
                required: true,
                //actionUpload: '<button type="button" class="kv-file-upload {uploadClass}" title="{uploadTitle}">{uploadIcon}</button>\n',
                allowedFileExtensions: ['jpg', 'jpeg', 'png', 'bmp'],
                slugCallback: function (filename) {
                    return filename.replace('(', '_').replace(']', '_');
                },
            });
        })(window, document, jQuery);
    </script>
@endsection
