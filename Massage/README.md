# 🏥 ระบบจองคิวร้านนวดออนไลน์

ระบบจองคิวออนไลน์สำหรับร้านนวดสุขภาพ พัฒนาด้วย PHP Native, MySQL และ Tailwind CSS

[![PHP Version](https://img.shields.io/badge/PHP-7.4+-blue.svg)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-5.7+-orange.svg)](https://mysql.com)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind-3.x-38bdf8.svg)](https://tailwindcss.com)

## 📋 สารบัญ

- [คุณสมบัติหลัก](#คุณสมบัติหลัก)
- [เทคโนโลยีที่ใช้](#เทคโนโลยีที่ใช้)
- [ความต้องการของระบบ](#ความต้องการของระบบ)
- [การติดตั้ง](#การติดตั้ง)
- [โครงสร้างไฟล์](#โครงสร้างไฟล์)
- [การใช้งาน](#การใช้งาน)
- [API Documentation](#api-documentation)
- [Testing](#testing)
- [Screenshots](#screenshots)
- [ทีมพัฒนา](#ทีมพัฒนา)

## ✨ คุณสมบัติหลัก

### สำหรับลูกค้า
- ✅ จองคิวออนไลน์ 24/7 ไม่ต้องโทรศัพท์
- ✅ เลือกบริการนวดตามต้องการ (แผนไทย, น้ำมัน, ฝ่าเท้า, etc.)
- ✅ เลือกวันและเวลาที่สะดวก
- ✅ เลือกหมอนวดหรือให้ระบบจัดหาให้อัตโนมัติ
- ✅ แสดงข้อมูลบริการและราคาชัดเจน
- ✅ Responsive Design รองรับทุกอุปกรณ์

### สำหรับร้าน
- ✅ ลดภาระการรับจองทางโทรศัพท์
- ✅ จัดการคิวอัตโนมัติ
- ✅ ลดความผิดพลาดในการจด appointment
- ✅ เพิ่มความน่าเชื่อถือและภาพลักษณ์

### คุณสมบัติทางเทคนิค
- ✅ PSR-12 Coding Standard
- ✅ OOP Architecture (Simple, No Framework)
- ✅ AJAX API สำหรับการทำงานแบบ asynchronous
- ✅ Client & Server-side Validation
- ✅ Security: XSS & SQL Injection Prevention
- ✅ WCAG 2.1 Level AA Accessibility
- ✅ SEO Optimized

## 🛠️ เทคโนโลยีที่ใช้

### Backend
- **PHP 7.4+** - Server-side programming
- **MySQL 5.7+** - Database management
- **mysqli** - Database connection (ไม่ใช้ PDO)

### Frontend
- **HTML5** - Semantic markup
- **Tailwind CSS 3.x** (CDN) - Utility-first CSS framework
- **Vanilla JavaScript** - Client-side logic
- **Font Awesome 6.x** - Icons
- **Google Fonts (Prompt)** - Thai font

### Development Tools
- **XAMPP/WAMP/MAMP** - Local development environment
- **Git** - Version control
- **VS Code** - Code editor

## 💻 ความต้องการของระบบ

### Server Requirements
- PHP 7.4 หรือสูงกว่า
- MySQL 5.7 หรือสูงกว่า
- Apache Web Server (พร้อม mod_rewrite)
- PHP Extensions:
  - mysqli
  - json
  - mbstring

### Browser Support
- Chrome 90+
- Firefox 88+
- Safari 14+
- Edge 90+

## 🚀 การติดตั้ง

### 1. Clone Repository
```bash
cd c:\xampp\htdocs
# (โปรเจคถูกสร้างใน c:\xampp\htdocs\Massage แล้ว)
```

### 2. สร้าง Database
1. เปิด phpMyAdmin: `http://localhost/phpmyadmin`
2. Import ไฟล์ `database/schema.sql`
3. Database `massage_booking` จะถูกสร้างพร้อมข้อมูลตัวอย่าง

หรือใช้ Command Line:
```bash
mysql -u root -p < database/schema.sql
```

### 3. ตั้งค่า Configuration
แก้ไขไฟล์ `config/config.php`:

```php
// Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');  // เปลี่ยนตาม password ของคุณ
define('DB_NAME', 'massage_booking');

// Base URL
define('BASE_URL', 'http://localhost/Massage');  // เปลี่ยนตาม URL ของคุณ
```

### 4. เริ่มใช้งาน
1. เปิด XAMPP/WAMP และ start Apache + MySQL
2. เข้าเว็บไซต์ที่: `http://localhost/Massage`
3. เริ่มจองคิวได้ทันที!

## 📁 โครงสร้างไฟล์

```
Massage/
├── index.php                      # หน้าแรก
├── services.php                   # หน้าแสดงบริการทั้งหมด
├── booking.php                    # หน้าจองคิว
├── therapists.php                 # หน้าแสดงนักบำบัด
├── contact.php                    # หน้าติดต่อ
├── copilot-instructions.md        # Context engineering instructions
├── requament.md                   # เอกสารความต้องการ
│
├── config/                        # การตั้งค่า
│   ├── config.php                # Configuration หลัก
│   └── database.php              # Database connection class
│
├── includes/                      # Components ที่ใช้ร่วมกัน
│   ├── header.php                # HTML head + meta tags
│   ├── navbar.php                # Navigation bar
│   └── footer.php                # Footer + scripts
│
├── classes/                       # OOP Classes
│   ├── Database.php              # Database wrapper
│   ├── Service.php               # Service management
│   ├── Therapist.php             # Therapist management
│   └── Booking.php               # Booking management
│
├── api/                          # RESTful API endpoints
│   ├── get_services.php          # ดึงข้อมูลบริการทั้งหมด
│   ├── get_therapists.php        # ดึงข้อมูลนักบำบัด
│   ├── check_availability.php    # ตรวจสอบความว่าง
│   ├── create_booking.php        # สร้างการจอง
│   └── response.php              # API response helper
│
├── assets/                       # Static files
│   ├── css/
│   │   └── custom.css           # Custom styles
│   ├── js/
│   │   ├── main.js              # JavaScript หลัก
│   │   ├── booking.js           # Logic การจองคิว
│   │   └── validation.js        # Form validation
│   └── images/                  # รูปภาพ
│
├── database/                     # Database files
│   └── schema.sql               # Database schema + mock data
│
└── docs/                         # Documentation
    └── testing-checklist.md     # Testing checklist
```

## 📖 การใช้งาน

### สำหรับลูกค้า

#### 1. เลือกบริการ
- เข้าหน้า "บริการ" หรือดูจากหน้าแรก
- เลือกบริการที่ต้องการ
- คลิก "จองบริการนี้"

#### 2. กรอกข้อมูลการจอง
- **เลือกบริการ**: เลือกจาก dropdown
- **เลือกวันที่**: คลิกปฏิทิน (ไม่สามารถเลือกวันย้อนหลังได้)
- **เลือกเวลา**: เลือกช่วงเวลาที่ต้องการ
- **เลือกหมอนวด**: เลือกหมอนวดหรือเลือก "หมอนวดว่าง"
- **กรอกข้อมูลส่วนตัว**:
  - ชื่อ-นามสกุล (จำเป็น)
  - เบอร์โทรศัพท์ 10 หลัก (จำเป็น)
  - อีเมล (ไม่จำเป็น)
  - หมายเหตุเพิ่มเติม (ไม่จำเป็น)

#### 3. ยืนยันการจอง
- ตรวจสอบข้อมูลให้ถูกต้อง
- คลิก "จองคิว"
- รอข้อความยืนยัน
- เสร็จสิ้น!

### สำหรับเจ้าของร้าน (Admin - ยังไม่ได้พัฒนา)
> 🚧 **Coming Soon**: ระบบ Admin Panel สำหรับจัดการคิว, บริการ, และหมอนวด

## 🔌 API Documentation

### 1. GET /api/get_services.php
ดึงข้อมูลบริการทั้งหมดที่เปิดใช้งาน

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "นวดแผนไทย",
      "description": "นวดแผนไทยแท้...",
      "duration": 60,
      "price": 300.00,
      "image_url": "..."
    }
  ]
}
```

### 2. GET /api/get_therapists.php
ดึงข้อมูลนักบำบัดทั้งหมด

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "สมหญิง ใจดี",
      "nickname": "ป้อม",
      "specialization": "นวดแผนไทย",
      "is_available": true
    }
  ]
}
```

### 3. POST /api/check_availability.php
ตรวจสอบความว่างของหมอนวด

**Request:**
```json
{
  "therapist_id": 1,
  "booking_date": "2025-12-25",
  "booking_time": "14:00",
  "service_duration": 60
}
```

**Response:**
```json
{
  "success": true,
  "available": true,
  "message": "ช่วงเวลานี้ว่าง"
}
```

### 4. POST /api/create_booking.php
สร้างการจองใหม่

**Request:**
```json
{
  "service_id": 1,
  "therapist_id": 1,
  "customer_name": "สมชาย ใจดี",
  "customer_phone": "0812345678",
  "customer_email": "somchai@email.com",
  "booking_date": "2025-12-25",
  "booking_time": "14:00",
  "notes": "ต้องการนวดแรงหน่อย"
}
```

**Response:**
```json
{
  "success": true,
  "booking_id": 123,
  "message": "จองคิวสำเร็จ"
}
```

## 🧪 Testing

### วิธีทดสอบระบบ

1. ดู [docs/testing-checklist.md](docs/testing-checklist.md) สำหรับ checklist ครบถ้วน
2. ทดสอบทุก feature ตาม checklist
3. ทดสอบบนอุปกรณ์และเบราว์เซอร์ต่างๆ
4. ทดสอบ edge cases และ boundary conditions

### Quick Test

```bash
# 1. ตรวจสอบ Database Connection
เข้า: http://localhost/Massage/index.php
ถ้าแสดงบริการได้ = database connected ✅

# 2. ทดสอบการจอง
เข้า: http://localhost/Massage/booking.php
กรอกข้อมูลและจอง
ตรวจสอบในตาราง bookings ใน database
```

## 📸 Screenshots

### หน้าแรก (Landing Page)
> แสดง Hero Section, บริการ, Features, และ CTA

### หน้าจองคิว (Booking)
> ฟอร์มจองที่สมบูรณ์พร้อม validation

### หน้าบริการ (Services)
> แสดงบริการทั้งหมดแบบ grid responsive

### หน้านักบำบัด (Therapists)
> แสดงนักบำบัดพร้อมความเชี่ยวชาญ

## 🔐 Security Features

- ✅ XSS Prevention: `htmlspecialchars()` ทุก output
- ✅ SQL Injection Prevention: `mysqli_real_escape_string()` ทุก input
- ✅ CSRF Protection: (แนะนำเพิ่มสำหรับ production)
- ✅ Input Validation: Client & Server-side
- ✅ Secure Headers: X-Frame-Options, X-Content-Type-Options
- ✅ HTTPS Ready: (ตั้งค่าเมื่อ deploy production)

## 🚀 Deployment

### สำหรับ Production

1. **เปลี่ยน Error Reporting**
   ```php
   // ใน config/config.php
   error_reporting(0);
   ini_set('display_errors', 0);
   ```

2. **อัพเดท Configuration**
   ```php
   define('DB_HOST', 'your_production_host');
   define('DB_USER', 'your_production_user');
   define('DB_PASS', 'your_strong_password');
   define('BASE_URL', 'https://your-domain.com');
   ```

3. **ติดตั้ง SSL Certificate**
   - ใช้ Let's Encrypt (ฟรี)
   - หรือซื้อ SSL Certificate

4. **ตั้งค่า File Permissions**
   ```bash
   # Unix/Linux
   chmod 755 /path/to/Massage
   chmod 644 /path/to/Massage/*.php
   ```

5. **Backup Database**
   ```bash
   mysqldump -u root -p massage_booking > backup.sql
   ```

## 📝 To-Do List (Future Enhancements)

- [ ] Admin Panel สำหรับจัดการระบบ
- [ ] ระบบ Login/Register สำหรับสมาชิก
- [ ] Email Notification เมื่อจองสำเร็จ
- [ ] SMS Reminder ก่อนนัดหมาย
- [ ] ระบบ Rating & Review
- [ ] ระบบชำระเงินออนไลน์
- [ ] Dashboard สำหรับดู Analytics
- [ ] Export รายงานเป็น PDF/Excel
- [ ] Multi-language Support
- [ ] PWA (Progressive Web App)

## 🤝 การสนับสนุน

หากพบปัญหาหรือต้องการสอบถาม:
- 📧 Email: info@massage-booking.com
- 📱 LINE: @massageshop
- 📞 โทร: 02-123-4567, 081-234-5678

## 📄 License

© 2025 ร้านนวดสุขภาพ. All rights reserved.

โปรเจคนี้พัฒนาเพื่อการศึกษาและใช้งานจริง

## 👥 ทีมพัฒนา

**Software Engineer Team**
- Full-stack Development
- UI/UX Design
- Database Design
- Testing & QA

---

**Version**: 1.0  
**Release Date**: December 23, 2025  
**Last Updated**: December 23, 2025

---

Made with ❤️ by Software Engineer Team
