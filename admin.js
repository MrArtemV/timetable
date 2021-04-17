let row = document.getElementById("form")
let baton = document.querySelector("#new_row")
let count = 0
baton.onclick = function () {
	count = count + 1
	row.innerHTML += `
			<div class='row ml-1 mr-1 underline'>
				<div class='col-lg-6'>
					<p class='name'>Выберите урок:</p>
					<select class='form-control' name='subject[]' id='sub`+ count +`'></select>
				</div>
				<div class='col-lg-6'>
					<p class='name'>ДЗ:</p>
					<textarea class='form-control' name='hw[]'></textarea>
				</div>
			</div>
	`;

	get_sub_json(count)
}

async function get_sub_json (count) {
	let qbo = document.querySelector('#sub'+count)
	fetch('subjects.json')
		.then((response) => {
	    	return response.json()
	  	}
	)
	  	.then((data) => {
	    	let arr = Object.values(data)
	    	delete arr[arr.length - 1]
	    	for (var i = 0; i < arr.length - 1; i++) {
	    		qbo.innerHTML += '<option>'+ arr[i]+'</option>';
	    	}
	    }
	)
	console.log(count);
}