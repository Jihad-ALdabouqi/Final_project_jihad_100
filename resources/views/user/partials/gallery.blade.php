<!-- Gallery Start -->
<div class="container-fluid gallery py-5">
    <div class="container">
        <div class="text-center wow fadeIn" data-wow-delay="0.2s">
            <h1 class="font-dancing-script text-primary">Gallery</h1>
            <h1 class="mb-5">Our Work</h1>
        </div>
        <div class="row g-0">
            @for($i = 1; $i <= 6; $i++)
                <div class="col-md-{{ $i == 1 || $i == 6 ? 6 : 3 }} wow fadeIn">
                    <div class="gallery-item h-100">
                        <img src="{{ asset('img/gallery-' . $i . '.jpg') }}" class="img-fluid w-100 h-100" alt="Gallery {{ $i }}">
                    </div>
                </div>
            @endfor
        </div>
    </div>
</div>
<!-- Gallery End -->