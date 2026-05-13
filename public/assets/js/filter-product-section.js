document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.fp-filter-btn');
    const priceSelect = document.getElementById('fp-price-range');
    const productItems = document.querySelectorAll('.fp-item');
    const noResults = document.getElementById('fp-no-results');
    const filterWrapper = document.querySelector('.fp-filter-wrapper');

    // Sticky Effect
    const observer = new IntersectionObserver(
        ([e]) => e.target.classList.toggle('is-sticky', e.intersectionRatio < 1),
        { 
            threshold: [1],
            rootMargin: `-${parseInt(getComputedStyle(document.documentElement).getPropertyValue('--header-height')) || 70}px 0px 0px 0px`
        }
    );
    if (filterWrapper) observer.observe(filterWrapper);

    function applyFilters() {
        const activeCategory = document.querySelector('.fp-filter-btn.active').dataset.filter;
        const priceRange = priceSelect.value;
        let visibleCount = 0;

        productItems.forEach(item => {
            const category = (item.dataset.category || '').toLowerCase();
            const price = parseFloat(item.dataset.price);
            
            // Category Match
            const categoryMatch = (activeCategory === 'all' || activeCategory === category);
            
            // Price Match
            let priceMatch = false;
            if (priceRange === 'all') {
                priceMatch = true;
            } else if (priceRange === '0-3000') {
                priceMatch = price < 3000;
            } else if (priceRange === '3000-5000') {
                priceMatch = price >= 3000 && price <= 5000;
            } else if (priceRange === '5000-above') {
                priceMatch = price > 5000;
            }

            if (categoryMatch && priceMatch) {
                item.classList.remove('hide');
                item.classList.add('show');
                visibleCount++;
            } else {
                item.classList.remove('show');
                item.classList.add('hide');
            }
        });

        noResults.style.display = visibleCount === 0 ? 'block' : 'none';
    }

    // Event Listeners
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            applyFilters();
        });
    });

    if (priceSelect) {
        priceSelect.addEventListener('change', applyFilters);
    }
});
