# 🎯 QUICK REFERENCE - Login di Postman

## 🚀 CARA TERCEPAT (3 Langkah)

### 1️⃣ LOGIN
```
Method: POST
URL: http://localhost:8080/api/login
Body (JSON):
{
    "email": "admin@admin.com",
    "password": "admin"
}
```

### 2️⃣ COPY TOKEN
Response akan seperti ini:
```json
{
    "access_token": "eyJ0eXAiOiJKV1Qi...",  ← COPY INI
    "token_type": "bearer",
    "expires_in": 3600
}
```

### 3️⃣ PAKAI TOKEN
Untuk request yang perlu auth, tambahkan header:
```
Authorization: Bearer eyJ0eXAiOiJKV1Qi...
```

⚠️ **PENTING**: Ada **SPASI** setelah kata `Bearer`!

---

## 📦 ATAU: Import Collection (Lebih Mudah!)

1. Buka Postman
2. Click **Import**
3. Pilih file: `Wisata-API.postman_collection.json`
4. Pilih file: `Wisata-API-Local.postman_environment.json`
5. Pilih environment "Wisata API - Local" di dropdown
6. Klik request "Login" → Send
7. Token otomatis tersimpan!

---

## 🎨 Visual Step-by-Step

### Di Postman:

```
┌────────────────────────────────────────────┐
│ POST ▼  http://localhost:8080/api/login   │
│                                   [Send] ► │
├────────────────────────────────────────────┤
│ Params  Authorization  Headers  Body  ... │
├────────────────────────────────────────────┤
│                                            │
│ ● none  ○ form-data  ○ x-www-form-url...  │
│ ● raw  ○ binary  ○ GraphQL                │
│                                            │
│ Text ▼  JSON ▼                             │
│ ┌────────────────────────────────────────┐ │
│ │ {                                      │ │
│ │     "email": "admin@admin.com",        │ │
│ │     "password": "admin"                │ │
│ │ }                                      │ │
│ └────────────────────────────────────────┘ │
└────────────────────────────────────────────┘
```

### Response:
```
Status: 200 OK

Body:
{
    "access_token": "eyJ0eXAiOiJKV1Qi...",  ← SELECT & COPY
    "token_type": "bearer",
    "expires_in": 3600
}
```

### Pakai Token di Request Lain:
```
┌────────────────────────────────────────────┐
│ POST ▼  http://localhost:8080/api/wisata  │
│                                   [Send] ► │
├────────────────────────────────────────────┤
│ Params  Authorization  Headers  Body      │
├────────────────────────────────────────────┤
│ Authorization                              │
│ ┌────────────────────────────────────────┐ │
│ │ Type: Bearer Token ▼                   │ │
│ │ Token: eyJ0eXAiOiJKV1Qi...  ← PASTE   │ │
│ └────────────────────────────────────────┘ │
└────────────────────────────────────────────┘
```

---

## 💡 Tips Pro

### Auto-Save Token (Recommended!)
Di request Login, tab **Tests**, paste ini:
```javascript
var jsonData = pm.response.json();
pm.environment.set("token", jsonData.access_token);
```

Lalu di request lain, gunakan:
```
Authorization: Bearer {{token}}
```

---

## 📋 Test Endpoints

### ✅ Tanpa Token (Public)
```
GET  http://localhost:8080/api/wisata         ← List wisata
GET  http://localhost:8080/api/wisata/1       ← Detail wisata
```

### 🔐 Dengan Token (Admin)
```
POST   http://localhost:8080/api/wisata       ← Create
PUT    http://localhost:8080/api/wisata/1     ← Update  
DELETE http://localhost:8080/api/wisata/1     ← Delete
POST   http://localhost:8080/api/user-profile ← Profile
```

---

## 🐛 Masalah Umum

❌ **"Unauthorized"**  
✅ Cek token sudah di-paste dengan benar  
✅ Pastikan ada spasi setelah "Bearer"  
✅ Token belum expired (max 1 jam)

❌ **"Token has expired"**  
✅ Login ulang atau gunakan `/api/refresh`

❌ **"Invalid credentials"**  
✅ Email: `admin@admin.com`  
✅ Password: `admin`

---

## 📞 Need Help?

Baca dokumentasi lengkap:
- **[POSTMAN_GUIDE_LOGIN.md](POSTMAN_GUIDE_LOGIN.md)** - Full guide
- **[POSTMAN_GUIDE.md](POSTMAN_GUIDE.md)** - Complete reference

---

**Happy Testing! 🚀**
