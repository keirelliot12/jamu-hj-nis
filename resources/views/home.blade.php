@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="relative bg-primary text-white overflow-hidden">
    <div class="absolute inset-0 z-0 opacity-20">
        <img src="https://images.unsplash.com/photo-1596462502278-27bfdc403348?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80" alt="Jamu Background" class="w-full h-full object-cover">
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 py-24 lg:py-32">
        <div class="text-center md:text-left md:w-2/3 lg:w-1/2">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">Warisan Leluhur untuk Kesehatan Keluarga</h1>
            <p class="text-lg md:text-xl text-green-100 mb-8">Jamu Herbal Hj. Nis diracik dari 100% bahan alami pilihan, tanpa pengawet, untuk menjaga vitalitas dan kesehatan Anda setiap hari.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                <a href="{{ route('products') }}" class="bg-white text-primary font-bold py-3 px-8 rounded-full shadow-lg hover:bg-green-50 transition transform hover:-translate-y-1 text-center">Lihat Produk</a>
                <a href="#about" class="bg-transparent border-2 border-white text-white font-bold py-3 px-8 rounded-full hover:bg-white hover:text-primary transition text-center">Tentang Kami</a>
            </div>
        </div>
    </div>
</section>

<!-- Features -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
            <div class="p-6 rounded-2xl bg-tertiary shadow-sm">
                <div class="w-16 h-16 mx-auto bg-primary text-white rounded-full flex items-center justify-center mb-4">
                    <i data-lucide="leaf" class="w-8 h-8"></i>
                </div>
                <h3 class="text-xl font-bold mb-2">100% Alami</h3>
                <p class="text-gray-600">Terbuat dari rempah pilihan tanpa bahan kimia dan pengawet buatan.</p>
            </div>
            <div class="p-6 rounded-2xl bg-tertiary shadow-sm">
                <div class="w-16 h-16 mx-auto bg-secondary text-white rounded-full flex items-center justify-center mb-4">
                    <i data-lucide="shield-check" class="w-8 h-8"></i>
                </div>
                <h3 class="text-xl font-bold mb-2">Higienis</h3>
                <p class="text-gray-600">Diproses dengan standar kebersihan tinggi untuk menjamin kualitas.</p>
            </div>
            <div class="p-6 rounded-2xl bg-tertiary shadow-sm">
                <div class="w-16 h-16 mx-auto bg-primary text-white rounded-full flex items-center justify-center mb-4">
                    <i data-lucide="heart" class="w-8 h-8"></i>
                </div>
                <h3 class="text-xl font-bold mb-2">Resep Turun Temurun</h3>
                <p class="text-gray-600">Warisan resep keluarga yang telah terbukti khasiatnya selama puluhan tahun.</p>
            </div>
        </div>
    </div>
</section>

<!-- Featured Products -->
<section class="py-16 bg-tertiary">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-primary mb-4">Produk Unggulan Kami</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Pilihan jamu dan herbal terlaris yang paling banyak dicari oleh pelanggan setia kami.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse($featuredProducts as $product)
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
                <p class="text-gray-500">Belum ada produk unggulan.</p>
            </div>
            @endforelse
        </div>
        
        <div class="text-center mt-12">
            <a href="{{ route('products') }}" class="inline-flex items-center gap-2 text-primary font-bold hover:text-green-800 transition">
                Lihat Semua Produk <i data-lucide="arrow-right" class="w-5 h-5"></i>
            </a>
        </div>
    </div>
</section>

<!-- About Section -->
<section id="about" class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row items-center gap-12">
            <div class="md:w-1/2">
                <img src="https://images.unsplash.com/photo-1608681291122-15494d13b41e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Tentang Jamu Hj. Nis" class="rounded-2xl shadow-lg w-full h-auto object-cover">
            </div>
            <div class="md:w-1/2">
                <h2 class="text-3xl md:text-4xl font-bold text-primary mb-6">Cerita di Balik Jamu Hj. Nis</h2>
                <p class="text-gray-600 mb-4 leading-relaxed">Berawal dari kecintaan pada pengobatan tradisional Nusantara, Jamu Herbal Hj. Nis didirikan untuk melestarikan warisan leluhur yang kaya akan manfaat.</p>
                <p class="text-gray-600 mb-6 leading-relaxed">Kami percaya bahwa alam telah menyediakan segala yang dibutuhkan untuk menjaga kesehatan tubuh. Oleh karena itu, setiap tetes jamu dan kapsul herbal kami diracik dengan penuh dedikasi, menggunakan 100% bahan alami pilihan tanpa campuran bahan kimia sintetis.</p>
                <ul class="space-y-3 mb-8">
                    <li class="flex items-center gap-3 text-gray-700">
                        <i data-lucide="check-circle-2" class="w-6 h-6 text-secondary"></i> Bahan baku segar dari petani lokal
                    </li>
                    <li class="flex items-center gap-3 text-gray-700">
                        <i data-lucide="check-circle-2" class="w-6 h-6 text-secondary"></i> Proses produksi higienis dan modern
                    </li>
                    <li class="flex items-center gap-3 text-gray-700">
                        <i data-lucide="check-circle-2" class="w-6 h-6 text-secondary"></i> Aman dikonsumsi jangka panjang
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-secondary text-white text-center">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl md:text-4xl font-bold mb-6">Mulai Hidup Sehat dengan Cara Alami</h2>
        <p class="text-lg text-orange-100 mb-8">Konsultasikan kebutuhan kesehatan Anda atau langsung pesan produk herbal kami melalui WhatsApp.</p>
        <a href="https://wa.me/6281332875057" class="inline-flex items-center gap-2 bg-white text-secondary font-bold py-3 px-8 rounded-full shadow-lg hover:bg-gray-100 transition transform hover:-translate-y-1">
            <i data-lucide="message-circle" class="w-6 h-6"></i> Hubungi via WhatsApp
        </a>
    </div>
</section>
@endsection