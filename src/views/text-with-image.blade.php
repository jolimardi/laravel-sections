<div @class([
    'section cke-content',
    'section--' . $section->template_name,
    'sectionkey--' . $section->keyClassname,
    $section->classname,
    'reverse' => $section->reverse,
    'no-padding-top',
])>
    <div class="text-with-image">

        {{-- Image Responsive --}}
        @if (isset($section->video[0]))
            <div class="section-video">
                <div class="video-container">
                    <x-video-popup :video='$section->video[0]' />
                </div>
            </div>

        @elseif($section->getFirstMedia('image'))
            <div class="section-image">
                {{ $section->getFirstMedia('image')->img('medium', ['alt' => $section->title]) }}
            </div>
        @endif


        {{-- Si SVG : <img src="{{ $section->getFirstMedia('image')->getUrl() }}" alt="{{ $section->title }}"> --}}


        <div class="text-container">
            <div class="text">

                {{-- Subheading --}}
                @empty(!$section->subheading)
                    <h5 class="subheading text-accent">{{ $section->subheading }}</h5>
                @endempty

                {{-- Title --}}
                @empty(!$section->title)
                    <h2>{!! $section->title !!}</h2>
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
