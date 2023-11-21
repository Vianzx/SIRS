const CtogglePassword = document.querySelector("#CtogglePassword");
const Cpassword = document.querySelector("#current_password");

CtogglePassword.addEventListener("click", function (e) {
	const Ctype =
		Cpassword.getAttribute("type") === "password" ? "text" : "password";

	Cpassword.setAttribute("type", Ctype);

	// toggle the eye slash icon
	this.classList.toggle("fa-eye-slash");
});


const NtogglePassword1 = document.querySelector("#NtogglePassword1");
const Npassword1 = document.querySelector('#new_password1');

NtogglePassword1.addEventListener("click", function (e) {
	const Ntype1 =
		Npassword1.getAttribute("type") === "password" ? "text" : "password";

	Npassword1.setAttribute("type", Ntype1);

	// toggle the eye slash icon
	this.classList.toggle("fa-eye-slash");
});


const NtogglePassword2 = document.querySelector("#NtogglePassword2");
const Npassword2 = document.querySelector('#new_password2');

NtogglePassword2.addEventListener("click", function (e) {
	const Ntype2 =
		Npassword2.getAttribute("type") === "password" ? "text" : "password";

	Npassword2.setAttribute("type", Ntype2);

	// toggle the eye slash icon
	this.classList.toggle("fa-eye-slash");
});
