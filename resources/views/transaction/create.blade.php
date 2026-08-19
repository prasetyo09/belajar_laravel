<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Central Jakarta PPKD Coffee Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <style>
        body {
            background-color: #f5f6f8;
            font-family: Arial, Helvetica, sans-serif;
        }

        .product-item{
            cursor: pointer;
        }

        .product-card{
            border: none;
            border-radius: 15px;
            transition: 0.2s;
            overflow: hidden;
        }

        .product-card:hover{
            transform: translateY(-4);
            box-shadow: 0, 8px, 20px rgba(0, 0, 0, 0.10);
        }

        .product-image{
            height: 130px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .price{
            color: greenyellow;
            font-weight: bold;
        }

        .cart-box{
            position: sticky;
            top: 20px;
        }

        .cart-item{
            border-bottom: 1px solid #eee;
            padding: 12px 0;
        }

        .cart-item:last-child{
            border-bottom: none;
        }

        .quantity-btn{
            width: 30px;
            height: 30px;
            padding: 0;
            border-radius: 50%;
        }

        .total-price{
            font-size: 25px;
            font-weight: bold;
            color:#6f4e37;
        }

        .payment-btn{
            border-radius:10px;
        }

        .card-text{
            backdrop-filter: blur(8px);
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="card">
            <main class="col-lg-12 p-5">
                <h3 class="fw-bold mb-1">Point of Sales</h3>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <p class="text-muted">Central Jakarta PPKD Coffee Shop</p>
                    <button class="btn btn-dark">Empty Cart</button>
                </div>
                <div class="mb-3">
                    <a href="{{ url('transaction') }}" class="btn btn-primary"><i class="bi bi-arrow-left"></i>Back to CMS</a>
                </div>

                <div class="row g-5 mb-2">
                    <div class="col-md-4">
                        <div class="card shadow-sm p-3 gap-3">
                            <div class="card-body">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-cart4" style="font-size: 2rem"></i>
                                    <div>
                                        <small class="text-muted">Today Transaction</small>
                                        <h4>10.000.000</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card shadow-sm p-3 gap-3">
                            <div class="card-body">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-cart4" style="font-size: 2rem"></i>
                                    <div>
                                        <small class="text-muted">Product Sold</small>
                                        <h4>10.000.000</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card shadow-sm p-3 gap-3">
                            <div class="card-body">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-cart4" style="font-size: 2rem"></i>
                                    <div>
                                        <small class="text-muted">Today Transaction</small>
                                        <h4>10.000.000</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-lg-8">
                        <div class="card border-0 shadow">
                            <div class="card-body">
                                <div class="row mb-4">
                                    <div class="col-md-7">
                                        <h5 class="fw-bold">Select Product</h5>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" id="searchProduct" class="form-control" placeholder="Search Product...">
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <button class="btn btn-dark btn-sm me-1 category-btn" onclick="filterCategory('all', this)" data-category="all">
                                        All
                                    </button>
                                    @foreach ($categories as $category )
                                    <button class="btn btn-outline-dark btn-sm me-1 category-btn" onclick="filterCategory('{{ $category->id }}', this)" data-category="{{ $category->id }}">
                                        {{ $category->name ?? '' }}
                                    </button>
                                    @endforeach
                                </div>

                                <div class="row g-3" id="productList">
                                    @foreach ($products as $product )
                                    <div class="col-md-4 col-sm-6 product-item"
                                    data-category="{{ $product->category->id }}"
                                        data-id="{{ $product->id }}"
                                        data-name="{{ $product->name }}"
                                        data-price="{{ $product->price }}"

                                        onclick="addToCart({{ $product->id }})">
                                        <div class="card product-card shadow h-100 rounded-4 border-black">
                                            <div class="product-image d-flex justify-content-center">
                                                <img src="{{ asset('storage/' . $product->photo) }}" style="object-fit: cover">
                                            </div>
                                            <div class="card-body bg-black bg-opacity-25 card-text">
                                                <span class="badge bg-light text-dark mb-2">{{ $product->category->name }}</span>
                                                <h6 class="fw-bold text-white">{{ $product->name ?? '' }}</h6>
                                                <span class="price">{{ number_format($product->price) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card border-0 shadow p-3 cart-box mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-3">
                                    <h5 class="fw-bold mb-0 d-flex flex-row gap-1">
                                        <i class="bi bi-cart"></i>
                                        Cart
                                    </h5>
                                    <span class="badge bg-dark" id="cartCount">
                                        0
                                    </span>
                                </div>
                                <div class="mb-3" id="cartItems">
                                    <div class="text-center text-muted py-5">
                                        <div class="fs-2">
                                            <i class="bi bi-cart4"></i>
                                            <p>Empty Card</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Sub Total</span>
                                <strong id="subTotal">Rp. 0</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Tax (10%)</span>
                                <strong id="tax">Rp. 0</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="fw-bold">Total</span>
                                <span class="total-price" id="total">Rp. 0</span>
                            </div>
                            <button class="btn btn-success w-100 py-3 payment-btn">Payment</button>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        const products = $products->map(function($product){
            return [
                'id' => $product->id,
                'name' => $product->name,
                'category_id' => $product->category_id,
                'category_name' => $product->category_name,
                'price' => $product->price
            ]
        });

        console.log($products);
        function filterCategory(categoryId, button){
            //selector all = array
            const products = document.querySelectorAll('.product-item');
            products.forEach(function(product){
                const categoryName = product.dataset.category;

                //jika user click category all, muncul category all
                //jika user click category snack, muncul category snack

                if (categoryId === 'all' || categoryName === String(categoryId) ) {
                    product.style.display = "";
                } else {
                    product.style.display = 'none';
                }
            });
            document.querySelectorAll('.category-btn').forEach(function(btn){
                btn.classList.remove('btn-dark', 'active');
                btn.classList.add('btn-outline-dark');
            });

            //ketika user memilih kategori
            button.classList.remove('btn-outline-dark');
            button.classList.add('btn-outline-dark', 'active');
        }

        function addToCart(productId){
            let cart = [];
            const products = document.querySelector(`.product-item`);

            const productCard = products.closest('.product-item');
            const productName = productCard.dataset.name;
            const productPrice = productCard.dataset.price;

            const existingItem = cart.find(function(item){
                return Number(item.id) === Number(productId);
            });

            if (existingItem) {
                existingItem.qty++;
            } else{
                cart.push({
                    id: productId,
                    name: productName,
                    price: productPrice,
                    qty: 1
                })
            }

            console.log(cart);
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
</body>
</html>
