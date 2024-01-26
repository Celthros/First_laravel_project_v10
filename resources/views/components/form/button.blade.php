
<x-form.field>
<button type="submit"
        {{ $attributes(['class' => 'bg-blue-500 text-white uppercase font-semibold text-xs rounded-2xl py-2 px-10 hover:bg-blue-600'])}}
>
    {{ $slot }}
</button>
</x-form.field>
