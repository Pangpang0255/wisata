@extends('layout')

@section('title', 'Dashboard - Aplikasi Wisata')

@section('styles')
<style>
    .dashboard {
        padding: 20px 0;
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
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
        border-color: #667eea;
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
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
        border-color: #667eea;
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
</style>
@endsection

@section('content')
<div class="container dashboard">
    <div class="header">
        <h1>🏝️ Dashboard Wisata Indonesia</h1>
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
            <div class="stat-icon">🏙️</div>
            <div class="stat-info">
                <h3>Total Kota</h3>
                <p id="totalKota">0</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">💰</div>
            <div class="stat-info">
                <h3>Rata-rata Tarif</h3>
                <p id="avgTarif">Rp 0</p>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="actions">
            <div class="search-box">
                <input type="text" id="searchInput" placeholder="🔍 Cari kota atau landmark...">
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
                <label for="kota">Kota *</label>
                <input type="text" id="kota" name="kota" placeholder="Contoh: Bali" required>
            </div>

            <div class="form-group">
                <label for="landmark">Landmark *</label>
                <input type="text" id="landmark" name="landmark" placeholder="Contoh: Pantai Kuta" required>
            </div>

            <div class="form-group">
                <label for="tarif">Tarif (Rp) *</label>
                <input type="number" id="tarif" name="tarif" placeholder="Contoh: 50000" required min="0">
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
<script>
    const API_URL = window.location.origin + '/api';
    let wisataData = [];
    let filteredData = [];

    // Check authentication
    const token = localStorage.getItem('token');
    if (!token) {
        window.location.href = '/';
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
                        <th>Kota</th>
                        <th>Landmark</th>
                        <th>Tarif</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
        `;

        filteredData.forEach((item, index) => {
            html += `
                <tr>
                    <td>${index + 1}</td>
                    <td>${item.kota}</td>
                    <td>${item.landmark}</td>
                    <td class="currency">Rp ${formatNumber(item.tarif)}</td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn btn-warning btn-sm" onclick="editWisata(${item.id_wisata})">Edit</button>
                            <button class="btn btn-danger btn-sm" onclick="deleteWisata(${item.id_wisata}, '${item.landmark}')">Hapus</button>
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
        
        const uniqueCities = new Set(wisataData.map(item => item.kota));
        document.getElementById('totalKota').textContent = uniqueCities.size;

        const avgTarif = wisataData.length > 0 
            ? wisataData.reduce((sum, item) => sum + parseFloat(item.tarif), 0) / wisataData.length 
            : 0;
        document.getElementById('avgTarif').textContent = 'Rp ' + formatNumber(Math.round(avgTarif));
    }

    // Format number
    function formatNumber(num) {
        return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    // Search functionality
    document.getElementById('searchInput').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        filteredData = wisataData.filter(item => 
            item.kota.toLowerCase().includes(searchTerm) ||
            item.landmark.toLowerCase().includes(searchTerm)
        );
        renderTable();
    });

    // Modal functions
    function openModal(id = null) {
        const modal = document.getElementById('wisataModal');
        const form = document.getElementById('wisataForm');
        form.reset();

        if (id) {
            const wisata = wisataData.find(item => item.id_wisata === id);
            if (wisata) {
                document.getElementById('modalTitle').textContent = 'Edit Data Wisata';
                document.getElementById('wisataId').value = wisata.id_wisata;
                document.getElementById('kota').value = wisata.kota;
                document.getElementById('landmark').value = wisata.landmark;
                document.getElementById('tarif').value = wisata.tarif;
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
            kota: document.getElementById('kota').value,
            landmark: document.getElementById('landmark').value,
            tarif: document.getElementById('tarif').value
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
    async function deleteWisata(id, landmark) {
        if (!confirm(`Apakah Anda yakin ingin menghapus "${landmark}"?`)) {
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
        window.location.href = '/';
    }

    // Close modal when clicking outside
    document.getElementById('wisataModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });

    // Initial load
    fetchWisata();
</script>
@endsection
