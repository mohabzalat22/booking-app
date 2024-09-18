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