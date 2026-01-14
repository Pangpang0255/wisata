# 🚀 Panduan Postman - Wisata API

## 📋 Quick Setup

### 1. Pastikan Server Running
```bash
# Di terminal, jalankan:
php -S localhost:8080 -t public
```

---

## 🔐 CARA LOGIN DAN MENDAPATKAN TOKEN

### Step 1: Login Request

**Method:** `POST`  
**URL:** `http://localhost:8080/api/login`  
**Headers:**
```
Content-Type: application/json
```

**Body (raw JSON):**
```json
{
    "email": "admin@admin.com",
    "password": "admin"
}
```

### Step 2: Kirim Request

1. Buka Postman
2. Pilih method **POST**
3. Masukkan URL: `http://localhost:8080/api/login`
4. Klik tab **Headers**, tambahkan:
   - Key: `Content-Type`
   - Value: `application/json`
5. Klik tab **Body**
6. Pilih **raw** dan pilih **JSON** dari dropdown
7. Copy-paste JSON di atas
8. Click **Send**

### Step 3: Response (Token)

Anda akan mendapat response seperti ini:

```json
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwODAvYXBpL2xvZ2luIiwiaWF0IjoxNzM2ODQyMDAwLCJleHAiOjE3MzY4NDU2MDAsIm5iZiI6MTczNjg0MjAwMCwianRpIjoiYWJjZGVmMTIzNDU2IiwidXNlciI6eyJpZCI6MSwiZW1haWwiOiJhZG1pbkBhZG1pbi5jb20ifX0.signature_here",
    "token_type": "bearer",
    "expires_in": 3600
}
```

### Step 4: Copy Token

**COPY** nilai dari `access_token` (text panjang yang dimulai dengan `eyJ...`)

---

## 🎯 CARA MENGGUNAKAN TOKEN

### Method 1: Manual (Setiap Request)

Untuk setiap request yang memerlukan authentication:

1. Klik tab **Headers**
2. Tambahkan header baru:
   - Key: `Authorization`
   - Value: `Bearer YOUR_TOKEN_HERE`

**Contoh:**
```
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...
```

⚠️ **PENTING:** Ada spasi setelah `Bearer`!

---

### Method 2: Postman Variables (RECOMMENDED)

#### Setup Token Variable:

1. Setelah login, klik tab **Tests** di request login
2. Paste script ini:
```javascript
var jsonData = pm.response.json();
pm.environment.set("token", jsonData.access_token);
```

3. Klik **Send** lagi untuk login
4. Token otomatis tersimpan di environment variable!

#### Gunakan Token di Request Lain:

1. Buat request baru (misal GET wisata)
2. Klik tab **Headers**
3. Tambahkan:
   - Key: `Authorization`
   - Value: `Bearer {{token}}`

Token akan otomatis diambil dari variable!

---

## 📝 CONTOH REQUEST DENGAN TOKEN

### 1. Get User Profile

**Method:** `POST`  
**URL:** `http://localhost:8080/api/user-profile`  
**Headers:**
```
Authorization: Bearer {{token}}
Content-Type: application/json
```

### 2. Create Wisata (Admin Only)

**Method:** `POST`  
**URL:** `http://localhost:8080/api/wisata`  
**Headers:**
```
Authorization: Bearer {{token}}
Content-Type: application/json
```
**Body:**
```json
{
    "nama_wisata": "Pantai Indah",
    "deskripsi": "Pantai dengan pasir putih",
    "lokasi": "Bali",
    "harga_tiket": 25000,
    "rating": 4.5
}
```

### 3. Update Wisata

**Method:** `PUT`  
**URL:** `http://localhost:8080/api/wisata/1`  
**Headers:**
```
Authorization: Bearer {{token}}
Content-Type: application/json
```
**Body:**
```json
{
    "nama_wisata": "Pantai Indah Updated",
    "deskripsi": "Pantai dengan pasir putih dan air jernih",
    "lokasi": "Bali",
    "harga_tiket": 30000,
    "rating": 4.8
}
```

