@props(['value'])

<label {{ $attributes->merge(['class' => 'font-medium text-xl']) }}>
    {{ $value ?? $slot }}
</label>
