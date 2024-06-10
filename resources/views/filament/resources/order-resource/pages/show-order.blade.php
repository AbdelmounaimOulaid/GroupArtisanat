<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>
<x-filament-panels::page>        
@php
    $deadline = \Carbon\Carbon::parse($record->deadline);
    $created_at = \Carbon\Carbon::parse($record->created_at);
    $diff = $deadline->diffInDays($created_at);
    $color = '';
    if ($diff <= 1) {
        $color = '#E95142'; // darker red
    }  elseif ($diff <= 4) {
        $color = '#1FABF1'; // darker blue
    } elseif ($diff <= 10) {
        $color = '#F1CD2E'; // darker yellow
    } else {
        $color = '#56C453'; // darker green
    }
@endphp
<x-filament::section class="rounded text-center">
        <div class="flex mb-5 justify-between">
            <p class="mb-2"><span style="background-color: {{ $color }}; border-radius: 5px; padding: 15px;font-size:30px;font-weight:bold">{{ $diff }}</span></p>
            <p class="mb-2 ml-2 text-4xl">{{ $record->taille }}</p>
        </div>
        
        <!-- Swiper Main Gallery -->
        <div class="swiper mySwiper2 lg:w-[60%] lg:h-[60%]">
            <div class="swiper-wrapper">
                @foreach($record->images as $image)
                    <div class="swiper-slide">
                        <img class="rounded w-full h-full object-cover border mt-2" src="{{ asset('storage/' . $image) }}" alt="Order Image">
                    </div>
                @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>

        <!-- Swiper Thumbnail Gallery -->
        <div class="swiper mySwiper mt-5 lg:w-[60%] lg:h-[60%]">
            <div class="swiper-wrapper">
                @foreach($record->images as $image)
                    <div class="swiper-slide">
                        <img class="rounded w-full lg:h-[150px] h-[70px]  object-cover border mt-2" src="{{ asset('storage/' . $image) }}" alt="Order Image">
                    </div>
                @endforeach
            </div>
        </div>
        
        <p class="mt-3 text-lg">Posted On: {{ $record->created_at }}</p>
        <p class="mt-3 text-xl font-semibold">{{ $record->description }}</p>
    
</x-filament::section>
</x-filament-panels::page>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper(".mySwiper", {
        spaceBetween: 10,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesProgress: true,
    });
    var swiper2 = new Swiper(".mySwiper2", {
        spaceBetween: 10,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        thumbs: {
            swiper: swiper,
        },
    });
</script>