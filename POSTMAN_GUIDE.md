# 🚀 Panduan Testing dengan Postman

## 📋 Setup Awal

### Base URL

```
http://127.0.0.1:8000
```

### Headers untuk Semua Request

```
Content-Type: application/json
Accept: application/json
```

---

## 🔐 1. AUTHENTICATION

### A. Login (POST)

**Endpoint:** `POST http://127.0.0.1:8000/api/login`

**Headers:**

```
Content-Type: application/json
```

**Body (raw JSON):**

**Login sebagai Admin:**

```json
{
    "email": "admin@gmail.com",
    "password": "admin"
}
```

**Login sebagai User:**

```json
{
    "email": "user@gmail.com",
    "password": "user123"
}
```

**Response (200 OK):**

```json
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGc...",
    "token_type": "bearer",
    "expires_in": 3600,
    "user": {
        "id": 1,
        "email": "admin@gmail.com",
        "role": "admin",
        "created_at": "2025-12-23T..."
    }
}
```

**🔑 PENTING:** Copy `access_token` untuk digunakan di request selanjutnya!

**Headers Response:**

```
X-RateLimit-Limit: 20
X-RateLimit-Remaining: 19
```

---

### B. Get User Profile (GET)

**Endpoint:** `GET http://127.0.0.1:8000/api/me`

**Headers:**

```
Authorization: Bearer YOUR_TOKEN_HERE
Content-Type: application/json
```

**Response (200 OK):**

```json
{
    "id": 1,
    "email": "admin@gmail.com",
    "role": "admin",
    "created_at": "2025-12-23T..."
}
```

---

### C. Refresh Token (POST)

**Endpoint:** `POST http://127.0.0.1:8000/api/refresh`

**Headers:**

```
Authorization: Bearer YOUR_TOKEN_HERE
Content-Type: application/json
```

**Response (200 OK):**

```json
{
    "access_token": "NEW_TOKEN_HERE",
    "token_type": "bearer",
    "expires_in": 3600
}
```

---

### D. Logout (POST)

**Endpoint:** `POST http://127.0.0.1:8000/api/logout`

**Headers:**

```
Authorization: Bearer YOUR_TOKEN_HERE
Content-Type: application/json
```

**Response (200 OK):**

```json
{
    "message": "Successfully logged out"
}
```

---

## 📊 2. API WISATA (Public - No Auth)

### A. Get All Wisata (GET)

**Endpoint:** `GET http://127.0.0.1:8000/api/wisata`

**Headers:**

```
Content-Type: application/json
```

**Response (200 OK):**

```json
{
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "nama_wisata": "Candi Borobudur",
            "lokasi": "Magelang, Jawa Tengah",
            "kategori": "Sejarah",
            "harga_tiket": "50000.00",
            "jam_buka": "06:00:00",
            "jam_tutup": "17:00:00",
            "rating": "4.90",
            "created_at": "2025-12-23T...",
            "updated_at": "2025-12-23T..."
        }
        // ... 9 more items
    ],
    "first_page_url": "http://127.0.0.1:8000/api/wisata?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://127.0.0.1:8000/api/wisata?page=1",
    "next_page_url": null,
    "path": "http://127.0.0.1:8000/api/wisata",
    "per_page": 10,
    "prev_page_url": null,
    "to": 10,
    "total": 10
}
```

**Headers Response:**

```
X-RateLimit-Limit: 200
X-RateLimit-Remaining: 199
```

---

### B. Get Wisata by ID (GET)

**Endpoint:** `GET http://127.0.0.1:8000/api/wisata/1`

**Response (200 OK):**

```json
{
    "id": 1,
    "nama_wisata": "Candi Borobudur",
    "lokasi": "Magelang, Jawa Tengah",
    "kategori": "Sejarah",
    "harga_tiket": "50000.00",
    "jam_buka": "06:00:00",
    "jam_tutup": "17:00:00",
    "rating": "4.90",
    "created_at": "2025-12-23T...",
    "updated_at": "2025-12-23T..."
}
```

---

## 🔍 3. FILTERING

### A. Filter by Kategori

