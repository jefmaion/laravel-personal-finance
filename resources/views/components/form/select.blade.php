<select {{ $attributes }}  class="form-control @error($attributes['name']) is-invalid @enderror ">
    <option></option>
    @if($options)
        @foreach($options as $option)
        <option value="{{ $option['value'] }}" {{ $option['selected'] }}>{{ $option['label'] }}</option>
        @endforeach
    @endif
</select>
<div class="invalid-feedback">{{ $errors->first($attributes['name']) }}</div>