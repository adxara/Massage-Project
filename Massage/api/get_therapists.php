<?php
/**
 * API: ดึงข้อมูลนักบำบัดทั้งหมด
 * GET /api/get_therapists.php
 * 
 * @author Software Engineer Team
 * @version 1.0
 * @since 2025-12-23
 */

// กำหนดให้เป็น API endpoint
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');

// โหลด configuration
require_once dirname(__DIR__) . '/config/config.php';
require_once dirname(__DIR__) . '/config/database.php';

// ตรวจสอบว่าเป็น GET request
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'message' => 'Method not allowed. Use GET request.'
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

try {
    // เชื่อมต่อ database
    $db = getDatabase();
    
    // ดึงข้อมูลนักบำบัดทั้งหมด
    $sql = "SELECT id, name, nickname, specialization, experience_years, image_url, is_available 
            FROM therapists 
            ORDER BY experience_years DESC";
    
    $therapists = $db->select($sql);
    
    if ($therapists === false) {
        throw new Exception('ไม่สามารถดึงข้อมูลจาก database ได้');
    }
    
    // แปลงค่า boolean
    foreach ($therapists as &$therapist) {
        $therapist['is_available'] = (bool)$therapist['is_available'];
        $therapist['experience_years'] = (int)$therapist['experience_years'];
    }
    
    // ส่งผลลัพธ์
    echo json_encode([
        'success' => true,
        'data' => $therapists,
        'count' => count($therapists)
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'เกิดข้อผิดพลาด: ' . $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}
?>
