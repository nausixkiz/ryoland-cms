<input type="checkbox"
       class="form-check-input @error('is_featured') is-invalid @enderror"
       id="is_featured" name="is_featured"
       @if($isChecked) checked @endif/>

<label class="form-check-label" for="is_featured">Is Feature</label>
@error('is_featured')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror

@push('page-script')
    <script src="example.js"></>
@endpush
