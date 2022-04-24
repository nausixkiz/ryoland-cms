<input type="checkbox"
       class="form-check-input @error('never_expired') is-invalid @enderror"
       id="never_expired" name="never_expired"
       @if($isChecked) checked @endif/>
<label class="form-check-label" for="never_expired">Never Expired</label>

@error('never_expired')
<span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
</span>
@enderror
