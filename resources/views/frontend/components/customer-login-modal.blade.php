{{-- Customer Email Login Modal --}}
<style>
    #customerLoginModal.hidden { display: none !important; }
    #customerLoginModal:not(.hidden) { display: flex !important; }
    .auth-panel.hidden { display: none !important; }
    #loginModalContent { max-height: calc(100vh - 32px); }
    .auth-modal-body { max-height: calc(100vh - 128px); overflow-y: auto; }
</style>

<div id="customerLoginModal" class="fixed inset-0 z-[9999] hidden items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" id="closeLoginOverlay"></div>

    <div class="relative w-full max-w-sm overflow-hidden rounded-2xl bg-white shadow-2xl transition-all duration-300 scale-95 opacity-0" id="loginModalContent">
        <button class="absolute right-3 top-3 z-10 p-2 text-gray-400 transition-all hover:text-primary" id="closeLoginBtn" aria-label="Close login">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>

        <div class="auth-modal-body p-5 pt-8 sm:p-6 sm:pt-9">
            <div class="mb-4 text-center">
                <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-2xl bg-primary/10 text-primary">
                    <i class="fas fa-envelope text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900">Welcome to Hustler</h3>
                <p class="mt-1.5 text-xs text-gray-500">Login or create your account with Gmail/email.</p>
            </div>

            <div class="mb-4 grid grid-cols-2 gap-2 rounded-2xl bg-gray-50 p-1">
                <button type="button" id="showLoginPanel" class="rounded-xl bg-white px-4 py-2.5 text-xs font-extrabold text-gray-950 shadow-sm">Login</button>
                <button type="button" id="showRegisterPanel" class="rounded-xl px-4 py-2.5 text-xs font-extrabold text-gray-500">Register</button>
            </div>

            <div id="customerAuthMessage" class="mb-4 hidden rounded-2xl border p-3 text-xs font-bold"></div>

            <form id="customerEmailLoginForm" class="auth-panel space-y-3">
                <div>
                    <label class="mb-1.5 block text-xs font-bold text-gray-700">Gmail / Email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-400">
                            <i class="fas fa-envelope text-sm"></i>
                        </span>
                        <input type="email" name="email" required
                            class="w-full rounded-2xl border border-gray-100 bg-gray-50 py-3 pl-10 pr-4 text-sm font-bold text-gray-900 outline-none transition-all focus:border-primary focus:ring-2 focus:ring-primary/20"
                            placeholder="you@gmail.com">
                    </div>
                </div>

                <div>
                    <label class="mb-1.5 block text-xs font-bold text-gray-700">Password</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-400">
                            <i class="fas fa-lock text-sm"></i>
                        </span>
                        <input type="password" name="password" required
                            class="w-full rounded-2xl border border-gray-100 bg-gray-50 py-3 pl-10 pr-4 text-sm font-bold text-gray-900 outline-none transition-all focus:border-primary focus:ring-2 focus:ring-primary/20"
                            placeholder="Enter password">
                    </div>
                </div>

                <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-2xl bg-primary py-3 text-sm font-bold text-white shadow-lg shadow-primary/20 transition-all hover:bg-[#c91015]">
                    <span>Login</span>
                    <i class="fas fa-arrow-right text-sm"></i>
                </button>
            </form>

            <form id="customerEmailRegisterForm" class="auth-panel hidden space-y-3">
                <div>
                    <label class="mb-1.5 block text-xs font-bold text-gray-700">Full Name</label>
                    <input type="text" name="name" required
                        class="w-full rounded-2xl border border-gray-100 bg-gray-50 px-4 py-3 text-sm font-bold text-gray-900 outline-none transition-all focus:border-primary focus:ring-2 focus:ring-primary/20"
                        placeholder="Your name">
                </div>

                <div>
                    <label class="mb-1.5 block text-xs font-bold text-gray-700">Gmail / Email</label>
                    <input type="email" name="email" required
                        class="w-full rounded-2xl border border-gray-100 bg-gray-50 px-4 py-3 text-sm font-bold text-gray-900 outline-none transition-all focus:border-primary focus:ring-2 focus:ring-primary/20"
                        placeholder="you@gmail.com">
                </div>

                <div>
                    <label class="mb-1.5 block text-xs font-bold text-gray-700">Password</label>
                    <input type="password" name="password" required minlength="6"
                        class="w-full rounded-2xl border border-gray-100 bg-gray-50 px-4 py-3 text-sm font-bold text-gray-900 outline-none transition-all focus:border-primary focus:ring-2 focus:ring-primary/20"
                        placeholder="Create password">
                </div>

                <div>
                    <label class="mb-1.5 block text-xs font-bold text-gray-700">Confirm Password</label>
                    <input type="password" name="password_confirmation" required minlength="6"
                        class="w-full rounded-2xl border border-gray-100 bg-gray-50 px-4 py-3 text-sm font-bold text-gray-900 outline-none transition-all focus:border-primary focus:ring-2 focus:ring-primary/20"
                        placeholder="Confirm password">
                </div>

                <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-2xl bg-primary py-3 text-sm font-bold text-white shadow-lg shadow-primary/20 transition-all hover:bg-[#c91015]">
                    <span>Create Account</span>
                    <i class="fas fa-check text-sm"></i>
                </button>
            </form>
        </div>

        <div class="border-t border-gray-100 bg-gray-50/50 p-4 text-center">
            <p class="px-2 text-[10px] leading-relaxed text-gray-400">
                By continuing, you agree to Hustler's <a href="#" class="underline">Terms of Service</a> and <a href="#" class="underline">Privacy Policy</a>.
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
    const loginForm = document.getElementById('customerEmailLoginForm');
    const registerForm = document.getElementById('customerEmailRegisterForm');
    const showLoginPanel = document.getElementById('showLoginPanel');
    const showRegisterPanel = document.getElementById('showRegisterPanel');
    const messageBox = document.getElementById('customerAuthMessage');

    function showMessage(text, type = 'error') {
        messageBox.textContent = text;
        messageBox.classList.remove('hidden', 'border-red-100', 'bg-red-50', 'text-red-600', 'border-green-100', 'bg-green-50', 'text-green-600');
        if (type === 'success') {
            messageBox.classList.add('border-green-100', 'bg-green-50', 'text-green-600');
        } else {
            messageBox.classList.add('border-red-100', 'bg-red-50', 'text-red-600');
        }
    }

    function clearMessage() {
        messageBox.classList.add('hidden');
        messageBox.textContent = '';
    }

    function switchPanel(panel) {
        clearMessage();
        const isLogin = panel === 'login';
        loginForm.classList.toggle('hidden', !isLogin);
        registerForm.classList.toggle('hidden', isLogin);
        showLoginPanel.classList.toggle('bg-white', isLogin);
        showLoginPanel.classList.toggle('text-gray-950', isLogin);
        showLoginPanel.classList.toggle('shadow-sm', isLogin);
        showLoginPanel.classList.toggle('text-gray-500', !isLogin);
        showRegisterPanel.classList.toggle('bg-white', !isLogin);
        showRegisterPanel.classList.toggle('text-gray-950', !isLogin);
        showRegisterPanel.classList.toggle('shadow-sm', !isLogin);
        showRegisterPanel.classList.toggle('text-gray-500', isLogin);
    }

    function openModal() {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => {
            content.classList.remove('scale-95', 'opacity-0');
            content.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeModal() {
        content.classList.remove('scale-100', 'opacity-100');
        content.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            loginForm.reset();
            registerForm.reset();
            switchPanel('login');
        }, 300);
    }

    async function submitAuthForm(form, url) {
        clearMessage();
        const button = form.querySelector('button[type="submit"]');
        const originalHtml = button.innerHTML;
        button.disabled = true;
        button.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i>';

        try {
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: new FormData(form)
            });

            const data = await response.json();

            if (!response.ok || data.status !== 'success') {
                const errors = data.errors ? Object.values(data.errors).flat() : [];
                showMessage(errors[0] || data.message || 'Please check your details and try again.');
                return;
            }

            showMessage(data.message || 'Logged in successfully.', 'success');
            window.location.href = data.redirect || '{{ route('customer.account') }}';
        } catch (error) {
            showMessage('Login service is unavailable. Please try again.');
        } finally {
            button.disabled = false;
            button.innerHTML = originalHtml;
        }
    }

    openTriggers.forEach(trigger => trigger.addEventListener('click', openModal));
    closeBtn.addEventListener('click', closeModal);
    closeOverlay.addEventListener('click', closeModal);
    showLoginPanel.addEventListener('click', () => switchPanel('login'));
    showRegisterPanel.addEventListener('click', () => switchPanel('register'));
    loginForm.addEventListener('submit', (event) => {
        event.preventDefault();
        submitAuthForm(loginForm, '{{ route("customer.login") }}');
    });
    registerForm.addEventListener('submit', (event) => {
        event.preventDefault();
        submitAuthForm(registerForm, '{{ route("customer.register") }}');
    });
});
</script>
