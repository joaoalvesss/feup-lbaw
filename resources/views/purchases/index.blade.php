<x-layout>
    <div class="container text-white">
        <h1 class="mt-2">Order Management</h1>
        <table class="table">
            <thead>
                <tr>
                    <th class="center-text">Username</th>
                    <th class="center-text">Address</th>
                    <th class="center-text">Product Name</th>
                    <th class="center-text">Amount Bought</th>
                    <th class="center-text">Total Price</th>
                    <th class="center-select">Delivery Progress</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($purchases as $purchase)
                    <tr>
                        <td class="center-text">
                            @if($purchase->user!= NULL)
                                <a href="/users/{{$purchase->user->id}}">{{$purchase->user->name}}</a>
                            @else
                                Deleted User
                            @endif
                        </td>
                        <td class="center-text">{{ $purchase->address()->withTrashed()->first()->street }}, {{ $purchase->address()->withTrashed()->first()->city }}, {{ $purchase->address()->withTrashed()->first()->postal_code }} </td>
                        <td class="center-text">
                            @if($purchase->product != NULL)
                                <a href="/products/{{$purchase->product->id}}">{{$purchase->product->name}}</a>
                            @else
                                Deleted Product
                            @endif
                        </td>
                        <td class="center-text">{{ $purchase->quantity }}</td>
                        <td class="center-text">{{ $purchase->total }}</td>
                        <td class="center-select">
                            <form method="post" action="/admin/orders/{{$purchase->id}}">
                                @csrf
                                @method('patch')
                                <select name="delivery_progress" onchange="this.form.submit()">
                                    <option value="Processing" {{ $purchase->delivery_progress == 'Processing' ? 'selected' : '' }}>Processing</option>
                                    <option value="Shipped" {{ $purchase->delivery_progress == 'Shipped' ? 'selected' : '' }}>Shipped</option>
                                    <option value="Delivered" {{ $purchase->delivery_progress == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{$purchases->links()}}
    </div>
</x-layout>