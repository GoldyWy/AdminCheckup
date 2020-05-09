$(document).ready(function(){
  $('#dataTable').DataTable();

  const flashSuccess = $('#flash-data').data('success');
  const flashFailed = $('#flash-data').data('failed');
    if (flashSuccess) {
      Swal.fire(
      'Selamat !',
      flashSuccess,
      'success'
    )
  }
  if(flashFailed){
      Swal.fire({
      type: 'error',
      title: 'Oops...',
      text: flashFailed
    });
  }
});
