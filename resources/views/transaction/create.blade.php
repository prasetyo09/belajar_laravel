<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Central Jakarta PPKD Coffee Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.client_key') }}"></script>

    <style>
        body {
            background-color: #f5f6f8;
            font-family: Arial, Helvetica, sans-serif;
        }

        .product-item {
            cursor: pointer;
        }

        .product-card {
            border: none;
            border-radius: 15px;
            transition: 0.2s;
            overflow: hidden;
        }

        .product-card:hover {
            transform: translateY(-4);
            box-shadow: 0, 8px, 20px rgba(0, 0, 0, 0.10);
        }

        .product-image {
            height: 130px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .price {
            color: greenyellow;
            font-weight: bold;
        }

        .cart-box {
            position: sticky;
            top: 20px;
        }

        .cart-item {
            border-bottom: 1px solid #eee;
            padding: 12px 0;
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .quantity-btn {
            width: 30px;
            height: 30px;
            padding: 0;
            border-radius: 50%;
        }

        .total-price {
            font-size: 25px;
            font-weight: bold;
            color: green;
        }

        .payment-btn {
            border-radius: 10px;
        }

        .card-text {
            backdrop-filter: blur(8px);
        }

        .card-payment{
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="card">
            <main class="col-lg-12 p-5">
                <h3 class="fw-bold mb-1">{{ $settings->pos_title }}</h3>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <p class="text-muted">{{ $settings->business_name }}</p>
                    <button class="btn btn-dark">Empty Cart</button>
                </div>
                <div class="mb-3">
                    <a href="{{ url('transaction') }}" class="btn btn-primary"><i class="bi bi-arrow-left"></i>Back to
                        CMS</a>
                </div>

                <div class="row g-5 mb-2">
                    <div class="col-md-4">
                        <div class="card shadow p-3 gap-3">
                            <div class="card-body">
                                <div class="d-flex align-items-center gap-2 ">
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
                        <div class="card shadow p-3 gap-3">
                            <div class="card-body">
                                <div class="d-flex align-items-center gap-2 ">
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
                        <div class="card shadow p-3 gap-3">
                            <div class="card-body">
                                <div class="d-flex align-items-center gap-2 ">
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
                                        <input type="text" id="searchProduct" class="form-control"
                                            placeholder="Search Product..." onkeyup="searchProduct()">
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <button class="btn btn-dark btn-sm me-1 category-btn"
                                        onclick="filterCategory('all', this)" data-category="all">
                                        All
                                    </button>
                                    @foreach ($categories as $category)
                                        <button class="btn btn-outline-dark btn-sm me-1 category-btn"
                                            onclick="filterCategory('{{ $category->id }}', this)"
                                            data-category="{{ $category->id }}">
                                            {{ $category->name ?? '' }}
                                        </button>
                                    @endforeach
                                </div>

                                <div class="row g-3" id="productList">
                                    @foreach ($products as $product)
                                        <div class="col-md-4 col-sm-6 product-item"
                                            data-category="{{ $product->category->id }}" data-id="{{ $product->id }}"
                                            data-name="{{ $product->name }}" data-price="{{ $product->price }}"
                                            onclick="addToCart({{ $product->id }})">
                                            <div class="card product-card shadow h-100 rounded-4 border-black">
                                                <div class="product-image d-flex justify-content-center">
                                                    <img src="{{ asset('storage/' . $product->photo) }}"
                                                        style="object-fit: cover">
                                                </div>
                                                <div class="card-body bg-black bg-opacity-25 card-text">
                                                    <span
                                                        class="badge bg-light text-dark mb-2">{{ $product->category->name }}</span>
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
                                            <p>Empty Cart</p>
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
                            <button type="submit" class="btn btn-success w-100 py-3 payment-btn"
                                onclick="openModalPayment()" id="btnOpenPaymentModal">Payment</button>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <div class="modal fade" id="paymentMethod" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="paymentMethodLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-bg-success">
                    <h1 class="modal-title fs-5" id="paymentMethodLabel">Detail Pembayaran</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Customer Name</label>
                        <input type="text" id="customer_name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Customer Email</label>
                        <input type="email" id="customer_email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Customer Address</label>
                        <textarea id="customer_address" class="form-control"></textarea>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 mb-1">
                            <strong class="bg-success p-2 text-white rounded" id="total-paid">Harga : Rp.0</strong>
                        </div>
                    </div>

                    <div class="row only-cash d-flex align-items-center mt-3 mb-3">
                        <div class="col-lg-6">
                            <label for="cash_paid" class="form-label">Pembayaran Cash :</label>
                            <input type="number" id="cash_paid" step="any" min="0" class="form-control" oninput="calculateChange()">
                        </div>

                        <div class="col-lg-6">
                            <strong class="bg-primary p-2 text-white rounded" id="change-paid">
                                Kembalian : Rp.0
                            </strong>
                        </div>
                    </div>

                    <h5 class="mb-3 fw-semibold">Pilih Metode Pembayaran</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="w-100 card-payment">
                                <input type="radio" name="payment_method" value="cash" class="d-none payment-option">
                                <div class="card p-3 shadow-sm border payment-card text-center h-100">
                                    <h4 class="text-success fw-bold"><i class="bi bi-cash-stack"></i> Cash</h4>
                                    <p class="text-muted small">Bayar Langsung di Kasir Secara Tunai.</p>
                                </div>
                            </label>
                        </div>
                        <div class="col-md-6 ">
                            <label class="w-100 card-payment">
                                <input type="radio" name="payment_method" value="midtrans" class="d-none payment-option">
                                <div class="card p-3 shadow-sm border payment-card text-center h-100">
                                    <h4 class="text-success fw-bold"><i class="bi bi-cash-stack"></i> Online</h4>
                                    <p class="text-muted small">Pembayaran Online via QRIS / E-Wallet</p>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="processPayment()" class="btn btn-primary">Pay Now</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>

    <script>
        document.querySelectorAll('.payment-option').forEach(input => {
            input.addEventListener('change', function(){
                document.querySelectorAll('.payment-card').forEach(card => card.classList.remove('border-success', 'border-primary', 'bg-light'));
                if (this.checked) {
                    const card = this.nextElementSibling;
                    card.classList.add(this.value === 'cash' ? 'border-success' : 'border-primary', 'bg-light');
                }

                const onlyCashBox = document.querySelector('.only-cash');
                if (this.value === 'cash') {
                    onlyCashBox.classList.remove('d-none');
                    document.getElementById('cash_paid').focus();
                } else {
                    onlyCashBox.classList.add('d-none');
                    document.getElementById('cash_paid').value = 0;
                }
            });
        })

        function calculateChange(){
            let subtotal = 0;
            cart.forEach(function(item){
                subtotal += Number(item.price)  * Number(item.qty);
            });

            const tax = subtotal * 0.1;
            const totalAmount = subtotal + tax;

            const cashPaidInput = parseFloat(document.getElementById('cash_paid').value) || 0;

            const changeMoney = cashPaidInput - totalAmount;
            const changeElement = document.getElementById('change-paid');

            if (changeMoney < 0) {
                changeElement.innerText = `Kurang Rp. ${formatRupiah(Math.abs(changeMoney))}`;
                changeElement.classList.add('text-bg-danger');
                changeElement.classList.remove('text-bg-success'); 
            } else {
                changeElement.innerText = `Kembalian Rp. ${formatRupiah(changeMoney)}`;
                changeElement.classList.add('text-success'); 
                changeElement.classList.remove('text-danger');
            }
        }

        function openModalPayment(){
            const modal = new bootstrap.Modal(document.getElementById('paymentMethod'));
            modal.show();
        }

        function filterCategory(categoryId, button) {
            //selector all = array
            const products = document.querySelectorAll('.product-item');
            products.forEach(function (product) {
                const categoryName = product.dataset.category;

                //jika user click category all, muncul category all
                //jika user click category snack, muncul category snack

                if (categoryId === 'all' || categoryName === String(categoryId)) {
                    product.style.display = "";
                } else {
                    product.style.display = 'none';
                }
            });
            document.querySelectorAll('.category-btn').forEach(function (btn) {
                btn.classList.remove('btn-dark', 'active');
                btn.classList.add('btn-outline-dark');
            });

            //ketika user memilih kategori
            button.classList.remove('btn-outline-dark');
            button.classList.add('btn-outline-dark', 'active');
        }

        let cart = [];

        function addToCart(productId) {
            const product = document.querySelector(`.product-item[data-id="${productId}"]`);

            if (!product) {
                alert('Product not found!');
                return;
            }

            const productName = product.dataset.name;
            const productPrice = Number(product.dataset.price);

            const existingItem = cart.find(function (item) {
                return Number(item.id) === Number(productId);
            });

            if (existingItem) {
                existingItem.qty++;
            } else {
                cart.push({
                    id: productId,
                    name: productName,
                    price: productPrice,
                    qty: 1
                })
            }

            displayCart();
        }

        function displayCart() {
            const cartItems = document.getElementById('cartItems');

            cartItems.innerHTML = "";
            if (cart.length === 0) {
                cartItems.innerHTML = `
                    <div class="text-center text-muted py-5">
                        <div class="fs-2">
                            <i class="bi bi-cart4"></i>
                            <p>Empty Card</p>
                        </div>
                    </div>
                `;
            }

            cart.forEach(function (item) {
                cartItems.innerHTML += `
                    <div class="cart-item">
                        <div class="d-flex justify-content-between">
                            <div>
                                <strong>
                                    ${item.name}
                                </strong>
                                <div class="small text-muted">${formatRupiah(item.price)}</div>
                            </div>
                            <strong>
                                ${formatRupiah(item.price * item.qty)}
                            </strong>
                        </div>
                        <div class="d-flex align-items-center mt-3 gap-1">
                            <button type="button" class="btn btn-outline-secondary quantity-btn" onclick="decreaseItem(${item.id})">
                                -
                            </button>
                            <span>${item.qty}</span>
                            <button type="button" class="btn btn-outline-secondary quantity-btn" onclick="increaseItem(${item.id})">
                                +
                            </button>

                            <button type="button" class="btn btn-outline-danger ms-auto" onclick="removeItem(${item.id})">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </div>
                `;
            });
            calculateCart();
        }

        function removeItem(productId) {
            cart = cart.filter(function (item) {
                return Number(item.id) !== Number(productId);
            });

            displayCart();
        }

        function decreaseItem(productId) {
            const item = cart.find(function (item) {
                return Number(item.id) === Number(productId);
            });

            item.qty--;

            if (item.qty <= 0) {
                removeItem(productId);
                return;
                exit();
            }
            displayCart();
        }

        function increaseItem(productId) {
            const item = cart.find(function (item) {
                return Number(item.id) === Number(productId);
            });

            item.qty++;

            displayCart();
        }

        function calculateCart() {
            let subTotal = 0;
            let itemCount = 0;

            cart.forEach(function (item) {
                subTotal += Number(item.price) * Number(item.qty);
                itemCount += Number(item.qty);
            });

            const tax = subTotal * 0.10;
            const total = subTotal + tax;

            document.getElementById('subTotal').innerText = `Rp${formatRupiah(subTotal)}`
            document.getElementById('tax').innerText = `Rp${formatRupiah(tax)}`
            document.getElementById('total').innerText = `Rp${formatRupiah(total)}`
            document.getElementById('total-paid').innerText = `Rp${formatRupiah(total)}`
            document.getElementById('cartCount').innerText = itemCount;
        }

        function formatRupiah(number) {
            return new Intl.NumberFormat('id-ID').format(number)
        }

        function searchProduct() {
            const search = document.getElementById('searchProduct').value.toLowerCase().trim();
            const products = document.querySelectorAll('.product-item');

            products.forEach(function (product) {
                const productName = product.dataset.name.toLowerCase();

                //jika product name di dalam tabel nilainya sama pada saat user input
                if (productName.includes(search)) {
                    product.style.display = "";
                } else {
                    product.style.display = "none";
                }
            })
        }

        async function processPayment() {
            if (cart.length === 0) {
                alert('Cart is Empty')
                return;
            }

            const selectedPayment = document.querySelector('input[name=payment_method]:checked');
            const paymentMethod = selectedPayment ? selectedPayment.value : 'cash';
            const customerName = document.getElementById('customer_name').value || 'Unknown';
            const customerEmail= document.getElementById('customer_email').value || 'Unknown';
            const customerAddress= document.getElementById('customer_address').value || 'Unknown';

            try {
                const response = await fetch("{{ route('transaction.store') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector(`meta[name="csrf-token"]`).getAttribute('content')
                    },

                    body: JSON.stringify({
                        items: cart.map(function (item) {
                            return {
                                id: item.id,
                                qty: item.qty
                            }
                        }),
                        payment_method: paymentMethod,
                        customer_name: customerName,
                        customer_email: customerEmail,
                        customer_address: customerAddress
                    })
                })

                const result = await response.json();
                if (!response.ok) {
                    throw new Error(result.message || 'Gagal memproses transaksi');
                }

                if (result.payment_method === "midtrans") {
                    //MIDTRANS
                    window.snap.pay(result.snap_token, {
                        onSuccess: function (result) {
                            /* You may add your own implementation here */

                            alert("payment success!");
                            cart = [];
                            displayCart();
                            location.reload();

                            // console.log(result)
                        },
                        onPending: function (result) {
                            /* You may add your own implementation here */

                            alert("waiting your payment!");
                            location.reload();
                            // console.log(result);
                        },
                        onError: function (result) {
                            /* You may add your own implementation here */

                            alert("payment failed!");
                            location.reload();

                            // console.log(result);
                        },
                        onClose: function () {
                            /* You may add your own implementation here */

                            alert('you closed the popup without finishing the payment');
                        }
                    });
                } else {
                    alert("Transaksi Cash Berhasil");
                    cart = [];
                    displayCart();
                    location.reload();
                }
            } catch (error) {
                console.log(error)
                alert(error.message);
            }
        }
        displayCart();
    </script>
</body>

</html>
