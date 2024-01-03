<x-layout>
    <h1 class="admin-title">Admin Management Areas</h1>
    <div class="admin-container">
        <ul class="dashboard-list">
            <li>
                <a href="admin/products" class="admin-btn">
                    <div class="text-container">
                        <h2>Total Products</h2>
                        <h5>» {{$products}}</h5>
                    </div>
                    <img src="images/product.png" alt="product">
                </a>
            </li>
            <li>
                <a href="admin/orders" class="admin-btn">
                    <div class="text-container">
                        <h2>Total Orders</h2>
                        <h5>» {{$orders}}</h5>
                    </div>
                    <img src="images/order.png" alt="order">
                </a>
            </li>
            <li>
                <a href="admin/users" class="admin-btn">
                    <div class="text-container">
                        <h2>Total Users</h2>
                        <h5>» {{$users}}</h5>
                    </div>
                    <img src="images/user.png" alt="user">
                </a>
            </li>
        </ul>
    </div>
</x-layout>
