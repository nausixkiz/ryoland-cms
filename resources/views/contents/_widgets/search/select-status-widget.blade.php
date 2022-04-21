<label class="form-label" for="blog-status">Status</label>
<select id="blog-status" class="form-select text-capitalize mb-md-0 mb-2">
    <option value=""> Select Status</option>
    @foreach($listStatus ?? \App\Constants\StatusConst::getAllListStatus() as $key => $value)
        <option value="{{ $value }}" class="text-capitalize">{{ $value }}</option>
    @endforeach
</select>
