-- =====================================================
-- Database Schema สำหรับระบบจองคิวร้านนวด
-- Version: 1.0
-- Date: 2025-12-23
-- =====================================================

-- สร้างฐานข้อมูล
CREATE DATABASE IF NOT EXISTS massage_booking 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

USE massage_booking;

-- =====================================================
-- ตาราง: services (บริการนวด)
-- =====================================================
CREATE TABLE IF NOT EXISTS services (
    id INT(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL COMMENT 'ชื่อบริการ',
    description TEXT DEFAULT NULL COMMENT 'รายละเอียดบริการ',
    duration INT(11) NOT NULL COMMENT 'ระยะเวลา (นาที)',
    price DECIMAL(10,2) NOT NULL COMMENT 'ราคา (บาท)',
    image_url VARCHAR(500) DEFAULT NULL COMMENT 'URL รูปภาพ',
    is_active TINYINT(1) DEFAULT 1 COMMENT 'สถานะเปิด/ปิดบริการ (1=เปิด, 0=ปิด)',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'วันที่สร้าง',
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'วันที่แก้ไขล่าสุด',
    PRIMARY KEY (id),
    KEY idx_is_active (is_active)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ข้อมูลตัวอย่าง services
INSERT INTO services (name, description, duration, price, image_url, is_active) VALUES
('นวดแผนไทย', 'นวดแผนไทยแท้ ผ่อนคลายกล้ามเนื้อ บรรเทาอาการปวดเมื่อย เหมาะสำหรับผู้ที่ใช้แรงงานหนักหรือทำงานหนักมาก', 60, 300.00, 'https://via.placeholder.com/400x300/6366f1/ffffff?text=Thai+Massage', 1),
('นวดน้ำมัน', 'นวดด้วยน้ำมันหอมระเหย ผ่อนคลายความเครียด ช่วยให้จิตใจสงบ ผิวพรรณเนียนนุ่ม เหมาะสำหรับการพักผ่อน', 90, 500.00, 'https://via.placeholder.com/400x300/8b5cf6/ffffff?text=Oil+Massage', 1),
('นวดฝ่าเท้า', 'นวดกดจุดฝ่าเท้า กระตุ้นระบบไหลเวียนโลหิต ช่วยบรรเทาอาการเมื่อยล้า เหมาะสำหรับผู้ที่ยืนนานหรือเดินมาก', 45, 250.00, 'https://via.placeholder.com/400x300/ec4899/ffffff?text=Foot+Massage', 1),
('นวดหัวไหล่คอ', 'นวดเฉพาะจุดหัวไหล่ คอ และบ่า บรรเทาอาการปวดตึงจากการทำงานหน้าคอมพิวเตอร์ เหมาะสำหรับคนออฟฟิศ', 30, 200.00, 'https://via.placeholder.com/400x300/f59e0b/ffffff?text=Shoulder+Massage', 1),
('นวดบำบัด', 'นวดบำบัดเต็มรูปแบบ ผสมผสานเทคนิคนวดหลายแบบ เหมาะสำหรับผู้ที่มีอาการบาดเจ็บหรือปวดเรื้อรัง', 120, 800.00, 'https://via.placeholder.com/400x300/10b981/ffffff?text=Therapy+Massage', 1),
('นวดสปาเพื่อสุขภาพ', 'นวดแบบสปาครบวงจร รวมอบไอน้ำและนวดผ่อนคลายทั้งตัว ช่วยให้ร่างกายและจิตใจสดชื่น', 150, 1200.00, 'https://via.placeholder.com/400x300/6366f1/ffffff?text=Spa+Massage', 1);

-- =====================================================
-- ตาราง: therapists (หมอนวด/นักบำบัด)
-- =====================================================
CREATE TABLE IF NOT EXISTS therapists (
    id INT(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL COMMENT 'ชื่อ-นามสกุล',
    nickname VARCHAR(100) DEFAULT NULL COMMENT 'ชื่อเล่น',
    specialization TEXT DEFAULT NULL COMMENT 'ความเชี่ยวชาญ',
    experience_years INT(11) DEFAULT 0 COMMENT 'ประสบการณ์ (ปี)',
    image_url VARCHAR(500) DEFAULT NULL COMMENT 'URL รูปภาพ',
    is_available TINYINT(1) DEFAULT 1 COMMENT 'สถานะพร้อมให้บริการ (1=ว่าง, 0=ไม่ว่าง)',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'วันที่สร้าง',
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'วันที่แก้ไขล่าสุด',
    PRIMARY KEY (id),
    KEY idx_is_available (is_available)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ข้อมูลตัวอย่าง therapists
INSERT INTO therapists (name, nickname, specialization, experience_years, image_url, is_available) VALUES
('สมหญิง ใจดี', 'ป้อม', 'นวดแผนไทย, นวดบำบัด', 8, 'https://via.placeholder.com/300x300/6366f1/ffffff?text=Pom', 1),
('สมชาย มั่นคง', 'เต้', 'นวดน้ำมัน, นวดสปา', 5, 'https://via.placeholder.com/300x300/8b5cf6/ffffff?text=Tae', 1),
('สมใจ รักษา', 'นิด', 'นวดฝ่าเท้า, นวดเพื่อสุขภาพ', 6, 'https://via.placeholder.com/300x300/ec4899/ffffff?text=Nid', 1),
('สมศรี สุขใจ', 'แหม่ม', 'นวดแผนไทย, นวดน้ำมัน, นวดฝ่าเท้า', 10, 'https://via.placeholder.com/300x300/f59e0b/ffffff?text=Maem', 1),
('สมปอง บำรุง', 'ต้อม', 'นวดบำบัด, นวดหัวไหล่คอ', 7, 'https://via.placeholder.com/300x300/10b981/ffffff?text=Tom', 1);

-- =====================================================
-- ตาราง: bookings (การจองคิว)
-- =====================================================
CREATE TABLE IF NOT EXISTS bookings (
    id INT(11) NOT NULL AUTO_INCREMENT,
    service_id INT(11) NOT NULL COMMENT 'รหัสบริการ',
    therapist_id INT(11) DEFAULT NULL COMMENT 'รหัสหมอนวด (NULL = หมอนวดว่าง)',
    customer_name VARCHAR(255) NOT NULL COMMENT 'ชื่อ-นามสกุลลูกค้า',
    customer_phone VARCHAR(20) NOT NULL COMMENT 'เบอร์โทรศัพท์',
    customer_email VARCHAR(255) DEFAULT NULL COMMENT 'อีเมล (optional)',
    booking_date DATE NOT NULL COMMENT 'วันที่จอง',
    booking_time TIME NOT NULL COMMENT 'เวลาที่จอง',
    notes TEXT DEFAULT NULL COMMENT 'หมายเหตุเพิ่มเติม',
    status ENUM('pending', 'confirmed', 'completed', 'cancelled') DEFAULT 'pending' COMMENT 'สถานะการจอง',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'วันที่สร้างการจอง',
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'วันที่แก้ไขล่าสุด',
    PRIMARY KEY (id),
    KEY idx_service_id (service_id),
    KEY idx_therapist_id (therapist_id),
    KEY idx_booking_date (booking_date),
    KEY idx_status (status),
    KEY idx_booking_datetime (booking_date, booking_time),
    CONSTRAINT fk_booking_service FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE CASCADE,
    CONSTRAINT fk_booking_therapist FOREIGN KEY (therapist_id) REFERENCES therapists(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ข้อมูลตัวอย่าง bookings
INSERT INTO bookings (service_id, therapist_id, customer_name, customer_phone, customer_email, booking_date, booking_time, notes, status) VALUES
(1, 1, 'ทดสอบ การจอง', '0812345678', 'test@email.com', '2025-12-25', '14:00:00', 'ต้องการนวดแรงหน่อย', 'confirmed'),
(2, 2, 'สมศรี ทดสอบ', '0898765432', NULL, '2025-12-25', '15:30:00', NULL, 'confirmed'),
(3, NULL, 'สมพร ใจดี', '0811112222', 'somporn@email.com', '2025-12-26', '10:00:00', 'หมอนวดว่าง', 'pending');

-- =====================================================
-- ตาราง: working_hours (เวลาทำงานของหมอนวด)
-- =====================================================
CREATE TABLE IF NOT EXISTS working_hours (
    id INT(11) NOT NULL AUTO_INCREMENT,
    therapist_id INT(11) NOT NULL COMMENT 'รหัสหมอนวด',
    day_of_week TINYINT(1) NOT NULL COMMENT 'วันในสัปดาห์ (0=อาทิตย์, 1=จันทร์, ..., 6=เสาร์)',
    start_time TIME NOT NULL COMMENT 'เวลาเริ่มทำงาน',
    end_time TIME NOT NULL COMMENT 'เวลาเลิกงาน',
    is_working TINYINT(1) DEFAULT 1 COMMENT 'ทำงานในวันนี้หรือไม่ (1=ทำงาน, 0=หยุด)',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'วันที่สร้าง',
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'วันที่แก้ไขล่าสุด',
    PRIMARY KEY (id),
    KEY idx_therapist_day (therapist_id, day_of_week),
    CONSTRAINT fk_working_therapist FOREIGN KEY (therapist_id) REFERENCES therapists(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ข้อมูลตัวอย่าง working_hours (ตั้งค่าให้ทุกคนทำงานทุกวัน 10:00-20:00)
INSERT INTO working_hours (therapist_id, day_of_week, start_time, end_time, is_working) VALUES
-- Therapist 1 (ป้อม)
(1, 1, '10:00:00', '20:00:00', 1), -- จันทร์
(1, 2, '10:00:00', '20:00:00', 1), -- อังคาร
(1, 3, '10:00:00', '20:00:00', 1), -- พุธ
(1, 4, '10:00:00', '20:00:00', 1), -- พฤหัสฯ
(1, 5, '10:00:00', '20:00:00', 1), -- ศุกร์
(1, 6, '09:00:00', '21:00:00', 1), -- เสาร์
(1, 0, '09:00:00', '21:00:00', 1), -- อาทิตย์
-- Therapist 2 (เต้)
(2, 1, '10:00:00', '20:00:00', 1),
(2, 2, '10:00:00', '20:00:00', 1),
(2, 3, '10:00:00', '20:00:00', 1),
(2, 4, '10:00:00', '20:00:00', 1),
(2, 5, '10:00:00', '20:00:00', 1),
(2, 6, '09:00:00', '21:00:00', 1),
(2, 0, '09:00:00', '21:00:00', 1),
-- Therapist 3 (นิด)
(3, 1, '10:00:00', '20:00:00', 1),
(3, 2, '10:00:00', '20:00:00', 1),
(3, 3, '10:00:00', '20:00:00', 1),
(3, 4, '10:00:00', '20:00:00', 1),
(3, 5, '10:00:00', '20:00:00', 1),
(3, 6, '09:00:00', '21:00:00', 1),
(3, 0, '09:00:00', '21:00:00', 1),
-- Therapist 4 (แหม่ม)
(4, 1, '10:00:00', '20:00:00', 1),
(4, 2, '10:00:00', '20:00:00', 1),
(4, 3, '10:00:00', '20:00:00', 1),
(4, 4, '10:00:00', '20:00:00', 1),
(4, 5, '10:00:00', '20:00:00', 1),
(4, 6, '09:00:00', '21:00:00', 1),
(4, 0, '09:00:00', '21:00:00', 1),
-- Therapist 5 (ต้อม)
(5, 1, '10:00:00', '20:00:00', 1),
(5, 2, '10:00:00', '20:00:00', 1),
(5, 3, '10:00:00', '20:00:00', 1),
(5, 4, '10:00:00', '20:00:00', 1),
(5, 5, '10:00:00', '20:00:00', 1),
(5, 6, '09:00:00', '21:00:00', 1),
(5, 0, '09:00:00', '21:00:00', 1);

-- =====================================================
-- Views และ Stored Procedures (optional - สำหรับอนาคต)
-- =====================================================

-- View: ดูการจองพร้อมข้อมูลบริการและหมอนวด
CREATE OR REPLACE VIEW v_bookings_detail AS
SELECT 
    b.id,
    b.booking_date,
    b.booking_time,
    b.customer_name,
    b.customer_phone,
    b.customer_email,
    b.notes,
    b.status,
    s.name AS service_name,
    s.duration AS service_duration,
    s.price AS service_price,
    t.name AS therapist_name,
    t.nickname AS therapist_nickname,
    b.created_at
FROM bookings b
INNER JOIN services s ON b.service_id = s.id
LEFT JOIN therapists t ON b.therapist_id = t.id
ORDER BY b.booking_date DESC, b.booking_time DESC;

-- =====================================================
-- Indexes สำหรับเพิ่มประสิทธิภาพ
-- =====================================================
-- (ได้สร้างไว้ในตารางแล้ว)

-- =====================================================
-- สิ้นสุดการสร้าง Database Schema
-- =====================================================

-- แสดงข้อความยืนยัน
SELECT 'Database schema created successfully!' AS message;
