<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Hustler</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = { theme: { extend: { colors: { primary: '#e71318' } } } }
    </script>
    <style>
        body { font-family: 'Montserrat', sans-serif; }
        .otp-input { letter-spacing: 0.4em; font-size: 1.4rem; text-align: center; }
        .fade-in { animation: fadeIn 0.3s ease; }
        @keyframes fadeIn { from { opacity:0; transform:translateY(8px); } to { opacity:1; transform:translateY(0); } }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center px-4 py-10"
      style="background: linear-gradient(135deg,#f8f8f8 0%,#fff0f0 100%);">

    <div class="w-full max-w-md">

        {{-- Logo --}}
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-flex flex-col items-center gap-1">
                <span class="flex h-14 w-14 items-center justify-center rounded-2xl bg-primary text-2xl font-extrabold text-white shadow-lg shadow-primary/30">H</span>
                <span class="text-xl font-extrabold tracking-tight text-gray-900 mt-1">Hustler</span>
                <span class="text-[10px] font-bold uppercase tracking-[0.25em] text-gray-400">Premium Wall Art</span>
            </a>
        </div>

        {{-- Card --}}
        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8">

            <div class="mb-7">
                <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Sign in to your account</h1>
                <p class="mt-1.5 text-sm text-gray-500">Enter your mobile number to get a one-time password.</p>
            </div>

            {{-- Alert --}}
            <div id="alertBox" class="hidden mb-5 rounded-2xl border p-4 text-sm font-semibold"></div>

            {{-- Demo OTP Box --}}
            <div id="demoOtpBox" class="hidden mb-5 rounded-2xl border-2 border-amber-300 bg-amber-50 p-4 fade-in">
                <div class="flex items-center gap-2 mb-2">
                    <i class="fas fa-flask text-amber-500 text-xs"></i>
                    <span class="text-xs font-extrabold uppercase tracking-widest text-amber-700">Development OTP</span>
                </div>
                <p class="text-3xl font-extrabold tracking-[0.35em] text-amber-800" id="demoOtpValue">------</p>
                <p class="text-[11px] text-amber-600 mt-1.5 font-semibold">Valid for 5 minutes &mdash; remove this display in production.</p>
            </div>

            {{-- Step 1: Phone --}}
            <div id="stepPhone">
                <div class="mb-5">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Mobile Number</label>
                    <div class="flex gap-2">
                        <span class="flex items-center px-4 bg-gray-50 border border-gray-200 rounded-2xl text-sm font-bold text-gray-500 select-none">+91</span>
                        <input type="tel" id="phoneInput" maxlength="10" inputmode="numeric"
                            class="flex-1 px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl text-sm font-bold text-gray-900 outline-none focus:border-primary focus:ring-2 focus:ring-primary/15 transition-all"
                            placeholder="9876543210">
                    </div>
                    <p id="phoneError" class="hidden mt-2 text-xs font-semibold text-red-500"></p>
                </div>

                <button id="getOtpBtn" onclick="sendOtp()"
                    class="w-full flex items-center justify-center gap-2 bg-primary text-white py-4 rounded-2xl font-extrabold text-sm shadow-lg shadow-primary/25 hover:bg-[#c91015] transition-all hover:-translate-y-0.5 active:translate-y-0">
                    <span>Get OTP</span>
                    <i class="fas fa-arrow-right text-xs"></i>
                </button>
            </div>

            {{-- Step 2: OTP --}}
            <div id="stepOtp" class="hidden">
                <div class="mb-4 flex items-center justify-between">
                    <p class="text-sm text-gray-500 font-semibold">OTP sent to <span id="phoneMask" class="text-gray-800 font-extrabold"></span></p>
                    <button onclick="resetToPhone()" class="text-xs font-bold text-primary hover:underline">Change</button>
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Enter OTP</label>
                    <input type="tel" id="otpInput" maxlength="6" inputmode="numeric"
                        class="otp-input w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl font-extrabold text-gray-900 outline-none focus:border-primary focus:ring-2 focus:ring-primary/15 transition-all"
                        placeholder="• • • • • •">
                    <p id="otpError" class="hidden mt-2 text-xs font-semibold text-red-500"></p>
                </div>

                <button id="verifyOtpBtn" onclick="verifyOtp()"
                    class="w-full flex items-center justify-center gap-2 bg-primary text-white py-4 rounded-2xl font-extrabold text-sm shadow-lg shadow-primary/25 hover:bg-[#c91015] transition-all hover:-translate-y-0.5 active:translate-y-0">
                    <span>Verify OTP</span>
                    <i class="fas fa-check text-xs"></i>
                </button>

                <div class="mt-4 text-center">
                    <button id="resendBtn" onclick="sendOtp(true)" disabled
                        class="text-xs font-bold text-gray-400 hover:text-primary transition-colors disabled:cursor-not-allowed">
                        Resend OTP <span id="resendTimer" class="text-primary"></span>
                    </button>
                </div>
            </div>

        </div>

        <p class="mt-6 text-center text-xs text-gray-400 font-semibold">
            &copy; {{ date('Y') }} Hustler. All rights reserved.
        </p>
    </div>

