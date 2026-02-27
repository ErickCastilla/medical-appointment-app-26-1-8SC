{{--verificar si hay un elemnto en el arreglo de breadcrumbs--}}
@if (count($breadcrumbs))
{{-- Display:Block --}}
    <nav class="mb-2" block> 
        <ol class= "flex felx-wrap text-slate-700 text-sm">
        @foreach ($breadcrumbs as $item)
        <li class="flex items-center">
            {{--Si no es el primer elemento, pinta el segundo--}}
            @unless ($loop->first)
            {{--EL SPAN CREA el separador con el margen lateral--}}
            <span class="px-2 text-gray-400">
                /
            </span> 
            @endunless

            {{--rebisa si existe un href--}}
            @isset($item['href'])
            {{--si existe se pinta con opacidad reducida--}}
            <a href="{{ $item['href'] }}" class="opacity-60 hover:opacity-100 transition">
                {{ $item['name'] }}
            </a>

            @else
            <a href=""></a>
            {{ $item['name'] }}
            @endisset
        </li>
        @endforeach
        </ol>
        {{--quiero que el ultimo elemento aparezca resaltado--}}
        @if (count($breadcrumbs) > 1)
        <h6 class="font-bold mt-2">
            {{ end($breadcrumbs)['name'] }}
        </h6>
        @endif
    </nav>
@endif
