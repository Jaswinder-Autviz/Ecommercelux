document.addEventListener('DOMContentLoaded', function() {
    // Accordion Logic
    const accButtons = document.querySelectorAll('.pi-acc-btn');
    accButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const item = btn.parentElement;
            item.classList.toggle('active');
        });
    });
});
