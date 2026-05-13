{{-- Customer Login Modal --}}
<style>
    #customerLoginModal.hidden { display: none !important; }
    #customerLoginModal:not(.hidden) { display: flex !important; }
    .step-content.hidden { display: none !important; }
</style>

<div id="customerLoginModal" class="fixed inset-0 z-[9999] hidden items-center justify-center p-4">
    {{-- Overlay --}}
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" id="closeLoginOverlay"></div>
    
    {{-- Modal Content --}}
    <div class="relative w-full max-w-md bg-white rounded-3xl shadow-2xl overflow-hidden transform transition-all duration-300 scale-95 opacity-0" id="loginModalContent">
        
        {{-- Close Button --}}
        <button class="absolute top-4 right-4 text-gray-400 hover:text-primary transition-all z-10 p-2" id="closeLoginBtn">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="12"></line></svg>
        </button>

        <div class="p-8 pt-12">
            {{-- Step 1: Phone Input --}}
            <div id="step-phone" class="step-content space-y-6">
                <div class="text-center">
                    <div class="w-16 h-16 bg-primary/10 text-primary rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-mobile-alt text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900">Welcome to LUXE</h3>
                    <p class="text-sm text-gray-500 mt-2">Login or Signup to manage your orders</p>
                </div>

                <div class="space-y-4">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <span class="text-gray-900 font-bold border-r border-gray-200 pr-3">+91</span>
                        </div>
                        <input type="tel" id="customerPhone" maxlength="10" 
                            class="w-full pl-16 pr-4 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none font-bold text-gray-900 tracking-widest text-lg"
                            placeholder="Mobile Number" autocomplete="off">
                    </div>
                    <p id="phoneError" class="text-red-500 text-xs hidden"></p>
                    
                    <button id="btnSendOtp" class="w-full bg-primary text-gray-400 font-bold py-4 rounded-2xl shadow-lg shadow-primary/20 hover:bg-[#e63961] transition-all flex items-center justify-center group">
                        <span>Get OTP</span>
                        <i class="fas fa-arrow-right ml-2 text-sm group-hover:translate-x-1 transition-transform"></i>
                        <div id="otpLoader" class="hidden ml-2"><i class="fas fa-circle-notch fa-spin"></i></div>
                    </button>
                </div>
            </div>

            {{-- Step 2: OTP Input --}}
            <div id="step-otp" class="step-content hidden space-y-6">
                <div class="text-center">
                    <button id="backToPhone" class="text-[10px] font-bold text-primary uppercase tracking-widest hover:underline mb-2 inline-flex items-center">
                        <i class="fas fa-chevron-left mr-1"></i> Change Number
                    </button>
                    <h3 class="text-2xl font-bold text-gray-900">Verify OTP</h3>
                    <p class="text-sm text-gray-500 mt-2">Sent to <span id="displayPhone" class="font-bold text-gray-900"></span></p>
                </div>

                <div class="space-y-6">
                    <div class="flex justify-between gap-2" id="otpInputContainer">
                        @for($i = 0; $i < 6; $i++)
                            <input type="text" maxlength="1" data-index="{{ $i }}" 
                                class="otp-digit w-12 h-14 bg-gray-50 border border-gray-100 rounded-xl text-center font-bold text-xl text-gray-900 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none">
                        @endfor
                    </div>
                    <p id="otpError" class="text-red-500 text-xs text-center hidden"></p>

                    <div class="text-center space-y-4">
                        <p class="text-xs text-gray-500">
                            Didn't receive code? 
                            <button id="resendOtp" class="text-primary font-bold hover:underline disabled:opacity-50 disabled:no-underline" disabled>
                                Resend <span id="timer">(30s)</span>
                            </button>
                        </p>

                        <button id="btnVerifyOtp" class="w-full bg-primary text-gray-400 font-bold py-4 rounded-2xl shadow-lg shadow-primary/20 hover:bg-[#e63961] transition-all flex items-center justify-center">
                            <span>Verify & Login</span>
                            <div id="verifyLoader" class="hidden ml-2"><i class="fas fa-circle-notch fa-spin"></i></div>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Footer Info --}}
        <div class="p-6 bg-gray-50/50 border-t border-gray-100 text-center">
            <p class="text-[10px] text-gray-400 px-8 leading-relaxed">
                By continuing, you agree to LUXE's <a href="#" class="underline">Terms of Service</a> and <a href="#" class="underline">Privacy Policy</a>.
            </p>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('customerLoginModal');
    const content = document.getElementById('loginModalContent');
    const openTriggers = document.querySelectorAll('.openLoginModalTrigger');
    const closeBtn = document.getElementById('closeLoginBtn');
    const closeOverlay = document.getElementById('closeLoginOverlay');
    const stepPhone = document.getElementById('step-phone');
    const stepOtp = document.getElementById('step-otp');
    const btnSendOtp = document.getElementById('btnSendOtp');
    const btnVerifyOtp = document.getElementById('btnVerifyOtp');
    const phoneInput = document.getElementById('customerPhone');
    const otpDigits = document.querySelectorAll('.otp-digit');
    const resendBtn = document.getElementById('resendOtp');
    const timerSpan = document.getElementById('timer');

    let phone = '';
    let countdown = 30;
    let timerInterval;

    // Modal Controls
    openTriggers.forEach(trigger => {
        trigger.addEventListener('click', () => {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            setTimeout(() => {
                content.classList.remove('scale-95', 'opacity-0');
                content.classList.add('scale-100', 'opacity-100');
            }, 10);
        });
    });

    const closeModal = () => {
        content.classList.remove('scale-100', 'opacity-100');
        content.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            // Reset to step 1
            stepPhone.classList.remove('hidden');
            stepOtp.classList.add('hidden');
            phoneInput.value = '';
            otpDigits.forEach(d => d.value = '');
        }, 300);
    };

    closeBtn.addEventListener('click', closeModal);
    closeOverlay.addEventListener('click', closeModal);

    // Step 1: Send OTP
    btnSendOtp.addEventListener('click', async () => {
        phone = phoneInput.value;
        if(phone.length !== 10) {
            document.getElementById('phoneError').textContent = 'Please enter a valid 10-digit number';
            document.getElementById('phoneError').classList.remove('hidden');
            return;
        }

        document.getElementById('otpLoader').classList.remove('hidden');
        
        try {
            const response = await fetch('{{ route("customer.sendOtp") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ phone: phone })
            });
            const data = await response.json();
            
            if(data.status === 'success') {
                console.log('OTP (Testing):', data.otp); // ONLY FOR TESTING
                document.getElementById('displayPhone').textContent = '+91 ' + phone;
                stepPhone.classList.add('hidden');
                stepOtp.classList.remove('hidden');
                startTimer();
            }
        } catch (error) {
            console.error('Error:', error);
        } finally {
            document.getElementById('otpLoader').classList.add('hidden');
        }
    });

    // Step 2: OTP Input Handling
    otpDigits.forEach((digit, index) => {
        digit.addEventListener('keyup', (e) => {
            if(e.key >= 0 && e.key <= 9) {
                if(index < 5) otpDigits[index + 1].focus();
            } else if(e.key === 'Backspace') {
                if(index > 0) otpDigits[index - 1].focus();
            }
        });
    });

    // Step 2: Verify OTP
    btnVerifyOtp.addEventListener('click', async () => {
        let otp = '';
        otpDigits.forEach(d => otp += d.value);

        if(otp.length !== 6) {
            document.getElementById('otpError').textContent = 'Please enter 6-digit OTP';
            document.getElementById('otpError').classList.remove('hidden');
            return;
        }

        document.getElementById('verifyLoader').classList.remove('hidden');

        try {
            const response = await fetch('{{ route("customer.verifyOtp") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ phone: phone, otp: otp })
            });
            const data = await response.json();
            
            if(data.status === 'success') {
                window.location.href = data.redirect;
            } else {
                document.getElementById('otpError').textContent = data.message;
                document.getElementById('otpError').classList.remove('hidden');
            }
        } catch (error) {
            console.error('Error:', error);
        } finally {
            document.getElementById('verifyLoader').classList.add('hidden');
        }
    });

    function startTimer() {
        countdown = 30;
        resendBtn.disabled = true;
        timerInterval = setInterval(() => {
            countdown--;
            timerSpan.textContent = `(${countdown}s)`;
            if(countdown <= 0) {
                clearInterval(timerInterval);
                resendBtn.disabled = false;
                timerSpan.textContent = '';
            }
        }, 1000);
    }

    document.getElementById('backToPhone').addEventListener('click', () => {
        stepOtp.classList.add('hidden');
        stepPhone.classList.remove('hidden');
        clearInterval(timerInterval);
    });
});
</script>