**Endpoint:** `GET http://127.0.0.1:8000/api/wisata?kategori=Sejarah`

**Response:** Data wisata dengan kategori "Sejarah"

---

### B. Filter by Lokasi (Partial Match)

**Endpoint:** `GET http://127.0.0.1:8000/api/wisata?lokasi=Bali`

**Response:** Data wisata yang lokasinya mengandung "Bali"

---

### C. Filter by Harga (Range)

**Endpoint:** `GET http://127.0.0.1:8000/api/wisata?harga_min=30000&harga_max=100000`

**Response:** Data wisata dengan harga Rp 30.000 - Rp 100.000

---

### D. Filter by Rating

**Endpoint:** `GET http://127.0.0.1:8000/api/wisata?rating_min=4.5`

**Response:** Data wisata dengan rating minimal 4.5

---

### E. Search by Name

**Endpoint:** `GET http://127.0.0.1:8000/api/wisata?nama_wisata=Borobudur`

**Response:** Data wisata yang namanya mengandung "Borobudur"

---

### F. Kombinasi Filter

**Endpoint:** `GET http://127.0.0.1:8000/api/wisata?kategori=Sejarah&rating_min=4.0&harga_max=100000`

**Response:** Data wisata kategori Sejarah, rating ≥ 4.0, harga ≤ Rp 100.000

---

## 📄 4. PAGINATION

### A. Custom Per Page

**Endpoint:** `GET http://127.0.0.1:8000/api/wisata?per_page=5`

**Response:** 5 data per halaman

---

### B. Go to Specific Page

**Endpoint:** `GET http://127.0.0.1:8000/api/wisata?page=2&per_page=5`

**Response:** Data halaman 2 dengan 5 item per halaman

---

## 🔄 5. SORTING

### A. Sort by Rating (Descending)

**Endpoint:** `GET http://127.0.0.1:8000/api/wisata?sort_by=rating&sort_order=desc`

**Response:** Data diurutkan dari rating tertinggi

---

### B. Sort by Harga (Ascending)

**Endpoint:** `GET http://127.0.0.1:8000/api/wisata?sort_by=harga_tiket&sort_order=asc`

**Response:** Data diurutkan dari harga termurah

---

### C. Sort by Name

**Endpoint:** `GET http://127.0.0.1:8000/api/wisata?sort_by=nama_wisata&sort_order=asc`

**Response:** Data diurutkan A-Z

---

### Sortable Columns:

-   `id`
-   `nama_wisata`
-   `lokasi`
-   `kategori`
-   `harga_tiket`
-   `rating`
-   `created_at`

---

## 🎯 6. KOMBINASI SEMUA FITUR

**Endpoint:**

```
GET http://127.0.0.1:8000/api/wisata?kategori=Sejarah&rating_min=4.0&sort_by=rating&sort_order=desc&per_page=3&page=1
```

**Artinya:**

-   Filter kategori = Sejarah
-   Rating minimal 4.0
-   Urutkan berdasarkan rating (tertinggi dulu)
-   Tampilkan 3 data per halaman
-   Halaman 1

---

## 🔒 7. PROTECTED ENDPOINTS (Butuh Auth)

### A. Create Wisata (POST)

**Endpoint:** `POST http://127.0.0.1:8000/api/wisata`

**Headers:**

```
Authorization: Bearer YOUR_TOKEN_HERE
Content-Type: application/json
```

**Body (raw JSON):**

```json
{
    "nama_wisata": "Pantai Kuta",
    "lokasi": "Bali",
    "kategori": "Pantai",
    "harga_tiket": 25000,
    "jam_buka": "08:00:00",
    "jam_tutup": "18:00:00",
    "rating": 4.5
}
```

**Response (201 Created):**

```json
{
    "id": 11,
    "nama_wisata": "Pantai Kuta",
    "lokasi": "Bali",
    "kategori": "Pantai",
    "harga_tiket": "25000.00",
    "jam_buka": "08:00:00",
    "jam_tutup": "18:00:00",
    "rating": "4.50",
    "created_at": "2025-12-23T...",
    "updated_at": "2025-12-23T..."
}
```

