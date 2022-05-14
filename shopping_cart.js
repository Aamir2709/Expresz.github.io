const pay = document.querySelector('.pay-btn');
const okbtn = document.querySelector('.ok-btn');
const popupbox = document.querySelector('.popup-overlay');

pay.addEventListener('click',()=>{
    popupbox.classList.add('active');
})
okbtn.addEventListener('click',()=>{
    popupbox.classList('active')
})

const closePopUp = ()=>{popupbox.classList.add('active')}