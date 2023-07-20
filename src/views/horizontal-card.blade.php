<div @class([
    'section cke-content',
    'section--' . $section->template_name,
    'sectionkey--' . $section->keyClassname,
    $section->classname,
    'reverse' => $section->reverse,
])>
    <div class="horizontal-card flex align-center gap">

        {{-- Image Responsive --}}
        <div class="section-image">
            {{ $section->getFirstMedia('image')->img('', ['alt' => $section->title]) }}
        </div>

        {{-- Image sans classe ni style : {{ $section->getFirstMedia('image') }} --}}


        <div class="text-container">
            <div class="text">

                {{-- Title --}}
                @empty(!$section->title)
                    <h3>{!! $section->title !!}</h3>
                @endempty

                {{-- Content CKE --}}
                {!! $section->p !!}

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
            </div>
        </div>
    </div>
</div>
