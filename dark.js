let themetoggler = document.querySelector('.theme-toggler');
let mobtoggler = document.querySelector('.mob_toggler');
let page = document.querySelector('#content');
	document.addEventListener("DOMContentLoaded", () => {
    	if (localStorage.getItem('dark') == 'true') {
		themetoggler.classList.toggle('active');
		page.classList.toggle('dark');	

		}
	});

themetoggler.onclick = function () {
	let dark = localStorage.getItem('dark');
	if (dark == 'true' ) {
		dark = false;
	}
	else {
		dark = true;
	}
	console.log(dark);
	localStorage.setItem('dark', dark);
	themetoggler.classList.toggle('active');
	page.classList.toggle('dark');	
}

mobtoggler.onclick = function () {
	let dark = localStorage.getItem('dark');
	if (dark == 'true' ) {
		dark = false;
	}
	else {
		dark = true;
	}
	console.log(dark);
	localStorage.setItem('dark', dark);
	themetoggler.classList.toggle('active');
	page.classList.toggle('dark');	
}