@props(['value', 'for'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700 dark:text-gray-200']) }} for="{{ $for }}">
    {{ $value ?? $slot }}
</label>
