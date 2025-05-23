<x-layout :title="__('common.meta.car-rental-show.title.0') .
    $carrental->brand_name .
    __('common.meta.car-rental-show.title.1')" :description="__('common.meta.car-rental-show.description.0') .
    $carrental->brand_name .
    __('common.meta.car-rental-show.description.1')">
    <section class="lg:container">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 py-0 lg:py-16 min-h-[20vh]">
            <div class="h-auto">
                <img src="{{ $carrental->banner ? asset('storage/' . $carrental->banner) : asset('storage/svg/panorama_icon.svg') }}"
                    alt="{{ $carrental->title ?? 'carrental banner' }}" class="object-contain object-top w-full h-full" />
            </div>

            <div class="flex flex-col px-4 space-y-6 leading-relaxed">
                {{-- title --}}
                <div class="">
                    <h2 class="text-2xl font-medium capitalize mb-2">{{ $carrental->brand_name }}</h2>
                    <p class="text-2xl mb-4 font-semibold">Rp{{ number_format($carrental->rental_price, 0, ',', '.') }}
                    </p>
                    {{-- <a href="{{ route('carrentals.show', $carrental) }}"
                        class="text-orange-500 hover:underline w-fit">{{ $carrental->carrentalcat->name ?? 'cat' }}</a> --}}

                    <p class="border-l-2 pl-2 border-orange-500 capitalize">
                        {{ $carrental->carrentalcat->name }}</p>
                </div>
                <div>
                    <h3 class="text-xl font-semibold mb-2">{{ __('common.car-rental.show.policy') }}
                        <i class="font-medium">{{ $carrental->carrentalcat->name }}</i>
                    </h3>
                    <div class="text-content">{!! $carrental->policy !!}</div>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">{{ __('common.car-rental.show.information') }}</h3>
                    <div class="text-content">{!! $carrental->information !!}</div>
                </div>
                <x-section-order />
            </div>
        </div>
    </section>

    <div class="container">
        <div class="flex justify-between items-center py-2 mt-4 mb-2">
            <h2 class="text-2xl font-semibold">{{ __('common.car-rental.show.others') }}</h2>
            <a href="{{ route('rental-mobil') }}"
                class="text-orange-500 min-w-max hover:underline flex gap-2 items-center">
                <span>{{ __('common.common.view-all') }}</span>
                <x-bi-arrow-right class="w-4 flex" />
            </a>
        </div>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-2 lg:gap-4 mb-8">
            @foreach ($latestThreeCarrentals as $carrental)
                <x-carrental-card :carrental="$carrental"></x-carrental-card>
            @endforeach
        </div>
    </div>

    <x-section-blog :blogs="$blogs" />

</x-layout>
