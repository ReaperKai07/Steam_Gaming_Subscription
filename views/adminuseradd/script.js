function showSweetAlertUpdateSuccess()
{
  Swal.fire({
  position: "center",
  icon: "success",
  title: "Added!",
  text: 'Profile has been successfully added.',
  showConfirmButton: false,
  timer: 2000
});
}

function showSweetAlertUpdateFailed()
{
  Swal.fire({
  position: "center",
  icon: "error",
  title: "Error!",
  text: 'Failed to add profile.',
  showConfirmButton: false,
  timer: 2000
});
}


