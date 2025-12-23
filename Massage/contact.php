<?php
/**
 * หน้าติดต่อเรา
 * แสดงข้อมูลติดต่อร้าน เวลาทำการ และแผนที่
 * 
 * @author Software Engineer Team
 * @version 1.0
 * @since 2025-12-23
 */

// โหลด configuration
require_once __DIR__ . '/config/config.php';

// ตั้งค่า page title และ description
$page_title = 'ติดต่อเรา';
$page_description = 'ติดต่อร้านนวดสุขภาพ ที่อยู่ เบอร์โทร อีเมล และเวลาทำการ พร้อมแผนที่ตั้ง';

// โหลด header และ navbar
include __DIR__ . '/includes/header.php';
include __DIR__ . '/includes/navbar.php';
?>

<main class="min-h-screen">
    <!-- Page Header -->
    <section class="bg-gradient-to-r from-primary-600 to-secondary-500 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">
                    <i class="fas fa-envelope mr-3"></i>
                    ติดต่อเรา
                </h1>
                <p class="text-xl md:text-2xl text-gray-100 max-w-3xl mx-auto">
                    ยินดีให้บริการและตอบทุกคำถาม<br>
                    ติดต่อเราได้ทุกช่องทาง
                </p>
            </div>
        </div>
    </section>

    <!-- Contact Info Section -->
    <section class="py-16" style="background-color: #EAE7DC;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                
                <!-- Contact Information -->
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-8">
                        ข้อมูลติดต่อ
                    </h2>
                    
                    <div class="space-y-6">
                        <!-- Address -->
                        <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition duration-300">
                            <div class="flex items-start">
                                <div class="bg-primary-100 w-12 h-12 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                                    <i class="fas fa-map-marker-alt text-xl text-primary-600"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-800 mb-2">ที่อยู่</h3>
                                    <p class="text-gray-600 leading-relaxed">
                                        <?php echo SHOP_ADDRESS; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Phone -->
                        <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition duration-300">
                            <div class="flex items-start">
                                <div class="bg-blue-100 w-12 h-12 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                                    <i class="fas fa-phone text-xl text-blue-600"></i>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-lg font-bold text-gray-800 mb-2">โทรศัพท์</h3>
                                    <p class="text-gray-600 mb-1">
                                        <a href="tel:<?php echo str_replace('-', '', SHOP_PHONE); ?>" 
                                           class="hover:text-primary-600 transition duration-200">
                                            <?php echo SHOP_PHONE; ?>
                                        </a>
                                    </p>
                                    <p class="text-gray-600">
                                        <a href="tel:<?php echo str_replace('-', '', SHOP_MOBILE); ?>" 
                                           class="hover:text-primary-600 transition duration-200">
                                            <?php echo SHOP_MOBILE; ?>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Email -->
                        <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition duration-300">
                            <div class="flex items-start">
                                <div class="bg-green-100 w-12 h-12 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                                    <i class="fas fa-envelope text-xl text-green-600"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-800 mb-2">อีเมล</h3>
                                    <p class="text-gray-600">
                                        <a href="mailto:<?php echo SHOP_EMAIL; ?>" 
                                           class="hover:text-primary-600 transition duration-200">
                                            <?php echo SHOP_EMAIL; ?>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- LINE -->
                        <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition duration-300">
                            <div class="flex items-start">
                                <div class="bg-green-100 w-12 h-12 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                                    <i class="fab fa-line text-xl text-green-600"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-800 mb-2">LINE Official</h3>
                                    <p class="text-gray-600">
                                        <a href="<?php echo SOCIAL_MEDIA['line']; ?>" 
                                           target="_blank"
                                           rel="noopener noreferrer"
                                           class="hover:text-primary-600 transition duration-200">
                                            <?php echo SHOP_LINE; ?>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Working Hours & Map -->
                <div>
                    <!-- Working Hours -->
                    <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
                        <h2 class="text-3xl font-bold text-gray-800 mb-6">
                            <i class="fas fa-clock text-primary-600 mr-2"></i>
                            เวลาทำการ
                        </h2>
                        
                        <div class="space-y-4">
                            <div class="flex items-center justify-between py-3 border-b border-gray-200">
                                <span class="text-gray-700 font-medium">จันทร์ - ศุกร์</span>
                                <span class="text-primary-600 font-bold">10:00 - 20:00 น.</span>
                            </div>
                            <div class="flex items-center justify-between py-3 border-b border-gray-200">
                                <span class="text-gray-700 font-medium">เสาร์ - อาทิตย์</span>
                                <span class="text-primary-600 font-bold">09:00 - 21:00 น.</span>
                            </div>
                            <div class="flex items-center justify-between py-3">
                                <span class="text-gray-700 font-medium">วันหยุดนักขัตฤกษ์</span>
                                <span class="text-green-600 font-bold">เปิดทำการปกติ</span>
                            </div>
                        </div>
                        
                        <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                            <p class="text-sm text-blue-800">
                                <i class="fas fa-info-circle mr-2"></i>
                                <strong>หมายเหตุ:</strong> แนะนำให้จองคิวล่วงหน้าเพื่อความสะดวกของคุณ
                            </p>
                        </div>
                    </div>
                    
                    <!-- Map Placeholder -->
                    <div class="bg-white rounded-xl shadow-lg p-8">
                        <h2 class="text-3xl font-bold text-gray-800 mb-6">
                            <i class="fas fa-map text-primary-600 mr-2"></i>
                            แผนที่
                        </h2>
                        
                        <!-- Google Maps Embed (แทนที่ด้วย URL จริง) -->
                        <div class="relative h-64 bg-gray-200 rounded-lg overflow-hidden">
                            <div class="absolute inset-0 flex items-center justify-center text-gray-500">
                                <div class="text-center">
                                    <i class="fas fa-map-marked-alt text-6xl mb-4 text-gray-400"></i>
                                    <p class="text-lg font-medium">แผนที่ตั้งร้าน</p>
                                    <p class="text-sm text-gray-400 mt-2">
                                        (ใส่ Google Maps Embed Code ที่นี่)
                                    </p>
                                </div>
                            </div>
                            <!-- Uncomment และใส่ Google Maps URL จริง
                            <iframe 
                                src="https://www.google.com/maps/embed?pb=..."
                                width="100%" 
                                height="100%" 
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                            -->
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>

    <!-- Social Media Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                    ติดตามเราบน Social Media
                </h2>
                <p class="text-lg text-gray-600">
                    อัพเดทข่าวสารและโปรโมชั่นพิเศษได้ที่นี่
                </p>
            </div>
            
            <div class="flex justify-center space-x-6">
                <!-- Facebook -->
                <a href="<?php echo SOCIAL_MEDIA['facebook']; ?>" 
                   target="_blank" 
                   rel="noopener noreferrer"
                   class="group"
                   aria-label="Facebook">
                    <div class="w-20 h-20 bg-blue-600 hover:bg-blue-700 rounded-full flex items-center justify-center transition duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                        <i class="fab fa-facebook-f text-3xl text-white"></i>
                    </div>
                    <p class="text-center mt-2 text-sm text-gray-600 group-hover:text-blue-600">Facebook</p>
                </a>
                
                <!-- LINE -->
                <a href="<?php echo SOCIAL_MEDIA['line']; ?>" 
                   target="_blank" 
                   rel="noopener noreferrer"
                   class="group"
                   aria-label="LINE">
                    <div class="w-20 h-20 bg-green-500 hover:bg-green-600 rounded-full flex items-center justify-center transition duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                        <i class="fab fa-line text-3xl text-white"></i>
                    </div>
                    <p class="text-center mt-2 text-sm text-gray-600 group-hover:text-green-600">LINE</p>
                </a>
                
                <!-- Instagram -->
                <a href="<?php echo SOCIAL_MEDIA['instagram']; ?>" 
                   target="_blank" 
                   rel="noopener noreferrer"
                   class="group"
                   aria-label="Instagram">
                    <div class="w-20 h-20 bg-gradient-to-br from-accent-500 to-primary-500 hover:from-accent-600 hover:to-primary-600 rounded-full flex items-center justify-center transition duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                        <i class="fab fa-instagram text-3xl text-white"></i>
                    </div>
                    <p class="text-center mt-2 text-sm text-gray-600 group-hover:text-pink-600">Instagram</p>
                </a>
                
                <!-- Twitter -->
                <a href="<?php echo SOCIAL_MEDIA['twitter']; ?>" 
                   target="_blank" 
                   rel="noopener noreferrer"
                   class="group"
                   aria-label="Twitter">
                    <div class="w-20 h-20 bg-blue-400 hover:bg-blue-500 rounded-full flex items-center justify-center transition duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                        <i class="fab fa-twitter text-3xl text-white"></i>
                    </div>
                    <p class="text-center mt-2 text-sm text-gray-600 group-hover:text-blue-400">Twitter</p>
                </a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-r from-primary-600 to-secondary-500 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-6">
                พร้อมเริ่มต้นการดูแลสุขภาพแล้วหรือยัง?
            </h2>
            <p class="text-xl mb-8 text-gray-100 max-w-2xl mx-auto">
                จองคิวออนไลน์ง่ายๆ หรือโทรมาคุยกับเราได้เลย
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="<?php echo BASE_URL; ?>/booking.php" 
                   class="inline-block bg-white text-primary-600 hover:bg-gray-100 px-8 py-4 rounded-lg text-lg font-bold transition duration-200 shadow-xl hover:shadow-2xl"
                   aria-label="จองคิวออนไลน์">
                    <i class="fas fa-calendar-plus mr-2"></i>
                    จองคิวออนไลน์
                </a>
                <a href="tel:<?php echo str_replace('-', '', SHOP_MOBILE); ?>" 
                   class="inline-block bg-transparent border-2 border-white text-white hover:bg-white hover:text-primary-600 px-8 py-4 rounded-lg text-lg font-bold transition duration-200"
                   aria-label="โทรเลย">
                    <i class="fas fa-phone mr-2"></i>
                    โทรเลย <?php echo SHOP_MOBILE; ?>
                </a>
            </div>
        </div>
    </section>
</main>

<?php
// โหลด footer
include __DIR__ . '/includes/footer.php';
?>
