<x-layout>
    @include('components.carousel')
    <div class="auto maingrid">
        <h2 class="highlights text-white">Highlights</h2>
        <div class="container-fluid mt-4" id="homeProductGrid">
            @foreach($topProducts as $product1)
                <div>
                    <x-card :product="$product1"/>
                </div>
            @endforeach
        </div>
        <h2 class="highlights text-white">Game Genres</h2>
        <div class="d-flex flex-row genres">
            @foreach ($categories as $category)
                <div class="text-center genre" data-category-id="{{ $category->name }}">
                    <a href="/?category={{ $category->name }}" class="btn btn-primary buy">
                        {{ $category->name }}
                    </a>                    
                </div>
            @endforeach
        </div>
        
        <h2 class="highlights text-white">More Products</h2>
        <div class="container-fluid mt-4" id="homeProductGrid">
            @foreach($otherProducts as $product2)
                <div>
                    <x-card :product="$product2"/>
                </div>
            @endforeach
        </div>    
        <div class="mt-6 p-4 pages">
            {{$otherProducts->onEachSide(1)->links()}}
        </div>             
    </div>
</x-layout>
