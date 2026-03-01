@extends('layouts.app')

@section('content')
<div class="bg-tertiary min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Left Column: Cart Items -->
            <div class="w-full md:w-2/3">
                <div class="bg-white rounded-2xl shadow-sm p-6 mb-8">
                    <h2 class="text-2xl font-bold font-serif mb-6 text-primary border-b border-gray-100 pb-4">
                        Keranjang Belanja
                    </h2>

                    @if(session('error'))
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                            <p>{{ session('error') }}</p>
                        </div>
                    @endif

                    @if(empty($cart))
                        <div class="text-center py-12">
                            <i data-lucide="shopping-cart" class="w-20 h-20 text-gray-300 mx-auto mb-4"></i>
                            <h3 class="text-xl font-medium text-gray-600 mb-2">Keranjang Anda Kosong</h3>
                            <p class="text-gray-500 mb-6">Sepertinya Anda belum memilih produk jamu untuk dibeli.</p>
                            <a href="{{ route('products') }}" class="inline-block bg-primary text-white font-medium py-3 px-8 rounded-full hover:bg-green-800 transition shadow-sm">
                                Mulai Belanja
                            </a>
                        </div>
                    @else
                        <div class="space-y-6">
                            @foreach($cart as $id => $details)
                                <div class="flex flex-col sm:flex-row items-center gap-6 pb-6 border-b border-gray-100 last:border-0 last:pb-0" data-id="{{ $id }}">
                                    <!-- Image -->
                                    <div class="w-24 h-24 flex-shrink-0 bg-gray-100 rounded-xl overflow-hidden shadow-inner">
                                        @if($details['image'])
                                            <img src="{{ asset('storage/' . $details['image']) }}" alt="{{ $details['name'] }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center">
                                                <i data-lucide="image" class="w-8 h-8 text-gray-300"></i>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Details -->
                                    <div class="flex-grow text-center sm:text-left">
                                        <h3 class="text-lg font-bold text-gray-800 mb-1">{{ $details['name'] }}</h3>
                                        <p class="text-primary font-medium">Rp {{ number_format($details['price'], 0, ',', '.') }}</p>
                                    </div>

                                    <!-- Actions -->
                                    <div class="flex items-center gap-4">
                                        <!-- Quantity Control -->
                                        <div class="flex items-center border border-gray-200 rounded-lg bg-gray-50 p-1">
                                            <button class="update-cart px-3 py-1 text-gray-600 hover:text-primary transition font-medium" data-action="decrease" data-id="{{ $id }}">-</button>
                                            <input type="number" value="{{ $details['quantity'] }}" class="w-12 text-center bg-transparent border-none focus:ring-0 text-gray-800 font-medium" readonly>
                                            <button class="update-cart px-3 py-1 text-gray-600 hover:text-primary transition font-medium" data-action="increase" data-id="{{ $id }}">+</button>
                                        </div>

                                        <!-- Remove Button -->
                                        <button class="remove-from-cart text-red-500 hover:text-red-700 hover:bg-red-50 p-2 rounded-lg transition" data-id="{{ $id }}" title="Hapus Produk">
                                            <i data-lucide="trash-2" class="w-5 h-5"></i>
                                        </button>
                                    </div>
                                    
                                    <!-- Subtotal (Hidden on very small screens) -->
                                    <div class="hidden sm:block w-32 text-right">
                                        <p class="text-sm text-gray-500 mb-1">Subtotal</p>
                                        <p class="font-bold text-gray-800">Rp {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <!-- Right Column: Checkout Form -->
            <div class="w-full md:w-1/3">
                <div class="bg-white rounded-2xl shadow-sm p-6 sticky top-28 border-t-4 border-secondary">
                    <h2 class="text-xl font-bold font-serif mb-6 text-gray-800">Detail Pengiriman</h2>

                    <form action="{{ route('cart.checkout') }}" method="POST">
                        @csrf
                        <div class="space-y-4 mb-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                <input type="text" id="name" name="name" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 p-2 border">
                            </div>
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor WhatsApp</label>
                                <input type="tel" id="phone" name="phone" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 p-2 border" placeholder="Contoh: 08123456789">
                            </div>
                            <div>
                                <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                                <textarea id="address" name="address" rows="3" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 p-2 border" placeholder="Nama Jalan, RT/RW, Kelurahan, Kecamatan, Kota"></textarea>
                            </div>
                        </div>

                        <!-- Summary -->
                        <div class="border-t border-gray-200 pt-4 mb-6">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-gray-600">Total Belanja</span>
                                <span class="font-bold text-lg text-gray-800">Rp {{ number_format($total ?? 0, 0, ',', '.') }}</span>
                            </div>
                            <p class="text-xs text-gray-500 text-right">*Belum termasuk ongkos kirim</p>
                        </div>

                        <button type="submit" class="w-full bg-secondary text-white font-bold py-3 px-4 rounded-xl hover:bg-orange-800 transition flex items-center justify-center gap-2 shadow-md {{ empty($cart) ? 'opacity-50 cursor-not-allowed' : '' }}" {{ empty($cart) ? 'disabled' : '' }}>
                            <i data-lucide="send" class="w-5 h-5"></i> Pesan via WhatsApp
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const updateCart = (id, quantity) => {
            fetch('{{ route('cart.update') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ id: id, quantity: quantity })
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    window.location.reload();
                }
            });
        };

        document.querySelectorAll('.update-cart').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const action = this.getAttribute('data-action');
                const input = this.parentElement.querySelector('input');
                let quantity = parseInt(input.value);

                if (action === 'increase') {
                    quantity++;
                } else if (action === 'decrease' && quantity > 1) {
                    quantity--;
                }

                input.value = quantity;
                this.disabled = true; // prevent double click
                updateCart(id, quantity);
            });
        });

        document.querySelectorAll('.remove-from-cart').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                
                Swal.fire({
                    title: 'Hapus Produk?',
                    text: "Apakah Anda yakin ingin menghapus produk ini dari keranjang?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch('{{ route('cart.remove') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({ id: id })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if(data.success) {
                                window.location.reload();
                            }
                        });
                    }
                });
            });
        });
    });
</script>
@endpush
@endsection