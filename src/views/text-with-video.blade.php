<div @class([
    'section cke-content',
    'section--' . $section->template_name,
    'sectionkey--' . $section->keyClassname,
    $section->classname,
    'reverse' => $section->reverse,
])>
    <div class="max-width-large">

        <div class="wavy-background">
            <svg>
                <clipPath id="wavy-background-clip-path" clipPathUnits="objectBoundingBox">
                    <path d="M-0.004,0 H0.996 C0.996,0,0.974,0.077,0.974,0.235 C0.974,0.394,0.991,0.459,0.991,0.631 C0.991,0.804,0.949,1,0.949,1 H-0.004 V0"></path>
                </clipPath>
            </svg>
        </div>

        <div class="text-with-video">
            {{-- Video --}}

            <div class="video-container">
                {{--<x-youtube :youtube='$section->video_url' :youtube-thumbnail-media="$section->getFirstMedia('video_thumbnail')" />--}}
                <x-youtube-inline :youtube='$section->video_url' />
            </div>


            <div class="text-container text-white">
                <div class="text">

                    {{-- Subheading --}}
                    @empty(!$section->subheading)
                        <h5 class="subheading text-highlight-blue">{{ $section->subheading }}</h5>
                    @endempty

                    {{-- Title --}}
                    @empty(!$section->title)
                        <h1>{{ $section->title }}</h1>
                    @endempty

                    {{-- Content CKE --}}
                    {!! $section->p !!}

                    {{-- CTA --}}
                    @empty(!$section->cta_title)

                        @if (!empty($section->cta_routename))
                            <a href="{{ route($section->cta_routename) }}" class="btn btn-blue">{{ $section->cta_title }}</a>
                        @else
                            <a href="{{ $section->cta_href }}" class="btn btn-blue">{{ $section->cta_title }}</a>
                        @endif
                    @endempty

                    {{-- secondary CTA --}}
                    @empty(!$section->cta_secondary_title)
                        @if (!empty($section->cta_secondary_routename))
                            <a href="{{ route($section->cta_secondary_routename) }}" class="btn btn-blue">{{ $section->cta_secondary_title }}</a>
                        @else
                            <a href="{{ $section->cta_secondary_href }}" class="btn btn-blue">{{ $section->cta_secondary_title }}</a>
                        @endif
                    @endempty
                </div>
            </div>
        </div>
    </div>
</div>

@foreach ($section->getMedia('photos') as $photo)
    <a href="{{ $photo->getUrl() }}" data-fancybox="photos">
        {{ $photo->img('', ['class' => 'test', 'style' => 'width: 300px; height: auto', 'alt' => $section->title]) }}
    </a>
@endforeach
