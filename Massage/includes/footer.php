    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- ข้อมูลร้าน -->
                <div>
                    <h3 class="text-xl font-bold mb-4 flex items-center">
                        <i class="fas fa-spa mr-2 text-primary-400"></i>
                        <?php echo SITE_NAME; ?>
                    </h3>
                    <p class="text-gray-400 leading-relaxed">
                        บริการนวดสุขภาพครบวงจร ด้วยทีมงานมืออาชีพ เพื่อสุขภาพและความผ่อนคลายของคุณ
                    </p>
                </div>
                
                <!-- ลิงก์ด่วน -->
                <div>
                    <h3 class="text-xl font-bold mb-4">ลิงก์ด่วน</h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="<?php echo BASE_URL; ?>/index.php" 
                               class="text-gray-400 hover:text-primary-400 transition duration-200 flex items-center">
                                <i class="fas fa-chevron-right text-xs mr-2"></i> หน้าแรก
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo BASE_URL; ?>/services.php" 
                               class="text-gray-400 hover:text-primary-400 transition duration-200 flex items-center">
                                <i class="fas fa-chevron-right text-xs mr-2"></i> บริการ
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo BASE_URL; ?>/booking.php" 
                               class="text-gray-400 hover:text-primary-400 transition duration-200 flex items-center">
                                <i class="fas fa-chevron-right text-xs mr-2"></i> จองคิว
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo BASE_URL; ?>/therapists.php" 
                               class="text-gray-400 hover:text-primary-400 transition duration-200 flex items-center">
                                <i class="fas fa-chevron-right text-xs mr-2"></i> นักบำบัด
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo BASE_URL; ?>/contact.php" 
                               class="text-gray-400 hover:text-primary-400 transition duration-200 flex items-center">
                                <i class="fas fa-chevron-right text-xs mr-2"></i> ติดต่อเรา
                            </a>
                        </li>
                    </ul>
                </div>
                
                <!-- ติดต่อ -->
                <div>
                    <h3 class="text-xl font-bold mb-4">ติดต่อเรา</h3>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-3 text-primary-400"></i>
                            <span class="text-gray-400"><?php echo SHOP_ADDRESS; ?></span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone mr-3 text-primary-400"></i>
                            <a href="tel:<?php echo str_replace('-', '', SHOP_PHONE); ?>" 
                               class="text-gray-400 hover:text-primary-400 transition duration-200">
                                <?php echo SHOP_PHONE; ?>
                            </a>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-mobile-alt mr-3 text-primary-400"></i>
                            <a href="tel:<?php echo str_replace('-', '', SHOP_MOBILE); ?>" 
                               class="text-gray-400 hover:text-primary-400 transition duration-200">
                                <?php echo SHOP_MOBILE; ?>
                            </a>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-3 text-primary-400"></i>
                            <a href="mailto:<?php echo SHOP_EMAIL; ?>" 
                               class="text-gray-400 hover:text-primary-400 transition duration-200">
                                <?php echo SHOP_EMAIL; ?>
                            </a>
                        </li>
                    </ul>
                </div>
                
                <!-- เวลาทำการ + Social Media -->
                <div>
                    <h3 class="text-xl font-bold mb-4">เวลาทำการ</h3>
                    <ul class="space-y-2 mb-6">
                        <li class="text-gray-400 flex justify-between">
                            <span>จันทร์ - ศุกร์:</span>
                            <span class="font-medium text-white">10:00 - 20:00</span>
                        </li>
                        <li class="text-gray-400 flex justify-between">
                            <span>เสาร์ - อาทิตย์:</span>
                            <span class="font-medium text-white">09:00 - 21:00</span>
                        </li>
                    </ul>
                    
                    <h3 class="text-lg font-bold mb-3">ติดตามเรา</h3>
                    <div class="flex space-x-4">
                        <a href="<?php echo SOCIAL_MEDIA['facebook']; ?>" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           class="w-10 h-10 bg-gray-800 hover:bg-primary-600 rounded-full flex items-center justify-center transition duration-200"
                           aria-label="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="<?php echo SOCIAL_MEDIA['line']; ?>" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           class="w-10 h-10 bg-gray-800 hover:bg-green-500 rounded-full flex items-center justify-center transition duration-200"
                           aria-label="LINE">
                            <i class="fab fa-line"></i>
                        </a>
                        <a href="<?php echo SOCIAL_MEDIA['instagram']; ?>" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           class="w-10 h-10 bg-gray-800 hover:bg-pink-500 rounded-full flex items-center justify-center transition duration-200"
                           aria-label="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="<?php echo SOCIAL_MEDIA['twitter']; ?>" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           class="w-10 h-10 bg-gray-800 hover:bg-blue-400 rounded-full flex items-center justify-center transition duration-200"
                           aria-label="Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Copyright -->
            <div class="border-t border-gray-800 mt-8 pt-8 text-center">
                <p class="text-gray-400">
                    &copy; <?php echo date('Y'); ?> <?php echo SITE_NAME; ?>. All rights reserved. | 
                    Made with <i class="fas fa-heart text-red-500"></i> by Software Engineer Team
                </p>
            </div>
        </div>
    </footer>
    
    <!-- Scroll to Top Button -->
    <button id="scrollTopBtn" 
            class="fixed bottom-8 right-8 bg-primary-600 hover:bg-primary-700 text-white w-12 h-12 rounded-full shadow-lg transition duration-200 opacity-0 pointer-events-none z-40"
            aria-label="เลื่อนขึ้นด้านบน"
            style="transition: opacity 0.3s, transform 0.3s;">
        <i class="fas fa-arrow-up"></i>
    </button>
    
    <script>
        // Scroll to Top Button
        document.addEventListener('DOMContentLoaded', function() {
            const scrollTopBtn = document.getElementById('scrollTopBtn');
            
            // Show/hide button based on scroll position
            window.addEventListener('scroll', function() {
                if (window.pageYOffset > 300) {
                    scrollTopBtn.classList.remove('opacity-0', 'pointer-events-none');
                    scrollTopBtn.classList.add('opacity-100');
                } else {
                    scrollTopBtn.classList.add('opacity-0', 'pointer-events-none');
                    scrollTopBtn.classList.remove('opacity-100');
                }
            });
            
            // Scroll to top when clicked
            scrollTopBtn.addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        });
    </script>
    
    <!-- Custom JS -->
    <script src="<?php echo JS_PATH; ?>/main.js"></script>
</body>
</html>
