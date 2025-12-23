    <!-- Navigation Bar -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="<?php echo BASE_URL; ?>/index.php" class="flex items-center space-x-2">
                        <i class="fas fa-spa text-3xl text-primary-600"></i>
                        <span class="text-2xl font-bold text-gray-800"><?php echo SITE_NAME; ?></span>
                    </a>
                </div>
                
                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="<?php echo BASE_URL; ?>/index.php" 
                       class="text-gray-700 hover:text-primary-600 font-medium transition duration-200 <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'text-primary-600 border-b-2 border-primary-600' : ''; ?>">
                        หน้าแรก
                    </a>
                    <a href="<?php echo BASE_URL; ?>/services.php" 
                       class="text-gray-700 hover:text-primary-600 font-medium transition duration-200 <?php echo basename($_SERVER['PHP_SELF']) == 'services.php' ? 'text-primary-600 border-b-2 border-primary-600' : ''; ?>">
                        บริการ
                    </a>
                    <a href="<?php echo BASE_URL; ?>/booking.php" 
                       class="text-gray-700 hover:text-primary-600 font-medium transition duration-200 <?php echo basename($_SERVER['PHP_SELF']) == 'booking.php' ? 'text-primary-600 border-b-2 border-primary-600' : ''; ?>">
                        จองคิว
                    </a>
                    <a href="<?php echo BASE_URL; ?>/therapists.php" 
                       class="text-gray-700 hover:text-primary-600 font-medium transition duration-200 <?php echo basename($_SERVER['PHP_SELF']) == 'therapists.php' ? 'text-primary-600 border-b-2 border-primary-600' : ''; ?>">
                        นักบำบัด
                    </a>
                    <a href="<?php echo BASE_URL; ?>/contact.php" 
                       class="text-gray-700 hover:text-primary-600 font-medium transition duration-200 <?php echo basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'text-primary-600 border-b-2 border-primary-600' : ''; ?>">
                        ติดต่อ
                    </a>
                </div>
                
                <!-- CTA Button + Phone -->
                <div class="hidden md:flex items-center space-x-4">
                    <a href="tel:<?php echo str_replace('-', '', SHOP_MOBILE); ?>" 
                       class="flex items-center space-x-2 text-gray-700 hover:text-primary-600 transition duration-200"
                       aria-label="โทรติดต่อร้าน">
                        <i class="fas fa-phone text-lg"></i>
                        <span class="font-medium"><?php echo SHOP_MOBILE; ?></span>
                    </a>
                    <a href="<?php echo BASE_URL; ?>/booking.php" 
                       class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-2 rounded-lg font-semibold transition duration-200 shadow-md hover:shadow-lg"
                       aria-label="จองคิวทันที">
                        จองเลย
                    </a>
                </div>
                
                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center">
                    <button type="button" 
                            id="mobile-menu-button" 
                            class="text-gray-700 hover:text-primary-600 focus:outline-none focus:ring-2 focus:ring-primary-500 rounded-lg p-2"
                            aria-label="เปิดเมนู"
                            aria-expanded="false">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-200">
            <div class="px-4 pt-2 pb-4 space-y-1">
                <a href="<?php echo BASE_URL; ?>/index.php" 
                   class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-primary-50 hover:text-primary-600 font-medium transition duration-200 <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'bg-primary-100 text-primary-600' : ''; ?>">
                    <i class="fas fa-home mr-2"></i> หน้าแรก
                </a>
                <a href="<?php echo BASE_URL; ?>/services.php" 
                   class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-primary-50 hover:text-primary-600 font-medium transition duration-200 <?php echo basename($_SERVER['PHP_SELF']) == 'services.php' ? 'bg-primary-100 text-primary-600' : ''; ?>">
                    <i class="fas fa-spa mr-2"></i> บริการ
                </a>
                <a href="<?php echo BASE_URL; ?>/booking.php" 
                   class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-primary-50 hover:text-primary-600 font-medium transition duration-200 <?php echo basename($_SERVER['PHP_SELF']) == 'booking.php' ? 'bg-primary-100 text-primary-600' : ''; ?>">
                    <i class="fas fa-calendar-check mr-2"></i> จองคิว
                </a>
                <a href="<?php echo BASE_URL; ?>/therapists.php" 
                   class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-primary-50 hover:text-primary-600 font-medium transition duration-200 <?php echo basename($_SERVER['PHP_SELF']) == 'therapists.php' ? 'bg-primary-100 text-primary-600' : ''; ?>">
                    <i class="fas fa-user-nurse mr-2"></i> นักบำบัด
                </a>
                <a href="<?php echo BASE_URL; ?>/contact.php" 
                   class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-primary-50 hover:text-primary-600 font-medium transition duration-200 <?php echo basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'bg-primary-100 text-primary-600' : ''; ?>">
                    <i class="fas fa-envelope mr-2"></i> ติดต่อ
                </a>
                
                <!-- Mobile CTA -->
                <div class="pt-4 space-y-2">
                    <a href="tel:<?php echo str_replace('-', '', SHOP_MOBILE); ?>" 
                       class="block w-full text-center bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-3 rounded-lg font-semibold transition duration-200"
                       aria-label="โทรติดต่อร้าน">
                        <i class="fas fa-phone mr-2"></i> <?php echo SHOP_MOBILE; ?>
                    </a>
                    <a href="<?php echo BASE_URL; ?>/booking.php" 
                       class="block w-full text-center bg-primary-600 hover:bg-primary-700 text-white px-4 py-3 rounded-lg font-semibold transition duration-200 shadow-md"
                       aria-label="จองคิวทันที">
                        <i class="fas fa-calendar-plus mr-2"></i> จองเลย
                    </a>
                </div>
            </div>
        </div>
    </nav>
    
    <script>
        // Mobile Menu Toggle
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            
            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    const isExpanded = mobileMenu.classList.contains('hidden');
                    
                    // Toggle menu
                    mobileMenu.classList.toggle('hidden');
                    
                    // Update button icon
                    const icon = this.querySelector('i');
                    if (isExpanded) {
                        icon.classList.remove('fa-bars');
                        icon.classList.add('fa-times');
                        this.setAttribute('aria-expanded', 'true');
                    } else {
                        icon.classList.remove('fa-times');
                        icon.classList.add('fa-bars');
                        this.setAttribute('aria-expanded', 'false');
                    }
                });
            }
        });
    </script>
