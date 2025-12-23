<?php
/**
 * หน้าแรก - Landing Page
 * แสดงข้อมูลหลักของร้านนวดและปุ่ม CTA สำหรับจองคิว
 * 
 * @author Software Engineer Team
 * @version 1.0
 * @since 2025-12-23
 */

// โหลด configuration
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/database.php';

// ตั้งค่า page title และ description
$page_title = 'หน้าแรก';
$page_description = 'ร้านนวดสุขภาพ บริการนวดแผนไทย นวดน้ำมัน นวดฝ่าเท้า และบริการนวดเพื่อสุขภาพอื่นๆ จองคิวออนไลน์ได้ตลอด 24 ชม.';

// โหลด header และ navbar
include __DIR__ . '/includes/header.php';
include __DIR__ . '/includes/navbar.php';

// ดึงข้อมูลบริการจาก database (แสดงแค่ 6 รายการ)
$db = getDatabase();
$services = $db->select("SELECT * FROM services WHERE is_active = 1 ORDER BY id ASC LIMIT 6");
?>

<main>
    <!-- Hero Section -->
    <section class="relative text-white" style="background-image: url('<?php echo BASE_URL; ?>/assets/images/11.jpg'); background-size: cover; background-position: center;">
        <div class="absolute inset-0 bg-black opacity-30"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 animate-fade-in">
                    ยินดีต้อนรับสู่ <?php echo SITE_NAME; ?>
                </h1>
                <p class="text-xl md:text-2xl mb-8 text-gray-100 max-w-3xl mx-auto leading-relaxed">
                    บริการนวดเพื่อสุขภาพและความผ่อนคลาย<br>
                    ด้วยทีมงานมืออาชีพและประสบการณ์มากกว่า 10 ปี
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a href="<?php echo BASE_URL; ?>/booking.php" 
                       class="bg-white text-primary-600 hover:bg-gray-100 px-8 py-4 rounded-lg text-lg font-bold transition duration-200 shadow-xl hover:shadow-2xl transform hover:-translate-y-1 w-full sm:w-auto text-center"
                       aria-label="จองคิวตอนนี้">
                        <i class="fas fa-calendar-check mr-2"></i>
                        จองคิวตอนนี้
                    </a>
                    <a href="#services" 
                       class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-primary-600 px-8 py-4 rounded-lg text-lg font-bold transition duration-200 w-full sm:w-auto text-center"
                       aria-label="ดูบริการของเรา">
                        <i class="fas fa-info-circle mr-2"></i>
                        ดูบริการของเรา
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Wave SVG -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 0L60 10C120 20 240 40 360 46.7C480 53 600 47 720 43.3C840 40 960 40 1080 46.7C1200 53 1320 67 1380 73.3L1440 80V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0V0Z" fill="#F9FAFB"/>
            </svg>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16" style="background-color: #EAE7DC;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                    ทำไมต้องเลือกเรา?
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    เราให้บริการด้วยความใส่ใจและมาตรฐานสูงสุด เพื่อสุขภาพและความพึงพอใจของคุณ
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition duration-300 transform hover:-translate-y-2">
                    <div class="bg-cream-100 w-16 h-16 rounded-full flex items-center justify-center mb-6 mx-auto">
                        <i class="fas fa-user-nurse text-3xl text-primary-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3 text-center">นักบำบัดมืออาชีพ</h3>
                    <p class="text-gray-600 text-center leading-relaxed">
                        ทีมงานที่ผ่านการอบรมและมีใบรับรองมาตรฐาน พร้อมประสบการณ์มากกว่า 5 ปี
                    </p>
                </div>
                
                <!-- Feature 2 -->
                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition duration-300 transform hover:-translate-y-2">
                    <div class="bg-cream-100 w-16 h-16 rounded-full flex items-center justify-center mb-6 mx-auto">
                        <i class="fas fa-shield-alt text-3xl text-primary-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3 text-center">มาตรฐานสูง</h3>
                    <p class="text-gray-600 text-center leading-relaxed">
                        สถานที่สะอาดปลอดภัย เครื่องมือฆ่าเชื้อทุกครั้งหลังใช้งาน ตามมาตรฐานสาธารณสุข
                    </p>
                </div>
                
                <!-- Feature 3 -->
                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition duration-300 transform hover:-translate-y-2">
                    <div class="bg-cream-100 w-16 h-16 rounded-full flex items-center justify-center mb-6 mx-auto">
                        <i class="fas fa-clock text-3xl text-primary-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3 text-center">จองง่าย 24 ชม.</h3>
                    <p class="text-gray-600 text-center leading-relaxed">
                        จองคิวออนไลน์ได้ตลอด 24 ชั่วโมง สะดวก รวดเร็ว ไม่ต้องโทรศัพท์รอ
                    </p>
                </div>
                
                <!-- Feature 4 -->
                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition duration-300 transform hover:-translate-y-2">
                    <div class="bg-cream-100 w-16 h-16 rounded-full flex items-center justify-center mb-6 mx-auto">
                        <i class="fas fa-star text-3xl text-primary-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3 text-center">บริการหลากหลาย</h3>
                    <p class="text-gray-600 text-center leading-relaxed">
                        นวดแผนไทย นวดน้ำมัน นวดฝ่าเท้า และบริการนวดครบวงจร ตรงความต้องการ
                    </p>
                </div>
                
                <!-- Feature 5 -->
                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition duration-300 transform hover:-translate-y-2">
                    <div class="bg-cream-100 w-16 h-16 rounded-full flex items-center justify-center mb-6 mx-auto">
                        <i class="fas fa-hand-holding-heart text-3xl text-primary-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3 text-center">ใส่ใจลูกค้า</h3>
                    <p class="text-gray-600 text-center leading-relaxed">
                        บริการที่เป็นกันเอง รับฟังความต้องการ และปรับแต่งตามความเหมาะสม
                    </p>
                </div>
                
                <!-- Feature 6 -->
                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition duration-300 transform hover:-translate-y-2">
                    <div class="bg-cream-100 w-16 h-16 rounded-full flex items-center justify-center mb-6 mx-auto">
                        <i class="fas fa-tags text-3xl text-primary-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3 text-center">ราคาเป็นมิตร</h3>
                    <p class="text-gray-600 text-center leading-relaxed">
                        ราคายุติธรรม คุ้มค่า พร้อมโปรโมชั่นและส่วนลดพิเศษสำหรับสมาชิก
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                    บริการของเรา
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    เลือกบริการนวดที่ตรงกับความต้องการของคุณ พร้อมนักบำบัดมืออาชีพ
                </p>
            </div>
            
            <?php if ($services && count($services) > 0): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($services as $service): ?>
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300 transform hover:-translate-y-2">
                    <div class="relative h-48 bg-gradient-to-r from-primary-500 to-secondary-500">
                        <img src="<?php echo htmlspecialchars($service['image_url']); ?>" 
                             alt="<?php echo htmlspecialchars($service['name']); ?>"
                             class="w-full h-full object-cover opacity-80">
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">
                            <?php echo htmlspecialchars($service['name']); ?>
                        </h3>
                        <p class="text-gray-600 mb-4 leading-relaxed line-clamp-3">
                            <?php echo htmlspecialchars($service['description']); ?>
                        </p>
                        <div class="flex justify-between items-center mb-4">
                            <div class="flex items-center text-gray-700">
                                <i class="fas fa-clock mr-2 text-primary-600"></i>
                                <span class="font-medium"><?php echo $service['duration']; ?> นาที</span>
                            </div>
                            <div class="text-2xl font-bold text-primary-600">
                                <?php echo number_format($service['price'], 0); ?> ฿
                            </div>
                        </div>
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
            
            <div class="text-center mt-12">
                <a href="<?php echo BASE_URL; ?>/services.php" 
                   class="inline-block bg-gray-800 hover:bg-gray-900 text-white px-8 py-3 rounded-lg font-semibold transition duration-200 shadow-md hover:shadow-lg"
                   aria-label="ดูบริการทั้งหมด">
                    ดูบริการทั้งหมด
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
            <?php else: ?>
            <div class="text-center py-12">
                <i class="fas fa-exclamation-triangle text-6xl text-gray-400 mb-4"></i>
                <p class="text-xl text-gray-600">ไม่พบข้อมูลบริการในขณะนี้</p>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-r from-primary-600 to-secondary-500 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-6">
                พร้อมผ่อนคลายและดูแลสุขภาพแล้วหรือยัง?
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

    <!-- Contact Section -->
    <section class="py-16" style="background-color: #EAE7DC;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                    ติดต่อเรา
                </h2>
                <p class="text-lg text-gray-600">
                    สอบถามข้อมูลเพิ่มเติมหรือติดต่อเราได้ทุกช่องทาง
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Phone -->
                <div class="bg-white rounded-xl shadow-lg p-8 text-center hover:shadow-xl transition duration-300">
                    <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mb-4 mx-auto">
                        <i class="fas fa-phone text-3xl text-blue-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">โทรศัพท์</h3>
                    <a href="tel:<?php echo str_replace('-', '', SHOP_PHONE); ?>" 
                       class="text-gray-600 hover:text-primary-600 transition duration-200">
                        <?php echo SHOP_PHONE; ?>
                    </a>
                    <br>
                    <a href="tel:<?php echo str_replace('-', '', SHOP_MOBILE); ?>" 
                       class="text-gray-600 hover:text-primary-600 transition duration-200">
                        <?php echo SHOP_MOBILE; ?>
                    </a>
                </div>
                
                <!-- Email -->
                <div class="bg-white rounded-xl shadow-lg p-8 text-center hover:shadow-xl transition duration-300">
                    <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mb-4 mx-auto">
                        <i class="fas fa-envelope text-3xl text-green-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">อีเมล</h3>
                    <a href="mailto:<?php echo SHOP_EMAIL; ?>" 
                       class="text-gray-600 hover:text-primary-600 transition duration-200">
                        <?php echo SHOP_EMAIL; ?>
                    </a>
                </div>
                
                <!-- LINE -->
                <div class="bg-white rounded-xl shadow-lg p-8 text-center hover:shadow-xl transition duration-300">
                    <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mb-4 mx-auto">
                        <i class="fab fa-line text-3xl text-green-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">LINE</h3>
                    <a href="<?php echo SOCIAL_MEDIA['line']; ?>" 
                       target="_blank"
                       rel="noopener noreferrer"
                       class="text-gray-600 hover:text-primary-600 transition duration-200">
                        <?php echo SHOP_LINE; ?>
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
// โหลด footer
include __DIR__ . '/includes/footer.php';
?>
