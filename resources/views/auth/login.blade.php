<x-layout>
    <div class="py-16">
        <div class="shadow-none sm:shadow-lg p-6 rounded-lg max-w-lg mx-auto">
            <h1 class="font-montserrat text-3xl font-semibold">Login</h1>

            @error('failed')
                <p class="bg-red-50 border border-red-300 text-red-500 rounded-lg px-4 py-3 mt-8 text-sm">{{ $message }}
                </p>
            @enderror

            <form action="{{ route('login') }}" method="POST" class="mt-8">
                @csrf

                {{-- email --}}
                <div class="mb-4">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" placeholder="example@email.com"
                        value="{{ old('email') }}" class="input @error('email') !ring-red-500 @enderror">
                    @error('email')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- password --}}
                <div class="mb-4">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="**********"
                        class="input @error('password') !ring-red-500 @enderror">
                    @error('password')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-between">
                    {{-- remember me --}}
                    <div class="mb-4 flex items-center gap-2">
                        <input type="checkbox" name="remember" id="remember">
                        <label for="remember" class="text-gray-600">Remember me</label>
                    </div>
                    <div>
                        <a href="{{ route('password.request') }}" class="text-gray-600 hover:underline">Forgot
                            password?</a>
                    </div>
                </div>

                {{-- submit --}}
                <button type="submit"
                    class="bg-orange-500 hover:bg-orange-600 transition py-2 px-4 w-full rounded-full text-white">Login</button>
            </form>

        </div>
    </div>
</x-layout>
