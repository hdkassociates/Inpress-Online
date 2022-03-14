/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens*/
const body = document.querySelector('body');
const hamburger = document.getElementById('hamburger');
hamburger.addEventListener('click',()=>{
	hamburger.classList.toggle('is-active');
	body.classList.toggle('mobile-nav-open');
})
