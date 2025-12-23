/**
 * Booking JavaScript
 * จัดการ logic การจองคิวทั้งหมด
 * 
 * @author Software Engineer Team
 * @version 1.0
 * @since 2025-12-23
 */

(function() {
    'use strict';
    
    // Global variables
    let services = [];
    let therapists = [];
    const { showLoading, hideLoading, showAlert, showSuccessModal, showErrorModal, showFieldError, hideFieldError, ajaxGet, ajaxPost } = window.MassageBooking;
    
    // DOM Elements
    const form = document.getElementById('bookingForm');
    const serviceSelect = document.getElementById('service_id');
    const therapistSelect = document.getElementById('therapist_id');
    const dateInput = document.getElementById('booking_date');
    const timeSelect = document.getElementById('booking_time');
    const notesTextarea = document.getElementById('notes');
    const notesCount = document.getElementById('notes_count');
    const submitBtn = document.getElementById('submitBtn');
    
    /**
     * Initialize
     */
    document.addEventListener('DOMContentLoaded', function() {
        initializeDatePicker();
        loadServices();
        loadTherapists();
        generateTimeSlots();
        setupEventListeners();
        
        // Set pre-selected values ถ้ามี
        if (BOOKING_CONFIG.selectedServiceId > 0) {
            setTimeout(() => {
                serviceSelect.value = BOOKING_CONFIG.selectedServiceId;
                serviceSelect.dispatchEvent(new Event('change'));
            }, 500);
        }
        
        if (BOOKING_CONFIG.selectedTherapistId > 0) {
            setTimeout(() => {
                therapistSelect.value = BOOKING_CONFIG.selectedTherapistId;
            }, 500);
        }
    });
    
    /**
     * ตั้งค่า Date Picker (ห้ามเลือกวันย้อนหลัง)
     */
    function initializeDatePicker() {
        const today = new Date().toISOString().split('T')[0];
        dateInput.setAttribute('min', today);
        
        // ตั้งค่า max date (30 วันข้างหน้า)
        const maxDate = new Date();
        maxDate.setDate(maxDate.getDate() + 30);
        dateInput.setAttribute('max', maxDate.toISOString().split('T')[0]);
    }
    
    /**
     * โหลดข้อมูลบริการ
     */
    function loadServices() {
        showLoading();
        
        ajaxGet(BOOKING_CONFIG.apiUrl + '/get_services.php')
            .then(response => {
                if (response.success && response.data) {
                    services = response.data;
                    populateServices();
                } else {
                    throw new Error('ไม่สามารถโหลดข้อมูลบริการได้');
                }
            })
            .catch(error => {
                console.error('Error loading services:', error);
                showAlert('เกิดข้อผิดพลาดในการโหลดบริการ', 'error');
            })
            .finally(() => {
                hideLoading();
            });
    }
    
    /**
     * แสดงรายการบริการใน dropdown
     */
    function populateServices() {
        serviceSelect.innerHTML = '<option value="">-- กรุณาเลือกบริการ --</option>';
        
        services.forEach(service => {
            const option = document.createElement('option');
            option.value = service.id;
            option.textContent = `${service.name} - ${service.duration} นาที (${service.price.toLocaleString()} บาท)`;
            option.dataset.duration = service.duration;
            option.dataset.price = service.price;
            serviceSelect.appendChild(option);
        });
    }
    
    /**
     * โหลดข้อมูลนักบำบัด
     */
    function loadTherapists() {
        ajaxGet(BOOKING_CONFIG.apiUrl + '/get_therapists.php')
            .then(response => {
                if (response.success && response.data) {
                    therapists = response.data;
                    populateTherapists();
                } else {
                    throw new Error('ไม่สามารถโหลดข้อมูลนักบำบัดได้');
                }
            })
            .catch(error => {
                console.error('Error loading therapists:', error);
            });
    }
    
    /**
     * แสดงรายชื่อนักบำบัดใน dropdown
     */
    function populateTherapists() {
        therapistSelect.innerHTML = '<option value="">-- หมอนวดว่าง (ระบบจัดให้อัตโนมัติ) --</option>';
        
        therapists.forEach(therapist => {
            const option = document.createElement('option');
            option.value = therapist.id;
            option.textContent = `${therapist.name} (${therapist.nickname}) - ${therapist.specialization}`;
            option.disabled = !therapist.is_available;
            
            if (!therapist.is_available) {
                option.textContent += ' [ไม่ว่าง]';
            }
            
            therapistSelect.appendChild(option);
        });
    }
    
    /**
     * สร้าง time slots (10:00 - 20:00 ทุก 30 นาที)
     */
    function generateTimeSlots() {
        timeSelect.innerHTML = '<option value="">-- เลือกเวลา --</option>';
        
        // เวลาทำการ: 10:00 - 20:00
        const startHour = 10;
        const endHour = 20;
        
        for (let hour = startHour; hour < endHour; hour++) {
            for (let minute = 0; minute < 60; minute += 30) {
                const time = `${hour.toString().padStart(2, '0')}:${minute.toString().padStart(2, '0')}`;
                const option = document.createElement('option');
                option.value = time;
                option.textContent = time + ' น.';
                timeSelect.appendChild(option);
            }
        }
    }
    
    /**
     * Setup Event Listeners
     */
    function setupEventListeners() {
        // Service change - แสดงข้อมูลบริการ
        serviceSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const serviceInfo = document.getElementById('service_info');
            
            if (selectedOption.value) {
                const duration = selectedOption.dataset.duration;
                const price = parseFloat(selectedOption.dataset.price);
                serviceInfo.innerHTML = `<i class="fas fa-info-circle text-blue-600 mr-2"></i>ระยะเวลา ${duration} นาที | ราคา ${price.toLocaleString()} บาท`;
                serviceInfo.classList.add('text-blue-600', 'font-medium');
            } else {
                serviceInfo.textContent = '';
            }
            
            hideFieldError(this);
        });
        
        // Date change - ตรวจสอบวันที่
        dateInput.addEventListener('change', function() {
            const selectedDate = new Date(this.value);
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            
            if (selectedDate < today) {
                showFieldError(this, 'ไม่สามารถเลือกวันย้อนหลังได้');
                this.value = '';
            } else {
                hideFieldError(this);
            }
        });
        
        // Phone input - ให้กรอกได้เฉพาะตัวเลข
        const phoneInput = document.getElementById('customer_phone');
        phoneInput.addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
            
            if (this.value.length === 10) {
                if (this.value.startsWith('0')) {
                    hideFieldError(this);
                } else {
                    showFieldError(this, 'เบอร์โทรศัพท์ต้องขึ้นต้นด้วย 0');
                }
            }
        });
        
        // Notes character count
        if (notesTextarea && notesCount) {
            notesTextarea.addEventListener('input', function() {
                notesCount.textContent = this.value.length;
            });
        }
        
        // Form submit
        form.addEventListener('submit', handleFormSubmit);
    }
    
    /**
     * Handle Form Submit
     */
    function handleFormSubmit(e) {
        e.preventDefault();
        
        // ลบ error messages ทั้งหมด
        document.querySelectorAll('.error-message').forEach(el => el.remove());
        document.querySelectorAll('.error-input').forEach(el => el.classList.remove('error-input'));
        
        // Validate form
        if (!validateForm()) {
            showAlert('กรุณากรอกข้อมูลให้ครบถ้วนและถูกต้อง', 'error');
            return;
        }
        
        // Collect form data
        const formData = {
            service_id: parseInt(serviceSelect.value),
            therapist_id: therapistSelect.value ? parseInt(therapistSelect.value) : null,
            customer_name: document.getElementById('customer_name').value.trim(),
            customer_phone: document.getElementById('customer_phone').value.trim(),
            customer_email: document.getElementById('customer_email').value.trim() || null,
            booking_date: dateInput.value,
            booking_time: timeSelect.value + ':00',
            notes: notesTextarea.value.trim() || null
        };
        
        // ส่งข้อมูลไป API
        submitBooking(formData);
    }
    
    /**
     * Validate Form
     */
    function validateForm() {
        let isValid = true;
        
        // Service
        if (!serviceSelect.value) {
            showFieldError(serviceSelect, 'กรุณาเลือกบริการ');
            isValid = false;
        }
        
        // Date
        if (!dateInput.value) {
            showFieldError(dateInput, 'กรุณาเลือกวันที่');
            isValid = false;
        }
        
        // Time
        if (!timeSelect.value) {
            showFieldError(timeSelect, 'กรุณาเลือกเวลา');
            isValid = false;
        }
        
        // Customer Name
        const nameInput = document.getElementById('customer_name');
        if (!nameInput.value.trim() || nameInput.value.trim().length < 2) {
            showFieldError(nameInput, 'กรุณากรอกชื่อ-นามสกุล (อย่างน้อย 2 ตัวอักษร)');
            isValid = false;
        }
        
        // Customer Phone
        const phoneInput = document.getElementById('customer_phone');
        const phonePattern = /^0[0-9]{9}$/;
        if (!phonePattern.test(phoneInput.value.trim())) {
            showFieldError(phoneInput, 'เบอร์โทรศัพท์ไม่ถูกต้อง (10 หลัก ขึ้นต้นด้วย 0)');
            isValid = false;
        }
        
        // Customer Email (optional)
        const emailInput = document.getElementById('customer_email');
        if (emailInput.value.trim()) {
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(emailInput.value.trim())) {
                showFieldError(emailInput, 'รูปแบบอีเมลไม่ถูกต้อง');
                isValid = false;
            }
        }
        
        return isValid;
    }
    
    /**
     * Submit Booking to API
     */
    function submitBooking(data) {
        showLoading();
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>กำลังจอง...';
        
        ajaxPost(BOOKING_CONFIG.apiUrl + '/create_booking.php', data)
            .then(response => {
                if (response.success) {
                    // แสดง modal สำเร็จ
                    showSuccessModal(
                        'จองคิวสำเร็จ!',
                        `หมายเลขการจองของคุณคือ <strong>#${response.booking_id}</strong><br><br>` +
                        `วันที่: ${response.data.booking_date}<br>` +
                        `เวลา: ${response.data.booking_time}<br>` +
                        `ชื่อ: ${response.data.customer_name}<br>` +
                        `เบอร์: ${response.data.customer_phone}<br><br>` +
                        `กรุณามาตามเวลาที่จองไว้ หากมีข้อสงสัยติดต่อ ${response.data.customer_phone}`,
                        function() {
                            // Reset form และ redirect
                            form.reset();
                            window.location.href = BOOKING_CONFIG.apiUrl.replace('/api', '/index.php');
                        }
                    );
                } else {
                    throw new Error(response.message || 'ไม่สามารถจองได้');
                }
            })
            .catch(error => {
                console.error('Booking error:', error);
                showErrorModal('เกิดข้อผิดพลาด', error.message || 'ไม่สามารถทำการจองได้ กรุณาลองใหม่อีกครั้ง');
            })
            .finally(() => {
                hideLoading();
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="fas fa-check-circle mr-2"></i>ยืนยันการจอง';
            });
    }
    
})();
