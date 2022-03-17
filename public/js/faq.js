const chevron = document.querySelector("i")
const questions = document.querySelectorAll(".question")
const reponses = document.querySelectorAll(".reponse")

const faqs = document.querySelectorAll(".faq")

faqs.forEach( faq => {
    faq.addEventListener('click', () => {
        faq.classList.toggle('active')
    })
})