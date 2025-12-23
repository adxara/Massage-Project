<?php
/**
 * ไฟล์ Configuration หลักของระบบ
 * จัดเก็บค่าคงที่และการตั้งค่าต่างๆ ของระบบจองคิวร้านนวด
 * 
 * @author Software Engineer Team
 * @version 1.0
 * @since 2025-12-23
 */

// ป้องกันการเข้าถึงไฟล์โดยตรง
defined('APP_ACCESS') or define('APP_ACCESS', true);

// =====================================================
// การตั้งค่า Error Reporting
// =====================================================
// Development mode: แสดง error ทั้งหมด
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Production mode: ซ่อน error (uncomment บรรทัดด้านล่างเมื่อ deploy)
// error_reporting(0);
// ini_set('display_errors', 0);

// =====================================================
// ข้อมูลฐานข้อมูล
// =====================================================
define('DB_HOST', 'localhost');          // ชื่อ host ของ database
define('DB_USER', 'root');               // username ของ database
define('DB_PASS', '');                   // password ของ database (ว่างสำหรับ XAMPP default)
define('DB_NAME', 'massage_booking');    // ชื่อ database

// =====================================================
// การตั้งค่า Path และ URL
// =====================================================
// Base path ของโปรเจค
define('BASE_PATH', dirname(dirname(__FILE__)));

// Base URL สำหรับ assets และ links
define('BASE_URL', 'http://localhost/Massage');

// Asset paths
define('CSS_PATH', BASE_URL . '/assets/css');
define('JS_PATH', BASE_URL . '/assets/js');
define('IMG_PATH', BASE_URL . '/assets/images');

// =====================================================
// การตั้งค่า Timezone
// =====================================================
date_default_timezone_set('Asia/Bangkok');

// =====================================================
// การตั้งค่าภาษาและการแสดงผล
// =====================================================
define('SITE_NAME', 'คุณเบนซ์นวดเพื่อสุขภาพ');
define('SITE_DESCRIPTION', 'ระบบจองคิวออนไลน์ร้านนวดสุขภาพ บริการนวดแผนไทย นวดน้ำมัน และนวดเพื่อสุขภาพ');
define('SITE_KEYWORDS', 'นวดแผนไทย, นวดน้ำมัน, นวดฝ่าเท้า, จองคิวนวด, ร้านนวด');
define('DEFAULT_LANG', 'th');

// =====================================================
// ข้อมูลติดต่อร้าน
// =====================================================
define('SHOP_PHONE', '02-123-4567');
define('SHOP_MOBILE', '081-234-5678');
define('SHOP_EMAIL', 'info@massage-booking.com');
define('SHOP_LINE', '@massageshop');
define('SHOP_ADDRESS', '123 ตลาดเซฟวันโคราช ต.ในเมือง อ.เมือง จ.นครราชสีมา 30000');

// =====================================================
// เวลาทำการของร้าน
// =====================================================
define('OPENING_HOURS', [
    'weekday' => ['start' => '10:00', 'end' => '20:00'],  // จันทร์-ศุกร์
    'weekend' => ['start' => '09:00', 'end' => '21:00']   // เสาร์-อาทิตย์
]);

// =====================================================
// การตั้งค่าการจองคิว
// =====================================================
define('BOOKING_ADVANCE_DAYS', 30);      // จองล่วงหน้าได้กี่วัน
define('BOOKING_MIN_NOTICE_HOURS', 2);   // ต้องจองก่อนกี่ชั่วโมง
define('TIME_SLOT_INTERVAL', 30);        // ช่วงเวลาแต่ละช่อง (นาที)

// =====================================================
// การตั้งค่า Pagination
// =====================================================
define('ITEMS_PER_PAGE', 12);            // จำนวนรายการต่อหน้า

// =====================================================
// สถานะการจอง
// =====================================================
define('BOOKING_STATUS', [
    'pending' => 'รอยืนยัน',
    'confirmed' => 'ยืนยันแล้ว',
    'completed' => 'เสร็จสิ้น',
    'cancelled' => 'ยกเลิก'
]);

// =====================================================
// ค่าคงที่สำหรับ Validation
// =====================================================
define('MIN_PHONE_LENGTH', 10);
define('MAX_PHONE_LENGTH', 10);
define('MIN_NAME_LENGTH', 2);
define('MAX_NAME_LENGTH', 100);
define('MAX_NOTES_LENGTH', 500);

// =====================================================
// Social Media Links
// =====================================================
define('SOCIAL_MEDIA', [
    'facebook' => 'https://facebook.com/massageshop',
    'line' => 'https://line.me/ti/p/@massageshop',
    'instagram' => 'https://instagram.com/massageshop',
    'twitter' => 'https://twitter.com/massageshop'
]);

// =====================================================
// การตั้งค่า Security
// =====================================================
define('SESSION_TIMEOUT', 3600);         // Session timeout (seconds) = 1 hour
define('MAX_LOGIN_ATTEMPTS', 5);         // จำนวนครั้งที่พยายาม login ได้

