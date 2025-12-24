<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Wisata Indonesia</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            color: white;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .header p {
            font-size: 1.2em;
            opacity: 0.9;
        }

        .filter-section {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
            margin-bottom: 30px;
        }

        .filter-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 15px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-weight: 600;
            margin-bottom: 5px;
            color: #333;
            font-size: 0.9em;
        }

        .form-group input,
        .form-group select {
            padding: 10px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #667eea;
        }

        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }

        .btn {
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary {
            background: #f5f5f5;
            color: #333;
        }

        .btn-secondary:hover {
            background: #e0e0e0;
        }

        .stats {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            color: white;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 2em;
            font-weight: bold;
        }

        .stat-label {
            font-size: 0.9em;
            opacity: 0.9;
        }

        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        .card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.25);
        }

        .card-image {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 3em;
        }

        .card-body {
            padding: 20px;
        }

        .card-title {
            font-size: 1.3em;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .card-info {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 15px;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9em;
            color: #666;
        }

        .badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85em;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .badge-primary {
            background: #e3f2fd;
            color: #1976d2;
        }

        .badge-success {
            background: #e8f5e9;
            color: #388e3c;
        }

        .badge-warning {
            background: #fff3e0;
            color: #f57c00;
        }

        .card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 15px;
            border-top: 1px solid #f0f0f0;
        }

        .price {
            font-size: 1.2em;
            font-weight: bold;
            color: #667eea;
        }

        .rating {
            display: flex;
            align-items: center;
            gap: 5px;
            font-weight: bold;
            color: #ffc107;
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 30px;
        }

        .pagination button {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            background: white;
            color: #667eea;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .pagination button:hover:not(:disabled) {
            background: #667eea;
            color: white;
        }

        .pagination button:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .pagination .active {
            background: #667eea;
            color: white;
        }

        .no-data {
            text-align: center;
            padding: 60px 20px;
            color: white;
            font-size: 1.2em;
        }

        .loading {
            text-align: center;
            padding: 60px 20px;
            color: white;
            font-size: 1.2em;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.7);
            z-index: 1000;
            padding: 20px;
            overflow-y: auto;
        }

        .modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: white;
            border-radius: 15px;
            max-width: 600px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
        }

        .modal-header {
            padding: 25px;
            border-bottom: 1px solid #f0f0f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h2 {
            color: #333;
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 1.5em;
            cursor: pointer;
            color: #999;
        }

        .close-btn:hover {
            color: #333;
        }

        .modal-body {
            padding: 25px;
        }

        .detail-image {
            width: 100%;
            height: 250px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 4em;
            margin-bottom: 20px;
        }

        .detail-info {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .detail-row {
            display: flex;
            gap: 10px;
        }

        .detail-label {
            font-weight: 600;
            color: #666;
            min-width: 120px;
        }

        .detail-value {
            color: #333;
        }

        @media (max-width: 768px) {
            .header h1 {
                font-size: 1.8em;
            }

            .filter-grid {
                grid-template-columns: 1fr;
            }

            .cards-grid {
                grid-template-columns: 1fr;
            }

            .stats {
                flex-direction: column;
                gap: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🏝️ Katalog Wisata Indonesia</h1>
            <p>Temukan destinasi wisata terbaik untuk liburan Anda</p>
            <div id="userInfo" style="margin-top: 15px; display: none;">
                <span style="background: rgba(255,255,255,0.2); padding: 8px 15px; border-radius: 20px; font-size: 14px;">
                    👤 <span id="userName"></span>
                    <button onclick="logout()" style="margin-left: 10px; background: rgba(255,255,255,0.3); border: none; padding: 5px 12px; border-radius: 15px; cursor: pointer; color: white;">
                        Logout
                    </button>
                </span>
            </div>
            <div id="loginBtn" style="margin-top: 15px; display: none;">
                <a href="/login" style="background: rgba(255,255,255,0.2); padding: 8px 20px; border-radius: 20px; text-decoration: none; color: white; font-size: 14px;">
                    🔐 Login
                </a>
            </div>
        </div>

        <div class="filter-section">
            <div class="filter-grid">
                <div class="form-group">
                    <label>🔍 Cari Nama Wisata</label>
                    <input type="text" id="searchName" placeholder="Contoh: Borobudur">
                </div>
                <div class="form-group">
                    <label>📍 Lokasi</label>
                    <input type="text" id="searchLocation" placeholder="Contoh: Yogyakarta">
                </div>
                <div class="form-group">
                    <label>🏷️ Kategori</label>
                    <select id="filterCategory">
                        <option value="">Semua Kategori</option>
                        <option value="Sejarah">Sejarah</option>
                        <option value="Alam">Alam</option>
                        <option value="Budaya">Budaya</option>
                        <option value="Pantai">Pantai</option>
                        <option value="Candi">Candi</option>
                        <option value="Gunung">Gunung</option>
                        <option value="Danau">Danau</option>
                        <option value="Bahari">Bahari</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>💰 Harga Maksimal</label>
                    <input type="number" id="maxPrice" placeholder="Contoh: 50000">
                </div>
                <div class="form-group">
                    <label>⭐ Rating Minimal</label>
                    <select id="minRating">
                        <option value="">Semua Rating</option>
                        <option value="3">3+ Bintang</option>
                        <option value="4">4+ Bintang</option>
                        <option value="4.5">4.5+ Bintang</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>📊 Urutkan Berdasarkan</label>
                    <select id="sortBy">
                        <option value="rating:desc">Rating Tertinggi</option>
                        <option value="harga_tiket:asc">Harga Termurah</option>
                        <option value="harga_tiket:desc">Harga Termahal</option>
                        <option value="nama_wisata:asc">Nama A-Z</option>
                        <option value="nama_wisata:desc">Nama Z-A</option>
                    </select>
                </div>
            </div>
            <div class="button-group">
                <button class="btn btn-primary" onclick="applyFilters()">🔍 Cari Wisata</button>
                <button class="btn btn-secondary" onclick="resetFilters()">🔄 Reset Filter</button>
            </div>
        </div>

        <div class="stats">
            <div class="stat-item">
                <div class="stat-number" id="totalWisata">0</div>
                <div class="stat-label">Total Wisata</div>
            </div>
            <div class="stat-item">
                <div class="stat-number" id="avgPrice">Rp 0</div>
                <div class="stat-label">Rata-rata Harga</div>
            </div>
            <div class="stat-item">
                <div class="stat-number" id="avgRating">0.0</div>
                <div class="stat-label">Rating Rata-rata</div>
            </div>
        </div>

        <div id="cardsContainer" class="cards-grid"></div>

        <div id="pagination" class="pagination"></div>
    </div>

    <!-- Modal Detail -->
    <div id="detailModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalTitle">Detail Wisata</h2>
                <button class="close-btn" onclick="closeModal()">&times;</button>
            </div>
            <div class="modal-body" id="modalBody"></div>
        </div>
    </div>

    <script>
        const API_URL = window.location.origin + '/api';
        let allData = [];
        let currentPage = 1;
        let totalPages = 1;
        let currentFilters = {};

        // Load data saat halaman dibuka
        document.addEventListener('DOMContentLoaded', () => {
            checkLoginStatus();
            loadWisata();
        });

        function checkLoginStatus() {
            const token = localStorage.getItem('token');
            const user = JSON.parse(localStorage.getItem('user') || '{}');
            
            if (token && user.email) {
                document.getElementById('userInfo').style.display = 'block';
                document.getElementById('userName').textContent = user.name || user.email;
            } else {
                document.getElementById('loginBtn').style.display = 'block';
            }
        }

        function logout() {
            localStorage.removeItem('token');
            localStorage.removeItem('user');
            window.location.href = '/login';
        }

        async function loadWisata() {
            const container = document.getElementById('cardsContainer');
            container.innerHTML = '<div class="loading">⏳ Memuat data wisata...</div>';

            try {
                const params = new URLSearchParams({
                    page: currentPage,
                    per_page: 9,
                    ...currentFilters
                });

                const response = await fetch(`${API_URL}/wisata?${params}`);
                const result = await response.json();

                if (result.data) {
                    allData = result.data;
                    totalPages = result.last_page;
                    renderCards();
                    renderPagination();
                    updateStats(result);
                } else {
                    container.innerHTML = '<div class="no-data">❌ Gagal memuat data</div>';
                }
            } catch (error) {
                console.error('Error:', error);
                container.innerHTML = '<div class="no-data">❌ Terjadi kesalahan saat memuat data</div>';
            }
        }

        function renderCards() {
            const container = document.getElementById('cardsContainer');
            
            if (allData.length === 0) {
                container.innerHTML = '<div class="no-data">😢 Tidak ada wisata yang sesuai dengan filter</div>';
                return;
            }

            let html = '';
            allData.forEach(item => {
                const price = item.harga_tiket == 0 ? 'Gratis' : `Rp ${formatNumber(item.harga_tiket)}`;
                const icon = getCategoryIcon(item.kategori);
                
                html += `
                    <div class="card" onclick="showDetail(${item.id})">
                        <div class="card-image">${icon}</div>
                        <div class="card-body">
                            <span class="badge badge-primary">${item.kategori}</span>
                            <div class="card-title">${item.nama_wisata}</div>
                            <div class="card-info">
                                <div class="info-item">📍 ${item.lokasi}</div>
                                <div class="info-item">🕐 ${item.jam_buka} - ${item.jam_tutup}</div>
                            </div>
                            <div class="card-footer">
                                <div class="price">${price}</div>
                                <div class="rating">⭐ ${item.rating}</div>
                            </div>
                        </div>
                    </div>
                `;
            });

            container.innerHTML = html;
        }

        function renderPagination() {
            const container = document.getElementById('pagination');
            
            if (totalPages <= 1) {
                container.innerHTML = '';
                return;
            }

            let html = `
                <button onclick="changePage(${currentPage - 1})" ${currentPage === 1 ? 'disabled' : ''}>
                    ← Sebelumnya
                </button>
            `;

            for (let i = 1; i <= totalPages; i++) {
                if (i === 1 || i === totalPages || (i >= currentPage - 1 && i <= currentPage + 1)) {
                    html += `
                        <button class="${i === currentPage ? 'active' : ''}" onclick="changePage(${i})">
                            ${i}
                        </button>
                    `;
                } else if (i === currentPage - 2 || i === currentPage + 2) {
                    html += '<span style="color: white;">...</span>';
                }
            }

            html += `
                <button onclick="changePage(${currentPage + 1})" ${currentPage === totalPages ? 'disabled' : ''}>
                    Selanjutnya →
                </button>
            `;

            container.innerHTML = html;
        }

        function changePage(page) {
            if (page < 1 || page > totalPages) return;
            currentPage = page;
            loadWisata();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function applyFilters() {
            currentFilters = {};
            currentPage = 1;

            const name = document.getElementById('searchName').value.trim();
            const location = document.getElementById('searchLocation').value.trim();
            const category = document.getElementById('filterCategory').value;
            const maxPrice = document.getElementById('maxPrice').value;
            const minRating = document.getElementById('minRating').value;
            const sortBy = document.getElementById('sortBy').value;

            if (name) currentFilters.nama_wisata = name;
            if (location) currentFilters.lokasi = location;
            if (category) currentFilters.kategori = category;
            if (maxPrice) currentFilters.harga_max = maxPrice;
            if (minRating) currentFilters.rating_min = minRating;

            if (sortBy) {
                const [field, order] = sortBy.split(':');
                currentFilters.sort_by = field;
                currentFilters.sort_order = order;
            }

            loadWisata();
        }

        function resetFilters() {
            document.getElementById('searchName').value = '';
            document.getElementById('searchLocation').value = '';
            document.getElementById('filterCategory').value = '';
            document.getElementById('maxPrice').value = '';
            document.getElementById('minRating').value = '';
            document.getElementById('sortBy').value = 'rating:desc';
            
            currentFilters = {};
            currentPage = 1;
            loadWisata();
        }

        function updateStats(result) {
            document.getElementById('totalWisata').textContent = result.total || 0;
            
            if (result.data && result.data.length > 0) {
                const avgPrice = result.data.reduce((sum, item) => sum + parseFloat(item.harga_tiket), 0) / result.data.length;
                const avgRating = result.data.reduce((sum, item) => sum + parseFloat(item.rating), 0) / result.data.length;
                
                document.getElementById('avgPrice').textContent = 'Rp ' + formatNumber(Math.round(avgPrice));
                document.getElementById('avgRating').textContent = avgRating.toFixed(1) + ' ⭐';
            }
        }

        async function showDetail(id) {
            try {
                const response = await fetch(`${API_URL}/wisata/${id}`);
                const data = await response.json();
                
                const modal = document.getElementById('detailModal');
                const modalTitle = document.getElementById('modalTitle');
                const modalBody = document.getElementById('modalBody');
                
                modalTitle.textContent = data.nama_wisata;
                
                const icon = getCategoryIcon(data.kategori);
                const price = data.harga_tiket == 0 ? 'Gratis' : `Rp ${formatNumber(data.harga_tiket)}`;
                
                modalBody.innerHTML = `
                    <div class="detail-image">${icon}</div>
                    <div class="detail-info">
                        <div class="detail-row">
                            <div class="detail-label">Kategori:</div>
                            <div class="detail-value"><span class="badge badge-primary">${data.kategori}</span></div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-label">Lokasi:</div>
                            <div class="detail-value">📍 ${data.lokasi}</div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-label">Deskripsi:</div>
                            <div class="detail-value">${data.deskripsi || '-'}</div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-label">Harga Tiket:</div>
                            <div class="detail-value" style="color: #667eea; font-weight: bold;">${price}</div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-label">Jam Operasional:</div>
                            <div class="detail-value">🕐 ${data.jam_buka} - ${data.jam_tutup}</div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-label">Rating:</div>
                            <div class="detail-value" style="color: #ffc107; font-weight: bold;">⭐ ${data.rating} / 5.0</div>
                        </div>
                    </div>
                `;
                
                modal.classList.add('active');
            } catch (error) {
                console.error('Error:', error);
                alert('Gagal memuat detail wisata');
            }
        }

        function closeModal() {
            document.getElementById('detailModal').classList.remove('active');
        }

        function getCategoryIcon(category) {
            const icons = {
                'Sejarah': '🏛️',
                'Alam': '🏞️',
                'Budaya': '🎭',
                'Pantai': '🏖️',
                'Candi': '⛩️',
                'Gunung': '⛰️',
                'Danau': '🌊',
                'Bahari': '🐠'
            };
            return icons[category] || '🏝️';
        }

        function formatNumber(num) {
            return new Intl.NumberFormat('id-ID').format(num);
        }

        // Close modal when clicking outside
        document.getElementById('detailModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
    </script>
</body>
</html>
