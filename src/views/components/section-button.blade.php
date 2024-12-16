@props([
    'btn',
    // La clé est le type de bouton, associées aux classes correspondantes
    'btnClasses' => [
        'primary' => 'btn-primary',
        'secondary' => 'btn-secondary',
    ],
    'href' => '',
    'icon' => '',
])

{{-- Si ça vient d'un Repeater, on a un array et pas un object, qu'on convertit en object--}}
@php
    if (is_array($btn) && isset($btn['fields'])) {
        $btn = (object) $btn['fields'];
    }
@endphp

@if(empty($href) && !empty($btn->href))
    @php
        $href = $btn->href;
    @endphp
@endif

{{-- S'il y a un routename valide, on override le href --}}
@if (!empty($btn->routename) && Route::has($btn->routename))
    @php
        $href = route($btn->routename);
    @endphp
@endif

@if (!empty($btn->icon))
    @php
        $icon = svg($btn->icon, 'btn-icon');
    @endphp
@endif





<a href="{{ $href }}" {{ $attributes->merge(['class' => "btn {$btnClasses[$btn->type]}"]) }} {{ $btn->target_blank ? 'target="_blank"' : '' }}>{!! $btn->title !!}{!! (!empty($icon) ? '&nbsp;' . $icon->toHtml() : '') !!}</a>




