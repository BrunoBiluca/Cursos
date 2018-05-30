// Write your JavaScript code.
function formOnFail(error) {
	if (error.status === 500) {
		console.log(error);
		$("#msg-error").html(error.responseText);
	}
}