@extends('layout')

@section('title', 'Wisata Indonesia - Jelajahi Destinasi Wisata Terbaik')

@section('styles')
<style>
    .header {
        background: white;
        padding: 15px 30px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .header h1 {
        color: #667eea;
        font-size: 24px;
        margin: 0;
    }

    .login-btn {
        padding: 8px 16px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 14px;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .login-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }

    .hero {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 100px 0 60px 0;
        text-align: center;
    }

    .hero h1 {
        font-size: 36px;
        margin-bottom: 10px;
        font-weight: 700;
    }

    .hero p {
        font-size: 18px;
        opacity: 0.9;
        max-width: 600px;
        margin: 0 auto;
    }

    .search-section {
        padding: 40px 0;
        background: #f8fafc;
    }

    .search-container {
        max-width: 600px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .search-box {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
    }

    .search-box input {
        flex: 1;
        padding: 15px 20px;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        font-size: 16px;
    }

    .search-box input:focus {
        outline: none;
        border-color: #667eea;
    }

    .filter-buttons {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        justify-content: center;
    }

    .filter-btn {
        padding: 8px 16px;
        border: 2px solid #e2e8f0;
        background: white;
        border-radius: 20px;
        cursor: pointer;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .filter-btn.active,
    .filter-btn:hover {
        background: #667eea;
        color: white;
        border-color: #667eea;
    }

    .wisata-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 30px;
        padding: 40px 20px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .wisata-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .wisata-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
    }

    .wisata-image {
        height: 200px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
        color: white;
    }

    .wisata-content {
        padding: 20px;
    }

    .wisata-title {
        font-size: 20px;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 8px;
        line-height: 1.3;
    }

    .wisata-location {
        color: #718096;
        font-size: 14px;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .wisata-category {
        display: inline-block;
        background: linear-gradient(135deg, #e6fffa 0%, #b2f5ea 100%);
        color: #234e52;
        padding: 4px 12px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 15px;
    }

    .wisata-details {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .wisata-price {
        font-size: 18px;
        font-weight: 700;
        color: #38a169;
    }

    .wisata-rating {
        color: #d69e2e;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 3px;
    }

    .wisata-time {
        color: #3182ce;
        font-size: 13px;
        margin-bottom: 15px;
    }

    .loading {
        text-align: center;
        padding: 60px;
        color: #718096;
        font-size: 16px;
    }

    .no-data {
        text-align: center;
        padding: 60px;
        color: #718096;
    }

    .no-data i {
        font-size: 48px;
        margin-bottom: 20px;
        display: block;
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .header {
            padding: 12px 20px;
        }

        .header h1 {
            font-size: 20px;
        }

        .login-btn {
            padding: 6px 12px;
            font-size: 12px;
        }

        .hero {
            padding: 80px 20px 40px 20px;
        }
        .hero {
            padding: 40px 20px;
        }

        .hero h1 {
            font-size: 28px;
        }

        .hero p {
            font-size: 16px;
        }

        .search-section {
            padding: 30px 0;
        }

        .search-container {
            padding: 0 15px;
        }

        .search-box {
            flex-direction: column;
        }

        .search-box input {
            padding: 16px 20px;
            font-size: 16px; /* Prevent zoom on iOS */
        }

        .filter-buttons {
            gap: 8px;
        }

        .filter-btn {
            padding: 10px 16px;
            font-size: 13px;
        }

        .wisata-grid {
            grid-template-columns: 1fr;
            gap: 20px;
            padding: 20px 15px;
        }

        .wisata-card {
            border-radius: 12px;
        }

        .wisata-image {
            height: 150px;
            font-size: 36px;
        }

        .wisata-content {
            padding: 15px;
        }

        .wisata-title {
            font-size: 18px;
        }

        .wisata-price {
            font-size: 16px;
        }
    }

    @media (max-width: 480px) {
        .hero {
            padding: 30px 15px;
        }

        .hero h1 {
            font-size: 24px;
        }

        .hero p {
            font-size: 14px;
        }

        .wisata-grid {
            padding: 15px 10px;
        }

        .wisata-content {
            padding: 12px;
        }

        .wisata-title {
            font-size: 16px;
        }

        .wisata-location {
            font-size: 13px;
        }

        .wisata-price {
            font-size: 15px;
        }

        .wisata-time {
            font-size: 12px;
        }
    }
</style>
@endsection

@section('content')
<div class="header">
    <h1>🏝️ Wisata Indonesia</h1>
    <a href="/login" class="login-btn">Login Admin</a>
</div>

<div class="hero">
    <h1>🏝️ Wisata Indonesia</h1>
    <p>Jelajahi keindahan destinasi wisata terbaik di Indonesia</p>
</div>

<div class="search-section">
    <div class="search-container">
        <div class="search-box">
            <input type="text" id="searchInput" placeholder="🔍 Cari nama wisata atau lokasi...">
        </div>
        <div class="filter-buttons">
            <button class="filter-btn active" data-category="all">Semua</button>
            <button class="filter-btn" data-category="Pantai">Pantai</button>
            <button class="filter-btn" data-category="Gunung">Gunung</button>
            <button class="filter-btn" data-category="Candi">Candi</button>
            <button class="filter-btn" data-category="Danau">Danau</button>
            <button class="filter-btn" data-category="Lainnya">Lainnya</button>
        </div>
    </div>
</div>

<div id="wisataContainer">
    <div class="loading">Memuat destinasi wisata...</div>
</div>
@endsection

@section('scripts')
<script>
    const API_URL = window.location.origin + '/api';
    let allWisata = [];
    let filteredWisata = [];
    let currentCategory = 'all';

    // Fetch wisata data
    async function fetchWisata() {
        try {
            const response = await fetch(API_URL + '/wisata');
            allWisata = await response.json();
            filteredWisata = [...allWisata];
            renderWisata();
        } catch (error) {
            console.error('Error fetching wisata:', error);
            document.getElementById('wisataContainer').innerHTML = `
                <div class="no-data">
                    <i>🏝️</i>
                    Gagal memuat data. Silakan refresh halaman.
                </div>
            `;
        }
    }

    // Render wisata cards
    function renderWisata() {
        const container = document.getElementById('wisataContainer');

        if (filteredWisata.length === 0) {
            container.innerHTML = `
                <div class="no-data">
                    <i>🏝️</i>
                    Tidak ada destinasi wisata ditemukan.
                </div>
            `;
            return;
        }

        const html = `
            <div class="wisata-grid">
                ${filteredWisata.map(item => `
                    <div class="wisata-card">
                        <div class="wisata-image">
                            ${getCategoryEmoji(item.kategori)}
                        </div>
                        <div class="wisata-content">
                            <h3 class="wisata-title">${item.nama_wisata || '-'}</h3>
                            <div class="wisata-location">
                                📍 ${item.lokasi || '-'}
                            </div>
                            <div class="wisata-category">${item.kategori || 'Lainnya'}</div>
                            <div class="wisata-details">
                                <div class="wisata-price">${item.harga_tiket ? 'Rp ' + formatNumber(item.harga_tiket) : 'Gratis'}</div>
                                <div class="wisata-rating">⭐ ${item.rating || 0}</div>
                            </div>
                            <div class="wisata-time">
                                🕐 ${formatTime(item.jam_buka || '-')} - ${formatTime(item.jam_tutup || '-')}
                            </div>
                        </div>
                    </div>
                `).join('')}
            </div>
        `;

        container.innerHTML = html;
    }

    // Get emoji for category
    function getCategoryEmoji(category) {
        const emojis = {
            'Pantai': '🏖️',
            'Gunung': '🏔️',
            'Candi': '🏛️',
            'Danau': '🏞️',
            'Bahari': '🚢',
            'Taman': '🌳',
            'Museum': '🏛️',
            'Lainnya': '🏝️'
        };
        return emojis[category] || '🏝️';
    }

    // Format number
    function formatNumber(num) {
        const number = typeof num === 'string' ? parseFloat(num) : num;
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    // Format time
    function formatTime(time) {
        if (time === '-' || !time) return '-';
        return time.slice(0, 5);
    }

    // Search functionality
    document.getElementById('searchInput').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        filteredWisata = allWisata.filter(item =>
            (item.nama_wisata || '').toLowerCase().includes(searchTerm) ||
            (item.lokasi || '').toLowerCase().includes(searchTerm)
        );

        if (currentCategory !== 'all') {
            filteredWisata = filteredWisata.filter(item => item.kategori === currentCategory);
        }

        renderWisata();
    });

    // Category filter
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active class from all buttons
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            // Add active class to clicked button
            this.classList.add('active');

            currentCategory = this.dataset.category;

            if (currentCategory === 'all') {
                filteredWisata = [...allWisata];
            } else {
                filteredWisata = allWisata.filter(item => item.kategori === currentCategory);
            }

            // Apply search filter if there's a search term
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            if (searchTerm) {
                filteredWisata = filteredWisata.filter(item =>
                    (item.nama_wisata || '').toLowerCase().includes(searchTerm) ||
                    (item.lokasi || '').toLowerCase().includes(searchTerm)
                );
            }

            renderWisata();
        });
    });

    // Initial load
    fetchWisata();
</script>
@endsection</content>
<parameter name="filePath">c:\laragon\www\wisata\wisata\resources\views\home.blade.php