window.onload = () => {
    const navbar = document.querySelector('.navbar');
    const burger = document.querySelector('.burger');
    burger.addEventListener('click', () => {
        navbar.classList.toggle('show-nav');
    });
}

const txtAnim = document.querySelector('.h1-anim');

new Typewriter(txtAnim, {
    deleteSpeed:45,
})
    .changeDelay(45)
    .typeString('Bienvenue sur Webgestion !')
    .pauseFor(400)
    .deleteChars(13)
    .typeString(' Webgestion <span class="txt-anim">V2</span> plutôt :)')
    .start()


const closeIcon = document.querySelector('.close');
if (closeIcon) {
    closeIcon.addEventListener('click', () => {
        document.querySelector('.alert').style.opacity = 0;
    });
}
