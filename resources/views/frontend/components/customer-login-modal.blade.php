{{-- Customer OTP Login Modal --}}
<style>
    #customerLoginModal.hidden { display: none !important; }
    #customerLoginModal:not(.hidden) { display: flex !important; }
    #loginModalContent { max-height: calc(100vh - 32px); }
    .auth-modal-body { max-height: calc(100vh - 80px); overflow-y: auto; }
    .otp-modal-input { letter-spacing: 0.35em; font-size: 1.3rem; text-align: center; }
    .demo-otp-badge { background: linear-gradient(135deg,#fef3c7,#fde68a); border: 1.5px solid #f59e0b; }
</style>

<div id="customerLoginModal" class="fixed inset-0 z-[9999] hidden items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" id="closeLoginOverlay"></div>

    <div class="relative w-full max-w-sm overflow-hidden rounded-2xl bg-white shadow-2xl transition-all duration-300 scale-95 opacity-0" id="loginModalContent">
        <button class="absolute right-3 top-3 z-10 p-2 text-gray-400 transition-all hover:text-primary" id="closeLoginBtn" aria-label="Close">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </button>

        <div class="auth-modal-body p-5 pt-8 sm:p-6 sm:pt-9">
            <div class="mb-5 text-center">
                <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-2xl bg-primary/10 text-primary">
                    <i class="fas fa-mobile-alt text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900">Welcome to Hustler</h3>
                <p class="mt-1.5 text-xs text-gray-500">Sign in instantly with your mobile number.</p>
            </div>

            {{-- Alert --}}
            <div id="modalAlertBox" class="hidden mb-4 rounded-2xl border p-3 text-xs font-bold"></div>

            {{-- Demo OTP --}}
            <div id="modalDemoOtp" class="hidden demo-otp-badge rounded-2xl p-3 mb-4">
                <div class="flex items-center gap-1.5 mb-1">
                    <i class="fas fa-flask text-amber-500 text-[10px]"></i>
                    <span class="text-[10px] font-extrabold uppercase tracking-widest text-amber-700">Dev OTP</span>
                </div>
                <p class="text-2xl font-extrabold tracking-[0.3em] text-amber-800" id="modalDemoOtpValue">------</p>
                <p class="text-[10px] text-amber-600 mt-1 font-semibold">Valid 5 min — dev only</p>
            </div>

            {{-- Step 1: Phone --}}
            <div id="modalStepPhone">
                <div class="mb-4">
                    <label class="mb-1.5 block text-xs font-bold text-gray-700">Mobile Number</label>
                    <div class="flex gap-2">
                        <span class="flex items-center px-3 bg-gray-50 border border-gray-100 rounded-2xl text-xs font-bold text-gray-500 select-none">+91</span>
                        <input type="tel" id="modalPhone" maxlength="10" inputmode="numeric"
                            class="flex-1 rounded-2xl border border-gray-100 bg-gray-50 py-3 px-4 text-sm font-bold text-gray-900 outline-none transition-all focus:border-primary focus:ring-2 focus:ring-primary/20"
                            placeholder="9876543210">
                    </div>
                    <p id="modalPhoneError" class="hidden mt-1.5 text-[11px] font-semibold text-red-500"></p>
                </div>

                <button id="modalGetOtpBtn" onclick="modalSendOtp()"
                    class="flex w-full items-center justify-center gap-2 rounded-2xl bg-primary py-3 text-sm font-bold text-white shadow-lg shadow-primary/20 transition-all hover:bg-[#c91015]">
                    <span>Get OTP</span>
                    <i class="fas fa-arrow-right text-sm"></i>
                </button>
            </div>

            {{-- Step 2: OTP --}}
            <div id="modalStepOtp" class="hidden">
                <div class="mb-3 flex items-center justify-between">
                    <p class="text-xs text-gray-500 font-semibold">OTP sent to <span id="modalPhoneMask" class="text-gray-800 font-extrabold"></span></p>
                    <button onclick="modalResetPhone()" class="text-[11px] font-bold text-primary hover:underline">Change</button>
                </div>

                <div class="mb-4">
                    <label class="mb-1.5 block text-xs font-bold text-gray-700">Enter OTP</label>
                    <input type="tel" id="modalOtp" maxlength="6" inputmode="numeric"
                        class="otp-modal-input w-full rounded-2xl border border-gray-100 bg-gray-50 py-3 px-4 font-extrabold text-gray-900 outline-none transition-all focus:border-primary focus:ring-2 focus:ring-primary/20"
                        placeholder="• • • • • •">
                    <p id="modalOtpError" class="hidden mt-1.5 text-[11px] font-semibold text-red-500"></p>
                </div>

                <button id="modalVerifyBtn" onclick="modalVerifyOtp()"
                    class="flex w-full items-center justify-center gap-2 rounded-2xl bg-primary py-3 text-sm font-bold text-white shadow-lg shadow-primary/20 transition-all hover:bg-[#c91015]">
                    <span>Verify OTP</span>
                    <i class="fas fa-check text-sm"></i>
                </button>

                <div class="mt-3 text-center">
                    <button id="modalResendBtn" onclick="modalSendOtp(true)" disabled
                        class="text-[11px] font-bold text-gray-400 hover:text-primary transition-colors disabled:cursor-not-allowed">
                        Resend OTP <span id="modalResendTimer" class="text-primary"></span>
                    </button>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-100 bg-gray-50/50 p-4 text-center">
            <p class="px-2 text-[10px] leading-relaxed text-gray-400">
                By continuing, you agree to Hustler's <a href="#" class="underline">Terms</a> &amp; <a href="#" class="underline">Privacy Policy</a>.
            </p>
        </div>
    </div>
</div>

<script>
(function() {
    const CSRF = document.querySelector('meta[name="csrf-token"]').content;
    let modalResendInterval;

    function modalSetLoading(btnId, loading) {
        const btn = document.getElementById(btnId);
        btn.disabled = loading;
        if (loading) { btn.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i>'; return; }
        if (btnId === 'modalGetOtpBtn') btn.innerHTML = '<span>Get OTP</span><i class="fas fa-arrow-right text-sm"></i>';
        else btn.innerHTML = '<span>Verify OTP</span><i class="fas fa-check text-sm"></i>';
    }

    function modalShowAlert(msg, type) {
        const box = document.getElementById('modalAlertBox');
        box.className = 'mb-4 rounded-2xl border p-3 text-xs font-bold ' +
            (type === 'success' ? 'border-green-200 bg-green-50 text-green-700' : 'border-red-200 bg-red-50 text-red-600');
        box.textContent = msg;
        box.classList.remove('hidden');
    }

    function modalHideAlert() { document.getElementById('modalAlertBox').classList.add('hidden'); }

    function modalStartTimer(sec) {
        const btn = document.getElementById('modalResendBtn');
        const timer = document.getElementById('modalResendTimer');
        btn.disabled = true;
        let rem = sec;
        timer.textContent = `(${rem}s)`;
        clearInterval(modalResendInterval);
        modalResendInterval = setInterval(() => {
            rem--;
            if (rem <= 0) { clearInterval(modalResendInterval); timer.textContent = ''; btn.disabled = false; }
            else timer.textContent = `(${rem}s)`;
        }, 1000);
    }

    window.modalSendOtp = async function(isResend) {
        modalHideAlert();
        const phone = document.getElementById('modalPhone').value.trim();
        const phoneErr = document.getElementById('modalPhoneError');
        phoneErr.classList.add('hidden');

        if (!/^\d{10}$/.test(phone)) {
            phoneErr.textContent = 'Enter a valid 10-digit mobile number.';
            phoneErr.classList.remove('hidden');
            return;
        }

        modalSetLoading('modalGetOtpBtn', true);

        try {
            const res = await fetch('{{ route("customer.sendOtp") }}', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
                body: JSON.stringify({ phone })
            });
            const data = await res.json();

            if (!res.ok || data.status !== 'success') {
                modalShowAlert(data.message || 'Could not send OTP.', 'error');
                modalSetLoading('modalGetOtpBtn', false);
                return;
            }

            if (data.demo_otp) {
                document.getElementById('modalDemoOtpValue').textContent = data.demo_otp;
                document.getElementById('modalDemoOtp').classList.remove('hidden');
            }

            document.getElementById('modalPhoneMask').textContent = '+91 ' + phone.slice(0,2) + 'XXXXXX' + phone.slice(-2);
            document.getElementById('modalStepPhone').classList.add('hidden');
            document.getElementById('modalStepOtp').classList.remove('hidden');
            document.getElementById('modalOtp').focus();
            modalStartTimer(60);

        } catch(e) { modalShowAlert('Network error. Try again.', 'error'); }

        modalSetLoading('modalGetOtpBtn', false);
    };

    window.modalVerifyOtp = async function() {
        modalHideAlert();
        const phone = document.getElementById('modalPhone').value.trim();
        const otp   = document.getElementById('modalOtp').value.trim();
        const otpErr = document.getElementById('modalOtpError');
        otpErr.classList.add('hidden');

        if (!/^\d{6}$/.test(otp)) {
            otpErr.textContent = 'Enter the 6-digit OTP.';
            otpErr.classList.remove('hidden');
            return;
        }

        modalSetLoading('modalVerifyBtn', true);

        try {
            const res = await fetch('{{ route("customer.verifyOtp") }}', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
                body: JSON.stringify({ phone, otp })
            });
            const data = await res.json();

            if (!res.ok || data.status !== 'success') {
                modalShowAlert(data.message || 'Invalid OTP.', 'error');
                modalSetLoading('modalVerifyBtn', false);
                return;
            }

            modalShowAlert('Verified! Redirecting...', 'success');
            setTimeout(() => { window.location.href = data.redirect || '/my-account'; }, 800);

        } catch(e) {
            modalShowAlert('Network error. Try again.', 'error');
            modalSetLoading('modalVerifyBtn', false);
        }
    };

    window.modalResetPhone = function() {
        modalHideAlert();
        document.getElementById('modalDemoOtp').classList.add('hidden');
        document.getElementById('modalStepOtp').classList.add('hidden');
        document.getElementById('modalStepPhone').classList.remove('hidden');
        document.getElementById('modalOtp').value = '';
        clearInterval(modalResendInterval);
    };

    // Modal open/close
    const modal   = document.getElementById('customerLoginModal');
    const content = document.getElementById('loginModalContent');

    function openModal() {
        modal.classList.remove('hidden');
        setTimeout(() => { content.classList.remove('scale-95','opacity-0'); content.classList.add('scale-100','opacity-100'); }, 10);
    }

    function closeModal() {
        content.classList.remove('scale-100','opacity-100');
        content.classList.add('scale-95','opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
            modalResetPhone();
            document.getElementById('modalPhone').value = '';
        }, 300);
    }

    document.querySelectorAll('.openLoginModalTrigger').forEach(el => el.addEventListener('click', openModal));
    document.getElementById('closeLoginBtn').addEventListener('click', closeModal);
    document.getElementById('closeLoginOverlay').addEventListener('click', closeModal);
})();
</script>
