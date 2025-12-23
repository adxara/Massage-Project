<?php
/**
 * API: ดึงข้อมูลบริการทั้งหมด
 * GET /api/get_services.php
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
    
    // ดึงข้อมูลบริการที่เปิดใช้งาน
    $sql = "SELECT id, name, description, duration, price, image_url 
            FROM services 
            WHERE is_active = 1 
            ORDER BY price ASC";
    
    $services = $db->select($sql);
    
    if ($services === false) {
        throw new Exception('ไม่สามารถดึงข้อมูลจาก database ได้');
    }
    
    // แปลง price เป็น float
    foreach ($services as &$service) {
        $service['price'] = (float)$service['price'];
        $service['duration'] = (int)$service['duration'];
    }
    
    // ส่งผลลัพธ์
    echo json_encode([
        'success' => true,
        'data' => $services,
        'count' => count($services)
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'เกิดข้อผิดพลาด: ' . $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}
?>
