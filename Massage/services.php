<?php
/**
 * หน้าแสดงบริการทั้งหมด
 * แสดงบริการนวดทั้งหมดที่ร้านมีให้บริการ
 * 
 * @author Software Engineer Team
 * @version 1.0
 * @since 2025-12-23
 */

// โหลด configuration
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/database.php';

// ตั้งค่า page title และ description
$page_title = 'บริการของเรา';
$page_description = 'บริการนวดครบวงจร นวดแผนไทย นวดน้ำมัน นวดฝ่าเท้า นวดบำบัด และบริการนวดเพื่อสุขภาพอื่นๆ ราคาเป็นมิตร';

// โหลด header และ navbar
include __DIR__ . '/includes/header.php';
include __DIR__ . '/includes/navbar.php';

// ดึงข้อมูลบริการทั้งหมดจาก database
$db = getDatabase();
$services = $db->select("SELECT * FROM services WHERE is_active = 1 ORDER BY price ASC");
?>

<main class="min-h-screen">
    <!-- Page Header -->
    <section class="bg-gradient-to-r from-primary-600 to-secondary-500 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">
                    <i class="fas fa-spa mr-3"></i>
                    บริการของเรา
                </h1>
                <p class="text-xl md:text-2xl text-gray-100 max-w-3xl mx-auto">
                    เลือกบริการนวดที่ตรงกับความต้องการของคุณ<br>
                    พร้อมนักบำบัดมืออาชีพและราคาเป็นมิตร
                </p>
            </div>
        </div>
    </section>

    <!-- Services Grid -->
    <section class="py-16" style="background-color: #EAE7DC;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <?php if ($services && count($services) > 0): ?>
            
            <!-- Services Count -->
            <div class="mb-8 text-center">
                <p class="text-lg text-gray-600">
                    พบทั้งหมด <span class="font-bold text-primary-600"><?php echo count($services); ?></span> บริการ
                </p>
            </div>
            
            <!-- Services Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($services as $index => $service): ?>
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300 transform hover:-translate-y-2"
                     data-aos="fade-up" 
                     data-aos-delay="<?php echo ($index % 3) * 100; ?>">
                    
                    <!-- Service Image -->
                    <div class="relative h-56 bg-gradient-to-r from-primary-500 to-secondary-500 overflow-hidden">
                        <img src="<?php echo htmlspecialchars($service['image_url']); ?>" 
                             alt="<?php echo htmlspecialchars($service['name']); ?>"
                             class="w-full h-full object-cover opacity-90 hover:scale-110 transition duration-300">
                        
                        <!-- Price Badge -->
                        <div class="absolute top-4 right-4 bg-white text-primary-600 px-4 py-2 rounded-full shadow-lg font-bold">
                            <?php echo number_format($service['price'], 0); ?> ฿
                        </div>
                    </div>
                    
                    <!-- Service Info -->
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-gray-800 mb-3">
                            <?php echo htmlspecialchars($service['name']); ?>
                        </h3>
                        
                        <p class="text-gray-600 mb-4 leading-relaxed">
                            <?php echo htmlspecialchars($service['description']); ?>
                        </p>
                        
                        <!-- Duration & Price -->
                        <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-200">
                            <div class="flex items-center text-gray-700">
                                <i class="fas fa-clock text-primary-600 mr-2"></i>
                                <span class="font-medium"><?php echo $service['duration']; ?> นาที</span>
                            </div>
                            <div class="text-2xl font-bold text-primary-600">
                                <?php echo format_price($service['price']); ?>
                            </div>
                        </div>
                        
                        <!-- Book Button -->
                        <a href="<?php echo BASE_URL; ?>/booking.php?service_id=<?php echo $service['id']; ?>" 
                           class="block w-full bg-primary-600 hover:bg-primary-700 text-white text-center py-3 rounded-lg font-semibold transition duration-200 shadow-md hover:shadow-lg"
                           aria-label="จองบริการ <?php echo htmlspecialchars($service['name']); ?>">
                            <i class="fas fa-calendar-check mr-2"></i>
                            จองบริการนี้
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <?php else: ?>
            
            <!-- No Services Found -->
            <div class="text-center py-16">
                <div class="bg-white rounded-xl shadow-lg p-12 max-w-md mx-auto">
                    <i class="fas fa-exclamation-triangle text-6xl text-gray-400 mb-6"></i>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">ไม่พบบริการ</h3>
                    <p class="text-gray-600 mb-6">
                        ขณะนี้ยังไม่มีบริการที่เปิดให้จองในระบบ<br>
                        กรุณาติดต่อร้านเพื่อสอบถามข้อมูลเพิ่มเติม
                    </p>
                    <a href="<?php echo BASE_URL; ?>/contact.php" 
                       class="inline-block bg-primary-600 hover:bg-primary-700 text-white px-8 py-3 rounded-lg font-semibold transition duration-200">
                        ติดต่อเรา
                    </a>
                </div>
            </div>
            
            <?php endif; ?>
            
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                    ทำไมต้องเลือกบริการของเรา?
                </h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Benefit 1 -->
                <div class="text-center">
                    <div class="bg-primary-100 w-20 h-20 rounded-full flex items-center justify-center mb-4 mx-auto">
                        <i class="fas fa-certificate text-4xl text-primary-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">รับรองมาตรฐาน</h3>
                    <p class="text-gray-600">
                        นักบำบัดผ่านการอบรมและมีใบรับรองมาตรฐาน
                    </p>
                </div>
                
                <!-- Benefit 2 -->
                <div class="text-center">
                    <div class="bg-green-100 w-20 h-20 rounded-full flex items-center justify-center mb-4 mx-auto">
                        <i class="fas fa-leaf text-4xl text-green-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">ผลิตภัณฑ์ธรรมชาติ</h3>
                    <p class="text-gray-600">
                        ใช้น้ำมันและครีมจากธรรมชาติ ปลอดภัยต่อผิว
                    </p>
                </div>
                
                <!-- Benefit 3 -->
                <div class="text-center">
                    <div class="bg-yellow-100 w-20 h-20 rounded-full flex items-center justify-center mb-4 mx-auto">
                        <i class="fas fa-heart text-4xl text-yellow-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">ใส่ใจทุกรายละเอียด</h3>
                    <p class="text-gray-600">
                        บริการด้วยความเป็นมิตรและใส่ใจในทุกขั้นตอน
                    </p>
                </div>
                
                <!-- Benefit 4 -->
                <div class="text-center">
                    <div class="bg-blue-100 w-20 h-20 rounded-full flex items-center justify-center mb-4 mx-auto">
                        <i class="fas fa-shield-alt text-4xl text-blue-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">สะอาด ปลอดภัย</h3>
                    <p class="text-gray-600">
                        สถานที่สะอาด เครื่องมือฆ่าเชื้อทุกครั้ง
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-r from-primary-600 to-secondary-500 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-6">
                พร้อมจองบริการแล้วหรือยัง?
            </h2>
            <p class="text-xl mb-8 text-gray-100 max-w-2xl mx-auto">
                จองคิวออนไลน์ง่ายๆ ได้ทันที เลือกวันและเวลาที่สะดวกสำหรับคุณ
            </p>
            <a href="<?php echo BASE_URL; ?>/booking.php" 
               class="inline-block bg-white text-primary-600 hover:bg-gray-100 px-10 py-4 rounded-lg text-lg font-bold transition duration-200 shadow-xl hover:shadow-2xl transform hover:-translate-y-1"
               aria-label="จองคิวทันที">
                <i class="fas fa-calendar-plus mr-2"></i>
                จองคิวทันที
            </a>
        </div>
    </section>
</main>

<?php
// โหลด footer
include __DIR__ . '/includes/footer.php';
?>
