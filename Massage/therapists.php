<?php
/**
 * หน้าแสดงนักบำบัด/หมอนวด
 * แสดงข้อมูลนักบำบัดทั้งหมด พร้อมความเชี่ยวชาญ
 * 
 * @author Software Engineer Team
 * @version 1.0
 * @since 2025-12-23
 */

// โหลด configuration
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/database.php';

// ตั้งค่า page title และ description
$page_title = 'นักบำบัด';
$page_description = 'ทีมนักบำบัดมืออาชีพของเรา ผ่านการอบรมและมีประสบการณ์สูง พร้อมให้บริการด้วยความใส่ใจ';

// โหลด header และ navbar
include __DIR__ . '/includes/header.php';
include __DIR__ . '/includes/navbar.php';

// ดึงข้อมูลนักบำบัดทั้งหมดจาก database
$db = getDatabase();
$therapists = $db->select("SELECT * FROM therapists ORDER BY experience_years DESC");
?>

<main class="min-h-screen">
    <!-- Page Header -->
    <section class="bg-gradient-to-r from-primary-600 to-secondary-500 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">
                    <i class="fas fa-user-nurse mr-3"></i>
                    ทีมนักบำบัด
                </h1>
                <p class="text-xl md:text-2xl text-gray-100 max-w-3xl mx-auto">
                    ทีมงานมืออาชีพที่พร้อมดูแลคุณด้วยความเชี่ยวชาญ<br>
                    และประสบการณ์มากกว่า 5 ปี
                </p>
            </div>
        </div>
    </section>

    <!-- Therapists Section -->
    <section class="py-16" style="background-color: #EAE7DC;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <?php if ($therapists && count($therapists) > 0): ?>
            
            <!-- Therapists Count -->
            <div class="mb-12 text-center">
                <p class="text-lg text-gray-600">
                    ทีมนักบำบัดของเรามี <span class="font-bold text-primary-600"><?php echo count($therapists); ?></span> ท่าน
                </p>
            </div>
            
            <!-- Therapists Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($therapists as $index => $therapist): ?>
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300 transform hover:-translate-y-2">
                    
                    <!-- Therapist Image -->
                    <div class="relative">
                        <div class="h-80 bg-gradient-to-br from-primary-500 to-secondary-500 overflow-hidden">
                            <img src="<?php echo htmlspecialchars($therapist['image_url']); ?>" 
                                 alt="<?php echo htmlspecialchars($therapist['name']); ?>"
                                 class="w-full h-full object-cover opacity-90">
                        </div>
                        
                        <!-- Status Badge -->
                        <?php if ($therapist['is_available']): ?>
                        <div class="absolute top-4 right-4">
                            <span class="bg-green-500 text-white px-4 py-2 rounded-full shadow-lg font-semibold flex items-center">
                                <i class="fas fa-check-circle mr-2"></i>
                                พร้อมให้บริการ
                            </span>
                        </div>
                        <?php else: ?>
                        <div class="absolute top-4 right-4">
                            <span class="bg-gray-500 text-white px-4 py-2 rounded-full shadow-lg font-semibold flex items-center">
                                <i class="fas fa-minus-circle mr-2"></i>
                                ไม่ว่าง
                            </span>
                        </div>
                        <?php endif; ?>
                        
                        <!-- Experience Badge -->
                        <div class="absolute bottom-4 left-4">
                            <div class="bg-white text-primary-600 px-4 py-2 rounded-full shadow-lg font-bold">
                                <i class="fas fa-award mr-1"></i>
                                <?php echo $therapist['experience_years']; ?> ปี
                            </div>
                        </div>
                    </div>
                    
                    <!-- Therapist Info -->
                    <div class="p-6">
                        <div class="text-center mb-4">
                            <h3 class="text-2xl font-bold text-gray-800">
                                <?php echo htmlspecialchars($therapist['name']); ?>
                            </h3>
                            <p class="text-lg text-primary-600 font-medium">
                                "<?php echo htmlspecialchars($therapist['nickname']); ?>"
                            </p>
                        </div>
                        
                        <!-- Experience -->
                        <div class="mb-4 pb-4 border-b border-gray-200">
                            <div class="flex items-center justify-center text-gray-600">
                                <i class="fas fa-briefcase text-primary-600 mr-2"></i>
                                <span>ประสบการณ์ <?php echo $therapist['experience_years']; ?> ปี</span>
                            </div>
                        </div>
                        
                        <!-- Specialization -->
                        <div class="mb-6">
                            <h4 class="text-sm font-semibold text-gray-500 mb-2 uppercase tracking-wider">
                                ความเชี่ยวชาญ
                            </h4>
                            <div class="flex flex-wrap gap-2">
                                <?php 
                                $specializations = explode(',', $therapist['specialization']);
                                foreach ($specializations as $spec): 
                                ?>
                                <span class="bg-primary-100 text-primary-700 px-3 py-1 rounded-full text-sm font-medium">
                                    <?php echo trim(htmlspecialchars($spec)); ?>
                                </span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        
                        <!-- Book Button -->
                        <?php if ($therapist['is_available']): ?>
                        <a href="<?php echo BASE_URL; ?>/booking.php?therapist_id=<?php echo $therapist['id']; ?>" 
                           class="block w-full bg-primary-600 hover:bg-primary-700 text-white text-center py-3 rounded-lg font-semibold transition duration-200 shadow-md hover:shadow-lg"
                           aria-label="จองกับ <?php echo htmlspecialchars($therapist['name']); ?>">
                            <i class="fas fa-calendar-check mr-2"></i>
                            จองกับคุณ<?php echo htmlspecialchars($therapist['nickname']); ?>
                        </a>
                        <?php else: ?>
                        <button class="block w-full bg-gray-400 text-white text-center py-3 rounded-lg font-semibold cursor-not-allowed"
                                disabled
                                aria-label="ไม่สามารถจองได้">
                            <i class="fas fa-ban mr-2"></i>
                            ขณะนี้ไม่ว่าง
                        </button>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <?php else: ?>
            
            <!-- No Therapists Found -->
            <div class="text-center py-16">
                <div class="bg-white rounded-xl shadow-lg p-12 max-w-md mx-auto">
                    <i class="fas fa-user-slash text-6xl text-gray-400 mb-6"></i>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">ไม่พบข้อมูลนักบำบัด</h3>
                    <p class="text-gray-600 mb-6">
                        ขณะนี้ยังไม่มีข้อมูลนักบำบัดในระบบ<br>
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

    <!-- Info Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                    มาตรฐานนักบำบัดของเรา
                </h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Standard 1 -->
                <div class="bg-gradient-to-br from-primary-50 to-secondary-500 bg-opacity-10 rounded-xl p-8 text-center" style="background: linear-gradient(135deg, #fef5f4 0%, #EAE7DC 100%);">
                    <div class="bg-white w-16 h-16 rounded-full flex items-center justify-center mb-4 mx-auto shadow-md">
                        <i class="fas fa-graduation-cap text-3xl text-primary-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">การอบรมมาตรฐาน</h3>
                    <p class="text-gray-600 leading-relaxed">
                        นักบำบัดทุกคนผ่านการอบรมจากสถาบันที่ได้รับการรับรอง และมีใบประกาศนียบัตรการนวดไทย
                    </p>
                </div>
                
                <!-- Standard 2 -->
                <div class="bg-gradient-to-br from-green-50 to-teal-50 rounded-xl p-8 text-center">
                    <div class="bg-white w-16 h-16 rounded-full flex items-center justify-center mb-4 mx-auto shadow-md">
                        <i class="fas fa-hands-helping text-3xl text-green-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">ประสบการณ์สูง</h3>
                    <p class="text-gray-600 leading-relaxed">
                        นักบำบัดมีประสบการณ์ตั้งแต่ 5 ปีขึ้นไป เชี่ยวชาญในเทคนิคการนวดหลากหลายรูปแบบ
                    </p>
                </div>
                
                <!-- Standard 3 -->
                <div class="bg-gradient-to-br from-yellow-50 to-orange-50 rounded-xl p-8 text-center">
                    <div class="bg-white w-16 h-16 rounded-full flex items-center justify-center mb-4 mx-auto shadow-md">
                        <i class="fas fa-user-check text-3xl text-yellow-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">บริการเป็นมิตร</h3>
                    <p class="text-gray-600 leading-relaxed">
                        นักบำบัดของเราผ่านการฝึกอบรมด้านมนุษยสัมพันธ์ พร้อมให้บริการด้วยรอยยิ้มและความใส่ใจ
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-r from-primary-600 to-secondary-500 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-6">
                เลือกนักบำบัดที่คุณชอบได้เลย!
            </h2>
            <p class="text-xl mb-8 text-gray-100 max-w-2xl mx-auto">
                หรือให้ระบบจัดหานักบำบัดที่ว่างให้คุณอัตโนมัติ
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="<?php echo BASE_URL; ?>/booking.php" 
                   class="inline-block bg-white text-primary-600 hover:bg-gray-100 px-8 py-4 rounded-lg text-lg font-bold transition duration-200 shadow-xl hover:shadow-2xl"
                   aria-label="จองคิวทันที">
                    <i class="fas fa-calendar-plus mr-2"></i>
                    จองคิวทันที
                </a>
                <a href="<?php echo BASE_URL; ?>/services.php" 
                   class="inline-block bg-transparent border-2 border-white text-white hover:bg-white hover:text-primary-600 px-8 py-4 rounded-lg text-lg font-bold transition duration-200"
                   aria-label="ดูบริการ">
                    <i class="fas fa-spa mr-2"></i>
                    ดูบริการ
                </a>
            </div>
        </div>
    </section>
</main>

<?php
// โหลด footer
include __DIR__ . '/includes/footer.php';
?>
