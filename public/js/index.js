$(document).ready(function() {
	$("#open").click(function () {
		$(".create-database-form").show(200);
		$("#close").show()
		$("#open").hide();
	});
	$("#close").click(function () {
		$(".create-database-form").hide(200);
		$("#open").show()
		$("#close").hide();
	});

	let alert = document.getElementById('alert');
	if(alert) {
		setTimeout(()=> {
			alert.style.display = "none"
		}, 5000);
	}

	let form = document.getElementById('query-form')['query-input'];
	form.addEventListener('change', (e) => {
		console.log(form.value);
	})

	$("#close-error").click(function () {
		$(".overlay").hide();
	})
});