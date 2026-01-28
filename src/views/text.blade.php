<div @class([
    'section cke-content',
    'section--' . $section->template_name,
    'sectionkey--' . $section->key_classname,
    $section->classname,
    'reverse' => $section->reverse,
])>
    <div class="{{ $section->max_width ?? 'max-width' }}">

        <div class="text-and-image">

            @if ($section->getFirstMedia('image'))
                <div class="section-image">
                    {{ $section->getFirstMedia('image')->img('medium', ['alt' => $section->title]) }}
                </div>
            @endif

            <div class="text">

                {{-- Subheading --}}
                @empty(!$section->subheading)
                    <h5 class="subheading text-accent">{{ $section->subheading }}</h5>
                @endempty

                {{-- Title --}}
                @empty(!$section->title)
                    <h2 class="with-separator">{!! $section->title !!}</h2>
                @endempty


                {{-- Content CKE --}}
                {!! $section->p !!}


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
</div>