<script>
const CSRF = document.querySelector('meta[name="csrf-token"]').content;
let resendInterval;

function setLoading(btnId, loading) {
    const btn = document.getElementById(btnId);
    btn.disabled = loading;
    if (loading) {
        btn.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i>';
    } else if (btnId === 'getOtpBtn') {
        btn.innerHTML = '<span>Get OTP</span><i class="fas fa-arrow-right text-xs"></i>';
    } else {
        btn.innerHTML = '<span>Verify OTP</span><i class="fas fa-check text-xs"></i>';
    }
}

function showAlert(msg, type = 'error') {
    const box = document.getElementById('alertBox');
    box.className = 'mb-5 rounded-2xl border p-4 text-sm font-semibold ' +
        (type === 'success' ? 'border-green-200 bg-green-50 text-green-700' : 'border-red-200 bg-red-50 text-red-600');
    box.textContent = msg;
    box.classList.remove('hidden');
}

function hideAlert() { document.getElementById('alertBox').classList.add('hidden'); }

function startResendTimer(seconds) {
    const btn = document.getElementById('resendBtn');
    const timer = document.getElementById('resendTimer');
    btn.disabled = true;
    let rem = seconds;
    timer.textContent = `(${rem}s)`;
    clearInterval(resendInterval);
    resendInterval = setInterval(() => {
        rem--;
        if (rem <= 0) { clearInterval(resendInterval); timer.textContent = ''; btn.disabled = false; }
        else { timer.textContent = `(${rem}s)`; }
    }, 1000);
}

async function sendOtp(isResend = false) {
    hideAlert();
    const phone = document.getElementById('phoneInput').value.trim();
    const phoneErr = document.getElementById('phoneError');
    phoneErr.classList.add('hidden');

    if (!/^\d{10}$/.test(phone)) {
        phoneErr.textContent = 'Please enter a valid 10-digit mobile number.';
        phoneErr.classList.remove('hidden');
        return;
    }

    setLoading('getOtpBtn', true);

    try {
        const res = await fetch('{{ route("customer.sendOtp") }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
            body: JSON.stringify({ phone })
        });
        const data = await res.json();

        if (!res.ok || data.status !== 'success') {
            showAlert(data.message || 'Could not send OTP. Please try again.');
            setLoading('getOtpBtn', false);
            return;
        }

        // Show demo OTP (development only)
        if (data.demo_otp) {
            document.getElementById('demoOtpValue').textContent = data.demo_otp;
            document.getElementById('demoOtpBox').classList.remove('hidden');
        }

        document.getElementById('phoneMask').textContent = '+91 ' + phone.slice(0,2) + 'XXXXXX' + phone.slice(-2);
        document.getElementById('stepPhone').classList.add('hidden');
        const stepOtp = document.getElementById('stepOtp');
        stepOtp.classList.remove('hidden');
        stepOtp.classList.add('fade-in');
        document.getElementById('otpInput').focus();
        startResendTimer(60);

    } catch (e) {
        showAlert('Network error. Please try again.');
    }

    setLoading('getOtpBtn', false);
}

async function verifyOtp() {
    hideAlert();
    const phone = document.getElementById('phoneInput').value.trim();
    const otp   = document.getElementById('otpInput').value.trim();
    const otpErr = document.getElementById('otpError');
    otpErr.classList.add('hidden');

    if (!/^\d{6}$/.test(otp)) {
        otpErr.textContent = 'Please enter the 6-digit OTP.';
        otpErr.classList.remove('hidden');
        return;
    }

    setLoading('verifyOtpBtn', true);

    try {
        const res = await fetch('{{ route("customer.verifyOtp") }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
            body: JSON.stringify({ phone, otp })
        });
        const data = await res.json();

        if (!res.ok || data.status !== 'success') {
            showAlert(data.message || 'Invalid OTP. Please try again.');
            setLoading('verifyOtpBtn', false);
            return;
        }

        showAlert('Verified! Redirecting...', 'success');
        setTimeout(() => { window.location.href = data.redirect || '{{ route("customer.account") }}'; }, 800);

    } catch (e) {
        showAlert('Network error. Please try again.');
        setLoading('verifyOtpBtn', false);
    }
}

function resetToPhone() {
    hideAlert();
    document.getElementById('demoOtpBox').classList.add('hidden');
    document.getElementById('stepOtp').classList.add('hidden');
    document.getElementById('stepPhone').classList.remove('hidden');
    document.getElementById('otpInput').value = '';
    clearInterval(resendInterval);
}

document.addEventListener('keydown', function(e) {
    if (e.key !== 'Enter') return;
    if (!document.getElementById('stepOtp').classList.contains('hidden')) verifyOtp();
    else sendOtp();
});
</script>
</body>
</html>
