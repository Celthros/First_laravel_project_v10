<x-layout>

    <section class="px-6 py-8">
        <x-panel class="max-w-lg mx-auto">
            <form action="/admin/posts" method="post">
                @csrf

                <div class="mb-6">
                    <label for="title" class="block mb-2 uppercase font-bold text-xs text-gray-700">
                        Title
                    </label>

                    <input class="border border-gray-400 p-2 w-full"
                    type="text"
                    name="title"
                    id="title"
                    value="{{ old('title')}}"
                    required
                    >

                    @error('title')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="slug" class="block mb-2 uppercase font-bold text-xs text-gray-700">
                        Slug
                    </label>

                    <input class="border border-gray-400 p-2 w-full"
                    type="text"
                    name="slug"
                    id="slug"
                    value="{{ old('slug')}}"
                    required
                    >

                    @error('slug')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="excerpt" class="block mb-2 uppercase font-bold text-xs text-gray-700">
                        excerpt
                    </label>

                    <textarea class="border border-gray-400 p-2 w-full"

                    name="excerpt"
                    id="excerpt"
                    required
                    >{{ old('excerpt') }}</textarea>

                    @error('excerpt')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="body" class="block mb-2 uppercase font-bold text-xs text-gray-700">
                        body
                    </label>

                    <textarea class="border border-gray-400 p-2 w-full"

                    name="body"
                    id="body"
                    required
                    >{{ old('body') }}</textarea>

                    @error('body')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="category_id" class="block mb-2 uppercase font-bold text-xs text-gray-700">
                        Category
                    </label>

                    <select class="border border-gray-400 p-2 w-full"

                    name="category_id"
                    id="category_id"
                    required
                    >
                    @foreach (\App\Models\Category::all() as $category)
                    <option
                        value="{{ $category->id }}"
                        {{ old('category_id') == $category->id ? 'selected' : ''}}>
                        {{ ucwords($category->name) }}
                    </option>
                    @endforeach

                    </select>

                    @error('category')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                    <x-submit-button class="">Publish</x-submit-button>

            </form>
        </x-panel>
    </section>

</x-layout>
