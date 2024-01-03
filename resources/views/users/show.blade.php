@php
    use Carbon\Carbon;

    function displayStars($score) {
        $fullStars = floor($score);
        $halfStar = ceil($score - $fullStars);
        $emptyStars = 5 - $fullStars - $halfStar;

        for ($i = 0; $i < $fullStars; $i++) { echo '<i class="fas fa-star star-icon"></i>'; }
        if ($halfStar) { echo '<i class="fas fa-star-half-alt star-icon"></i>'; }
        for ($i = 0; $i < $emptyStars; $i++) { echo '<i class="far fa-star star-icon"></i>'; }
    }
@endphp

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.18.0/font/bootstrap-icons.css" rel="stylesheet">

<x-layout>
    <div class="profile-container mt-4">
        <div class="row">
            <div>
                <div class="card2">
                    <h2 class="card-header">
                        Profile
                    </h2>

                    <div class="card-body">
                        <div class="row">
                            <div class="profile-pic col">
                                <!-- Profile Picture -->
                                <img src="{{ asset($user->image ? 'storage/' . $user->image : 'images/users/no-image.png') }}" alt="Profile Picture" class="img-fluid rounded" style="max-width: 20em; max-height: 20em; width: auto; height: auto;">
                            </div>
                            <div class="details2 col">
                                <!-- User Details -->
                                <h3 class="mb-2">{{ $user->name }}</h3>
                                @can('owner', $user)
                                <p class="mb-0">Phone Number:</p>
                                <p class="mb-2">{{ $user->phone_number }}</p>
                                <p class="mb-0">E-mail:</p>
                                <p class="mb-4">{{ $user->email }}</p>
                                
                                <div class="buttons">
                                    <div class="d-inline-block mr-2">
                                        <a href="edit" class="btn btn-info">
                                            <div class="d-flex align-items-center text-white">
                                                Edit Profile
                                            </div>
                                        </a>
                                    </div>
                                    <div class="d-inline-block">
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                                            <div class="d-flex align-items-center">
                                                Delete Account
                                            </div>
                                        </button>
                                    </div>
                                </div>
                                @else
                                <p class="mb-0">Client status: {{ $user->permission }}</p>
                                @endcan
                           </div>
                        </div>
                    </div>
                 </div>
                @can('owner', $user)
                 <div class="card2 mt-3 mb-5" >
                    <div class="special">
                        Saved Addresses
                        <button type="button" class="navbar-toggler btn-lg" data-bs-toggle="collapse" data-bs-target="#addAddress" aria-controls="addAddress" aria-expanded="false" aria-label="Toggle navigation">
                            +
                        </button>
                    </div>
                    @foreach($user->addresses as $address)
                    <div class="card-body">
                        <div class="address-box">
                            <h5>{{ $address->label }}</h5>
                            <p>{{ $address->street }}, {{ $address->city }}, {{ $address->postal_code }}</p>
                
                            <!-- Edit and Remove Buttons -->
                            <div class="d-flex mb-2">
                                <!-- Edit Button -->
                                <button class="btn btn-secondary btn-sm mb-1 me-1" type="button" data-bs-toggle="collapse" data-bs-target="#editAddress{{$address->id}}" aria-controls="editAddress{{$address->id}}" aria-expanded="false" aria-label="Toggle navigation"> Edit </button>
                
                                <!-- Remove Button -->
                                <form method="post" action="/addresses/{{ $address->id }}" class="mb-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-secondary btn-sm"> Remove </button>
                                </form>
                            </div>
                
                            <!-- Edit Address Form (Collapsed by Default) -->
                            <div class="collapse" id="editAddress{{$address->id}}">
                                <form class="d-flex flex-row" method="post" action="/addresses/{{$address->id}}">
                                    @csrf
                                    @method('PUT')
                                    <input class="form-control me-2 mb-1" type="text" name="label" placeholder="Label" value="{{$address->label}}">
                                    <input class="form-control me-2 mb-1" type="text" name="street" placeholder="Address" value="{{$address->street}}">
                                    <input class="form-control me-2 mb-1" type="text" name="city" placeholder="City" value="{{$address->city}}">
                                    <input class="form-control me-2 mb-1" type="text" name="postal_code" placeholder="Postal Code" value="{{$address->postal_code}}">
                                    <button class="btn btn-outline-success" type="submit">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
                
                    <div class="collapse navbar-collapse justify-content-between" id="addAddress">
                        <form class="d-flex mx-auto" method="post" action="/addresses">
                            @csrf
                            @method('POST')
                            <input class="form-control me-2" type="text" name="label" placeholder="Label">
                            <input class="form-control me-2" type="text" name="street" placeholder="Address">
                            <input class="form-control me-2" type="text" name="city" placeholder="City">
                            <input class="form-control me-2" type="text" name="postal_code" placeholder="Postal Code">
                            <button class="btn btn-outline-success" type="submit">Save</button>
                        </form>
                    </div>                            

                </div>
                @endcan
            </div>
        </div>
    </div>
    <!-- Delete Account Modal -->
    <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteAccountModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete your account? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form method="post" action ="/users">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete Account</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @can('ownerOrAdmin', $user)
    <div class="history">
        <h4 class="text-white">{{$user->name}}'s History</h4>
        <section class="d-flex justify-content-around">
            <table class="table">
                <thead>
                   <tr class="text-center">
                       <th scope="col">Product</th>
                       <th scope="col">Date</th>
                       <th scope="col">Status</th>
                       <th scope="col">Amount</th>
                       <th scope="col">Price</th>
                   </tr>
                </thead>
                <tbody>
                    @foreach($purchases as $purchase)
                            @php
                                $date = Carbon::parse($purchase->date)->format('d/m/Y');
                            @endphp
                            <tr>
                                <td class="cart-entry">
                                    <span class="aux">{{$purchase->product != NULL ? $purchase->product->name : "Deleted Product"}}</span>
                                </td>

                                <td class="cart-entry">
                                    <span class="aux">{{$date}}</span>
                                </td>
                                
                                <td class="cart-entry">
                                    <span class="aux">{{$purchase->delivery_progress}}</span>
                                </td>

                                <td class="cart-entry">
                                    <span class="aux">{{$purchase->quantity}}</span>
                                </td>
                            
                                <td class="cart-entry">
                                    <span class="aux">{{$purchase->total}}€</span>
                                </td>
                            </tr>	
                    @endforeach
                </tbody>
            </table>
        </section>
    </div>
    @endcan

    <div class=reviews>
        <div class="username">
            {{$user->name}}'s reviews
        </div>
        @foreach($user->reviews as $review)
            <div id="profile_review">
                <h5 class="card-title">{{ $review->product->name }}</h5>                              
                <section class="info">
                <p>    
                    Date: 
                    <span class="date-span">{{ \Carbon\Carbon::parse($review->date)->format('d/m/Y') }}</span>
                    Score:
                    <span class="stars">
                        @php displayStars($review->score) @endphp
                    </span>
                </p>
                <p>
                    @if (!empty($review->comment))
                        Comment: {{ $review->comment }}
                    @endif
                </p>    
                </section>
            </div>
        @endforeach
    </div>
    
</x-layout>
