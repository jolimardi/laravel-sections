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
        <div class="section-image">
            {{ $section->getFirstMedia('image')->img('', ['alt' => $section->title]) }}
        </div>

        {{-- Si SVG : <img src="{{ $section->getFirstMedia('image')->getUrl() }}" alt="{{ $section->title }}"> --}}


        <div class="text-container">
            <div class="text">

                @empty(!$section->alternative)
                    <h5 class="subheading text-highlight-blue">{{ $section->subheading }}</h5>
                @endempty
                {{-- Title --}}
                @empty(!$section->title)
                    <h3>{!! $section->title !!}</h3>
                @endempty

                {{-- Content CKE --}}
                @empty($section->alternative)
                    {!! $section->p !!}
                @endempty

                @if (!empty($section->cta_title) || !empty($section->cta_secondary_title))
                    <div class="btns">
                        {{-- CTA --}}
                        @empty(!$section->cta_title)
                            @if (!empty($section->cta_routename))
                                <a href="{{ route($section->cta_routename) }}"
                                    class="btn btn-primary">{{ $section->cta_title }}</a>
                            @else
                                <a href="{{ $section->cta_href }}" class="btn btn-primary">{{ $section->cta_title }}</a>
                            @endif
                        @endempty

                        {{-- secondary CTA --}}
                        @empty(!$section->cta_secondary_title)
                            @if (!empty($section->cta_secondary_routename))
                                <a href="{{ route($section->cta_secondary_routename) }}"
                                    class="btn btn-secondary">{{ $section->cta_secondary_title }}</a>
                            @else
                                <a href="{{ $section->cta_secondary_href }}"
                                    class="btn btn-secondary">{{ $section->cta_secondary_title }}</a>
                            @endif
                        @endempty
                    </div>
                @endif

                @if ($section->getMedia('photos'))
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
