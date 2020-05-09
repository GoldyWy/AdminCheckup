function pindahHalaman(url)
{
  // Open in new tab
  window.open(url, '_blank');
  //focus to thet window
  window.focus();
  //reload current page
  setTimeout(
    function(){
      location.reload();
    },5000);


  // console.log(url);

}

$(document).ready(function(){

  var urll = $(location).attr('href'),
      parts = urll.split("/"),
      last_part = parts[parts.length-1];



  function show(){
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var url = $('meta[name="url"]').attr('content');

    $.ajax({
        /* the route pointing to the post function */
        url: url+"/pegawai/antrianAjax",
        type: 'POST',
        /* send the csrf-token and the input to the controller */
        data: {_token: CSRF_TOKEN, id : last_part },
        dataType: 'JSON',
        /* remind that 'data' is the response of the AjaxController */
        success: function (data) {
          var antrian = ``;
          if (data.antrian != null) {
            $.each(data.antrian, function(k, v) {
              if (k == 0) {
                antrian += `<li class="list-group-item list-group-item-warning">`+ v.nomor_antrian +`</li>`;
              }else{
                antrian += `<li class="list-group-item list-group-item-secondary">`+ v.nomor_antrian +`</li>`;
              }
            });
          }else{
            antrian += `<li class="list-group-item list-group-item-danger">Tidak ada antrian</li>`;
          }
          $('#listAntrian').html(antrian);
          // console.log(data);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown0){
          console.log(textStatus);
        }


    });

  }

  setInterval(show,1000);
  // show();

  // console.log(last_part);
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
