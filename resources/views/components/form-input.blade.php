@if(isset($label))
<label for="{{ $id ?? $name}}" class="{{ $labelClass ?? null}}">{{ $label }}</label>
@endif
        <input type="{{ $type ?? 'text' }}" 
        class="form-control {{ $inputClass ?? null }} @error('{{ $name }}') is-invalid @enderror" 
        name="{{ $name }}" 
        value="{{ old('$name', $value ?? null )}}">
        @error($name)
        <p class="invalid-feedback">{{ $message }}</p>
        @enderror