### 4. Delete Wisata

**Method:** `DELETE`  
**URL:** `http://localhost:8080/api/wisata/1`  
**Headers:**
```
Authorization: Bearer {{token}}
```

---

## 🔄 REFRESH TOKEN

Jika token expired (setelah 1 jam):

**Method:** `POST`  
**URL:** `http://localhost:8080/api/refresh`  
**Headers:**
```
Authorization: Bearer {{token}}
Content-Type: application/json
```

Response akan memberikan token baru.

---

## 🚪 LOGOUT

**Method:** `POST`  
**URL:** `http://localhost:8080/api/logout`  
**Headers:**
```
Authorization: Bearer {{token}}
Content-Type: application/json
```

---

## 📦 ENDPOINT TANPA TOKEN (Public)

Endpoint ini bisa diakses tanpa login:

### 1. Get All Wisata
**Method:** `GET`  
**URL:** `http://localhost:8080/api/wisata`

### 2. Get Single Wisata
**Method:** `GET`  
**URL:** `http://localhost:8080/api/wisata/1`

---

## 🎨 POSTMAN COLLECTION

Saya sudah buatkan Postman Collection untuk Anda!  
**File:** `Wisata-API.postman_collection.json`

### Import Collection:
1. Buka Postman
2. Click **Import**
3. Pilih file `Wisata-API.postman_collection.json`
4. All requests sudah ready to use!

---

## 🐛 TROUBLESHOOTING

### Error: "Unauthorized" / "Token not provided"
**Solusi:**
- Pastikan header `Authorization` ada
- Pastikan format: `Bearer SPACE token`
- Pastikan token belum expired (max 1 jam)
- Login ulang untuk dapat token baru

### Error: "Token has expired"
**Solusi:**
- Gunakan endpoint `/api/refresh` untuk refresh token
- Atau login ulang

### Error: "Invalid credentials"
**Solusi:**
- Cek email dan password
- Default: `admin@admin.com` / `admin`

### Token terlalu panjang untuk di-copy?
**Solusi:**
- Gunakan method 2 (Postman Variables)
- Atau copy step by step (select all → copy)

---

## 📸 VISUAL GUIDE

### Login di Postman:
```
┌─────────────────────────────────────────────────────┐
│ POST  http://localhost:8080/api/login      [Send]   │
├─────────────────────────────────────────────────────┤
│ Headers  Body  Tests                                │
├─────────────────────────────────────────────────────┤
│ Body Type: raw ▼  JSON ▼                            │
│                                                      │
│ {                                                    │
│     "email": "admin@admin.com",                      │
│     "password": "admin"                              │
│ }                                                    │
└─────────────────────────────────────────────────────┘

Response:
{
    "access_token": "eyJ0eXAiOi...",  ← COPY INI!
    "token_type": "bearer",
    "expires_in": 3600
}
```

### Menggunakan Token:
```
┌─────────────────────────────────────────────────────┐
│ POST  http://localhost:8080/api/user-profile [Send] │
├─────────────────────────────────────────────────────┤
│ Headers  Body  Authorization                        │
├─────────────────────────────────────────────────────┤
│ Authorization                                        │
│ Type: Bearer Token ▼                                │
│ Token: eyJ0eXAiOiJKV1QiLCJhbGc...  ← PASTE DI SINI │
└─────────────────────────────────────────────────────┘
```

---

## 💡 TIPS

1. ✅ **Simpan Token di Environment Variable** - Lebih mudah dan aman
2. ✅ **Gunakan Collection** - Organize requests dengan rapi
3. ✅ **Set Auto-refresh Token** - Buat script di pre-request
4. ✅ **Save Responses** - Untuk dokumentasi
5. ✅ **Use Tests Tab** - Automate validation

---

## 🔗 Quick Links

- Login: `http://localhost:8080/api/login`
- Get Wisata: `http://localhost:8080/api/wisata`
- User Profile: `http://localhost:8080/api/user-profile`
- Web Test UI: `http://localhost:8080/test-ui.html`

---

**Happy Testing! 🚀**
