@extends('layout')

@section('title', 'Dashboard - Aplikasi Wisata')

@section('styles')
<style>
    .dashboard {
        padding: 20px 0;
    }

    .header h1 {
        color: #228B22;
        font-size: 28px;
        margin: 0;
        font-weight: 700;
    }

    .stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: white;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .stat-icon {
        font-size: 40px;
        background: linear-gradient( #00BFFF );
        width: 70px;
        height: 70px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
    }

    .stat-info h3 {
        color: #718096;
        font-size: 14px;
        font-weight: 500;
        margin-bottom: 5px;
    }

    .stat-info p {
        color: #2d3748;
        font-size: 28px;
        font-weight: 700;
    }

    .actions {
        margin-bottom: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .search-box {
        display: flex;
        gap: 10px;
        flex: 1;
        max-width: 400px;
    }

    .search-box input {
        flex: 1;
        padding: 10px 15px;
        border: 2px solid #e2e8f0;
        border-radius: 5px;
        font-size: 14px;
    }

    .search-box input:focus {
        outline: none;
        border-color: #FF7F50;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    thead {
        background: linear-gradient( #228B22);
        color: white;
    }

    th, td {
        padding: 15px;
        text-align: left;
    }

    th {
        font-weight: 600;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    tbody tr {
        border-bottom: 1px solid #e2e8f0;
        transition: background-color 0.3s ease;
    }

    tbody tr:hover {
        background-color: #f7fafc;
    }

    tbody tr:last-child {
        border-bottom: none;
    }

    td {
        color: #2d3748;
    }

    .action-buttons {
        display: flex;
        gap: 5px;
    }

    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1000;
        justify-content: center;
        align-items: center;
    }

    .modal.active {
        display: flex;
    }

    .modal-content {
        background: white;
        border-radius: 10px;
        padding: 30px;
        width: 90%;
        max-width: 500px;
        max-height: 90vh;
        overflow-y: auto;
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #e2e8f0;
    }

    .modal-header h3 {
        color: #2d3748;
        font-size: 22px;
    }

    .close-btn {
        background: none;
        border: none;
        font-size: 24px;
        cursor: pointer;
        color: #718096;
    }

    .close-btn:hover {
        color: #2d3748;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #2d3748;
        font-weight: 500;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        font-size: 14px;
        transition: border-color 0.3s ease;
        font-family: inherit;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #FF7F50;
    }

    .modal-footer {
        display: flex;
        gap: 10px;
        justify-content: flex-end;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 2px solid #e2e8f0;
    }

    .loading {
        text-align: center;
        padding: 40px;
        color: #718096;
    }

    .no-data {
        text-align: center;
        padding: 40px;
        color: #718096;
    }

    .currency {
        color: #48bb78;
        font-weight: 600;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .dashboard {
            padding: 10px 0;
        }

        .header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }

        .header h1 {
            font-size: 24px;
        }

        .stats {
            grid-template-columns: 1fr;
            gap: 15px;
            margin-bottom: 20px;
        }

        .stat-card {
            padding: 20px;
            gap: 15px;
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            font-size: 30px;
        }

        .stat-info h3 {
            font-size: 13px;
        }

        .stat-info p {
            font-size: 24px;
        }

        .actions {
            flex-direction: column;
            gap: 15px;
            align-items: stretch;
        }

        .search-box {
            max-width: none;
        }

        .search-box input {
            padding: 12px 15px;
            font-size: 16px; /* Prevent zoom on iOS */
        }

        .card {
            padding: 20px;
        }

        table {
            font-size: 14px;
            overflow-x: auto;
            display: block;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
            border-radius: 10px;
        }

        th, td {
            padding: 10px 8px;
            min-width: 80px;
        }

        .action-buttons {
            flex-direction: column;
            gap: 5px;
        }

        .action-buttons button {
            padding: 6px 12px;
            font-size: 12px;
        }

        .modal-content {
            width: 95%;
            padding: 20px;
            margin: 10px;
        }

        .modal-header h3 {
            font-size: 18px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            padding: 14px 15px; /* Prevent zoom on iOS */
            font-size: 16px;
        }

        .modal-footer {
            flex-direction: column;
        }

        .modal-footer button {
            width: 100%;
        }
    }

    @media (max-width: 480px) {
        .dashboard {
            padding: 5px 0;
        }

        .header h1 {
            font-size: 20px;
        }

        .stat-card {
            padding: 15px;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            font-size: 24px;
        }

        .stat-info p {
            font-size: 20px;
        }

        table {
            font-size: 12px;
        }

        th, td {
            padding: 8px 6px;
        }

        /* Card layout for very small screens */
        table thead {
            display: none;
        }

        table, table tbody, table tr, table th, table td {
            display: block;
            width: 100%;
        }

        table tr {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            margin-bottom: 20px;
            padding: 15px;
            background: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        table td {
            border: none;
            border-bottom: 1px solid #f7fafc;
            padding: 12px 10px;
            text-align: left;
            position: relative;
            padding-left: 35%;
            word-wrap: break-word;
            hyphens: auto;
            line-height: 1.4;
        }

        table td:before {
            content: attr(data-label) ": ";
            position: absolute;
            left: 10px;
            top: 12px;
            width: 30%;
            font-weight: 600;
            color: #4a5568;
            font-size: 13px;
            line-height: 1.4;
        }

        table td:last-child {
            border-bottom: none;
            padding-bottom: 15px;
        }

        /* Special styling for different content types */
        table td[data-label="Nama Wisata"] {
            font-weight: 600;
            color: #2d3748;
            font-size: 14px;
            word-break: break-word;
            hyphens: auto;
        }

        table td[data-label="Lokasi"] {
            color: #4a5568;
            word-break: break-word;
            hyphens: auto;
        }

        table td[data-label="Kategori"] {
            background: linear-gradient(135deg, #e6fffa 0%, #b2f5ea 100%);
            border-radius: 4px;
            margin: 5px 0;
            padding: 2px 6px;
            display: inline-block;
            font-size: 12px;
            font-weight: 500;
        }

        table td[data-label="Harga Tiket"] {
            font-weight: 600;
            color: #38a169;
            font-size: 14px;
        }

        table td[data-label="Jam Buka"],
        table td[data-label="Jam Tutup"] {
            color: #3182ce;
            font-weight: 500;
        }

        table td[data-label="Rating"] {
            color: #d69e2e;
            font-weight: 600;
        }

        .action-buttons {
            justify-content: flex-start;
            gap: 8px;
            margin-top: 10px;
        }

        .action-buttons button {
            padding: 8px 16px;
            font-size: 13px;
            border-radius: 6px;
            min-width: 70px;
        }

        .card {
            padding: 15px;
        }

        .modal-content {
            width: 98%;
            padding: 15px;
            margin: 5px;
        }
    }
</style>

<style>
.btn {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
    transition: background-color 0.3s ease;
    display: inline-block;
    text-align: center;
    text-decoration: none;
}

.btn-success {
    background-color: #28a745;
    color: white;
}

.btn-success:hover {
    background-color: #218838;
}

.btn-warning {
    background-color: #ffc107;
    color: #212529;
}

.btn-warning:hover {
    background-color: #e0a800;
}

.btn-danger {
    background-color: #dc3545;
    color: white;
}

.btn-danger:hover {
    background-color: #c82333;
}

.btn-sm {
    padding: 5px 10px;
    font-size: 12px;
}

.alert {
    padding: 15px;
    border-radius: 5px;
    margin-bottom: 20px;
}

.alert-error {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    /* Select2 custom styling */
    .select2-container {
        width: 100% !important;
    }

    .select2-container--default .select2-selection--single {
        height: 44px;
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        padding: 0 15px;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #2d3748;
        line-height: 40px;
        font-size: 14px;
    }

    .select2-container--default .select2-selection--single .select2-selection__placeholder {
        color: #a0aec0;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 42px;
        right: 10px;
    }

    .select2-dropdown {
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .select2-container--default .select2-results__option {
        padding: 10px 15px;
        font-size: 14px;
    }

    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: #FF7F50;
        color: white;
    }
</style>
@endsection

@section('content')
<div class="container dashboard">
    <div class="header">
        <h1>🏝️ Dashboard Admin - Wisata Indonesia</h1>
        <div>
            <span id="userEmail" style="margin-right: 15px; color: #718096;"></span>
            <button class="btn btn-danger" onclick="logout()">Logout</button>
        </div>
    </div>

    <div class="stats">
        <div class="stat-card">
            <div class="stat-icon">📍</div>
            <div class="stat-info">
                <h3>Total Destinasi</h3>
                <p id="totalWisata">0</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">⭐</div>
            <div class="stat-info">
                <h3>Rating Rata-rata</h3>
                <p id="avgRating">0</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">💰</div>
            <div class="stat-info">
                <h3>Rata-rata Tiket</h3>
                <p id="avgTarif">Rp 0</p>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="actions">
            <div class="search-box">
                <input type="text" id="searchInput" placeholder="🔍 Cari nama wisata atau lokasi...">
            </div>
            <button class="btn btn-success" onclick="openModal()">+ Tambah Wisata</button>
        </div>

        <div id="tableContainer">
            <div class="loading">Memuat data...</div>
        </div>
    </div>
</div>

<!-- Modal Form -->
<div id="wisataModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 id="modalTitle">Tambah Data Wisata</h3>
            <button class="close-btn" onclick="closeModal()">&times;</button>
        </div>
        
        <form id="wisataForm">
            <input type="hidden" id="wisataId">
            
            <div class="form-group">
                <label for="nama_wisata">Nama Wisata *</label>
                <input type="text" id="nama_wisata" name="nama_wisata" placeholder="Contoh: Pantai Kuta" required>
            </div>

            <div class="form-group">
                <label for="lokasi">Lokasi *</label>
                <input type="text" id="lokasi" name="lokasi" placeholder="Contoh: Kuta, Bali" required>
            </div>

            <div class="form-group">
                <label for="kategori">Kategori</label>
                <select id="kategori" name="kategori">
                    <option value="">Pilih Kategori</option>
                    <option value="Pantai">Pantai</option>
                    <option value="Gunung">Gunung</option>
                    <option value="Candi">Candi</option>
                    <option value="Danau">Danau</option>
                    <option value="Bahari">Bahari</option>
                    <option value="Taman">Taman</option>
                    <option value="Museum">Museum</option>
                    <option value="Air Terjun">Air Terjun</option>
                    <option value="Goa">Goa</option>
                    <option value="Pulau">Pulau</option>
                    <option value="Hutan">Hutan</option>
                    <option value="Desa Wisata">Desa Wisata</option>
                    <option value="Kebun">Kebun</option>
                    <option value="Taman Nasional">Taman Nasional</option>
                    <option value="Monumen">Monumen</option>
                    <option value="Istana">Istana</option>
                    <option value="Kuil">Kuil</option>
                    <option value="Masjid">Masjid</option>
                    <option value="Gereja">Gereja</option>
                    <option value="Vihara">Vihara</option>
                    <option value="Pantai">Pantai</option>
                    <option value="Resort">Resort</option>
                    <option value="Spa">Spa</option>
                    <option value="Kuliner">Kuliner</option>
                    <option value="Belanja">Belanja</option>
                    <option value="Hiburan">Hiburan</option>
                    <option value="Olahraga">Olahraga</option>
                    <option value="Petualangan">Petualangan</option>
                    <option value="Edukasi">Edukasi</option>
                    <option value="Religi">Religi</option>
                    <option value="Sejarah">Sejarah</option>
                    <option value="Budaya">Budaya</option>
                    <option value="Alam">Alam</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" rows="3" placeholder="Deskripsi tempat wisata..."></textarea>
            </div>

            <div class="form-group">
                <label for="harga_tiket">Harga Tiket (Rp)</label>
                <input type="number" id="harga_tiket" name="harga_tiket" placeholder="Contoh: 50000" min="0" value="0">
            </div>

            <div class="form-group">
                <label for="jam_buka">Jam Buka</label>
                <input type="time" id="jam_buka" name="jam_buka">
            </div>

            <div class="form-group">
                <label for="jam_tutup">Jam Tutup</label>
                <input type="time" id="jam_tutup" name="jam_tutup">
            </div>

            <div class="form-group">
                <label for="rating">Rating (0-5)</label>
                <input type="number" id="rating" name="rating" min="0" max="5" step="0.1" value="0">
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick="closeModal()">Batal</button>
                <button type="submit" class="btn btn-success" id="submitBtn">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    const API_URL = window.location.origin + '/api';
    let wisataData = [];
    let filteredData = [];

    // Check authentication
    const token = localStorage.getItem('token');
    if (!token) {
        window.location.href = '/login';
    }

    // Display user email
    const user = JSON.parse(localStorage.getItem('user') || '{}');
    document.getElementById('userEmail').textContent = user.email || 'User';

    // Fetch wisata data
    async function fetchWisata() {
        try {
            const response = await fetch(API_URL + '/wisata', {
                headers: {
                    'Authorization': 'Bearer ' + token
                }
            });

            if (response.status === 401) {
                alert('Sesi Anda telah berakhir. Silakan login kembali.');
                logout();
                return;
            }

            wisataData = await response.json();
            filteredData = [...wisataData];
            renderTable();
            updateStats();
        } catch (error) {
            console.error('Error fetching wisata:', error);
            document.getElementById('tableContainer').innerHTML = `
                <div class="alert alert-error">
                    Gagal memuat data. Silakan refresh halaman.
                </div>
            `;
        }
    }

    // Render table
    function renderTable() {
        const container = document.getElementById('tableContainer');
        
        if (filteredData.length === 0) {
            container.innerHTML = '<div class="no-data">Tidak ada data wisata.</div>';
            return;
        }

        let html = `
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Wisata</th>
                        <th>Lokasi</th>
                        <th>Kategori</th>
                        <th>Harga Tiket</th>
                        <th>Jam Buka</th>
                        <th>Jam Tutup</th>
                        <th>Rating</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
        `;

        filteredData.forEach((item, index) => {
            html += `
                <tr>
                    <td data-label="No">${index + 1}</td>
                    <td data-label="Nama Wisata">${item.nama_wisata || '-'}</td>
                    <td data-label="Lokasi">${item.lokasi || '-'}</td>
                    <td data-label="Kategori">${item.kategori || '-'}</td>
                    <td data-label="Harga Tiket" class="currency">${item.harga_tiket ? 'Rp ' + formatNumber(item.harga_tiket) : '-'}</td>
                    <td data-label="Jam Buka">🕐 ${formatTime(item.jam_buka || '-')}</td>
                    <td data-label="Jam Tutup">🕐 ${formatTime(item.jam_tutup || '-')}</td>
                    <td data-label="Rating">⭐ ${item.rating || 0}</td>
                    <td data-label="Aksi">
                        <div class="action-buttons">
                            <button class="btn btn-warning btn-sm" onclick="editWisata(${item.id})">Edit</button>
                            <button class="btn btn-danger btn-sm" onclick="deleteWisata(${item.id}, '${item.nama_wisata}')">Hapus</button>
                        </div>
                    </td>
                </tr>
            `;
        });

        html += `
                </tbody>
            </table>
        `;

        container.innerHTML = html;
    }

    // Update statistics
    function updateStats() {
        document.getElementById('totalWisata').textContent = wisataData.length;
        
        const avgRating = wisataData.length > 0 
            ? (wisataData.reduce((sum, item) => sum + parseFloat(item.rating || 0), 0) / wisataData.length).toFixed(1)
            : 0;
        document.getElementById('avgRating').textContent = '⭐ ' + avgRating;

        const avgTarif = wisataData.length > 0 
            ? wisataData.reduce((sum, item) => sum + parseFloat(item.harga_tiket || 0), 0) / wisataData.length 
            : 0;
        document.getElementById('avgTarif').textContent = 'Rp ' + formatNumber(Math.round(avgTarif));
    }

    // Format number
    function formatNumber(num) {
        const number = typeof num === 'string' ? parseFloat(num) : num;
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    // Format time to show only hours and minutes
    function formatTime(time) {
        if (time === '-' || !time) return '-';
        return time.slice(0, 5); // Assumes format HH:MM:SS
    }

    // Search functionality
    document.getElementById('searchInput').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        filteredData = wisataData.filter(item => 
            (item.nama_wisata || '').toLowerCase().includes(searchTerm) ||
            (item.lokasi || '').toLowerCase().includes(searchTerm) ||
            (item.kategori || '').toLowerCase().includes(searchTerm)
        );
        renderTable();
    });

    // Modal functions
    function openModal(id = null) {
        const modal = document.getElementById('wisataModal');
        const form = document.getElementById('wisataForm');
        form.reset();

        // Reset Select2
        $('#kategori').val(null).trigger('change');

        if (id) {
            const wisata = wisataData.find(item => item.id === id);
            if (wisata) {
                document.getElementById('modalTitle').textContent = 'Edit Data Wisata';
                document.getElementById('wisataId').value = wisata.id;
                document.getElementById('nama_wisata').value = wisata.nama_wisata || '';
                document.getElementById('lokasi').value = wisata.lokasi || '';
                $('#kategori').val(wisata.kategori || '').trigger('change');
                document.getElementById('deskripsi').value = wisata.deskripsi || '';
                document.getElementById('harga_tiket').value = wisata.harga_tiket || 0;
                document.getElementById('jam_buka').value = wisata.jam_buka || '';
                document.getElementById('jam_tutup').value = wisata.jam_tutup || '';
                document.getElementById('rating').value = wisata.rating || 0;
            }
        } else {
            document.getElementById('modalTitle').textContent = 'Tambah Data Wisata';
            document.getElementById('wisataId').value = '';
        }

        modal.classList.add('active');
    }

    function closeModal() {
        document.getElementById('wisataModal').classList.remove('active');
    }

    // Form submission
    document.getElementById('wisataForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const id = document.getElementById('wisataId').value;
        const data = {
            nama_wisata: document.getElementById('nama_wisata').value,
            lokasi: document.getElementById('lokasi').value,
            kategori: $('#kategori').val(),
            deskripsi: document.getElementById('deskripsi').value,
            harga_tiket: document.getElementById('harga_tiket').value || 0,
            jam_buka: document.getElementById('jam_buka').value,
            jam_tutup: document.getElementById('jam_tutup').value,
            rating: document.getElementById('rating').value || 0
        };

        const submitBtn = document.getElementById('submitBtn');
        submitBtn.disabled = true;
        submitBtn.textContent = 'Menyimpan...';

        try {
            const url = id ? `${API_URL}/wisata/${id}` : `${API_URL}/wisata`;
            const method = id ? 'PUT' : 'POST';

            const response = await fetch(url, {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer ' + token
                },
                body: JSON.stringify(data)
            });

            if (response.ok) {
                closeModal();
                fetchWisata();
                alert(id ? 'Data berhasil diupdate!' : 'Data berhasil ditambahkan!');
            } else {
                throw new Error('Gagal menyimpan data');
            }
        } catch (error) {
            alert('Error: ' + error.message);
        } finally {
            submitBtn.disabled = false;
            submitBtn.textContent = 'Simpan';
        }
    });

    // Edit wisata
    function editWisata(id) {
        openModal(id);
    }

    // Delete wisata
    async function deleteWisata(id, nama_wisata) {
        if (!confirm(`Apakah Anda yakin ingin menghapus "${nama_wisata}"?`)) {
            return;
        }

        try {
            const response = await fetch(`${API_URL}/wisata/${id}`, {
                method: 'DELETE',
                headers: {
                    'Authorization': 'Bearer ' + token
                }
            });

            if (response.ok) {
                fetchWisata();
                alert('Data berhasil dihapus!');
            } else {
                throw new Error('Gagal menghapus data');
            }
        } catch (error) {
            alert('Error: ' + error.message);
        }
    }

    // Logout
    function logout() {
        localStorage.removeItem('token');
        localStorage.removeItem('user');
        window.location.href = '/login';
    }

    // Close modal when clicking outside
    document.getElementById('wisataModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });

    // Initial load
    fetchWisata();

    // Initialize Select2 for kategori
    $('#kategori').select2({
        placeholder: 'Pilih atau ketik kategori baru',
        allowClear: true,
        tags: true,
        tokenSeparators: [',', ' '],
        createTag: function (params) {
            var term = $.trim(params.term);
            if (term === '') {
                return null;
            }
            return {
                id: term,
                text: term,
                newTag: true
            };
        }
    });
</script>
@endsection
