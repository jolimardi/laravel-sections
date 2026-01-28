<div @class([
    'section cke-content',
    'section--' . $section->template_name,
    'sectionkey--' . $section->key_classname,
    $section->classname,
    'reverse' => $section->reverse,
    'no-padding-top' =>$section->getFirstMedia('image') ? true : false,
])>

    <div class="banner section-banner">
        @if ($section->getFirstMedia('image'))
            {{ $section->getFirstMedia('image')->img('responsive', ['alt' => $section->title]) }}
        @endif
    </div>


    <div class="{{ $section->max_width ?? 'max-width' }}">




        <div class="text">


            <div class="title-bloc centered {{ empty($section->p) ? 'no-margin-bottom' : '' }}">
                {{-- Title --}}
                @empty(!$section->title)
                    <h1 class="with-separator">{!! $section->title !!}</h1>
                @endempty

                {{-- Subheading --}}
                @empty(!$section->subheading)
                    <p><strong>{{ $section->subheading }}</strong></p>
                @endempty
            </div>


            {{-- Content CKE --}}
            <div class="custom-list">
                {!! $section->p !!}
            </div>

            {{-- Boutons --}}
            @if ($section->buttons && count($section->buttons) > 0)
                <div class="btns">
                    @foreach($section->buttons as $btn)
                        <x-section-button :btn="$btn" />
                    @endforeach
                </div>
            @endif


            @if (isset($section->getMedia('photos')[0]))
                <div class="section-photos">
                    @foreach ($section->getMedia('photos') as $photo)
                        <a href="{{ $photo->getUrl('full') }}" data-fancybox="photos-{{ $section->keyClassname }}">
                            {{ $photo->img('thumbnail-small', ['alt' => $section->title]) }}
                        </a>
                    @endforeach
                </div>
            @endif

        </div>

    </div>

</div>
