function showSweetAlertDelete()
{
  Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#3085d6',
    confirmButtonText: 'Delete'
  }).then((result) => {if (result.isConfirmed){Swal.fire('Deleted!','Record has been successfully deleted.','success')}})
}

function showSweetAlertUpdateSuccess()
{
  Swal.fire({
  position: "center",
  icon: "success",
  title: "Updated!",
  text: 'Profile has been successfully updated.',
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
  text: 'Failed to update profile.',
  showConfirmButton: false,
  timer: 2000
});
}


