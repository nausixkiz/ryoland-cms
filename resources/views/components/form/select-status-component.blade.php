<div class="col-12">
    @if($layoutStyle == 'vertical')
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">@if($type == 'moderation-status') Moderation Status @else Status @endif</h4>
                @error($name)
                <small class="card-text text-danger">
                    <strong>{{ $message }}</strong>
                </small>
                @enderror
            </div>
            <div class="card-body">
                <select class="select2 form-select @error('{{$name}}') is-invalid @enderror"
                        id="{{ $name }}" name="{{ $name }}" required>
                    @foreach($listStatus as $key => $value)
                        <option value="{{ $value }}" @if($statusVal !== null && $statusVal== $value) selected @endif>
                            {{ ucwords($value) }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    @else
        <div class="mb-1 row">
            <div class="col-sm-3">
                <label class="col-form-label" for="{{$name}}">@if($type == 'moderation-status') Moderation Status @else Status @endif</label>
                @error($name)
                <small class="card-text text-danger">
                    <strong>{{ $message }}</strong>
                </small>
                @enderror
            </div>
            <div class="col-sm-9">
                <select class="select2 form-select @error($name) is-invalid @enderror"
                        id="{{$name}}" name="{{ $name }}" required>
                    @foreach($listStatus as $key => $value)
                        <option value="{{ $value }}" @if($statusVal !== null && $statusVal== $value) selected @endif>
                            {{ ucwords($value) }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    @endif
</div>
