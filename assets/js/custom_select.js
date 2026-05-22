const all = document.querySelectorAll(".custom-select-wrapper");

// console.log(all);

let counter = 1;
all.forEach((wrapper) => {
	const trigger = wrapper.querySelector(".select-trigger");
	const options = wrapper.querySelector(".custom-options");
	const real_input = wrapper.querySelector(".real-input");

	// toggle dropdown
	trigger.addEventListener("click", () => {
		// console.log(trigger);
		options.classList.toggle("open");

		options.style.zIndex = counter;
		// console.log(options);
		counter++;
	});

	wrapper.querySelectorAll(".custom-option").forEach((option) => {
		option.addEventListener("click", () => {
			const val = option.getAttribute("data-value");
			const text = option.innerHTML;
			// console.log(val);
			// update

			trigger.innerHTML = text;
			trigger.classList.add("row");
			trigger.classList.add("d-flex");

			real_input.value = val;
			// console.log(real_input);

			options.classList.remove("open");
		});
	});
});

// Close dropdown if clicking outside
window.addEventListener("click", (e) => {
	if (!e.target.closest(".custom-select-wrapper")) {
		document
			.querySelectorAll(".custom-options")
			.forEach((list) => list.classList.remove("open"));
	}
});

const customOptions = document.querySelectorAll(".custom-option");
customOptions.forEach((option) => {
	option.addEventListener("click", function () {
		// Find the wrapper and the specific parent container
		const wrapper = this.closest(".custom-select-wrapper");
		const parent = this.closest(".select-parent");
		const inputJumlah = parent.querySelector(".input-jumlah");

		// console.log(inputJumlah);
		const get_style = window.getComputedStyle(inputJumlah);

		// Get data from the clicked custom-option
		const selectedStok = parseInt(this.dataset.stok);

		// Update max attribute and validate current value
		inputJumlah.setAttribute("max", selectedStok);
		inputJumlah.style = get_style;

		if (parseInt(inputJumlah.value) > selectedStok) {
			inputJumlah.value = selectedStok;
		}

		// Close the menu after selection
		this.parentElement.classList.remove("open");
	});
});
