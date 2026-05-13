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

    // Shoe Size Selection
    const shoeBtns = document.querySelectorAll('.pi-shoe-btn');
    shoeBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            shoeBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            const sizeError = document.getElementById('sizeError');
            if (sizeError) sizeError.style.display = 'none';
        });
    });

    // Size Selection
    const sizeBtns = document.querySelectorAll('.pi-size-btn');
    sizeBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            sizeBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
        });
    });

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
