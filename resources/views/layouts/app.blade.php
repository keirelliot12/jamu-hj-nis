<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jamu Herbal Hj. Nis - Tradisional & Alami</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Playfair Display', serif; }
        .bg-primary { background-color: #2D5A27; }
        .text-primary { color: #2D5A27; }
        .bg-secondary { background-color: #8B5A2B; }
        .text-secondary { color: #8B5A2B; }
        .bg-tertiary { background-color: #FDF5E6; }
    </style>
</head>
<body class="bg-tertiary text-gray-800 flex flex-col min-h-screen">

    <!-- Smart Sticky Navbar -->
    <nav id="navbar" class="bg-white shadow-md fixed w-full z-50 transition-transform duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center gap-3">
                        <img class="h-10 w-auto rounded-full shadow-sm" src="https://ui-avatars.com/api/?name=Hj+Nis&background=2D5A27&color=fff&size=64&bold=true" alt="Logo">
                        <span class="font-bold text-2xl text-primary font-serif">Jamu Hj. Nis</span>
                    </a>
                </div>
                
                <!-- Desktop Menu -->
                <div class="hidden sm:flex sm:items-center sm:space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-primary px-3 py-2 rounded-md font-medium transition">Beranda</a>
                    <a href="{{ route('products') }}" class="text-gray-600 hover:text-primary px-3 py-2 rounded-md font-medium transition">Produk</a>
                    <a href="#about" class="text-gray-600 hover:text-primary px-3 py-2 rounded-md font-medium transition">Tentang Kami</a>
                    <a href="{{ route('cart.index') }}" class="relative text-gray-600 hover:text-primary p-2 transition">
                        <i data-lucide="shopping-cart" class="w-6 h-6"></i>
                        @php $cartCount = collect(session('cart', []))->sum('quantity'); @endphp
                        <span id="cart-badge" class="{{ $cartCount > 0 ? '' : 'hidden' }} absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">
                            {{ $cartCount }}
                        </span>
                    </a>
                </div>
                
                <!-- Mobile menu button -->
                <div class="flex items-center sm:hidden">
                    <a href="{{ route('cart.index') }}" class="relative text-gray-600 hover:text-primary p-2 mr-4">
                        <i data-lucide="shopping-cart" class="w-6 h-6"></i>
                        <span id="mobile-cart-badge" class="{{ $cartCount > 0 ? '' : 'hidden' }} absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">
                            {{ $cartCount }}
                        </span>
                    </a>
                    <button type="button" id="mobile-menu-btn" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary" aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <i data-lucide="menu" class="block h-6 w-6"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="sm:hidden hidden bg-white border-t border-gray-200" id="mobile-menu">
            <div class="pt-2 pb-3 space-y-1">
                <a href="{{ route('home') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:bg-gray-50 hover:border-primary hover:text-primary">Beranda</a>
                <a href="{{ route('products') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:bg-gray-50 hover:border-primary hover:text-primary">Produk</a>
                <a href="#about" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:bg-gray-50 hover:border-primary hover:text-primary">Tentang Kami</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow pt-20">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-primary text-white pt-12 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <div>
                    <h3 class="text-2xl font-bold font-serif mb-4">Jamu Herbal Hj. Nis</h3>
                    <p class="text-green-100 mb-4">Melestarikan warisan leluhur melalui jamu dan herbal tradisional yang diolah secara higienis dan alami untuk kesehatan keluarga Anda.</p>
                </div>
                <div>
                    <h4 class="text-lg font-bold mb-4 font-serif">Menu Cepat</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-green-100 hover:text-white transition">Beranda</a></li>
                        <li><a href="{{ route('products') }}" class="text-green-100 hover:text-white transition">Katalog Produk</a></li>
                        <li><a href="{{ route('cart.index') }}" class="text-green-100 hover:text-white transition">Keranjang Belanja</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-bold mb-4 font-serif">Kontak & Lokasi</h4>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-3">
                            <i data-lucide="map-pin" class="w-5 h-5 flex-shrink-0 text-green-200 mt-0.5"></i>
                            <span class="text-green-100">Jl. KH. Zubair, Gresik, Jawa Timur</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i data-lucide="phone" class="w-5 h-5 flex-shrink-0 text-green-200"></i>
                            <a href="https://wa.me/6281332875057" class="text-green-100 hover:text-white transition">+62 813-3287-5057</a>
                        </li>
                        <li class="flex items-center gap-3">
                            <i data-lucide="instagram" class="w-5 h-5 flex-shrink-0 text-green-200"></i>
                            <a href="#" class="text-green-100 hover:text-white transition">@jamuhjnis</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-green-700 pt-8 text-center text-sm text-green-200">
                &copy; {{ date('Y') }} Jamu Herbal Hj. Nis. All rights reserved. <br>
                <span class="opacity-75">Developed by <a href="https://santrigresik.me" class="hover:underline">SantriGresik Official</a></span>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        lucide.createIcons();

        // Mobile menu toggle
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            var menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Smart Sticky Navbar
        let lastScrollTop = 0;
        const navbar = document.getElementById('navbar');
        
        window.addEventListener('scroll', function() {
            let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            if (scrollTop > lastScrollTop && scrollTop > 100) {
                // Scroll down
                navbar.style.transform = 'translateY(-100%)';
            } else {
                // Scroll up
                navbar.style.transform = 'translateY(0)';
            }
            lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
        });

        // Global function to update cart count
        function updateCartBadge(count) {
            const badges = [document.getElementById('cart-badge'), document.getElementById('mobile-cart-badge')];
            badges.forEach(badge => {
                if(badge) {
                    if(count > 0) {
                        badge.textContent = count;
                        badge.classList.remove('hidden');
                    } else {
                        badge.classList.add('hidden');
                    }
                }
            });
        }

        // Add to cart AJAX
        document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const productId = this.getAttribute('data-id');
                const btnContent = this.innerHTML;
                
                // Show loading
                this.innerHTML = '<i data-lucide="loader-2" class="w-5 h-5 animate-spin"></i>';
                lucide.createIcons();
                this.disabled = true;

                fetch('{{ route('cart.add') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ product_id: productId })
                })
                .then(response => response.json())
                .then(data => {
                    this.innerHTML = btnContent;
                    this.disabled = false;
                    
                    if(data.success) {
                        updateCartBadge(data.cartCount);
                        Swal.fire({
                            title: 'Berhasil!',
                            text: data.message,
                            icon: 'success',
                            showCancelButton: true,
                            confirmButtonColor: '#2D5A27',
                            cancelButtonColor: '#8B5A2B',
                            confirmButtonText: 'Lanjut Belanja',
                            cancelButtonText: 'Lihat Keranjang'
                        }).then((result) => {
                            if (!result.isConfirmed) {
                                window.location.href = "{{ route('cart.index') }}";
                            }
                        });
                    }
                })
                .catch(error => {
                    this.innerHTML = btnContent;
                    this.disabled = false;
                    console.error('Error:', error);
                });
            });
        });
    </script>
    @stack('scripts')
</body>
</html>