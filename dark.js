let themetoggler = document.querySelector('.theme-toggler');
let page = document.querySelector('#content');

themetoggler.onclick = function () {
	themetoggler.classList.toggle('active');
	page.classList.toggle('dark');
}
