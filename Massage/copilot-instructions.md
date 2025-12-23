# Copilot Instructions - ระบบจองคิวร้านนวด

## 🎯 จุดประสงค์ของโปรเจค
ระบบเว็บไซต์จองคิวร้านนวดออนไลน์ที่มีความสามารถครบถ้วน ออกแบบเพื่อ:
- อำนวยความสะดวกในการจองคิวโดยไม่ต้องโทรศัพท์
- เพิ่มโอกาสทางการตลาดและการเข้าถึงลูกค้า 24/7
- แสดงข้อมูลบริการอย่างชัดเจนและครบถ้วน
- สร้างภาพลักษณ์ที่เป็นมืออาชีพ
- ลดความผิดพลาดในการสื่อสาร
- รองรับการใช้งานผ่านอุปกรณ์มือถือ

## 🛠️ Technology Stack

### Backend
- **PHP 7.x** - Native PHP (ไม่ใช้ Framework)
- **MySQL** - ใช้ mysql_* หรือ mysqli_* (ไม่ใช้ PDO)
- **OOP** - Object-Oriented Programming แบบเรียบง่าย
- **ไม่ใช้**: MVC Framework, Composer, PDO

### Frontend
- **Tailwind CSS** - จาก CDN (https://cdn.tailwindcss.com)
- **Vanilla JavaScript** - ไม่ใช้ Framework (React, Vue, etc.)
- **AJAX** - สำหรับ API calls
- **Font**: Google Fonts - Prompt (ไทย)
- **Responsive Design**: Mobile-first approach

### External Resources (CDN)
```html
<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com"></script>

<!-- Google Fonts - Prompt -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<!-- Font Awesome (optional for icons) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
```

## 📁 โครงสร้างโปรเจค

```
Massage/
├── index.php                 # หน้าแรก (Landing Page)
├── booking.php              # หน้าจองคิว
├── services.php             # หน้าแสดงบริการทั้งหมด
├── therapists.php           # หน้าแสดงหมอนวด
├── contact.php              # หน้าติดต่อ
├── config/
│   ├── config.php          # Configuration settings
│   └── database.php        # Database connection
├── includes/
│   ├── header.php          # Header component
│   ├── navbar.php          # Navigation bar
│   └── footer.php          # Footer component
├── classes/
│   ├── Service.php         # Service class (OOP)
│   ├── Therapist.php       # Therapist class (OOP)
│   ├── Booking.php         # Booking class (OOP)
│   └── Database.php        # Database wrapper class
├── api/
│   ├── get_services.php    # API: Get all services
│   ├── get_therapists.php  # API: Get available therapists
│   ├── check_availability.php # API: Check time slot availability
│   ├── create_booking.php  # API: Create new booking
│   └── response.php        # API response helper
├── assets/
│   ├── js/
│   │   ├── main.js         # Main JavaScript file
│   │   ├── booking.js      # Booking form handler
│   │   └── validation.js   # Form validation
│   ├── css/
│   │   └── custom.css      # Custom styles (เสริม Tailwind)
│   └── images/
│       └── placeholder/    # Placeholder images
├── database/
│   └── schema.sql          # Database schema
├── docs/
│   └── testing-checklist.md # Testing checklist
├── copilot-instructions.md  # (This file)
└── requament.md            # Requirements document
```

## 🗄️ Database Schema

### ตาราง: services
```sql
- id (INT, PRIMARY KEY, AUTO_INCREMENT)
- name (VARCHAR(255)) - ชื่อบริการ
- description (TEXT) - รายละเอียดบริการ
- duration (INT) - ระยะเวลา (นาที)
- price (DECIMAL(10,2)) - ราคา
- image_url (VARCHAR(500)) - URL รูปภาพ
- is_active (TINYINT(1)) - สถานะเปิด/ปิด
- created_at (TIMESTAMP)
- updated_at (TIMESTAMP)
```

### ตาราง: therapists
```sql
- id (INT, PRIMARY KEY, AUTO_INCREMENT)
- name (VARCHAR(255)) - ชื่อหมอนวด
- nickname (VARCHAR(100)) - ชื่อเล่น
- specialization (TEXT) - ความเชี่ยวชาญ
- image_url (VARCHAR(500)) - URL รูปภาพ
- is_available (TINYINT(1)) - สถานะพร้อมงาน
- created_at (TIMESTAMP)
- updated_at (TIMESTAMP)
```

### ตาราง: bookings
```sql
- id (INT, PRIMARY KEY, AUTO_INCREMENT)
- service_id (INT, FOREIGN KEY -> services.id)
- therapist_id (INT, FOREIGN KEY -> therapists.id, NULL for "หมอนวดว่าง")
- customer_name (VARCHAR(255)) - ชื่อลูกค้า
- customer_phone (VARCHAR(20)) - เบอร์โทร
- customer_email (VARCHAR(255), NULL) - อีเมล (optional)
- booking_date (DATE) - วันที่จอง
- booking_time (TIME) - เวลาที่จอง
- notes (TEXT, NULL) - หมายเหตุ
- status (ENUM: 'pending', 'confirmed', 'completed', 'cancelled')
- created_at (TIMESTAMP)
- updated_at (TIMESTAMP)
```

### ตาราง: working_hours
```sql
- id (INT, PRIMARY KEY, AUTO_INCREMENT)
- therapist_id (INT, FOREIGN KEY -> therapists.id)
- day_of_week (TINYINT) - 0=อาทิตย์, 1=จันทร์, ... 6=เสาร์
- start_time (TIME) - เวลาเริ่มงาน
- end_time (TIME) - เวลาเลิกงาน
- is_available (TINYINT(1)) - วันนี้ทำงานหรือไม่
```

## 🎨 Design Guidelines

### Color Palette (Tailwind Classes)
- **Primary**: `bg-indigo-600`, `text-indigo-600`
- **Secondary**: `bg-purple-500`, `text-purple-500`
- **Accent**: `bg-pink-500`, `text-pink-500`
- **Success**: `bg-green-500`, `text-green-500`
- **Warning**: `bg-yellow-500`, `text-yellow-500`
- **Error**: `bg-red-500`, `text-red-500`
- **Neutral**: `bg-gray-100`, `text-gray-700`

### Typography
- **Font Family**: 'Prompt', sans-serif (ทุกที่)
- **Headings**: `font-semibold` หรือ `font-bold`
- **Body**: `font-normal` (400)

### Spacing & Layout
- **Container**: `max-w-7xl mx-auto px-4 sm:px-6 lg:px-8`
- **Sections**: `py-12 lg:py-16`
- **Cards**: `rounded-lg shadow-lg p-6`

### Responsive Breakpoints
- **Mobile**: `default` (< 640px)
- **Tablet**: `sm:` (≥ 640px), `md:` (≥ 768px)
- **Desktop**: `lg:` (≥ 1024px), `xl:` (≥ 1280px)

## 📋 Functional Requirements (ทุกฟีเจอร์ต้องทำงานได้จริง)

### 1. หน้าแรก (index.php)
- [x] Navigation bar พร้อม responsive hamburger menu
- [x] Hero section พร้อม CTA button "จองเลย"
- [x] Services section (3-6 การ์ด)
- [x] CTA section "เหตุผลที่ควรเลือกเรา"
- [x] Footer พร้อมข้อมูลติดต่อ

### 2. หน้าบริการ (services.php)
- [x] แสดงบริการทั้งหมดแบบ grid
- [x] แต่ละการ์ดแสดง: ชื่อ, ระยะเวลา, ราคา, คำอธิบาย
- [x] ปุ่ม "จองบริการนี้" เชื่อมไปหน้า booking

### 3. หน้าจองคิว (booking.php) ⭐ CORE FEATURE
#### Form Fields:
- [x] เลือกบริการ (Dropdown จาก database)
- [x] เลือกวันที่ (Date picker)
- [x] เลือกเวลา (Time picker หรือ dropdown)
- [x] เลือกหมอนวด (Dropdown + option "หมอนวดว่าง")
- [x] ชื่อ-นามสกุล (Required, Text)
- [x] เบอร์โทรศัพท์ (Required, Tel, 10 หลัก)
- [x] อีเมล (Optional, Email validation)
- [x] หมายเหตุ (Optional, Textarea)

#### Validation (Client-side)
- [x] ตรวจสอบฟิลด์ว่างก่อน submit
- [x] ตรวจสอบรูปแบบเบอร์โทร (10 หลัก)
- [x] ตรวจสอบรูปแบบอีเมล
- [x] ตรวจสอบวันที่ไม่ให้เลือกวันย้อนหลัง
- [x] แสดง error message แบบ inline

#### Backend Processing
- [x] รับข้อมูลผ่าน AJAX (JSON)
- [x] Validate ข้อมูลอีกครั้งฝั่ง server
- [x] ตรวจสอบ availability ของหมอนวด/เวลา
- [x] บันทึกข้อมูลลง database
- [x] ส่ง response กลับ (success/error)

#### UI/UX
- [x] แสดง loading spinner ขณะ submit
- [x] แสดง modal ยืนยันเมื่อจองสำเร็จ
- [x] แสดง error message ถ้าจองไม่สำเร็จ
- [x] Reset form หลังจองสำเร็จ

### 4. หน้าหมอนวด (therapists.php)
- [x] แสดงรายชื่อหมอนวดพร้อมรูป
- [x] แสดงความเชี่ยวชาญของแต่ละคน
- [x] แสดงสถานะว่าง/ไม่ว่าง (realtime)

### 5. หน้าติดต่อ (contact.php)
- [x] แสดงข้อมูลร้าน (ชื่อ, ที่อยู่, เบอร์โทร)
- [x] Google Maps embed (optional)
- [x] เวลาทำการ
- [x] Social media links

## 🔧 API Endpoints (AJAX)

### GET /api/get_services.php
```json
Response:
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "นวดแผนไทย",
      "duration": 60,
      "price": 300.00,
      "description": "นวดแผนไทยแท้...",
      "image_url": "..."
    }
  ]
}
```

### GET /api/get_therapists.php
```json
Response:
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "คุณสมหญิง",
      "nickname": "ป้อม",
      "specialization": "นวดแผนไทย",
      "is_available": true
    }
  ]
}
```

### POST /api/check_availability.php
```json
Request:
{
  "therapist_id": 1,
  "booking_date": "2025-12-25",
  "booking_time": "14:00",
  "service_duration": 60
}

Response:
{
  "success": true,
  "available": true,
  "message": "ช่วงเวลานี้ว่าง"
}
```

### POST /api/create_booking.php
```json
Request:
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

Response:
{
  "success": true,
  "booking_id": 123,
  "message": "จองคิวสำเร็จ"
}
```

## 📝 Coding Standards (PSR-12)

### PHP Code Style
```php
<?php
declare(strict_types=1);

namespace MassageBooking;

/**
 * Class description
 */
class ClassName
{
    private $property;

    public function __construct()
    {
        // Constructor code
    }

    public function methodName(): void
    {
        // Method code
    }
}
```

### Naming Conventions
- **Classes**: PascalCase (`BookingManager`, `ServiceHandler`)
- **Methods**: camelCase (`getAvailableTherapists()`, `createBooking()`)
- **Variables**: snake_case (`$customer_name`, `$booking_date`)
- **Constants**: UPPER_SNAKE_CASE (`DB_HOST`, `MAX_BOOKINGS_PER_DAY`)
- **Files**: snake_case (`get_services.php`, `create_booking.php`)

### Comments & Documentation
```php
/**
 * สร้างการจองใหม่
 * 
 * @param int $service_id รหัสบริการ
 * @param int|null $therapist_id รหัสหมอนวด (null = หมอนวดว่าง)
 * @param array $customer_data ข้อมูลลูกค้า
 * @return array ผลลัพธ์การจอง
 */
public function createBooking(int $service_id, ?int $therapist_id, array $customer_data): array
{
    // Implementation
}
```

## 🔒 Security Measures

### Database
- [x] Use `mysqli_real_escape_string()` สำหรับ input sanitization
- [x] Validate และ sanitize ทุก input ก่อนใส่ database
- [x] ใช้ prepared statements เมื่อเป็นไปได้

### Input Validation
- [x] Whitelist validation สำหรับ enum values
- [x] Type checking (is_numeric, filter_var)
- [x] Length limits สำหรับ string inputs
- [x] XSS prevention: `htmlspecialchars()`

### API Security
- [x] Verify HTTP method (GET/POST)
- [x] Set proper headers (`Content-Type: application/json`)
- [x] Rate limiting (optional, สำหรับ production)

## ♿ Accessibility (WCAG 2.1 Level AA)

### Required Elements
- [x] Semantic HTML5 tags (`<nav>`, `<main>`, `<section>`, `<article>`)
- [x] ARIA labels สำหรับ interactive elements
- [x] `alt` text สำหรับรูปภาพทั้งหมด
- [x] Form labels เชื่อมกับ inputs (`for` attribute)
- [x] Focus states ชัดเจน (`:focus-visible`)
- [x] Color contrast ratio ≥ 4.5:1
- [x] Keyboard navigation support (Tab, Enter, Esc)

### Example
```html
<button 
  type="submit" 
  class="btn-primary focus:ring-4 focus:ring-indigo-300"
  aria-label="ยืนยันการจอง"
>
  จองเลย
</button>
```

## 📱 Responsive Design Requirements

### Mobile First (< 640px)
- [x] Single column layout
- [x] Hamburger menu
- [x] Touch-friendly buttons (min 44x44px)
- [x] Stack form fields vertically

### Tablet (640px - 1024px)
- [x] Two-column layouts
- [x] Grid: `sm:grid-cols-2 md:grid-cols-3`

### Desktop (> 1024px)
- [x] Full navigation bar
- [x] Multi-column layouts
- [x] Hover effects

## 🧪 Testing Checklist

### Functional Testing
- [ ] ทุก page โหลดได้ไม่ error
- [ ] Form validation ทำงานถูกต้อง (client-side)
- [ ] API endpoints ตอบกลับ JSON ถูกต้อง
- [ ] Database CRUD operations สำเร็จ
- [ ] การจองบันทึกลง database
- [ ] แสดง success/error message

### UI/UX Testing
- [ ] Responsive ทุกขนาดหน้าจอ (375px, 768px, 1920px)
- [ ] Typography อ่านง่าย (font Prompt)
- [ ] Colors สอดคล้องกัน
- [ ] Loading states แสดงผล
- [ ] Modal เปิด/ปิดได้

### Browser Testing
- [ ] Chrome (latest)
- [ ] Firefox (latest)
- [ ] Safari (latest)
- [ ] Edge (latest)

### Performance
- [ ] Page load < 3 seconds
- [ ] No console errors
- [ ] Images optimized

## ⚠️ AI Behavior Rules (กฎสำคัญ)

### ❌ ห้ามเด็ดขาด
1. **ห้ามสรุปหรือเดา** - ถ้าข้อมูลไม่ครบ ต้องถามก่อนเสมอ
2. **ห้ามสมมติ library** - ใช้เฉพาะที่มีอยู่จริง (PHP native, Tailwind CDN)
3. **ห้าม copy-paste โค้ดที่ไม่เข้าใจ** - ต้องอธิบายได้ทุกบรรทัด
4. **ห้ามใช้ framework** - ไม่ใช้ Laravel, CodeIgniter, Symfony
5. **ห้ามใช้ PDO** - ใช้ mysqli_* เท่านั้น
6. **ห้ามข้าม validation** - ต้อง validate ทั้ง client และ server
7. **ห้ามทิ้งโค้ดครึ่งๆ กลางๆ** - ทำให้เสร็จครบทุกฟีเจอร์

### ✅ ต้องทำเสมอ
1. **ตรวจสอบไฟล์ก่อนอ้างอิง** - ใช้ `file_exists()` หรือตรวจสอบจริง
2. **เขียน comment เป็นภาษาไทย** - อธิบายโค้ดให้ชัดเจน
3. **Test ก่อน deploy** - รัน code ให้แน่ใจว่าไม่ error
4. **Responsive ทุก breakpoint** - ทดสอบ mobile, tablet, desktop
5. **Sanitize ทุก input** - ป้องกัน SQL injection, XSS
6. **Error handling ครบถ้วน** - `try-catch`, error messages ชัดเจน
7. **Log errors** - เก็บ error log สำหรับ debug

### 🔍 Validation Checklist
```php
// ✅ ตัวอย่างการ validate input
function validateBookingData($data) {
    $errors = [];
    
    // ตรวจสอบฟิลด์ required
    if (empty($data['service_id'])) {
        $errors[] = 'กรุณาเลือกบริการ';
    }
    
    // ตรวจสอบรูปแบบเบอร์โทร
    if (!preg_match('/^0[0-9]{9}$/', $data['customer_phone'])) {
        $errors[] = 'เบอร์โทรศัพท์ไม่ถูกต้อง';
    }
    
    // ตรวจสอบวันที่ไม่ย้อนหลัง
    if (strtotime($data['booking_date']) < strtotime('today')) {
        $errors[] = 'ไม่สามารถจองย้อนหลังได้';
    }
    
    return empty($errors) ? true : $errors;
}
```

## 🎯 Mockup Data (สำหรับทดสอบ)

### Services
1. นวดแผนไทย - 60 นาที - 300 บาท
2. นวดน้ำมัน - 90 นาที - 500 บาท
3. นวดฝ่าเท้า - 45 นาที - 250 บาท
4. นวดหัวไหล่คอ - 30 นาที - 200 บาท
5. นวดบำบัด - 120 นาที - 800 บาท

### Therapists
1. คุณสมหญิง (ป้อม) - นวดแผนไทย
2. คุณสมชาย (เต้) - นวดน้ำมัน
3. คุณสมใจ (นิด) - นวดฝ่าเท้า
4. คุณสมศรี (แหม่ม) - ครบทุกประเภท

### Working Hours
- จันทร์ - ศุกร์: 10:00 - 20:00
- เสาร์ - อาทิตย์: 09:00 - 21:00

## 🚀 Deployment Notes

### Development Environment
- XAMPP/WAMP/MAMP
- PHP 7.x
- MySQL 5.7+
- Apache web server

### Production Checklist
- [ ] Set `error_reporting(0)` in production
- [ ] Enable HTTPS
- [ ] Backup database regularly
- [ ] Set file permissions correctly
- [ ] Remove debug code/console.logs

## 📚 Reference Links

### Official Documentation
- [PHP Manual](https://www.php.net/manual/en/)
- [MySQL Documentation](https://dev.mysql.com/doc/)
- [Tailwind CSS Docs](https://tailwindcss.com/docs)
- [MDN Web Docs](https://developer.mozilla.org/)

### Thai Language Resources
- Google Fonts: Prompt (https://fonts.google.com/specimen/Prompt)
- Thai Date/Time format: `d/m/Y` (25/12/2025)

---

## 💡 Tips for AI Copilot

เมื่อสร้างโค้ด:
1. **อ่านความต้องการให้ครบก่อน** - อ่าน requament.md ทั้งหมด
2. **เริ่มจากโครงสร้าง** - สร้าง folders และ config ก่อน
3. **ทีละส่วน** - อย่าพยายามสร้างทั้งหมดพร้อมกัน
4. **Test ระหว่างทาง** - สร้างเสร็จแต่ละส่วนให้ test ทันที
5. **Comment ชัดเจน** - อธิบายโค้ดเป็นภาษาไทย
6. **Responsive เสมอ** - ทุก element ต้อง responsive
7. **Validation ครบ** - ทั้ง client และ server side

---

**Version**: 1.0
**Last Updated**: December 23, 2025
**Author**: Software Engineer Team
**Project**: Massage Booking System
