/* ============================================================
   PREMIUM TOAST NOTIFICATION SYSTEM — toast.js
   ============================================================ */

window.Toast = (function () {
    'use strict';

    let container = null;

    function getContainer() {
        if (!container) {
            container = document.getElementById('toast-container');
            if (!container) {
                container = document.createElement('div');
                container.id = 'toast-container';
                document.body.appendChild(container);
            }
        }
        return container;
    }

    const icons = {
        warning: '<i class="fas fa-exclamation-triangle"></i>',
        success: '<i class="fas fa-check"></i>',
        info: '<i class="fas fa-info-circle"></i>',
        error: '<i class="fas fa-times-circle"></i>',
    };

    function show(message, type = 'warning', title = '', duration = 3500) {
        const cont = getContainer();

        const toast = document.createElement('div');
        toast.className = `toast-item toast-${type}`;

        const iconHtml = icons[type] || icons.info;
        const defaultTitle = type === 'warning' ? 'Notice' : type === 'success' ? 'Success' : 'Information';
        const displayTitle = title || defaultTitle;

        toast.innerHTML = `
            <div class="toast-icon">${iconHtml}</div>
            <div class="toast-content">
                <div class="toast-title">${displayTitle}</div>
                <div class="toast-message">${message}</div>
            </div>
            <button class="toast-close" aria-label="Close">&times;</button>
            <div class="toast-progress" style="animation-duration: ${duration}ms;"></div>
        `;

        cont.appendChild(toast);

        // Animate in
        requestAnimationFrame(() => {
            requestAnimationFrame(() => {
                toast.classList.add('toast-show');
            });
        });

        let isDismissed = false;
        function dismiss() {
            if (isDismissed) return;
            isDismissed = true;
            toast.classList.remove('toast-show');
            toast.classList.add('toast-hide');
            setTimeout(() => {
                toast.remove();
            }, 350);
        }

        // Close on button click
        toast.querySelector('.toast-close').addEventListener('click', dismiss);

        // Auto dismiss after duration
        if (duration > 0) {
            setTimeout(dismiss, duration);
        }

        return toast;
    }

    return {
        show: show,
        warning: (msg, title = 'Notice', duration = 3500) => show(msg, 'warning', title, duration),
        success: (msg, title = 'Success', duration = 3500) => show(msg, 'success', title, duration),
        info: (msg, title = 'Info', duration = 3500) => show(msg, 'info', title, duration),
        error: (msg, title = 'Error', duration = 4000) => show(msg, 'warning', title, duration),
    };
})();
