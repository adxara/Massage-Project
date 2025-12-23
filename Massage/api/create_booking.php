<?php
/**
 * API: สร้างการจองใหม่
 * POST /api/create_booking.php
 * 
 * @author Software Engineer Team
 * @version 1.0
 * @since 2025-12-23
 */

// กำหนดให้เป็น API endpoint
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// โหลด configuration
require_once dirname(__DIR__) . '/config/config.php';
require_once dirname(__DIR__) . '/config/database.php';

// ตรวจสอบว่าเป็น POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'message' => 'Method not allowed. Use POST request.'
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

try {
    // อ่านข้อมูล JSON จาก request body
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);
    
    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception('Invalid JSON format');
    }
    
    // รับข้อมูลจาก request
    $service_id = isset($data['service_id']) ? (int)$data['service_id'] : 0;
    $therapist_id = isset($data['therapist_id']) && !empty($data['therapist_id']) ? (int)$data['therapist_id'] : null;
    $customer_name = isset($data['customer_name']) ? trim($data['customer_name']) : '';
    $customer_phone = isset($data['customer_phone']) ? trim($data['customer_phone']) : '';
    $customer_email = isset($data['customer_email']) ? trim($data['customer_email']) : null;
    $booking_date = isset($data['booking_date']) ? trim($data['booking_date']) : '';
    $booking_time = isset($data['booking_time']) ? trim($data['booking_time']) : '';
    $notes = isset($data['notes']) ? trim($data['notes']) : null;
    
    // Validate ข้อมูลจำเป็น
    $errors = [];
    
    if ($service_id <= 0) {
        $errors[] = 'กรุณาเลือกบริการ';
    }
    
    if (empty($customer_name) || strlen($customer_name) < MIN_NAME_LENGTH || strlen($customer_name) > MAX_NAME_LENGTH) {
        $errors[] = 'ชื่อ-นามสกุลต้องมีความยาว ' . MIN_NAME_LENGTH . '-' . MAX_NAME_LENGTH . ' ตัวอักษร';
    }
    
    if (empty($customer_phone) || !preg_match('/^0[0-9]{9}$/', $customer_phone)) {
        $errors[] = 'เบอร์โทรศัพท์ไม่ถูกต้อง (ต้องเป็น 10 หลัก ขึ้นต้นด้วย 0)';
    }
    
    if (!empty($customer_email) && !filter_var($customer_email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'รูปแบบอีเมลไม่ถูกต้อง';
    }
    
    if (empty($booking_date)) {
        $errors[] = 'กรุณาเลือกวันที่';
    } elseif (strtotime($booking_date) < strtotime(date('Y-m-d'))) {
        $errors[] = 'ไม่สามารถจองย้อนหลังได้';
    }
    
    if (empty($booking_time)) {
        $errors[] = 'กรุณาเลือกเวลา';
    }
    
    if (!empty($notes) && strlen($notes) > MAX_NOTES_LENGTH) {
        $errors[] = 'หมายเหตุยาวเกิน ' . MAX_NOTES_LENGTH . ' ตัวอักษร';
    }
    
    // ถ้ามี error ให้ส่งกลับ
    if (!empty($errors)) {
        throw new Exception(implode(', ', $errors));
    }
    
    // เชื่อมต่อ database
    $db = getDatabase();
    
    // ตรวจสอบว่ามี service อยู่จริง
    $service_check = $db->selectOne("SELECT id, duration FROM services WHERE id = " . $service_id . " AND is_active = 1");
    if (!$service_check) {
        throw new Exception('ไม่พบบริการที่เลือก');
    }
    
    // ถ้าระบุ therapist_id ให้ตรวจสอบความว่าง
    if ($therapist_id) {
        $therapist_check = $db->selectOne("SELECT id FROM therapists WHERE id = " . $therapist_id);
        if (!$therapist_check) {
            throw new Exception('ไม่พบนักบำบัดที่เลือก');
        }
        
        // ตรวจสอบความว่าง (คล้ายกับ check_availability.php)
        $duration = (int)$service_check['duration'];
        $end_time = date('H:i:s', strtotime($booking_time) + ($duration * 60));
        
        $conflict_sql = "SELECT COUNT(*) as count 
                        FROM bookings 
                        WHERE therapist_id = " . $therapist_id . "
                        AND booking_date = '" . $db->escape($booking_date) . "'
                        AND status NOT IN ('cancelled')
                        AND (
                            (booking_time <= '" . $db->escape($booking_time) . "' AND 
                             DATE_ADD(CONCAT(booking_date, ' ', booking_time), INTERVAL (SELECT duration FROM services WHERE id = service_id) MINUTE) > '" . $db->escape($booking_date) . " " . $db->escape($booking_time) . "')
                            OR
                            (booking_time < '" . $db->escape($end_time) . "' AND booking_time >= '" . $db->escape($booking_time) . "')
                        )";
        
        $conflict_result = $db->selectOne($conflict_sql);
        if ((int)$conflict_result['count'] > 0) {
            throw new Exception('ช่วงเวลานี้นักบำบัดไม่ว่าง กรุณาเลือกเวลาอื่น');
        }
    }
    
    // เตรียมข้อมูลสำหรับ insert
    $therapist_value = $therapist_id ? $therapist_id : 'NULL';
    $email_value = !empty($customer_email) ? "'" . $db->escape($customer_email) . "'" : 'NULL';
    $notes_value = !empty($notes) ? "'" . $db->escape($notes) . "'" : 'NULL';
    
    // Insert ข้อมูลการจอง
    $insert_sql = "INSERT INTO bookings 
                   (service_id, therapist_id, customer_name, customer_phone, customer_email, booking_date, booking_time, notes, status, created_at) 
                   VALUES 
                   ($service_id, $therapist_value, '" . $db->escape($customer_name) . "', '" . $db->escape($customer_phone) . "', $email_value, '" . $db->escape($booking_date) . "', '" . $db->escape($booking_time) . "', $notes_value, 'pending', NOW())";
    
    $booking_id = $db->insert($insert_sql);
    
    if (!$booking_id) {
        throw new Exception('ไม่สามารถบันทึกการจองได้');
    }
    
    // ส่งผลลัพธ์สำเร็จ
    echo json_encode([
        'success' => true,
        'booking_id' => $booking_id,
        'message' => 'จองคิวสำเร็จ! หมายเลขการจองของคุณคือ #' . $booking_id,
        'data' => [
            'booking_id' => $booking_id,
            'booking_date' => thai_date($booking_date),
            'booking_time' => thai_time($booking_time),
            'customer_name' => $customer_name,
            'customer_phone' => format_phone($customer_phone)
        ]
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}
?>
