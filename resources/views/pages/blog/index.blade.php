<x-layout :meta="[
    'title' => __('meta.blog.title'),
    'description' => __('meta.blog.description'),
    'keywords' => __('meta.blog.keywords'),
]">
    <x-section-hero :title="__('common.blog.title')">
        <form class="mt-8 max-w-screen-sm">
            {{-- @if (request('search'))
                <input type="hidden" name="search" value="{{ request('search') }}">
            @endif --}}

            @if (request('sort'))
                <input type="hidden" name="sort" value="{{ request('sort') }}">
            @endif

            {{-- @if (request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
            @endif --}}

            <div class="items-center mx-auto max-w-screen-sm flex sm:space-y-0">
                <div class="relative w-full">
                    <label for="search"
                        class="hidden mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('common.common.search-btn') }}</label>
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <x-bi-search class="w-5 h-5 text-gray-500 dark:text-gray-400"></x-bi-search>
                    </div>
                    <input name="search" autocomplete="off" value="{{ $search }}"
                        class="block p-3 pl-10 w-full text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-l-lg focus:ring-primary-500 focus:border-primary-500"
                        placeholder="Search blogs" type="text" id="search">
                </div>
                <div>
                    <button type="submit"
                        class="rounded-l-none py-3 px-5 text-sm font-medium text-center text-white border cursor-pointer bg-orange-500 transition hover:bg-orange-600  rounded-r-lg focus:ring-4 focus:ring-orange-300">
                        {{ __('common.common.search-btn') }}
                    </button>
                </div>
            </div>
        </form>

        {{-- <x-badge-cat :cats="$blogcats" /> --}}
    </x-section-hero>

    <div class="container mt-8">
        <div class="flex flex-col gap-2 lg:flex-row lg:items-center justify-between">
            {{-- <div class="relative">
                <x-badge-cat :cats="$blogcats" />
            </div> --}}
            <x-badge-sorting :sorting="__('common.common.sorting-time')" />
        </div>
    </div>

    @if ($search)
        <div class="container py-6">
            <p class="text-xl">
                {{ __('common.blog.results.start') }} <span
                    class="text-orange-500 font-semibold italic">"{{ $search }}"</span>
                {{ __('common.blog.results.end') }} ( {{ $blogs->total() }} )
            </p>
        </div>
    @endif

    {{-- blog list --}}
    @if ($blogs->total() == 0)
        <div class="container">
            <p class="text-3xl italic font-semibold mt-4">{{ __('common.blog.results.not-found') }}</p>
        </div>
    @else
        <section class="container py-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-2 lg:gap-4">
                @foreach ($blogs as $blog)
                    <x-blog-card :blog="$blog"></x-blog-card>
                @endforeach
            </div>
            <div class="mt-8">
                {{ $blogs->links() }}
            </div>
        </section>
    @endif

    <x-section-destination :destinationblogs="$destinationblogs" />

</x-layout>
