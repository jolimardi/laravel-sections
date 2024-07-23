@props([
    'maxWidth' => false,
    'bg' => '',
    'maxWidthClasses' => [
        'small' => 'max-width-small',
        'medium' => 'max-width',
        'large' => 'max-width-large',
    ],
    'gray' => false,
    'grayAlt' => false,
    'green' => false,
    'gradient' => false,

    'small' => false,
    'large' => false,
])

<?php
if (!$maxWidth) {
    $maxWidth = 'medium';
    if ($small) {
        $maxWidth = 'small';
    }
    if ($large) {
        $maxWidth = 'large';
    }
}

if (empty($bg)) {
    if ($gray) {
        $bg = 'gray';
    }
    if ($grayAlt) {
        $bg = 'gray-alt';
    }
    if ($green) {
        $bg = 'green';
    }
    if ($gradient) {
        $bg = 'gradient';
    }
}
?>

<div {{ $attributes->merge(['class' => "section {$bg}"]) }}>
    <div class="{{ $maxWidthClasses[$maxWidth] }}">
        {{ $slot }}
    </div>
</div>
