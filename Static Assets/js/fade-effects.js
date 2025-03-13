document.addEventListener("DOMContentLoaded", () => {
    const wrapper = document.querySelector('.fade-wrapper');
    if (wrapper) {
        wrapper.classList.add('fade-in');
    }
});


document.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', event => {
        const wrapper = document.querySelector('.fade-wrapper');
        if (wrapper) {
            const href = link.getAttribute('href');
            if (href && href !== "#") {  
                event.preventDefault();
                wrapper.classList.add('fade-out');
                setTimeout(() => {
                    window.location.href = href;
                }, 500);  
            }
        }
    });
});
