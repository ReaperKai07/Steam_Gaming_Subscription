const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const main = document.getElementById('main');

signUpButton.addEventListener('click', () => {
    main.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
    main.classList.remove("right-panel-active");
});



function showSweetAlertAddSuccess()
{
  Swal.fire({
  position: "center",
  icon: "success",
  title: "Added!",
  text: 'Account has been successfully created.',
  showConfirmButton: false,
  timer: 5000
});
}

function showSweetAlertAddFailed()
{
  Swal.fire({
  position: "center",
  icon: "error",
  title: "Error!",
  text: 'Failed to create account. An account with this email already exists. Please use a different email or login with your existing account.',
  showConfirmButton: false,
  timer: 5000
});
}

function showSweetAlertLoginFailed()
{
  Swal.fire({
  position: "center",
  icon: "error",
  title: "Error!",
  text: 'Failed to login. Please check your email and password correctly.',
  showConfirmButton: false,
  timer: 5000
});
}
