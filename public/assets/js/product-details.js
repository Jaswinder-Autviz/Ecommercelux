document.addEventListener('DOMContentLoaded', function() {
    // Accordion Logic
    const accButtons = document.querySelectorAll('.pi-acc-btn');
    accButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const item = btn.parentElement;
            item.classList.toggle('active');
        });
    });

    // Qty Logic
    const minusBtn = document.querySelector('.pi-qty-btn.minus');
    const plusBtn = document.querySelector('.pi-qty-btn.plus');
    const qtyInput = document.querySelector('.pi-qty-input');

    if (minusBtn && plusBtn && qtyInput) {
        minusBtn.addEventListener('click', () => {
            let val = parseInt(qtyInput.value);
            if (val > 1) qtyInput.value = val - 1;
        });
        plusBtn.addEventListener('click', () => {
            let val = parseInt(qtyInput.value);
            qtyInput.value = val + 1;
        });
    }

    // Poster option selection
    const sizeButtons = document.querySelectorAll('.poster-option-btn[data-size]');
    sizeButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            sizeButtons.forEach(b => {
                if (b.dataset.size === btn.dataset.size) b.classList.add('active');
                else b.classList.remove('active');
            });
            const sizeError = document.getElementById('sizeError');
            if (sizeError) sizeError.style.display = 'none';
        });
    });

    const frameButtons = document.querySelectorAll('.poster-option-btn[data-frame]');
    frameButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            frameButtons.forEach(b => {
                if (b.dataset.frame === btn.dataset.frame) b.classList.add('active');
                else b.classList.remove('active');
            });
        });
    });

    // Size Guide Modal
    const guideBtn = document.querySelector('.pi-size-guide');
    const guideModal = document.getElementById('sizeGuideModal');
    const closeGuide = () => {
        if (!guideModal) return;
        guideModal.classList.remove('active');
        guideModal.setAttribute('aria-hidden', 'true');
        guideBtn?.setAttribute('aria-expanded', 'false');
    };

    guideBtn?.addEventListener('click', () => {
        if (!guideModal) return;
        guideModal.classList.add('active');
        guideModal.setAttribute('aria-hidden', 'false');
        guideBtn.setAttribute('aria-expanded', 'true');
    });

    document.querySelectorAll('[data-close-size-guide]').forEach(el => {
        el.addEventListener('click', closeGuide);
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') closeGuide();
    });

    // Size guide unit conversion
    const unitOptions = document.querySelectorAll('.pi-unit-toggle span');
    const sizeChart = document.querySelector('.pi-size-chart');

    if (unitOptions.length && sizeChart) {
        const headers = Array.from(sizeChart.querySelectorAll('thead th'));
        const measureCells = Array.from(sizeChart.querySelectorAll('tbody tr')).flatMap(row => {
            return Array.from(row.querySelectorAll('td')).slice(1);
        });

        measureCells.forEach(cell => {
            cell.dataset.inches = cell.textContent.trim();
        });

        function formatCm(value) {
            const cm = parseFloat(value) * 2.54;
            return Number.isInteger(cm) ? String(cm) : cm.toFixed(1);
        }

        function setUnit(unit) {
            unitOptions.forEach(option => {
                option.classList.toggle('active', option.dataset.unit === unit);
            });

            headers.forEach(header => {
                if (header.textContent.includes('Inch') || header.textContent.includes('Cm')) {
                    header.textContent = header.textContent
                        .replace(/\(Inch\)/g, unit === 'cm' ? '(Cm)' : '(Inch)')
                        .replace(/\(Cm\)/g, unit === 'cm' ? '(Cm)' : '(Inch)');
                }
            });

            measureCells.forEach(cell => {
                const inches = cell.dataset.inches;
                cell.textContent = unit === 'cm' ? formatCm(inches) : inches;
            });
        }

        unitOptions.forEach(option => {
            const unit = option.textContent.trim().toLowerCase().startsWith('cm') ? 'cm' : 'in';
            option.dataset.unit = unit;
            option.setAttribute('role', 'button');
            option.setAttribute('tabindex', '0');

            option.addEventListener('click', () => setUnit(unit));
            option.addEventListener('keydown', event => {
                if (event.key === 'Enter' || event.key === ' ') {
                    event.preventDefault();
                    setUnit(unit);
                }
            });
        });

        setUnit('in');
    }

    // Variant Image Selection
    const variantItems = document.querySelectorAll('.pi-variant-item');
    variantItems.forEach(item => {
        item.addEventListener('click', () => {
            variantItems.forEach(i => i.classList.remove('active'));
            item.classList.add('active');
            
            // Scroll to the corresponding image in gallery if needed
            const index = item.getAttribute('data-img-index');
            const galleryItems = document.querySelectorAll('.pg-item');
            if (galleryItems[index]) {
                galleryItems[index].scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        });
    });
});