---

### B. Update Wisata (PUT)

**Endpoint:** `PUT http://127.0.0.1:8000/api/wisata/11`

**Headers:**

```
Authorization: Bearer YOUR_TOKEN_HERE
Content-Type: application/json
```

**Body (raw JSON):**

```json
{
    "nama_wisata": "Pantai Kuta Sunset",
    "lokasi": "Kuta, Bali",
    "kategori": "Pantai",
    "harga_tiket": 30000,
    "jam_buka": "07:00:00",
    "jam_tutup": "19:00:00",
    "rating": 4.7
}
```

**Response (200 OK):**

```json
{
    "id": 11,
    "nama_wisata": "Pantai Kuta Sunset",
    "lokasi": "Kuta, Bali"
    // ... updated data
}
```

---

### C. Delete Wisata (DELETE)

**Endpoint:** `DELETE http://127.0.0.1:8000/api/wisata/11`

**Headers:**

```
Authorization: Bearer YOUR_TOKEN_HERE
Content-Type: application/json
```

**Response (200 OK):**

```json
{
    "message": "Data wisata berhasil dihapus"
}
```

---

## 🚦 8. TEST THROTTLING

### Test Rate Limit (Login)

Kirim **20+ request login** dalam 1 menit:

**Request ke-21:**
**Response (429 Too Many Requests):**

```json
{
    "message": "Too Many Attempts.",
    "retry_after": 60
}
```

**Headers:**

```
X-RateLimit-Limit: 20
X-RateLimit-Remaining: 0
Retry-After: 60
```

---

### Test Rate Limit (API)

Kirim **200+ request GET /api/wisata** dalam 1 menit:

**Request ke-201:**
**Response (429 Too Many Requests):**

```json
{
    "message": "Too Many Attempts.",
    "retry_after": 60
}
```

---

## 📦 9. IMPORT POSTMAN COLLECTION

Buat file `Wisata_API.postman_collection.json`:

