<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{config("app.name")}}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

    <header>
        <nav>
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('products.index') }}">Products</a></li>
                <li><a href="{{ route('sales.index') }}">Sales</a></li>
                <li><a href="{{ route('categories.index') }}">Categories</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="hero">
            <h1>Welcome to Sales Tracker</h1>
            <p>Monitor and manage your sales, products, and inventory with ease.</p>
        </section>

        <section class="overview">
            <h2>Sales Overview</h2>
            <div class="overview-stats">
                <div>
                    <p>Total Sales This Month</p>
                    <h3>${{ number_format($totalSalesMonth, 2) }}</h3>
                </div>
                <div>
                    <p>Total Sales Today</p>
                    <h3>${{ number_format($totalSalesToday, 2) }}</h3>
                </div>
            </div>
        </section>

        <section class="categories">
            <h2>Product Categories</h2>
            <ul>
                @foreach ($categories as $category)
                    <li>
                        <a href="{{ route('category.show', $category->id) }}">{{ $category->name }}</a>
                    </li>
                @endforeach
            </ul>
        </section>

        <section class="featured-products">
            <h2>Featured Products</h2>
            <div class="product-grid">
                @foreach ($products as $product)
                    <div class="product-card">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                        <h3>{{ $product->name }}</h3>
                        <p>{{ $product->description }}</p>
                        <p>Price: ${{ $product->price }}</p>
                        <a href="{{ route('product.show', $product->id) }}">View Details</a>
                    </div>
                @endforeach
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} Your Company. All Rights Reserved.</p>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
