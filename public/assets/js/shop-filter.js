document.addEventListener('DOMContentLoaded', function() {
    const items = Array.from(document.querySelectorAll('.shop-item'));
    const categoryFilters = document.querySelectorAll('.category-filter');
    const sizeBtns = document.querySelectorAll('.size-filter-btn');
    const priceRadios = document.querySelectorAll('.price-radio-filter');
    const countDisplay = document.getElementById('filtered-count');
    const noResults = document.getElementById('no-results');
    const clearBtn = document.querySelector('.clear-filters-btn');

    // Mobile Sidebar Logic
    const mobileTrigger = document.querySelector('.mobile-filter-trigger');
    const sidebar = document.querySelector('.shop-sidebar-container');
    const overlay = document.querySelector('.mobile-filter-overlay');
    const closeBtn = document.querySelector('.mobile-sidebar-close');

    if (mobileTrigger) {
        mobileTrigger.addEventListener('click', () => {
            sidebar.classList.add('active');
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
    }

    const closeMobileSidebar = () => {
        sidebar.classList.remove('active');
        overlay.classList.remove('active');
        document.body.style.overflow = '';
    };

    if (closeBtn) closeBtn.addEventListener('click', closeMobileSidebar);
    if (overlay) overlay.addEventListener('click', closeMobileSidebar);

    function applyFilters() {
        const activeCategories = Array.from(categoryFilters).filter(i => i.checked).map(i => i.value);
        const activeSize = document.querySelector('.size-filter-btn.active')?.dataset.size;
        const selectedPriceRadio = document.querySelector('.price-radio-filter:checked');
        
        const minP = selectedPriceRadio ? parseFloat(selectedPriceRadio.dataset.min) : 0;
        const maxP = selectedPriceRadio ? parseFloat(selectedPriceRadio.dataset.max) : Infinity;

        let visibleCount = 0;

        items.forEach(item => {
            const cat = item.dataset.category;
            const price = parseFloat(item.dataset.price);
            
            const catMatch = activeCategories.length === 0 || activeCategories.includes(cat);
            const priceMatch = price >= minP && price <= maxP;
            // Size match would need product size data, adding simple check
            const sizeMatch = !activeSize || true; // Mocking size match for now

            if (catMatch && priceMatch && sizeMatch) {
                item.classList.remove('hide');
                item.classList.add('show');
                visibleCount++;
            } else {
                item.classList.remove('show');
                item.classList.add('hide');
            }
        });

        if (countDisplay) countDisplay.textContent = visibleCount;
        if (noResults) noResults.style.display = visibleCount === 0 ? 'block' : 'none';
    }

    // Event Listeners
    categoryFilters.forEach(f => f.addEventListener('change', applyFilters));
    
    sizeBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            if (btn.classList.contains('active')) {
                btn.classList.remove('active');
            } else {
                sizeBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
            }
            applyFilters();
        });
    });

    priceRadios.forEach(r => r.addEventListener('change', applyFilters));

    if (clearBtn) {
        clearBtn.addEventListener('click', () => {
            categoryFilters.forEach(f => f.checked = false);
            priceRadios.forEach(r => r.checked = false);
            sizeBtns.forEach(b => b.classList.remove('active'));
            applyFilters();
        });
    }
});