```json
{
    "info": {
        "name": "Wisata API",
        "schema": "https://schema.getpostman.com/json/collection/v2.1.0/collection.json"
    },
    "item": [
        {
            "name": "Auth",
            "item": [
                {
                    "name": "Login Admin",
                    "request": {
                        "method": "POST",
                        "header": [
                            {
                                "key": "Content-Type",
                                "value": "application/json"
                            }
                        ],
                        "body": {
                            "mode": "raw",
                            "raw": "{\n    \"email\": \"admin@gmail.com\",\n    \"password\": \"admin\"\n}"
                        },
                        "url": {
                            "raw": "http://127.0.0.1:8000/api/login",
                            "host": ["127", "0", "0", "1"],
                            "port": "8000",
                            "path": ["api", "login"]
                        }
                    }
                },
                {
                    "name": "Get Profile",
                    "request": {
                        "method": "GET",
                        "header": [
                            {
                                "key": "Authorization",
                                "value": "Bearer {{token}}"
                            }
                        ],
                        "url": {
                            "raw": "http://127.0.0.1:8000/api/me",
                            "host": ["127", "0", "0", "1"],
                            "port": "8000",
                            "path": ["api", "me"]
                        }
                    }
                },
                {
                    "name": "Logout",
                    "request": {
                        "method": "POST",
                        "header": [
                            {
                                "key": "Authorization",
                                "value": "Bearer {{token}}"
                            }
                        ],
                        "url": {
                            "raw": "http://127.0.0.1:8000/api/logout",
                            "host": ["127", "0", "0", "1"],
                            "port": "8000",
                            "path": ["api", "logout"]
                        }
                    }
                }
            ]
        },
        {
            "name": "Wisata",
            "item": [
                {
                    "name": "Get All Wisata",
                    "request": {
                        "method": "GET",
                        "header": [],
                        "url": {
                            "raw": "http://127.0.0.1:8000/api/wisata",
                            "host": ["127", "0", "0", "1"],
                            "port": "8000",
                            "path": ["api", "wisata"]
                        }
                    }
                },
                {
                    "name": "Get Wisata by ID",
                    "request": {
                        "method": "GET",
                        "header": [],
                        "url": {
                            "raw": "http://127.0.0.1:8000/api/wisata/1",
                            "host": ["127", "0", "0", "1"],
                            "port": "8000",
                            "path": ["api", "wisata", "1"]
                        }
                    }
                },
                {
                    "name": "Create Wisata",
                    "request": {
                        "method": "POST",
                        "header": [
                            {
                                "key": "Authorization",
                                "value": "Bearer {{token}}"
                            },
                            {
                                "key": "Content-Type",
                                "value": "application/json"
                            }
                        ],
                        "body": {
                            "mode": "raw",
                            "raw": "{\n    \"nama_wisata\": \"Pantai Kuta\",\n    \"lokasi\": \"Bali\",\n    \"kategori\": \"Pantai\",\n    \"harga_tiket\": 25000,\n    \"jam_buka\": \"08:00:00\",\n    \"jam_tutup\": \"18:00:00\",\n    \"rating\": 4.5\n}"
                        },
                        "url": {
                            "raw": "http://127.0.0.1:8000/api/wisata",
                            "host": ["127", "0", "0", "1"],
                            "port": "8000",
                            "path": ["api", "wisata"]
                        }
                    }
                },
                {
                    "name": "Update Wisata",
                    "request": {
                        "method": "PUT",
                        "header": [
                            {
                                "key": "Authorization",
                                "value": "Bearer {{token}}"
                            },
                            {
                                "key": "Content-Type",
                                "value": "application/json"
                            }
                        ],
                        "body": {
                            "mode": "raw",
                            "raw": "{\n    \"nama_wisata\": \"Pantai Kuta Updated\",\n    \"lokasi\": \"Kuta, Bali\",\n    \"kategori\": \"Pantai\",\n    \"harga_tiket\": 30000,\n    \"jam_buka\": \"07:00:00\",\n    \"jam_tutup\": \"19:00:00\",\n    \"rating\": 4.7\n}"
                        },
                        "url": {
                            "raw": "http://127.0.0.1:8000/api/wisata/11",
                            "host": ["127", "0", "0", "1"],
                            "port": "8000",
                            "path": ["api", "wisata", "11"]
                        }
                    }
                },
                {
                    "name": "Delete Wisata",
                    "request": {
                        "method": "DELETE",
                        "header": [
                            {
                                "key": "Authorization",
                                "value": "Bearer {{token}}"
                            }
                        ],
                        "url": {
                            "raw": "http://127.0.0.1:8000/api/wisata/11",
                            "host": ["127", "0", "0", "1"],
                            "port": "8000",
                            "path": ["api", "wisata", "11"]
                        }
                    }
                }
            ]
        },
        {
            "name": "Filtering & Sorting",
            "item": [
                {
                    "name": "Filter by Kategori",
                    "request": {
                        "method": "GET",
                        "header": [],
                        "url": {
                            "raw": "http://127.0.0.1:8000/api/wisata?kategori=Sejarah",
                            "host": ["127", "0", "0", "1"],
                            "port": "8000",
                            "path": ["api", "wisata"],
                            "query": [
                                {
                                    "key": "kategori",
                                    "value": "Sejarah"
                                }
                            ]
                        }
                    }
                },
                {
                    "name": "Sort by Rating Desc",
                    "request": {
                        "method": "GET",
                        "header": [],
                        "url": {
                            "raw": "http://127.0.0.1:8000/api/wisata?sort_by=rating&sort_order=desc",
                            "host": ["127", "0", "0", "1"],
                            "port": "8000",
                            "path": ["api", "wisata"],
                            "query": [
                                {
                                    "key": "sort_by",
                                    "value": "rating"
                                },
                                {
                                    "key": "sort_order",
                                    "value": "desc"
                                }
                            ]
                        }
                    }
                },
                {
                    "name": "Pagination 5 per page",
                    "request": {
                        "method": "GET",
                        "header": [],
                        "url": {
                            "raw": "http://127.0.0.1:8000/api/wisata?per_page=5&page=1",
                            "host": ["127", "0", "0", "1"],
                            "port": "8000",
                            "path": ["api", "wisata"],
                            "query": [
                                {
                                    "key": "per_page",
                                    "value": "5"
                                },
                                {
                                    "key": "page",
                                    "value": "1"
                                }
                            ]
                        }
                    }
                },
                {
                    "name": "All Features Combined",
                    "request": {
                        "method": "GET",
                        "header": [],
                        "url": {
                            "raw": "http://127.0.0.1:8000/api/wisata?kategori=Sejarah&rating_min=4.0&sort_by=rating&sort_order=desc&per_page=3",
                            "host": ["127", "0", "0", "1"],
                            "port": "8000",
                            "path": ["api", "wisata"],
                            "query": [
                                {
                                    "key": "kategori",
                                    "value": "Sejarah"
                                },
                                {
                                    "key": "rating_min",
                                    "value": "4.0"
                                },
                                {
                                    "key": "sort_by",
                                    "value": "rating"
                                },
                                {
                                    "key": "sort_order",
                                    "value": "desc"
                                },
                                {
                                    "key": "per_page",
                                    "value": "3"
                                }
                            ]
                        }
                    }
                }
            ]
        }
    ],
    "variable": [
        {
            "key": "token",
            "value": "YOUR_TOKEN_HERE",
            "type": "string"
        }
    ]
}
```

