let row = document.getElementById("form")
let baton = document.querySelector("#new_row")

baton.onclick = function () {
	row.innerHTML += `

			<div class='row ml-1 mr-1'>
				<div class='col-lg-4'>
					<p class='name'>Выберите номер урока:</p>
					<select class='form-control' name='subject[]'></select>
				</div>
				<div class='col-lg-4'>
					<p class='name'>Выберите время урока:</p>
					<select class='form-control' name='subject[]'></select>
				</div>
				<div class='col-lg-4'>
					<p class='name'>ДЗ:</p>
					<textarea class='form-control' name='hw[]'></textarea>
				</div>
			</div>
	`;
}