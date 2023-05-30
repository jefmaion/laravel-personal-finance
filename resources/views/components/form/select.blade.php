<select {{ $attributes->merge(['class' => 'form-control ' . ($errors->has($attributes['name']) ? 'is-invalid' : null)]) }} >
    <option></option>
    @if($options)
        @foreach($options as $option)
        <option value="{{ $option['value'] }}" {{ $option['selected'] }}>{{ $option['label'] }}</option>
        @endforeach
    @endif
</select>
<div class="invalid-feedback">{{ $errors->first($attributes['name']) }}</div>