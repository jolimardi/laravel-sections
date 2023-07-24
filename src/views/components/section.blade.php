@props([
    'maxWidth' => 'medium',
    'bg' => '',
    'maxWidthClasses' => [
        'small' => 'max-width-small',
        'medium' => 'max-width',
        'large' => 'max-width-large',
    ],
])

<div {{ $attributes->merge(['class' => "section {$bg}"]) }}>
    <div class="{{ $maxWidthClasses[$maxWidth] }}">
        {{ $slot }}
    </div>
</div>
