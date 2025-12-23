<?php
/**
 * หน้าจองคิว - CORE FEATURE
 * ฟอร์มจองคิวออนไลน์พร้อม validation และ AJAX
 * 
 * @author Software Engineer Team
 * @version 1.0
 * @since 2025-12-23
 */

// โหลด configuration
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/database.php';

// ตั้งค่า page title และ description
$page_title = 'จองคิว';
$page_description = 'จองคิวนวดออนไลน์ เลือกบริการ วันเวลา และหมอนวดได้ตามต้องการ สะดวก รวดเร็ว ไม่ต้องโทรศัพท์รอ';

// โหลด header และ navbar
include __DIR__ . '/includes/header.php';
include __DIR__ . '/includes/navbar.php';

// ดึงข้อมูล pre-selected (ถ้ามี)
$selected_service_id = isset($_GET['service_id']) ? (int)$_GET['service_id'] : 0;
$selected_therapist_id = isset($_GET['therapist_id']) ? (int)$_GET['therapist_id'] : 0;
?>

<main class="min-h-screen">
    <!-- Page Header -->
    <section class="bg-gradient-to-r from-primary-600 to-secondary-500 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">
                    <i class="fas fa-calendar-check mr-3"></i>
                    จองคิวออนไลน์
                </h1>
                <p class="text-xl text-gray-100 max-w-2xl mx-auto">
                    กรอกข้อมูลด้านล่างเพื่อจองคิว<br>
                    เลือกบริการ วันเวลา และหมอนวดที่คุณต้องการ
                </p>
            </div>
        </div>
    </section>

    <!-- Booking Form Section -->
    <section class="py-16" style="background-color: #EAE7DC;">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Progress Steps -->
            <div class="mb-12">
                <div class="flex items-center justify-center">
                    <div class="flex items-center">
                        <div class="flex items-center justify-center w-10 h-10 bg-primary-600 text-white rounded-full font-bold">
                            1
                        </div>
                        <span class="ml-3 text-primary-600 font-semibold">เลือกบริการ</span>
                    </div>
                    <div class="w-16 h-1 bg-gray-300 mx-4"></div>
                    <div class="flex items-center">
                        <div class="flex items-center justify-center w-10 h-10 bg-gray-300 text-gray-600 rounded-full font-bold">
                            2
                        </div>
                        <span class="ml-3 text-gray-600 font-semibold">กรอกข้อมูล</span>
                    </div>
                    <div class="w-16 h-1 bg-gray-300 mx-4"></div>
                    <div class="flex items-center">
                        <div class="flex items-center justify-center w-10 h-10 bg-gray-300 text-gray-600 rounded-full font-bold">
                            3
                        </div>
                        <span class="ml-3 text-gray-600 font-semibold">ยืนยัน</span>
                    </div>
                </div>
            </div>
            
            <!-- Booking Form -->
            <div class="bg-white rounded-xl shadow-lg p-8">
                <form id="bookingForm" class="space-y-6">
                    
                    <!-- Service Selection -->
                    <div>
                        <label for="service_id" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-spa text-primary-600 mr-2"></i>
                            เลือกบริการ <span class="text-red-500">*</span>
                        </label>
                        <select id="service_id" 
                                name="service_id" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-200"
                                required
                                aria-required="true">
                            <option value="">-- กรุณาเลือกบริการ --</option>
                        </select>
                        <p id="service_info" class="mt-2 text-sm text-gray-600"></p>
                    </div>
                    
                    <!-- Date & Time -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="booking_date" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-calendar text-primary-600 mr-2"></i>
                                เลือกวันที่ <span class="text-red-500">*</span>
                            </label>
                            <input type="date" 
                                   id="booking_date" 
                                   name="booking_date" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-200"
                                   required
                                   aria-required="true">
                        </div>
                        
                        <div>
                            <label for="booking_time" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-clock text-primary-600 mr-2"></i>
                                เลือกเวลา <span class="text-red-500">*</span>
                            </label>
                            <select id="booking_time" 
                                    name="booking_time" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-200"
                                    required
                                    aria-required="true">
                                <option value="">-- เลือกเวลา --</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Therapist Selection -->
                    <div>
                        <label for="therapist_id" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-user-nurse text-primary-600 mr-2"></i>
                            เลือกหมอนวด
                        </label>
                        <select id="therapist_id" 
                                name="therapist_id" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-200"
                                aria-label="เลือกหมอนวดหรือหมอนวดว่าง">
                            <option value="">-- หมอนวดว่าง (ระบบจัดให้อัตโนมัติ) --</option>
                        </select>
                        <p class="mt-2 text-sm text-gray-500">
                            <i class="fas fa-info-circle mr-1"></i>
                            ถ้าไม่เลือก ระบบจะจัดหมอนวดที่ว่างให้อัตโนมัติ
                        </p>
                    </div>
                    
                    <!-- Customer Information -->
                    <div class="border-t border-gray-200 pt-6 mt-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">
                            <i class="fas fa-user text-primary-600 mr-2"></i>
                            ข้อมูลลูกค้า
                        </h3>
                        
                        <!-- Name -->
                        <div class="mb-4">
                            <label for="customer_name" class="block text-sm font-semibold text-gray-700 mb-2">
                                ชื่อ-นามสกุล <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="customer_name" 
                                   name="customer_name" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-200"
                                   placeholder="กรอกชื่อ-นามสกุล"
                                   required
                                   aria-required="true"
                                   minlength="2"
                                   maxlength="100">
                        </div>
                        
                        <!-- Phone & Email -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="customer_phone" class="block text-sm font-semibold text-gray-700 mb-2">
                                    เบอร์โทรศัพท์ <span class="text-red-500">*</span>
                                </label>
                                <input type="tel" 
                                       id="customer_phone" 
                                       name="customer_phone" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-200"
                                       placeholder="0812345678"
                                       required
                                       aria-required="true"
                                       pattern="[0-9]{10}"
                                       maxlength="10">
                                <p class="mt-1 text-xs text-gray-500">รูปแบบ: 10 หลัก (ตัวอย่าง: 0812345678)</p>
                            </div>
                            
                            <div>
                                <label for="customer_email" class="block text-sm font-semibold text-gray-700 mb-2">
                                    อีเมล (ไม่บังคับ)
                                </label>
                                <input type="email" 
                                       id="customer_email" 
                                       name="customer_email" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-200"
                                       placeholder="email@example.com"
                                       aria-label="อีเมล">
                            </div>
                        </div>
                        
                        <!-- Notes -->
                        <div>
                            <label for="notes" class="block text-sm font-semibold text-gray-700 mb-2">
                                หมายเหตุเพิ่มเติม (ไม่บังคับ)
                            </label>
                            <textarea id="notes" 
                                      name="notes" 
                                      rows="3" 
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-200"
                                      placeholder="ระบุความต้องการพิเศษ เช่น นวดแรงหน่อย, มีอาการปวดบริเวณใด"
                                      maxlength="500"
                                      aria-label="หมายเหตุ"></textarea>
                            <p class="mt-1 text-xs text-gray-500 text-right">
                                <span id="notes_count">0</span>/500 ตัวอักษร
                            </p>
                        </div>
                    </div>
                    
                    <!-- Submit Button -->
                    <div class="border-t border-gray-200 pt-6 mt-6">
                        <button type="submit" 
                                id="submitBtn"
                                class="w-full bg-primary-600 hover:bg-primary-700 text-white py-4 rounded-lg text-lg font-bold transition duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-1"
                                aria-label="ยืนยันการจอง">
                            <i class="fas fa-check-circle mr-2"></i>
                            ยืนยันการจอง
                        </button>
                        
                        <p class="mt-4 text-sm text-gray-500 text-center">
                            <i class="fas fa-lock mr-1"></i>
                            ข้อมูลของคุณจะถูกเก็บเป็นความลับและปลอดภัย
                        </p>
                    </div>
                    
                </form>
            </div>
            
            <!-- Help Text -->
            <div class="mt-8 bg-blue-50 rounded-lg p-6">
                <h3 class="text-lg font-bold text-blue-900 mb-3">
                    <i class="fas fa-question-circle mr-2"></i>
                    ต้องการความช่วยเหลือ?
                </h3>
                <p class="text-blue-800 mb-2">
                    หากมีข้อสงสัยหรือต้องการความช่วยเหลือในการจองคิว สามารถติดต่อเราได้ที่:
                </p>
                <div class="flex flex-wrap gap-4 mt-3">
                    <a href="tel:<?php echo str_replace('-', '', SHOP_MOBILE); ?>" 
                       class="inline-flex items-center text-blue-800 hover:text-blue-900 font-semibold">
                        <i class="fas fa-phone mr-2"></i>
                        <?php echo SHOP_MOBILE; ?>
                    </a>
                    <a href="<?php echo SOCIAL_MEDIA['line']; ?>" 
                       target="_blank"
                       rel="noopener noreferrer"
                       class="inline-flex items-center text-blue-800 hover:text-blue-900 font-semibold">
                        <i class="fab fa-line mr-2"></i>
                        LINE: <?php echo SHOP_LINE; ?>
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

<!-- Booking JavaScript -->
<script src="<?php echo JS_PATH; ?>/booking.js"></script>
<script>
    // Pass PHP variables to JavaScript
    const BOOKING_CONFIG = {
        selectedServiceId: <?php echo $selected_service_id; ?>,
        selectedTherapistId: <?php echo $selected_therapist_id; ?>,
        apiUrl: '<?php echo BASE_URL; ?>/api',
        minDate: '<?php echo date('Y-m-d'); ?>'
    };
</script>
