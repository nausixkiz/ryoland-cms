<label class="form-label" for="filter-status">Status</label>
<select id="filter-status" class="form-select text-capitalize mb-md-0 mb-2">
    <option value=""> Select Status</option>
    @foreach($listStatus as $key => $value)
        <option value="{{ $value }}" class="text-capitalized">{{ $value }}</option>
    @endforeach
</select>
