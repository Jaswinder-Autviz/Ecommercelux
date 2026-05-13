document.addEventListener('DOMContentLoaded', function() {
    const sortSelect = document.getElementById('product-sort');
    const grid = document.getElementById('product-grid');

    if (sortSelect) {
        sortSelect.addEventListener('change', function() {
            const val = this.value;
            const items = Array.from(grid.children);

            items.sort((a, b) => {
                if (val === 'price-low') {
                    return parseFloat(a.dataset.price) - parseFloat(b.dataset.price);
                } else if (val === 'price-high') {
                    return parseFloat(b.dataset.price) - parseFloat(a.dataset.price);
                } else if (val === 'trending') {
                    return (b.dataset.trending === 'true') - (a.dataset.trending === 'true');
                } else if (val === 'newest') {
                    return parseInt(b.dataset.id) - parseInt(a.dataset.id);
                }
                return 0; // Featured / Default
            });

            // Re-append sorted items
            items.forEach(item => grid.appendChild(item));
        });
    }
});
