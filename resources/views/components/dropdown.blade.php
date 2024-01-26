
@props(['trigger'])
<div x-data="{ show: false}" @click.away="show = false" class="relative appearance-none bg-transparent text-left">
    {{-- trigger --}}
        <div @click="show = ! show">
            {{ $trigger }}
        </div>

    {{-- links --}}
    <div x-show="show" :class="{ 'hidden': ! show }" class="text-sm leading-6 font-semibold py-2 absolute bg-gray-100 w-full mt-1 rounded-xl z-50 overflow-auto max-h-52" style="display: none;">
        {{ $slot}}
    </div>
</div>
