@php
    $cashAmounts = [5, 10, 20, 35, 50, 100];
@endphp

<x-layout>
    <h1 class="admin-title">Add More Credits</h1>
    <div class="cash-container">
        <div class="cash-line">
            <ul class="cash-list">
                @foreach(array_slice($cashAmounts, 0, 3) as $amount)
                    <li>
                        <form method="POST" action="/payment">
                            @csrf
                            <input type="hidden" name="price" value="{{$amount}}"/>
                            <button type="submit" class="cash-btn">
                                <h1 class="text-white">{{$amount}} €</h1>
                            </button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="cash-line">
            <ul class="cash-list">
                @foreach(array_slice($cashAmounts, 3) as $amount)
                    <li>
                        <form method="POST" action="/payment">
                            @csrf
                            <input type="hidden" name="price" value="{{$amount}}"/>
                            <button type="submit" class="cash-btn">
                                <h1 class="text-white">{{$amount}} €</h1>
                            </button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>  
</x-layout>