<x-panel>
    @auth
    <form method="POST" action="/posts/{{ $post->slug }}/comments">
        @csrf

        <header class="flex items-center">
            <img src="https://i.pravatar.cc/60?u={{ auth()->id() }}" class="rounded-xl" alt="" width="40" height="40" class="rounded-full"/>

            <h2 class="ml-4">Want to participate?</h2>
        </header>

        <div class="mt-6">
            <textarea
            name="body"
            class="w-full text-sm p-2 focus:outline-none focus:ring rounded-sm" rows="5" placeholder="Quick, think of something to say!"
            required></textarea>

            @error('body')
                <span class="text-xs text-red">{{ $message }}</span>
            @enderror
        </div>
        <div class="flex justify-end mt-6 pt-6 border-t border-gray-200">
            <x-form.button>Post</x-form.button>
        </div>

    </form>

    @else
    <p class="font-semibold">
        <a href="/register" class="text-blue-800 underline hover:no-underline">Register</a> or <a href="/login" class="text-blue-800 underline hover:no-underline">Log in</a> to leave a comment.
    </p>
    @endauth
</x-panel>
