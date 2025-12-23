/**
 * Main JavaScript File
 * จัดการ functionality หลักของเว็บไซต์
 * 
 * @author Software Engineer Team
 * @version 1.0
 * @since 2025-12-23
 */

// Global configuration
const CONFIG = {
    baseUrl: window.location.origin + '/Massage',
    apiUrl: window.location.origin + '/Massage/api',
    minPhoneLength: 10,
    maxPhoneLength: 10,
    minNameLength: 2,
    maxNameLength: 100
};

// =====================================================
// Utility Functions
// =====================================================

/**
 * แสดง loading overlay
 */
function showLoading() {
    const overlay = document.getElementById('loadingOverlay');
    if (overlay) {
        overlay.classList.add('active');
    }
}

/**
 * ซ่อน loading overlay
 */
function hideLoading() {
    const overlay = document.getElementById('loadingOverlay');
    if (overlay) {
        overlay.classList.remove('active');
    }
}

/**
 * แสดง alert message
 * @param {string} message - ข้อความที่ต้องการแสดง
 * @param {string} type - ประเภท: success, error, warning, info
 * @param {number} duration - ระยะเวลาแสดง (milliseconds), 0 = ไม่ปิดอัตโนมัติ
 */
function showAlert(message, type = 'info', duration = 5000) {
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type} fixed top-4 right-4 z-50 shadow-lg max-w-md animate-fade-in`;
    alertDiv.innerHTML = `
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <i class="fas fa-${getIconByType(type)} mr-3"></i>
                <span>${message}</span>
            </div>
            <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-xl leading-none">
                &times;
            </button>
        </div>
    `;
    
    document.body.appendChild(alertDiv);
    
    if (duration > 0) {
        setTimeout(() => {
            alertDiv.remove();
        }, duration);
    }
}

/**
 * ดึง icon ตามประเภทของ alert
 * @param {string} type - ประเภทของ alert
 * @returns {string} ชื่อ icon
 */
function getIconByType(type) {
    const icons = {
        'success': 'check-circle',
        'error': 'times-circle',
        'warning': 'exclamation-triangle',
        'info': 'info-circle'
    };
    return icons[type] || 'info-circle';
}

/**
 * แสดง modal ยืนยัน
 * @param {string} title - หัวข้อ modal
 * @param {string} message - ข้อความใน modal
 * @param {function} onConfirm - callback เมื่อกดยืนยัน
 */
function showConfirmModal(title, message, onConfirm) {
    const modal = document.createElement('div');
    modal.className = 'fixed inset-0 z-50 flex items-center justify-center modal-backdrop';
    modal.innerHTML = `
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 transform transition-all animate-fade-in">
            <div class="p-6">
                <h3 class="text-2xl font-bold text-gray-800 mb-4">${title}</h3>
                <p class="text-gray-600 mb-6">${message}</p>
                <div class="flex space-x-4">
                    <button id="confirmBtn" class="flex-1 bg-primary-600 hover:bg-primary-700 text-white py-3 rounded-lg font-semibold transition duration-200">
                        ยืนยัน
                    </button>
                    <button id="cancelBtn" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 py-3 rounded-lg font-semibold transition duration-200">
                        ยกเลิก
                    </button>
                </div>
            </div>
        </div>
    `;
    
    document.body.appendChild(modal);
    
    // Event listeners
    document.getElementById('confirmBtn').addEventListener('click', () => {
        modal.remove();
        if (typeof onConfirm === 'function') {
            onConfirm();
        }
    });
    
    document.getElementById('cancelBtn').addEventListener('click', () => {
        modal.remove();
    });
    
    // ปิด modal เมื่อคลิกนอก modal
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.remove();
        }
    });
}

/**
 * แสดง modal สำเร็จ
 * @param {string} title - หัวข้อ modal
 * @param {string} message - ข้อความใน modal
 * @param {function} onClose - callback เมื่อปิด modal
 */
function showSuccessModal(title, message, onClose) {
    const modal = document.createElement('div');
    modal.className = 'fixed inset-0 z-50 flex items-center justify-center modal-backdrop';
    modal.innerHTML = `
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 transform transition-all animate-fade-in">
            <div class="p-6 text-center">
                <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-check text-4xl text-green-600"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">${title}</h3>
                <p class="text-gray-600 mb-6">${message}</p>
                <button id="closeBtn" class="w-full bg-primary-600 hover:bg-primary-700 text-white py-3 rounded-lg font-semibold transition duration-200">
                    ตกลง
                </button>
            </div>
        </div>
    `;
    
    document.body.appendChild(modal);
    
    document.getElementById('closeBtn').addEventListener('click', () => {
        modal.remove();
        if (typeof onClose === 'function') {
            onClose();
        }
    });
}

/**
 * แสดง modal error
 * @param {string} title - หัวข้อ modal
 * @param {string} message - ข้อความใน modal
 */
function showErrorModal(title, message) {
    const modal = document.createElement('div');
    modal.className = 'fixed inset-0 z-50 flex items-center justify-center modal-backdrop';
    modal.innerHTML = `
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 transform transition-all animate-fade-in">
            <div class="p-6 text-center">
                <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-times text-4xl text-red-600"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">${title}</h3>
                <p class="text-gray-600 mb-6">${message}</p>
                <button id="closeBtn" class="w-full bg-red-600 hover:bg-red-700 text-white py-3 rounded-lg font-semibold transition duration-200">
                    ปิด
                </button>
            </div>
        </div>
    `;
    
    document.body.appendChild(modal);
    
    document.getElementById('closeBtn').addEventListener('click', () => {
        modal.remove();
    });
}

// =====================================================
// Validation Functions
// =====================================================

/**
 * ตรวจสอบว่าเป็นค่าว่างหรือไม่
 * @param {string} value - ค่าที่ต้องการตรวจสอบ
 * @returns {boolean}
 */
function isEmpty(value) {
    return value === null || value === undefined || value.trim() === '';
}

/**
 * ตรวจสอบรูปแบบอีเมล
 * @param {string} email - อีเมลที่ต้องการตรวจสอบ
 * @returns {boolean}
 */
function isValidEmail(email) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
}

/**
 * ตรวจสอบรูปแบบเบอร์โทรศัพท์ (10 หลัก ขึ้นต้นด้วย 0)
 * @param {string} phone - เบอร์โทรที่ต้องการตรวจสอบ
 * @returns {boolean}
 */
function isValidPhone(phone) {
    const regex = /^0[0-9]{9}$/;
    return regex.test(phone);
}

/**
 * ตรวจสอบความยาวของข้อความ
 * @param {string} value - ข้อความที่ต้องการตรวจสอบ
 * @param {number} min - ความยาวต่ำสุด
 * @param {number} max - ความยาวสูงสุด
 * @returns {boolean}
 */
function isValidLength(value, min, max) {
    const length = value.trim().length;
    return length >= min && length <= max;
}

/**
 * ตรวจสอบวันที่ (ห้ามเลือกวันย้อนหลัง)
 * @param {string} date - วันที่ในรูปแบบ YYYY-MM-DD
 * @returns {boolean}
 */
function isValidDate(date) {
    const selectedDate = new Date(date);
    const today = new Date();
    today.setHours(0, 0, 0, 0);
    return selectedDate >= today;
}

/**
 * แสดง error message สำหรับ input field
 * @param {HTMLElement} input - input element
 * @param {string} message - ข้อความ error
 */
function showFieldError(input, message) {
    // ลบ error เก่า (ถ้ามี)
    hideFieldError(input);
    
    // เพิ่ม class error
    input.classList.add('error-input');
    
    // สร้าง error message
    const errorDiv = document.createElement('div');
    errorDiv.className = 'text-red-600 text-sm mt-1 error-message';
    errorDiv.textContent = message;
    
    // แทรก error message หลัง input
    input.parentNode.appendChild(errorDiv);
}

/**
 * ซ่อน error message ของ input field
 * @param {HTMLElement} input - input element
 */
function hideFieldError(input) {
    input.classList.remove('error-input');
    const errorMessage = input.parentNode.querySelector('.error-message');
    if (errorMessage) {
        errorMessage.remove();
    }
}

/**
 * แสดง success state สำหรับ input field
 * @param {HTMLElement} input - input element
 */
function showFieldSuccess(input) {
    hideFieldError(input);
    input.classList.add('success-input');
}

// =====================================================
// AJAX Helper Functions
// =====================================================

/**
 * ส่ง AJAX request แบบ GET
 * @param {string} url - URL ที่ต้องการเรียก
 * @returns {Promise}
 */
function ajaxGet(url) {
    return fetch(url, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    });
}

/**
 * ส่ง AJAX request แบบ POST
 * @param {string} url - URL ที่ต้องการเรียก
 * @param {object} data - ข้อมูลที่ต้องการส่ง
 * @returns {Promise}
 */
function ajaxPost(url, data) {
    return fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify(data)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    });
}

// =====================================================
// Document Ready
// =====================================================

document.addEventListener('DOMContentLoaded', function() {
    console.log('Main.js loaded successfully');
    
    // ซ่อน loading overlay เมื่อหน้าเว็บโหลดเสร็จ
    hideLoading();
});

// Export functions for use in other scripts
window.MassageBooking = {
    showLoading,
    hideLoading,
    showAlert,
    showConfirmModal,
    showSuccessModal,
    showErrorModal,
    isEmpty,
    isValidEmail,
    isValidPhone,
    isValidLength,
    isValidDate,
    showFieldError,
    hideFieldError,
    showFieldSuccess,
    ajaxGet,
    ajaxPost,
    CONFIG
};
