@extends('layouts.app')

@section('content')
<div class="bg-tertiary py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-primary mb-4">Katalog Produk</h1>
            <p class="text-gray-600 max-w-2xl mx-auto">Temukan berbagai pilihan jamu dan herbal tradisional untuk menjaga kesehatan Anda dan keluarga.</p>
        </div>

        <!-- Filter Categories -->
        <div class="flex flex-wrap justify-center gap-4 mb-12">
            <a href="{{ route('products') }}" class="{{ !request('category') ? 'bg-primary text-white' : 'bg-white text-gray-600 hover:bg-green-50' }} px-6 py-2 rounded-full font-medium shadow-sm transition">
                Semua Produk
            </a>
            @foreach($categories as $category)
            <a href="{{ route('products', ['category' => $category->slug]) }}" class="{{ request('category') == $category->slug ? 'bg-primary text-white' : 'bg-white text-gray-600 hover:bg-green-50' }} px-6 py-2 rounded-full font-medium shadow-sm transition">
                {{ $category->name }}
            </a>
            @endforeach
        </div>

        <!-- Product Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse($products as $product)
            <div class="bg-white rounded-2xl shadow-md overflow-hidden group hover:shadow-xl transition duration-300">
                <div class="relative h-64 overflow-hidden">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    @else
                        <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                            <i data-lucide="image" class="w-12 h-12 text-gray-400"></i>
                        </div>
                    @endif
                    <div class="absolute top-4 right-4 bg-secondary text-white text-xs font-bold px-3 py-1 rounded-full">
                        {{ $product->category->name }}
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-2 text-gray-800">{{ $product->name }}</h3>
                    <p class="text-primary font-bold text-lg mb-4">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    <button data-id="{{ $product->id }}" class="add-to-cart-btn w-full bg-primary text-white font-medium py-2 px-4 rounded-lg hover:bg-green-800 transition flex items-center justify-center gap-2">
                        <i data-lucide="shopping-bag" class="w-5 h-5"></i> Tambah ke Keranjang
                    </button>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <i data-lucide="package-x" class="w-16 h-16 mx-auto text-gray-400 mb-4"></i>
                <p class="text-gray-500 text-lg">Tidak ada produk yang ditemukan dalam kategori ini.</p>
                <a href="{{ route('products') }}" class="text-primary hover:underline mt-2 inline-block">Kembali ke Semua Produk</a>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-12">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection