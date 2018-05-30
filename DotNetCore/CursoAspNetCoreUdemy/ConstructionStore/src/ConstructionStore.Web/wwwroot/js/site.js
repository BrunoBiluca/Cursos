// Write your JavaScript code.
function formOnFail(error) {
	if (error.status === 500) {
		$("#msg-error").html(error.responseText);
	}
}