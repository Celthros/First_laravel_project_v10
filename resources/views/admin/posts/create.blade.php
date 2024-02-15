<x-layout>
    <x-setting heading="Publish New Post">
        <form action="/admin/posts" method="post" enctype="multipart/form-data">
            @csrf

            <x-form.input name="title" required />
            <x-form.input name="slug" required />
            <x-form.input name="thumbnail" type="file" required />
            <x-form.textarea name="excerpt" />
            <x-form.textarea name="body" />

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
                    {{ old('category_id') == $category->id ? 'selected' : ''}}>
                    {{ ucwords($category->name) }}
                </option>
                @endforeach
                </select>

                <x-form.error name="catecory" />
            </x-form.field>

            <x-form.button class="">Publish</x-form.button>

        </form>
    </x-setting>
</x-layout>
