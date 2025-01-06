<x-authlayout>
    <div class="container py-4">
        <h1 class="title">Destinationblog List</h1>

        <h1 class="text-2xl font-semibold mt-3 py-2">Your Destination Blog ({{ $destinationblogs->total() }})</h1>
        <a href="{{ route('destinationblogs.create') }}"
            class="bg-orange-500 hover:bg-orange-600 py-2 px-4 rounded-full text-white inline-block my-2">Add New
            Destinationblog</a>

        @if (session('success'))
            <x-flash-msg message="{{ session('success') }}" bg="bg-green-500"></x-flash-msg>
        @endif

        <div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                @foreach ($myDestinationblogs as $destinationblog)
                    <x-blog-card :blog="$destinationblog" route="destinationblogs.show" :fullblog="false">
                        <div class="mt-auto flex justify-end gap-1 items-center bg-gray-100 p-2 border-t">
                            {{-- update destinationblog --}}
                            <a href="{{ route('destinationblogs.edit', $destinationblog) }}"
                                class="bg-green-500 hover:bg-green-600 py-1 px-3 rounded-full text-white text-sm">Ubah</a>
                            {{-- delete destinationblog --}}
                            <form action="{{ route('destinationblogs.destroy', $destinationblog) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Are you sure?')" type="submit"
                                    class="bg-red-500 hover:bg-red-600 py-1 px-3 rounded-full text-white text-sm">Hapus</button>
                            </form>
                        </div>
                    </x-blog-card>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $myDestinationblogs->links() }}
            </div>
        </div>

        <h1 class="text-2xl font-semibold mt-3 py-2">Display All Destinationblog ({{ $destinationblogs->total() }})</h1>
        <x-blog-destination :destinationblogs="$destinationblogs"></x-blog-destination>

    </div>
</x-authlayout>
