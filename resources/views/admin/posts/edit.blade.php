<x-layout>
    <x-setting :heading="'Edit Post: ' . $post->title">
        <form action="/admin/posts/{{ $post->id }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <x-form.input name="title" :value="old('title', $post->title)" required />
            <x-form.input name="slug" :value="old('slug', $post->slug)" required />
            <div class="flex mt-6">
                <img src="{{ $post->thumbnail() }}" alt="" class="rounded-xl mr-6" width="100">
                <div class="flex-1">
                <x-form.input name="thumbnail" type="file" :value="old('thumbnail', $post->thumbnail)" />
                </div>
            </div>
            <x-form.textarea name="excerpt">{{ old('excerpt', $post->excerpt) }}</x-form.textarea>
            <x-form.textarea name="body">{{ old('body', $post->body) }}</x-form.textarea>

            <x-form.field>
                <x-form.label name="category" />

                <select class="border border-gray-400 p-2 w-full rounded"

                name="category_id"
                id="category_id"
                required
                >
                @foreach ($categories as $category)
                <option
                    value="{{ $category->id }}"
                    {{ old('category_id', $post->category_id) == $category->id ? 'selected' : ''}}>
                    {{ ucwords($category->name) }}
                </option>
                @endforeach
                </select>

                <x-form.error name="catecory" />
            </x-form.field>

            <x-form.button class="">Update</x-form.button>

        </form>
    </x-setting>
</x-layout>
