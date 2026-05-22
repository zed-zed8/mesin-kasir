document.addEventListener("keydown", function (event) {
	if (event.key === "Enter") {
		const element = event.target;
		// console.log(event);
		// console.log(element);

		// Only apply this to input, not textareas or submit buttons
		if (element.tagName === "INPUT") {
			const form = element.form;
			console.log(form);
			if (form) {
				// Get all focusable elements in the form
				let index = Array.prototype.indexOf.call(form, element);
				let nextElement = form.elements[index + 1];
				// console.log(nextElement);

				if (
					nextElement.type == "hidden" ||
					nextElement.classList.contains("total-harga")
				) {
					let nextElement = form.elements[index + 2];
					// console.log(nextElement);
					nextElement.focus(); // Move to next input
				}

				if (nextElement) {
					event.preventDefault(); // Stop form submission
					nextElement.focus(); // Move to next input
					// console.log(nextElement);
				}
				if (nextElement.type == "submit") {
					// console.log(nextElement);
					const submit = form.querySelector('input[type = "submit"]');
					form.requestSubmit(submit);
				}
			}
		}
	}
});
