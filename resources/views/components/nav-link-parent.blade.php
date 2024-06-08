@props(['active'])

@php
$classes = ($active ?? false)
            ? 'parent-nav inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-semibold leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out cursor-pointer relative'
            : 'parent-nav inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-semibold leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out cursor-pointer relative';
@endphp

<div x-data="{ open: false }" @click.away="open = false" @close.stop="open = false" @click="open = ! open" {{ $attributes->merge(['class' => $classes]) }} >
    <div>
        <div class="inline-block">{{ $name }}</div>

        <div class="relative inline-block ml-1 top-1">
                
        </div>
    </div>

    <div class="border border-gray-300 children" 
    x-show="open"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="transform opacity-0 scale-95"
    x-transition:enter-end="transform opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-75"
    x-transition:leave-start="transform opacity-100 scale-100"
    x-transition:leave-end="transform opacity-0 scale-95">
        {{ $children }}
    </div>
</div>