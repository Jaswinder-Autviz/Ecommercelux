document.addEventListener('DOMContentLoaded', function() {
    const galleryWraps = document.querySelectorAll('.pg-img-wrap');

    galleryWraps.forEach(wrap => {
        wrap.addEventListener('mousemove', (e) => {
            const img = wrap.querySelector('img');
            const { left, top, width, height } = wrap.getBoundingClientRect();
            const x = ((e.pageX - left - window.scrollX) / width) * 100;
            const y = ((e.pageY - top - window.scrollY) / height) * 100;

            img.style.transformOrigin = `${x}% ${y}%`;
            img.style.transform = 'scale(1.5)';
        });

        wrap.addEventListener('mouseleave', () => {
            const img = wrap.querySelector('img');
            img.style.transform = 'scale(1)';
            img.style.transformOrigin = 'center center';
        });
    });
});