---

## 🎯 QUICK START - Langkah demi Langkah

### Step 1: Login

1. Buat request baru: `POST http://127.0.0.1:8000/api/login`
2. Pilih Body → raw → JSON
3. Masukkan:
    ```json
    {
        "email": "admin@gmail.com",
        "password": "admin"
    }
    ```
4. Klik **Send**
5. **Copy token** dari response

### Step 2: Test API Public (No Auth)

1. Buat request: `GET http://127.0.0.1:8000/api/wisata`
2. Klik **Send**
3. Lihat data 10 wisata

### Step 3: Test Filtering

1. Buat request: `GET http://127.0.0.1:8000/api/wisata?kategori=Sejarah&rating_min=4.0`
2. Klik **Send**
3. Lihat hasil filter

### Step 4: Test Protected API (Butuh Auth)

1. Buat request: `POST http://127.0.0.1:8000/api/wisata`
2. Tambahkan Header:
    - Key: `Authorization`
    - Value: `Bearer YOUR_TOKEN_HERE` (paste token dari Step 1)
3. Pilih Body → raw → JSON
4. Masukkan data wisata baru
5. Klik **Send**

### Step 5: Check Rate Limit Headers

Setelah setiap request, lihat **Headers** di response:

```
X-RateLimit-Limit: 200
X-RateLimit-Remaining: 199
```

---

## ⚠️ Common Errors

### 1. Unauthorized (401)

```json
{
    "error": "Unauthorized"
}
```

**Solution:** Pastikan token sudah benar di header `Authorization: Bearer TOKEN`

### 2. Too Many Attempts (429)

```json
{
    "message": "Too Many Attempts.",
    "retry_after": 60
}
```

**Solution:** Tunggu 60 detik, Anda sudah mencapai rate limit

### 3. Validation Error (422)

```json
{
    "nama_wisata": ["The nama wisata field is required."]
}
```

**Solution:** Lengkapi semua field yang required

---

## 💡 Tips Postman

1. **Environment Variable:**

    - Buat variable `{{token}}` di Environment
    - Setelah login, simpan token ke variable ini
    - Gunakan `{{token}}` di semua request yang butuh auth

2. **Collection Runner:**

    - Import collection
    - Klik "Run Collection"
    - Test semua endpoint sekaligus

3. **Pre-request Script (Auto Login):**
    ```javascript
    // Di tab Pre-request Script
    pm.sendRequest(
        {
            url: "http://127.0.0.1:8000/api/login",
            method: "POST",
            header: {
                "Content-Type": "application/json",
            },
            body: {
                mode: "raw",
                raw: JSON.stringify({
                    email: "admin@gmail.com",
                    password: "admin",
                }),
            },
        },
        function (err, res) {
            const token = res.json().access_token;
            pm.environment.set("token", token);
        }
    );
    ```

---

**Selamat Testing! 🎉**