// =====================================================
// External CDN Links
// =====================================================
define('CDN_TAILWIND', 'https://cdn.tailwindcss.com');
define('CDN_FONTAWESOME', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css');
define('CDN_GOOGLE_FONTS', 'https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&display=swap');

// =====================================================
// Placeholder Images (สำหรับ mockup)
// =====================================================
define('PLACEHOLDER_SERVICE', 'https://via.placeholder.com/400x300/6366f1/ffffff?text=Service');
define('PLACEHOLDER_THERAPIST', 'https://via.placeholder.com/300x300/8b5cf6/ffffff?text=Therapist');
define('PLACEHOLDER_HERO', 'https://via.placeholder.com/1920x600/6366f1/ffffff?text=Massage+Spa');

// =====================================================
// Helper Functions
// =====================================================

/**
 * ฟังก์ชันสำหรับ sanitize string input
 * 
 * @param string $data ข้อมูลที่ต้องการ sanitize
 * @return string ข้อมูลที่ผ่านการ sanitize แล้ว
 */
function sanitize_input($data)
{
    if ($data === null) {
        return '';
    }
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

/**
 * ฟังก์ชันสำหรับแปลงวันที่เป็นรูปแบบไทย
 * 
 * @param string $date วันที่ในรูปแบบ Y-m-d
 * @return string วันที่ในรูปแบบไทย
 */
function thai_date($date)
{
    $thai_months = [
        '01' => 'มกราคม', '02' => 'กุมภาพันธ์', '03' => 'มีนาคม',
        '04' => 'เมษายน', '05' => 'พฤษภาคม', '06' => 'มิถุนายน',
        '07' => 'กรกฎาคม', '08' => 'สิงหาคม', '09' => 'กันยายน',
        '10' => 'ตุลาคม', '11' => 'พฤศจิกายน', '12' => 'ธันวาคม'
    ];
    
    $date_parts = explode('-', $date);
    if (count($date_parts) != 3) {
        return $date;
    }
    
    $year = $date_parts[0] + 543;  // แปลงเป็น พ.ศ.
    $month = $thai_months[$date_parts[1]];
    $day = (int)$date_parts[2];
    
    return "$day $month $year";
}

/**
 * ฟังก์ชันสำหรับแปลงเวลาเป็นรูปแบบไทย
 * 
 * @param string $time เวลาในรูปแบบ H:i:s
 * @return string เวลาในรูปแบบไทย
 */
function thai_time($time)
{
    $time_parts = explode(':', $time);
    if (count($time_parts) < 2) {
        return $time;
    }
    
    return $time_parts[0] . ':' . $time_parts[1] . ' น.';
}

/**
 * ฟังก์ชันสำหรับ redirect ไปยังหน้าอื่น
 * 
 * @param string $url URL ที่ต้องการ redirect
 * @return void
 */
function redirect($url)
{
    header("Location: $url");
    exit();
}

/**
 * ฟังก์ชันสำหรับตรวจสอบว่าเป็น POST request หรือไม่
 * 
 * @return bool
 */
function is_post_request()
{
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}

/**
 * ฟังก์ชันสำหรับตรวจสอบว่าเป็น GET request หรือไม่
 * 
 * @return bool
 */
function is_get_request()
{
    return $_SERVER['REQUEST_METHOD'] === 'GET';
}

/**
 * ฟังก์ชันสำหรับตรวจสอบว่าเป็น AJAX request หรือไม่
 * 
 * @return bool
 */
function is_ajax_request()
{
    return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
           strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
}

/**
 * ฟังก์ชันสำหรับ format เบอร์โทรศัพท์
 * 
 * @param string $phone เบอร์โทรศัพท์
 * @return string เบอร์โทรศัพท์ที่ format แล้ว
 */
function format_phone($phone)
{
    // Remove all non-numeric characters
    $phone = preg_replace('/[^0-9]/', '', $phone);
    
    // Format: 0XX-XXX-XXXX
    if (strlen($phone) == 10) {
        return substr($phone, 0, 3) . '-' . substr($phone, 3, 3) . '-' . substr($phone, 6, 4);
    }
    
    return $phone;
}

/**
 * ฟังก์ชันสำหรับ format ราคา
 * 
 * @param float $price ราคา
 * @return string ราคาที่ format แล้ว
 */
function format_price($price)
{
    return number_format($price, 0, '.', ',') . ' บาท';
}

/**
 * ฟังก์ชันสำหรับ debug (แสดงเฉพาะ development mode)
 * 
 * @param mixed $data ข้อมูลที่ต้องการ debug
 * @param bool $exit ต้องการ exit หลัง debug หรือไม่
 * @return void
 */
function debug($data, $exit = false)
{
    if (ini_get('display_errors') == 1) {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        
        if ($exit) {
            exit();
        }
    }
}

// =====================================================
// เริ่มต้น Session
// =====================================================
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// =====================================================
// ตั้งค่า Header สำหรับ Security
// =====================================================
header('X-Frame-Options: SAMEORIGIN');
header('X-Content-Type-Options: nosniff');
header('X-XSS-Protection: 1; mode=block');

?>
