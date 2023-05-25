<div class="custom-control custom-checkbox">
    <input type="hidden" name="{{ $attributes['name'] }}" value="0">
    <input type="checkbox" class="custom-control-input" name="{{ $attributes['name'] }}" id="{{ $attributes['name'] }}" value="1"  {{ ($attributes['value']) ? 'checked' : '' }}>
    <label class="custom-control-label" for="{{ $attributes['name'] }}"  >{{ $attributes['label'] }}</label>
</div>