// Active Links for SPA
// function activeLinks() {
//     const links = document.querySelectorAll('.link');
//     links.forEach((link) => {
//         link.addEventListener('click', () => {
//             links.forEach((item) => item.classList.remove('active'));
//             link.classList.add('active');
//         });
//     });
// }

function fadeOutSessionAlert() {
    const sessionContainer = document.querySelector('.session-container');

    if (sessionContainer) {
        setTimeout(() => {
            sessionContainer.style.transition = "opacity 0.5s ease";
            sessionContainer.style.opacity = 0;

            setTimeout(() => sessionContainer.remove(), 500);
        }, 3000); // 5 seconds
    }
}

fadeOutSessionAlert();
