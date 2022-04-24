@extends('layouts/contentLayoutMaster')

@section('title', 'Create New Project')

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
            <form class="form form-vertical" method="POST" action="{{ route('real-estate.projects.store') }}"
                  enctype="multipart/form-data">
                @csrf
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
                                                   value="{{ old('name') }}"/>
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
                                              >{{ old('description') }} </textarea>
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
                                                   value="{{ old('location') }}"/>
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
                                                   name="latitude" value="{{ old('latitude') }}" required/>
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
                                                   name="longitude" value="{{ old('longitude') }}" required/>
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
                                                   name="number_block" value="{{ old('number_block') }}" required/>
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
                                                   name="number_floor" value="{{ old('number_floor') }}" required/>
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
                                                   name="number_flat" value="{{ old('number_flat') }}" required/>
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
                                                       name="price_from" value="{{ old('price_from') }}" required/>
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
                                                       name="price_to" value="{{ old('price_to') }}" required/>
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
                                                src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAe8AAAHvCAIAAADy68CaAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAA2RpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNS1jMDE0IDc5LjE1MTQ4MSwgMjAxMy8wMy8xMy0xMjowOToxNSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtcE1NOk9yaWdpbmFsRG9jdW1lbnRJRD0ieG1wLmRpZDo5MEY0RUNCODhEMDFFMDExOEEyREM0RTY3OEVCQTNEOCIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDpBNzRCMTk3QTc5MzIxMUU0OTNDMkVEMTU0Qzc3OThENSIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDpBNzRCMTk3OTc5MzIxMUU0OTNDMkVEMTU0Qzc3OThENSIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgQ1M0IFdpbmRvd3MiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDoxNTAzQjA3MTBBMzcxMUU0ODFDODkyQkY0MzlGMjdFMSIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDoxNTAzQjA3MjBBMzcxMUU0ODFDODkyQkY0MzlGMjdFMSIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/Pp+FiK8AADbGSURBVHja7J3rdtvI0XYxtscSKctOsnL/V5RLyVqTWDZJaWzPVy+fqL5S40AAbAANcO8fWhRFgTg+XV1dh9/+9a9/VQAAsHLecQoAAFBzAABAzQEAADUHAADUHAAANQcAANQcAABQcwAAQM0BAFBzAABAzQEAADUHAADUHAAANQcAANQcAABm4UM5u/Lbb79xPUbw119/ZTnPQ7fD9Z3nei313OW6r3Kdn6Xun9KuF2qOOqDmqDlqjprDbYDacp5h1aDmqMP/ePdu2kWUFdk4kzL1eV67Lcxoh5rDtU8LTxFqxei7bkOBUwAAgG0O2HrAfcX9jG0OAADY5jDOliFCcVnWEqG41HEtdX9imwMAALY5AMA6574FzhVQ89XcPUvN9PGQrOv6Dr3upXlItporOwN4WgAAtgBqDgCAmgMAAGoOAACoOQAAoOYAAKg5AACg5gAAgJoDAEAT5IJOzq1VFm3LkSut505plFb1jCpa2OYAAICaAwAAag4AcLPgN4fMUHMRANscAACwzQHbHADbHAAAUHMAAEDNAQDgavCbZ2Nqf/FS/UKnzuFs+962411LTumvX79WcX1z7c9S/WbJKcU2BwBAzQEAoDDwtMDCENEIgJoDqgoA/wNPCwAAtjlgm0/2vcQqAGCbAwCg5gAAgJoDAMAi4DdvJZcfeat9QafOyVx7jM3U52fqXNPSckeHfu8NrrtgmwMAoOYAAICaAwAAag4AAKg5AABqDgAAqDkAAKDmAACAmgMAbBVyQVeTc7j2vqO5cva2Woe9tL6aa88dXWr7C+agouawcZXkeuVVMShWzfG0AABsAdQcAGAL4GmBQmesAIBtDgCAmgMAAGoOAACLgN8cFmapnjUA2OYAAIBtDqXavMB9wtwINUfdxmx/LZn6pWWQl9ZNONd5yLU/S2XA32AmfWngaQEAQM0BAKAM8JvDTCzlxy9t/YD1DMA2BwAA1BwAYNPgaYGNs9VYFADUHNatqpwf1B8awdMCAIBtDti2wH3IHAI1L1z1trqdtYwuazneoWpVWm7q0P0sLXeUdQgHTwsAALY5wOZs8Kn3H88DoOaAegJAK3haAABQcwAAKAM8LbAwa49JwG8OqDmgPgCQDTwtAACoOQAAlMECnpZ37/IMIWvvw7nUeRiaU5frPLd9769fvxa5XrlYKrdzLTmWbfd523Wf+nncsOcQ2xwAANscbpip50ZkOQFgmwMAoOYAALBC8LRAoWzV00L8PqDmsA61zRVrwXkDQM0B2xzbHG4O/OYAAKg5AACUwQo8LWvvh7mW3Neh/tyhHoNcuaZrr6049P2lciZz0Xa9huaIUi0O2xwAADUHAICVQEwLZPYYwDznPxfE2KDmANtUNwDUHFBVmO88Y1MDag6oNteFUWGDsAoKAIBtDtiGs9uA9CTCpgZscwAAbPPt2oy5tjM053MtvXuW6lc5tc27FobmUg7tvzr1XGHo54c+R1P3lV3R/YZtDgCwBVBzAIAtwCooZJ6ZwjauL6usqDmgGsv49wFQcwBU9XavLzY4ag7AKDKG0tQTlUfNAdsNdVhy9OK6QAIxLQAA2OY3aSstlSWUy7by/fcN6kWurJ+pbb2ps5OW2p+lKgFMXb8+V1ZR9uddX7SlqQm2OQAAtjkUPLfY6uri2o8X/zWg5rAOVYJlzyejAmoOqAPHi3oCag63p2K39r1D92ep1VpGF9QcbkXlt/q0Y5vDjUNMCwAAtvm8tmQSHz217TZ1XHmu7Vw/09cnc9nyuTwMQ8//UjZyrvMztWdm6Hbev39fvQ3KTvYweTPX9Zqtu4W+yL8uVzcPbHMAWCWENmGbw8093rcW/77t62uWsr3wWR2LB6g5qsd+rv78rKUmYt79l4JHQeeJRs2B0YvjKnFU6GmbY5ij5rBZ2xwzLe95zlX5djrbnCuOmgNqxaiwPtu8UdC5vUuAmBYAYJTFNt/GgLZQvfJrnqX4c3ScchJvmysOeupM9zJXHWPY9W9nfv369dcr+pj+9OPHj0HH1XZ/Do2PHhffndwkxs+fPye9/6euh16/4cct5BY4I0HNAa7C1C0+2HI+OP6msYH8FMA2hw3OoJlx+3mQ77itl40b77LW22ztra6K41VHzeFWRoXStj/4Efrwfw+R+1V8D3/8+OFeF/e9VHSrANQcbk21V3QeGmP1pN2JoFft/m5sc0DN4bbUubT9NBs8FoZz+bb3XcH1Uz4WvOeAmsM6VPXWbDdTZ4n4+/fvP7xiv0q16870bcTwAGoOsDVkjJuCf/z48e7u7uMZe/NwOPw6o6AXciYBNR9cj3vxZ6YeojtUHbJYbT134GJ9asUXJwfVsfGpbclc21f97mSbMeYk+SIPXEkM7c+fP//+++/Scf/HHz9+PD4+Pj09nU6nd2f0j26zb4+lKhCwqoxtDrc+17ZRKlmflPns/u4kWlxCrM+4JW4vbFSwPymyxc+P3tGfkmh07h9AzWEZLU7s8dmkfOovkprLT9Khth4n/v6MZPrulbYJjb3/+xl7EdOL5GRfxflh4EHNYZuW8vVSXppF35auaZIdly7tA/aO/ZQlLre4vfBwwyjo0Tlu79snTdDdop/H8zD1fYXKo+aw+tHiyr6spSG/eaLmyYErQMUUOYlXcUPbbe3G0c7+0QT9zz//HFrbZIrRERVGzQFbPo+Ul1Y5QKLsZni007VuKUv8/v5eHpV6kSZ9zMTaXycfkE/m+fk5riQvZQvfWlcN1BzwtFyW8u7ajWshKXAot7jrskxy/fSj9n+J5yGx8ZPTpY2YoGsd1fP7UWFAzWGDo8UieGWVqOAmzWaM++voUXGb3cVRWaCm143bN3tc/hkNEhLTDUcoAmo+Xk2GqkyuOuZD47jbPj90f0rwYCTLg1lswxj3fQ2KLKzPIUxP/wpIxP19WeXyqBgx0DBeKfe0xKPo3nMfKna7ne3b8XhUcMtQj8rUnpap5wo6S/HsZcmTmO789NlJ1Bxgylv5Nc7En8nYL8Lta+mLRNZeKI7Q1zYzZmx6wRZfQW3rUwGAmgMemzc2Zix65bOfWBVLwqoYlf1+r1+nMPTi3EuRLbYbyvIfWt8cfzeg5qjhtNsvzZ+uOPF65r2WH5XOo2hxqbn7SdpapmWUdZn/Ly8vSXz6FOcZ9UfNAdaNybRppZnAZv96Xwjj4eHBMzOl40mXS1/hzOXBd1X1L/KAGZZAATWH1c8VprblFQUoXfb4QtPQ3W4npU4ShTy+MK+IRzX3MPZYtmXq84NtjprD1tSztO1PjVzS7k5R/n2jUmtRNIYbTkFMOFLYjPJCUVtAzQG6eHh4kEkuq1weczXnTAYtL71StTdlzj5AemEAE3QuFtyomieB29lNyFzx7LniypeywaeoGx5pcxm7OyIpg+W1TdxZoZ+KNVSkipItZYZ/+vQpuU/63DD1vyo2prGqflJgSz56ZQ/Va3glr1WE6/n5WduPke+eZXrNA3Ixv6Ft+2335xRx6PXuqdd/77jn2lu5tn2gLfy85KkVtjksjAd6R3WrXssTuq9Z4X2qcShTV+4LX9u8ciz0h7ZxfyTH9qvtw48zqqVln/n73//eqP7JcKVxznbV/fuJXlwvXvhwsM1hm6wlojFpoZnY1G6pufWqdUtv2+YB46pXPmIaF6u1xLATKbhvR/L9fMZea3JgPD4+xiD37lmL7fP379895MaPfUQvp7qNiaCj5gBzqH+36Zok/thP5cHL/vUQQ5m3nl3ZVuuqGliAIWqxvi4aztJxU2E3zKMcv7y81AMfG10uUnP7Kas/aZRxjUkeBX0pDxug5rA1dR66PzGHswqlDZUNpPfVeNM7t7UZ14OkvM3R7Ns3ETelliUuHa9CIVzfYfuMit/WXStVrVSAZhXy+yc1eIfWaUlscwxzQM0hs+dk3Pf+VcMt8Rim0tb1rdEu7jkn8F/dUW7ybSJ+Op08oNAXOZO4Rlnu3q4o2atGe/n+/l7Lp/FPajh3pW2+jUrFgJrDWm3zGNGhZU/VwIoelViHtu4b6ZDOnrIu01s2uIm4e3iq1wKKUtt65zlFtpi53aih8U3fmqm5fYUsej8D11TK7Wmb42lBzQGmJa4EmizuzkR3iqzmxHfRKOUjkCKbUrtTxV5oFLm7u6teY2nkGGl06cTqjI3mf/wiDVdJYmqfFdQ2Eef+gaLVvDHes/7cTl03fDrjtHtGPDT+ffTxdp/ni98bgzHiocWYkPrxRr+KV6w1M1zlxT3WMOpgInaxA1yyP26lNu5zosVykpiZLBH33VP8uG3NZL3jJPimlBBk2/Gd91bRcVdjxV3NNmL/imiq97y+dUeTfg712Az93o6hq8/7o+Myp64+Vt+x1Q2W2OaQebjyZBn3NeupMLGTkSu58QCPh4cH96g0WrU98WEg8caYUKpMin61b/dQcd+f+PkRz7CsezUb6mNoK2dVJRUzVlQHbHOADFONGIcXEzs9K0dZMwpWqRvjGd0miQPdAxlNOmVEa3lTvYeSFKFq1GqwvOe2TTURvThb0uHbv8gkR80BNYdSND0Jwqvehoj4DF3OaM/6kf3eqN0j3EceJZLEnNg70k3P+pGvICrp9ZIqk9823tYmNJlGmJofj0d3tuABB9QcSrHNq5C9KSnXOx6joq6bijXU5+XxSOSvj23btj8uyh6mYruhhpyS2uo14tt+moVeL64y7nt1vDY8qNLAxQmEl5epZ/kDoOZQiqa7jSyPiirBSkMTzbpY8nsQvswoHX85o2CVJGZc401bD7kRq21ewkWC3tgquo7OjHYP8xxQcyhIyvVT2u3FaWOYSrI+2eHfGLE2aNa3ciydWKUrxtKoxIoCEGOFvHEGsi8P+Aygv5rbPmg/CTcE1ByWl/IExajIKq9/3lXVwxOT7syjdU0elaSOipY6kzZAHoNYvU1HqsYGcSvKMOYcdaNSMBrw0HHYoJrX48rLdCYOjc/tCFWedH/Gbcf3zeXVZddDD4VitL1NmixNT7q5eH3dMI91ChujSuqCG+3xw+FgOv7y8hIt4rYSWv5mVYubTspYD71vFTmj4lxaJGhMNYpjhqG10NPp1NEIKbkuF/ewrb58Wxz60PsnVz30qbc/NPe1rW9JMm+LtxZqDoXi6iONlg4m0XsypaULZldKxyXlWt4c4QSvl17x1dRGh4x24M8z7kvZ7XYL9vSJTqS4Ahzt7rq4eBekWOYFADWHDDZRbH/c6HmILpH9fi8pj2EqGWdpyeRMfgzFrWuRU+5vb6CskJX55zQ+d4mjnTKJqqYWNj4uauTT0sLQnc84h2MgQc1hc7fCq4u5PoX0GiNypChsw34mTgz9b9tMf6jW+Nqpe8PlEDc1T2bl+lM5MxsNNjZdSA6w0VuiyJYCp+2AmsNaicuSicprOVEKLqdK3aNyTWfLqmmZRHsij4piDWWbuyvci6I0RhzOZpsn9WQ8VPH+/j75ipgZG1NVPbKFmxBQc8iAV55KPCqmNd4swlt0qqZgFTzdHet4/W3baOGeTiePOIz59yo/G3NNl62zFj377vGXOjeek2RVzT5gJ1bDFZ4WQM0hj69A4vIhoE7zih+vG6GJoo1Wmehudhvc1LyqJfXE9dj6m4PUKpdtnjTAq16jHbyYVxT05LzJva4Zj44XADWHa1FaplY1vZpK4vdw8fIwjFya6A4KL6Xitq0PHi76ej8WhPFVx6Vs82SQ0+E0zhuS2jXa7bzLyICar4yh8+uhdcNnUIFB77cdr/fESexWpbS4N7zeRrl6G1H7+PgoHXcRlyRJaOr2r3eQaCwMHT0wetM0OsnjlxD/97//dR9L4lFpE03fAf9Th5RPfX2TBQM/pU9PT1++fNGO6RrFyHqPUteL+/v7h4cH+xdNhlS/Rf2g6xXku+ccQ99fO9fEldefgurq+uZTx+Njm296QD6rbbKA6Yk5fm8lLSgVBGL/azqy3+/ljJZtHu/1jiGzUUBjK/rkYfByVF4/Vs5l7Undb74Bz1W8HBcHFQ11Sbg6tzeg5rdFvU53hynnFcY9gVOe8WsmQI05MknwojKSpOPClwo3aTl6on89GbURBZ4rjj5Os9B0QM1vBeVAujHuQiC/bdRZvb/b7dwzLve3F/9LxLe/bNWHjfirRprD4RAL1XrbnXpHum3ol6Ygqnje3TvQ51h2CVQ7TJMqok0ANb8t6unvMTtREu/GuL34/PlzElAYreOhehrTR6NJ7ouTHmKo5gxeZsv9+F5BNwn120BCjYZJ5e5f/LCCW06nky+EkFIEqPltEf3RcS1ROT4qGegxKi4rUVUlrGYVJirfHbUSHdx1e9w9KgpT8aov9f9Kqm5txjzX+oTay/lp766Y6M6WxH8FgJrfim0uaZYp571+5EhRZdqYvelu2cQnntQVuSipSTlAhVcb0m6Fjcceyq7mScxAY/efDQiZrxPIe35xVVPprLHBHrY5oOa3hUdnu5Sre7JMwtjxRx9rk87RGZWSLSmX/fz69WtVyxFVc85Eu2MHicTk34B57ln+vkJw0Wcln1gMCmIJFFDzaWfQk24/iR+v1/qIxrhaJ8udok7wuzNte9648z0lo67+sW3b8/Oz0tM9Pt2HEE87atzs0KyftVisXkXdzoyG2O7P6zzYjGq/33///t2mOJpa5TretqusjqaPj4/aVRv+NZ1aS93zoXHiSQxV9lnggvcnal4ccYotY032mrsy4vOv0t4SCxVUmc2aMxs88ah0q0DbYzP07l8q5/Ma9fFViosq6a0/vEH24XAYdD4vDsYJ9l2qLeztmXgGsc0hDybKcTHT82vcr+0NlGWVPzw86PlPHt2pH0v3CXgqZqM7frTNOFSVSsPOiYY3Dbp9PC06e8rk8kXstqT/XOfBtqNO03EZgwVY1Bwy4DFteoxl/3rzTF/YlCWuX6+XyBHYKFI15UkPFYKhu7qWyrFScwXz9IlpcdNYOu7uqaFzkaHn83Q6PT09YZuj5jAJ3oBYT5eqeex2O/nHG9u2uXva47hn8AjVH/7RfTW352mpXl1hQ/9LV3y2uYgGDzfM6wkEgJrD+KdL0qysd8m3icKXL1/cjR4f9dh8ec799EpScVW2o2vErdXX9uq4bW2CEy6u8k00/fJVQZdyL/jFw4iaQwaV9Mq0vryZPO2egNNoSc1gXtXrc8nEm9pvvhaViReoeluPbITaTjoRjHdLz3hKQM2hl0qadivQ0KTcH2aPeKve9gaKbplFNCup9tXm1x5qey6lbhPJetV7XSG5lG3nc+hcp+Pz0WmWt2w93KiaNxqYVXn1x0d/vp6zroJZCitUGIMp+D//+c/GremdxM1S1SLhuh9vqX/8lx8/fpxOp0+fPvVX1USVknSkqf3a6/XMdO95YwpVx+iVsU9I9TbbS4u36z2r41bj27bTeKJGWBvUN98yLy8v6vCr1E3FjI9o3x5NucYnPBF9F/Tj8aiSWGpJvKLVRQBAzQvChNss4oeHB/nEkxiV/sTiWY0Snxjvz8/PyhZ5enryaosLdmIDANR83Zh6qn+Y+5qlquNWEeu9e5JQZSXfq7Shvs5scy23tgWtAwBqDpc5nU5e2MTjC0eY5x5hFpt/VufVM+Uiqsq21NzLA0jopfjaAdL/AFBzGINMciMWV/EkwBFbq3dhNkvcFNyGDVWpjervIu4VEAljAEDNYQzKEjKd/fjxo0Q8iTbpSaydrTYRGiTUxUbtNz1N3DPL/3qLfQC/OQBqDmNQaKAKZimURc7uoba5XO2S6ZeXl+PxeDgc5MPx+otSan2FR6x7C7fVRXADwIrV/GJi9PpO/YcPz8/PpqSfPn26u7tzq7mt8om/r+ZBbkrbFiTihlniGhK8e1ks8yTVtu+1LahWn7vL29Lx45ihDdoIpFLdbVktbaPRUL/8xV1qu0NmpqOKVlJEu/sM5Kp8INeZV22rLmWWxfwv30LHOkqubK+hdcknul5+1Lq9650OUXPodVdJar1tZnclUpNgPZ/2U1VctLBp8up1xt39PdGNaLv67ds3Gzbkw5lUnaeuxTiDmjdKedt5UN3jLKOgnQobqvf7vbx5rIhgm8PkKiC/ismx2ea73a5nXWn7zOmMGijbi+rVJ+7FqTMm+vtIo6/WN9rPtg5Hbd87tJLt2m3z5AP+sakrH9hY64vbFTn6qDnMg9TcHj91gOueFLu62ee/fv3qIq5OCFFwpzDMva6Avs5LA/Zn6o5xpal5UvDAP9Z2HoZ6rjpGQSUQKIeA1hOoOcyBZNHsXEWC99E7OVWUBOTR4omI59W1xGb0Dme5/ONb9bREl1f0urRd5byellghmUJaqDlMLuX+sCkwfL/fdzxyWro0zJCXj8V95fGJ9Sc5b5UfLawp3lE73OZpydX/c2h6aoFq3ug6bzsPSS/A0efNJm2yzX2hBSlHzWEmTVewoAm0ZscXbTH7jAn68Xj0KittJuHUI9AgdRvqBx/qZy98FdRfTL0KqmXPOMwj5ag5zOFmcRmS2dthkNa7Q8RY8qRay7hEpDZ18Gl7n/Gm7XtvbRU0Rv7Fz0y9CqrAUy/iht8cNZ+QKGH1kt8Z7cdCnvbu+HE9cvKbq765PCruXU1sK02f9/v94XD4/v373d2dn9VYorrKVy8+uVI26shpPrTu9tDPj+i6UJSaVy1JEkPjuNuOt80DI5+YfurmUS2gtu1rZdsbVlxs9Nz913q89q3lpi1YGp4kwCLwsrQxHLDx4fFfP5zB7AIA1LwUHfcJuIJb5D9pCzT0ifP9GVrxAgBqXpamK1RRUeQduu9q/vHjR2XYAwCg5qUY5p7ib7Z5vW5GYpv/78q9e3d3d0eXCQBAzQuSck/FNkF/eXmJtTUSxcc8BwDUvDg1j1Eokm/TcfV788/EHHoPB9I76kXHmQQA1LwUNY/tJmKfoOpt4FrMQ5H93pZACAC3RkHZQz3jxCeqRnLNDo9Lv1TBE+8aobBce/2f//zHLW5FClfnMHOPC65CL9Dff//98fHxjz/+sNem7NqUfWxoqs4YQ2B4/LgPWl7osSNT0Y/RGycp2mdoJd6h+5+r2leuOjNLBaHWfX3967Pr+vaJTK9vYS1Bt0PzKmYIPyMXtESb3QXL74yOB0OB5yqfEq3+0vK5bSdVWKZ6zVjRYPbw8ND4+efnZ7U2VRi+4vGJrwdAzdeEypebhe72qVvlde7OqK2oaqbnzezPaMtrDzUpUUCOctAbP68ZhuqLqbXp6NapAKg5LGObm1l6OBy801u3oa3IFqnepCXOr0SWtarp2g6bmsfeXY0zWQm9FP/PMyp7wE0CgJqvA5Nm9feJ/UI7kJ0rNVekY4Fl8+T619ij46peS3p1/JevFugnua8AqPlq0LqoMolM+7w5XMe/fDxjA0D2NnKZ77azVR6jKrunEbEUlLxJ8p5zkwDUYdJaopob6l+h5VCvndt6Fd+9kw/aPS0FuiNsvInJq9JxWdyNJMOYvbb/JSITANt8ZagdhNuhHR4JX1eM/YYKtM192dOrRXrPs46BLa58diyZAkBBFtxfnSSm64bbqahBqCnXy8vL4XCQoHfUY5GC73a7T58+yTxXpVyPconm7TznTQueHmd5Op1Myvf7vWuxHOjdEwjtuY7IX2s7KrPuywPjnOm/WuiYAFWva7buzVfWrq6X+rXqw3bt5pnDJZXTM65+tz16Uz/vjQdFZCqelnVektCcVz2dez7bXvF82aXC5Jn0Nkm5ti/pjG6l2Y4rGQk0JdKihQ23Cp+vQjQOAGp+07i/WLkzZoT2zMEzu9VkZfF1wmQqIMnLqG62KQl6NOJm0PRYLcf7itgJt1mRonRM0N3Rj5oDag5vbHOthbb1/03UXIuEHZ0uZh6TXNDVQj6jbe5qPv8oFScEOi4756bd9kLLABJ6GisDag5vMB1XWlAfNa/OcSO+0rigbR6LiFWvFWkyjhNxwKufhEkPLR6RRNx3QMNMFXq0AqDmN020rFXx/KKzJdqtNus3iSlETXwldgozOVmgm3PaISk3fGnUsF9tNJWgExQPqDlUsei5nC2qUtJTaEzNTVMWXAh1d7k0biI1jxE780h57Pr0+xkte/qys72jk4+bBVBzSKfzVVhz62MIK8VGkS3lHMt0kXNzelrcd+S2eYyr0QtXeW5jmJ8FVt7rUcYdbTDLN6JH739b3XY/P1481mT66enpH//4hxdHjEmSf/75p7y3vjSnmDkP1vY/yZjNFW7RNsCoQtbLy8vd3Z1KFOx2u3iW/MA1SrUtkMYqBX4UCsYXNmXxWMCMc5F4NZPAZ51exbx7PXqFS/rH7K92yCqaVh+eFSlfvV0l7j6fF2+/RdxN/e+H0Y9VclClLUW07c+C02Js83IHCb+VlZZiP305UWZ4WyKVx5DUzdgZHvj6XS7vvwJRquBMH5rbKe/TzGuM7i+qXj3mMZymLvoew9M4KUmuwhRzF8DTAsUJejRIVVWxUTHrcx0Vt/JC5zOvFtaHDe1/PKLGrL+ew5uvIkxktSXeG/fR+zAZR6D6PsirHivOx5oziZffN05tSEDNt2+bS83Ntj0ej/7M91HzJFpufts8RuaYmtdbWvcxxutKrWmKb22evCGpcIwrrztk/B37gJf8TfxLPqlKNo5tDqj5BklUoHpdCI0lFRvVMCbTx0yiKBxzhn/EQzAJVsX2KOh9JCzx+2tgS2zzqY9FnvEPrzSWl4k7IxPePUvJwJA4ZwiAAdR8+2ruDZ31jiqet9njdUFRc5/Etz6ndsT9t9eHw8Es9Di9uGiTxr9q8cC24KUlJ2q0VHcHKYJFOZ/dva2jJa7Pu4OlqkUr+TiRrKMCjINqEiWqeVL40BcPZZ6rHsjFf1Qmi0tGd3mAKQYkeRV8NLKdl09Z8TY9PT8x5EOJVJLy6eQvqrmXDFNJlvil9T1Pzr+NppqUJFez7QUJR4Btvn1xlxwrkyhm+TfapL74pupU81cPThYGvd6hbGrnorckKqAEUeb51ElDicnvgp5kfnbstqeGenpR3X6vQpoVtjlgm1+eng9Sn0KItqcU3CfmZt5+//5dU/i243VdkDl5PB69M7LX466XPu+jbt50VHuYGNdJlF4Vwiv15m63s//99u2b50wm5VYSL4RvUNHrwvY/xnH3ue5Dr69C2pVP67USzdBu+7rkwJOyORrDFNLjZr6vlGqapXRfuaHkoNeV0pAw1GbXNVK9dW+T3X28fstNsSRbWrhOMqZefLGihQ08LSsbqGSf6im9eJ8pBsNkQkEgJWSXeGFI9R6SeNWjtn3I0bKnoXFoBhtWXyEx9cXPcd8r1XaXl6RcCq4ta7NxbSPJDyDWBVDzbbpc3NnijZK7n3ZZwfI1z19Ctm3OpP2xnxJKBfPFtFXNGxS74mVq3G8z9X4qy1RnLFrQI4RVwUWyeV3N63n/Xn/RJ0z10gUAqPnWbHOP67iYRWkflpofj0ezhRe3zavgAZetLevbXse4jtjULeZh1ufI053kmMTvkePjzHxP362HmSfHIqcK5dEBNb8VlIljuLOlTd0k3+XUgXKvgguZahV4qZNEzT2kJAanz2CravBQBpZL+WiFra9CJylgvhBq3+jBlzp2DHNAzbfsbKleW1gonPyiZ0MreAptlCN4cY1wb4nW66KDJWqcVD4KYreg57JnvVK5nbe4Tnvl9t1/0ubyskHXrlF9ERgANd8g0mLFSJimX7S4pY8SJp/CL6Xm0WGisA0vCVk1hf25qT5zaIEXWtHsJ4u/vk+sSNInOpaJ584H1HybtrkE/WKYilu+SjSXLixo8bmaexS8DqGudNrJpGqYTNp5Ylq0POt76PH+V147d9r4MCyfUnQoxQowJSx1AGo+0n5Jpsz1VaP4Yqs9Adrqv7s/1wzzb9++7c/Ya8VfuxciJu/IujQr3iMr7MOKDkw80SOEo60+e9t2ku7V/mZjeKJvKrnKI/azTYXdjVO9LXsbmwfZt48+P23nKg4M8QBVDOD79++2G/ZC/WA9eKn/cWn40Zih3faa+N3DTNxCR9nhpeYKdW/bRLUz2+7w0c9vYs1MKB0MaCsyzGOAh+L8khuunsJThT6WSlThTNbtA/do60S5x+PKB3uEEEiCdWVLWOSANRmCnIIVqblPzO0hP51JaoM0CpAXjbIXsTAAap5Y5XJJebLP/LvkbUaUAOwzAwDUfIMC5Lb58/Pz8XiMTuekG1G9pKIpBbZ5o6BXIW+zHtA58wKs91fSCy4ToObbNM99SdArhvfsrKbIFlbVGgVdMirapjjzXF/tA7mggJpvXHc8jyZWPO8IfYvvu3nOmYxDozxXcrBEqzw5q/OoqpYu1TdKEaWoOaDm21Rzr7Cq5TJVPO/zwEuzTM29ACF4nLurudf/auvOPIOaK9tLFxc3C6Dm27fNPfhBGZ4XbXOPbsQ2T2zzKsT8+EmrG8WzqbkukzzmqDkMguyhkY9cm6033fZVx0MvPAbD3nl6evry5UssJu6RbS5YHh3xt7/97evXr+6ocX1XTHr3LkXXRL0YVmwSNOj89K+xHiOj67UG2/IPknRKXyhW3IhH+8QP1DeVMbmh2xHvnjQPKh1a31wGvpfF1w2zDWumfj9U5dVPX3B/UPPVo5qx0uKkl3wjykyJAl0VX5K/3s7Cn+1YSvfiFnxyk4QkFqJ3Plypdm72xhGApwWKRkmDid3Xoc77/V6NaTw/Ra6bwtVcEtyYMNVYNDyx45KRQAavegzF5M9l1dPTU7Ue622eAFDzW1Hz5+dnOWFivHkbu90uZpOXr+aJYa5CtV6jyqvWDNqgCaXHsTQm0C6o5po/qTAZrnNAzW8INXzw4JaLeuShePM0f7jG7VC9LcsjL//Dw4NNL2xMcn+3Ohn135q80jYqFFL5vT6WKOqc5AAYBH7z1WPPvNS8bmm2oQK5Xn6r8HJ9WuFUXcP3ATnBbWrSbcMmlciqV3e5qXl8v5DD927aWgIt3AMGqDnkRA5WVTzvGYCo+t3eJF4VYEqrSRlL0EjdZE37UXvXHhUga3O2eA8jxfzJyW4jXxTKckYyvxBe/IuFUMDTcjOX8KxT3oSs5wDgrRiKbYlQ9414XV8/cK1hqnvnRWs3sc2jte6vF69jk8TqYJsDtnnO56pRZcrZHz3w3759M5F6eHiQ46U75E6zeNPB4/FoHzZp6/i81ki9OYb3eBta/7rNGWLf7n2RZI3KiNbgpGmEWeVtkSexuMrPVzz+Mlrl1Wu3z91u5/+SLIEuGKqo06tkAp2K/X7/9PSkBVv7q3xKHoTeNpey47XL+vnzZ8X/iO6+pt4EyhecR9Q3b7u+Q7czdPvd1kBVK4Z+8blOPrmi1QtG/o2MOkqH0WJgR2sCv3HlcPDs9ukGm0H/KB3xLs9eDEvK1e0f//Tpk8mfd1lyPdIL18qlqt0OVSK/Rn4seoeWoYBtvll8JVNVFfvEabjjQtWdxglxveHZuLXEaAFJrGWYS8vkRXE17/gKzTYkeYrBlwNK6wruYHF3TbGa6ImOylON0UqeIoA/HbDNN6vmSuaW56TnP0Zpu9IkvziN7bmpaIcqHjxJu7/oR7b/MiP98fHR7HRvpaaumwpwvP6QZ/Ok6Qz4ajBudMA2vwlnizckUqhin89LLOSNvd42H23tJp4WF9/dbifHSPxTx4Bhw5j7jrzOgY1w3rApBnGvwrCVo8lOgjebvmYOBKg5rOCZ1xKWt7CQDnab8wprUZyiCjGO1uIo6NXwVaNo17sLSMuVg5RXuu+Oda0J24vD4eCjl9u2BaphUlBMu6pgSuX6xtZ3FY0sADXfHqqkKC+z0oguxrRIzRXhp5CSLDODayQy5nwmvvKqKd6gcVSrLxhW51Sp6nXhdxUmbVIs0C6Q1z32A6QBNKDmGyS2l1PF84vq7JKnpMprrPLsx+K2eaPR2hGZ57Hk/qsOMxnYig07i7vkWV3VazhpFYoAc89D6Wpef8DyPnijH4N60+R5vrcuwY3vS+B8J0+n09evX/f7vdvLsfK4suRlrsqhvNvt7u/vzaK3n30O3zVlRO5oIkZJMqdNFB7ORKu8qvXD63khkoyhFZnkcpr5eGkXyK7Oy8uLx+OrBrLWeBt7fNv5VH1zN+G7bfkY0FlIOcnrn6+O2Kfq7ep9t84k2y/5/GCbb4T4SKvDnPzO3QUCY1Hc2fawett3Qm4Ej2AhbKPxGkU/UrWqlBZAzWGYp8WLkChv83A4xKpSjWoec/ozqnmHrdTYQsj21lM0Y8InxBmJlrhjjiunBRKwg7Zjm/vqnz32puax5Eijwrqjo7vbQ8ZRJ85zlSJkqJyhcvcxzJttrjNe8wA1B2zz7au5d0p7ORMbkhXy/Mu6jGF2j4+PKsaiUEvSZBrV3E6Ral6i44Cab1nHY8yDO16Ox6Oc0Y0fnnR/Ot53HfeSI+psF9f0EKx0Bn1OI4ojHJEtgJrfhJrrV6URSc0vLsTPo/LRHeTltJIIQtwIjWoeY0lZCAXUfLM0qnlj4Hmi5n0itKZQcwWVq71nzCP1Nsdc02SgTUIzmcHAptS8Lf56apfr0PrLU+9PjHOIMeanM/f39zJ+fRGyvv/duuDCEbeQhMolK5xaU7XhRKmMqsetRTydEBUVsH2LvvI+OzN6qFv1UK0cKAWe6+I+PT3Zr8kBxkjTJGg943korY750P28+FwnUV7UN4ciVEAVz73oxzzO1lgZygeYuHyn9CWvDsiV6ik0crYorKW0tn+AmsOUl/Zc5tvMczdS5pmeRzX3UUQ+H7nLFY/oPXS4Un3MTJnndvZUtL1nA1hAzWEjam6Guan5zL0uY0xknBMo4fPh4UEdgvzDXKmeqHmFxN1e/9UCJwo1hw2quQeez+wEjC5ILw6j3kCm5i5J7gKCPqdUJ1CXlfMGqPkNEWu2qBvZPH7qaCTKxyIZSurc5lrsupGBOZrnrDcAan5zai6LWGo+WxphbPeu3H0TI9Pxx8dHUyJX+bVUGy9HzTXFkXmubkR4WgA1vxWk5vbkK7KlmiWsJWqKO9CVlaoaMopclEJhoQ8aJtX6WWGdnBBI+LDJm757ulpXnzbbNn5gtOt59P4MCsGui7UiFPXwHw6H/X6vNpujBV26rGpZjRmb/gGv6Shb0r735eXljz/+6D7P189FFrnfph4gvcyWzqrGwo6ZVmKk9zwtfv9cDDTKFVee6zwP3X4M8YovetY3R81hGZVxzVVY2zxf6hVX/OFRKdfn5+dBo9pW1XyoWe0FbarXdQhCzgE1vzm8pKKCWzrasF05ZiTJnEl7l+6BZO2u3qnVXGcvyeckpgVQ8w2qRodNKjWX68PU3Kzj/X6fd39cymPxryg9+nYjqeZ4s56WoUIsNU/axSmZYNLzwIIqag4FqX98sO3h9/ZyE9nmev7l0vWQldgxDjUf84ieE4V8UFxXs1NAzSGPbR5tup8/f5qam6S22cijR4vENldDu2hLjvMwrP265Bp1fElZah4XRYsa1QA1h2mRhr5//15xihnVvFHQqxAcXb0NG2hz2edSn6VcyVOPUjHCJG81xGXnHICawxjB1fOvXJ4ptt+mqlHT21Rv7bbkUDUfEdNSNVUebvNcAWq+NQ/DemfWGfnx44dMZgUpm5T/+9//VhVDL7KqjyUNgOr7L015eXmxF6fT6eHhoS1Spa1+eq5wmjY1XMqTM3ROMDTvoW0Abruv7Brpv3RZk4ijxu+NlRgu5pRmj/ueaE5wg3MLbPObw5TdWyr3GW/s88opdapFC62UZsvnmu7kslo0aqrBt0/IlETGzY+aw6Y4Ho9mm5ugxwjxDvMtltKW1WZGn5rgLGIrlabmU9uAQ7dvVydm/GokRspRc1gBQ5/20+kk81yh6Go51qcmlxdltcHAfg5NLl17zufUx5XL9t/tduoKMtseAmoOy2AqbIJuz7yn4HdXWDUz3Obp8qvYi8+fP+/3e/e8z6/CpflDpx5dRnhyFEHkdc2oWImaw7pt844qQqbmygt1H0uH+Sbj3XXfjHqz+66p3nUlpcWtTz3n6Fig7nNX4GZBzWGz2LOtiudSc9Uf7zDcNGd387x6zQ9aytaj2lSf0W5QAU5AzWHFau7RyjFfvG2mHwU06fa5Pc9GrrlRruMa6mmpj3bezI+bHzUv5WlJzI2hHobsdc+vfNov7k/P+ss9v91fyKw+Ho+n0+n+/t5Mb+l12366CviOoQtzji7Xn+1lPS25PGMzxw4l7Q3WYajxNN7gTFxlstVejsk4wEam3ZyCW0Mzd/t5OBzMPJftRmcyqNuq9B1FzaH4q36Wb0W2rG46CQCoOfxPypUfqIbLssoJYgNAzWFlxOUdE3QVacJ1Dgl4WlBzWMFTqoXQ6pwXejweTdB5SgFQc1gZ3simOq+FKvYcNQdYOxvMHloqDr2Njgz7QfvTFnd8sd50PS1Q0eXym9uvDw8P3vvt+uMdeh5gnvuqGxvU7+7uqtdkMfs5dPv1zIbuPIlc91tpNSxRc5hxOhb6L6uM4ul0+vDhgx7m6Zhazdc+6izVpUFpB2tMlgHU/FZstw41d6NJoYrH49Hs9FhDdQrVW0rNh4brLCVnuWzzoakDSedoL5KMrKPmUDre/d0fYLPORiyElqbmHaPX0PNzU7a5jeJS8CjuNldDzVFzmPtpH6qSP3/+dCnX/46ryrQWNR/KWvYzl9oqgyzWuO+uwgaoORRkmyet42In+OlUby0JSksJ2dA5QS5Pi7qGVqHQMWUeUHNYh20eS5MnDvRV2JJD1W0tHoNcsRwjjldBLLFsPW4W1BxWgD+xCjyvxjYCHvr5qW3etv0ZWh98LTEtudRclz7633hGUPPSbbe12NRDP39xO/X431jrXO93xBfnmtHnGhU6PAZZzvPU9+HU9b5H5FWouoMsdH9xfR3/ZAv6QD0NYiJ96H+eNzMdIRcUAADbHDY0p8nllwfuK0DNYU1PNSqPCgNqDqgtcF8Bag5l2HQ81djmgJoDNhRwX0FmiGkBAMA2n4W6LdBdNzmXrZGr7nmuuPKhn1fscL24+fXnP6/ttlS1qVznYan9yXX/DN3PodlYQ793urjyxi/akmMK2xwAANscbgBWR7dxvVgdRc0BplX/Wzuu0s4PKo+aAwCjLKDmgAq8cmueGboSA2oOqNuSo8La1w+G+tNZ/1gdxLQAAGCbr8qmyxU3vZY49OSvSU3z6WyxXD2ASrMNl9qfqePHc12vqT8/NK685/aTPlzY5gAAgG0O2yKXjYbfNq8NDqg53Io6rGXVDjhvgJoDoNqAmgNMY/ujSqg2oOaAOnAdrx1NYTMQ0wIAgG1+kx6AtXgMLu6nPpA93nZo3H324yrtPM98Xy0VP55rO2vZT9T8FkeLoU/dWkY7gBKeI/j/hhSnAABgA2CbQ6G21VpstFzZPdikgJpDWeqMZ6bM0RFQc4A86jN1V+61nwdUG1BzYLRYUuVRYSgEVkEBALDN4YZt4aHgaenef3I7AdscAACWsM2n7t1Tms019Xm40kZOUkPLsfHb9mftWVe3lts59P7vuQOz3bfY5gAAgJoDAMBAWAW9Oba6ugiAmgPMoZJLxcYwugBqDoBtDoCaw1bUkJgBgFXAKigAALY5wGRzgls7LuZAgG0OAABrts1Lq7y6VI5oLpuxnlynF0vlOq6FqXM1p66gu3hu57j9uXjb3OBqObY5AABqDgAAqDkAAOSCmBaAoiFbCrDNAQCwzQEA2xywzQEAADUHAADUHADgJtmg33wtOaJttG1/aK7d0NzR+g7P47Fde/eM0nJip75qQ+/D0nJWsc0BAAA1BwCAiSFCEQpl7R6YXMcLgJoDoMJwQ+BpAQDANgeY3eYtzdMydcwGPYkA2xwAADUHAADUHAAAZuaG/Oa5cvOmzvFbS+7oUucTf/o4cvXtXMvxrv18YpsDANwoqDkAwBYgQhFmYi0zaABscwAAwDaHW7XNyY4BQM0BLo8WU8NoBIWApwUAANsc4GrbGdsWANscAACwzeeyJae2SZfKHW01EFpySkf3Kb3yeJe6T4ayVG7h1PfDUtfrBiNWsc0BAFBzAABAzQEAIBf4zQFuGioiYJsDAABqDgAAqDkAACTgNwe4afCbY5sDAAC2+RZtmaX6fy5li02dQzj1+cxFrn6npZ3/0s4zcwhscwAA1BwAAFBzAACYDfzmUChr8ZPiRwZscwAAQM0BAAA1BwDYGPjNoVCWisfPtZ9T7w9+c8A2BwDANoflbMmpczixDcedt7bzQEwO9w+2OQAAoOYAAKg5AACsFPzmAL3AzwvY5gAAgJoDAEAP8LQA9AJPC2CbAwAAag4AAD3A07Kamfta+oKu5Xxu9T5h/7HNAQAANQcAANQcAABQcwAAQM0BAFBzAABAzQEAADUHAADUHABgY5ALuhpK62FPjt+62GpfU8A2BwDANgeArc/tANscAABQcwAAQM0BAG4W/OYAN0Gb37y0OvWAbQ4AgJoDAABqDgAAi1OQ3/zXr195Bqh3DFH/x1b7f0Le604cOrY5AACg5gAAgJoDAABqDgCAmgMAAGoOAACoOQAAoOYAAKg5AAAUzgZrKLbllJIjOo6lcgXXnoNKjuW29QTbHAAAUHMAAEDNAQBQcwAAQM0BAAA1BwAA1BwAADUHAICV8IFTAGVC9g0Aat7MinK6AACGgqcFAAA1BwAA1BwAAFBzAABAzQEAUHMAAEDNAQAANQcAANQcAAA1BwAA1BwAAFBzAABAzQEAUHMAAEDNAQBgHv6fAAMAu+aOO8CZ3t8AAAAASUVORK5CYII="
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
                                                           accept="image/*" name="thumbnail" required/>
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
                                    <input type="hidden" name="contents" id="contents" value="{{ old('contents') }}"
                                           hidden>
                                    <div class="mb-1">
                                        <div id="full-wrapper">
                                            <div id="full-container">
                                                <div class="editor">
                                                    {!! old('contents') !!}
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
                                                        statusVal="{{ old('status') }}"/>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Open Sell Date</h4>
                                </div>
                                <div class="card-body">
                                    <input
                                        type="text"
                                        id="date_sell"
                                        class="form-control flatpickr-human-friendly @error('date_finish') is-date_sell @enderror"
                                        name="date_sell" value="{{ old('date_sell') }}" required/>
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
                                        name="date_finish" value="{{ old('date_finish') }}" required/>
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
                                           @if(old('is_featured') == 'on') checked @endif/>
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
                                                    @if(old('category') !== null && in_array($item->slug, old('category'))) selected @endif>
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
                                                    @if(old('investor') == $investor->id) selected @endif>{{ $investor->name }}</option>
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
                                                    @if(old('feature') !== null && in_array($item->id, old('feature'))) selected @endif>
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
                                                    @if(old('city') == $item->slug) selected @endif>{{ $item->name }}</option>
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
