<?php
/**
 * API: ตรวจสอบความว่างของนักบำบัด
 * POST /api/check_availability.php
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
    
    // Validate input
    $therapist_id = isset($data['therapist_id']) ? (int)$data['therapist_id'] : null;
    $booking_date = isset($data['booking_date']) ? trim($data['booking_date']) : '';
    $booking_time = isset($data['booking_time']) ? trim($data['booking_time']) : '';
    $service_duration = isset($data['service_duration']) ? (int)$data['service_duration'] : 0;
    
    if (empty($booking_date) || empty($booking_time) || $service_duration <= 0) {
        throw new Exception('ข้อมูลไม่ครบถ้วน');
    }
    
    // เชื่อมต่อ database
    $db = getDatabase();
    
    // ถ้าไม่ระบุ therapist_id (หมอนวดว่าง) ให้ถือว่าว่าง
    if (!$therapist_id) {
        echo json_encode([
            'success' => true,
            'available' => true,
            'message' => 'ระบบจะจัดหมอนวดที่ว่างให้อัตโนมัติ'
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }
    
    // คำนวณเวลาสิ้นสุด
    $end_time = date('H:i:s', strtotime($booking_time) + ($service_duration * 60));
    
    // ตรวจสอบการจองที่ซ้อนทับ
    $sql = "SELECT COUNT(*) as count 
            FROM bookings 
            WHERE therapist_id = " . $db->escape($therapist_id) . "
            AND booking_date = '" . $db->escape($booking_date) . "'
            AND status NOT IN ('cancelled')
            AND (
                (booking_time <= '" . $db->escape($booking_time) . "' AND 
                 DATE_ADD(CONCAT(booking_date, ' ', booking_time), INTERVAL (SELECT duration FROM services WHERE id = service_id) MINUTE) > '" . $db->escape($booking_date) . " " . $db->escape($booking_time) . "')
                OR
                (booking_time < '" . $db->escape($end_time) . "' AND booking_time >= '" . $db->escape($booking_time) . "')
            )";
    
    $result = $db->selectOne($sql);
    $count = (int)$result['count'];
    
    $available = ($count == 0);
    
    echo json_encode([
        'success' => true,
        'available' => $available,
        'message' => $available ? 'ช่วงเวลานี้ว่าง' : 'ช่วงเวลานี้ไม่ว่าง กรุณาเลือกเวลาอื่น'
    ], JSON_UNESCAPED_UNICODE);
    
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'available' => false,
        'message' => 'เกิดข้อผิดพลาด: ' . $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}
?>
