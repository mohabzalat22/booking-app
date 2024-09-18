import './bootstrap';
import 'flowbite';

const registerButton = document.getElementById('register-button');

registerButton?.addEventListener('click', ()=>{
    const register = document.getElementById('register');
    const login = document.getElementById('login');
    login.classList.add('hidden');
    register.classList.remove('hidden');
    register.classList.add('block');
});


const loginButton = document.getElementById('login-button');

loginButton?.addEventListener('click', ()=>{
    const register = document.getElementById('register');
    const login = document.getElementById('login');
    register.classList.add('hidden');
    login.classList.remove('hidden');
    login.classList.add('block');
});

// animation

import {animate, inView, stagger} from 'motion';
// nav
animate('#nav' , {paddingTop: "10px", paddingBottom: "10px"}, {duration:0.5, easing: 'ease-in-out'});


// card on main page
let cardsSection = document.getElementById('#cards-section');
inView('.mainCard', (info) => {
    animate('.mainCard' , {y:20 ,scale:0.96 }, {delay:stagger(0.1)})
}, {root:cardsSection})
