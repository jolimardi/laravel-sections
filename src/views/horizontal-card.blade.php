<div @class([
    'section cke-content',
    'section--' . $section->template_name,
    'sectionkey--' . $section->keyClassname,
    $section->classname,
    'reverse' => $section->reverse,
    'alternative' => $section->alternative,
])>
    <div class="horizontal-card flex align-center gap">

        {{-- Image Responsive --}}
        @if($section->getFirstMedia('image'))
            <div class="section-image">
                {{ $section->getFirstMedia('image')->img('', ['alt' => $section->title]) }}
            </div>
        @endif

        {{-- Si SVG : <img src="{{ $section->getFirstMedia('image')->getUrl() }}" alt="{{ $section->title }}"> --}}


        <div class="text-container">
            <div class="text">

                @empty(!$section->alternative)
                    <h5 class="subheading text-accent">{{ $section->subheading }}</h5>
                @endempty
                {{-- Title --}}
                @empty(!$section->title)
                    <h3>{!! $section->title !!}</h3>
                @endempty

                {{-- Content CKE --}}
                @empty($section->alternative)
                    {!! $section->p !!}
                @endempty


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
                            <a href="{{ $photo->getUrl() }}" data-fancybox="photos-{{ $section->keyClassname }}">
                                {{ $photo->img('', ['alt' => $section->title]) }}
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
