# Cooperative API

ระบบ API สำหรับจัดการคำขอจัดตั้งสหกรณ์ พัฒนาด้วย Laravel 11 และ PostgreSQL

## Tech Stack

- **Framework:** Laravel 11
- **Database:** PostgreSQL
- **Authentication:** Laravel Sanctum (Token-based)
- **Language:** PHP 8.2+

## Requirements

- PHP >= 8.2
- Composer
- PostgreSQL

## Production

API URL: `https://cooperative-api-production.up.railway.app`

Health Check: `GET /api/health`

## Installation & Setup

### 1. Clone โปรเจกต์

```bash
git clone https://github.com/chinkoike/cooperative-api.git
cd cooperative-api
```

### 2. ติดตั้ง Dependencies

```bash
composer install
```

### 3. ตั้งค่า Environment

```bash
cp .env.example .env
php artisan key:generate
```

แก้ไขไฟล์ `.env` ให้ตรงกับ Database ของคุณ:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=cooperative_db
DB_USERNAME=postgres
DB_PASSWORD=your_password
```

### 4. รัน Migration และ Seeder

```bash
php artisan migrate --seed
```

### 5. รันเซิร์ฟเวอร์

```bash
php artisan serve
```

PHP Artisan Serve: `http://127.0.0.1:8000`
Local Domain (Herd/Laragon): `http://cooperative-api.test`

## Test Accounts

| Role   | Email           | Password |
| ------ | --------------- | -------- |
| Public | public@test.com | password |
| Staff  | staff@test.com  | password |

## API Endpoints

### Authentication

| Method | Endpoint      | Description |
| ------ | ------------- | ----------- |
| POST   | /api/register | สมัครสมาชิก |
| POST   | /api/login    | เข้าสู่ระบบ |
| POST   | /api/logout   | ออกจากระบบ  |

### Public (ต้อง Login ด้วย Role: public)

| Method | Endpoint             | Description           |
| ------ | -------------------- | --------------------- |
| POST   | /api/public/requests | ยื่นคำขอจัดตั้งสหกรณ์ |
| GET    | /api/public/requests | ดูคำขอของตัวเอง       |

### Staff (ต้อง Login ด้วย Role: staff)

| Method | Endpoint                           | Description        |
| ------ | ---------------------------------- | ------------------ |
| GET    | /api/staff/requests                | ดูคำขอทั้งหมด      |
| GET    | /api/staff/requests?status=pending | กรองคำขอตามสถานะ   |
| PATCH  | /api/staff/requests/{id}/review    | อนุมัติ/ปฏิเสธคำขอ |

## Response Format

ทุก Endpoint คืนค่าในรูปแบบเดียวกัน:

```json
// Success
{
    "success": true,
    "message": "Success message",
    "data": { }
}

// Error
{
    "success": false,
    "message": "Error message",
    "errors": { }
}
```
