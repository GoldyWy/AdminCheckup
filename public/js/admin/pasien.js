$(document).ready(function() {
  $('#dataTable').DataTable();

  // console.log("ok");
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


  //Batal Checkup
  $("#daftarCheckup").on("click", '.btlCheckup', function() {
      $(this).closest('tr.bataltr').remove();
      var id = $(this).data('id');
      var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
      var url = $('meta[name="url"]').attr('content');
      var kodepembayaran = $('#kodepembayaran').val();

      $.ajax({
          /* the route pointing to the post function */
          url: url+"/admin/pasien/daftar-checkup-batal",
          type: 'POST',
          /* send the csrf-token and the input to the controller */
          data: {_token: CSRF_TOKEN, id : id, kode: kodepembayaran },
          dataType: 'JSON',
          /* remind that 'data' is the response of the AjaxController */
          success: function (data) {
            if (data.status == 'success') {
              $(this).closest("tr").remove();
              Swal.fire(
                'Selamat !',
                data.msg,
                'success'
              )
              $('#totalHarga').html('Rp. '+ data.total);
            }

          }
      });
  });



  //Daftar checkup
  $("#tambahCheckup").click(function(){
      var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
      var url = $('meta[name="url"]').attr('content');
      var kodepembayaran = $('#kodepembayaran').val();
      var jnscheckup = $('#jnscheckup').val();
      var idpasien = $('#idpasien').val();
      // console.log(url+"/admin/pasien");

      $.ajax({
          /* the route pointing to the post function */
          url: url+"/admin/pasien/daftar-checkup",
          type: 'POST',
          /* send the csrf-token and the input to the controller */
          data: {_token: CSRF_TOKEN, kode : kodepembayaran, jnscheckup : jnscheckup, idpasien : idpasien},
          dataType: 'JSON',
          /* remind that 'data' is the response of the AjaxController */
          success: function (data) {
            if (data.status == 'success') {
              $('#jnscheckup').val('');
              Swal.fire(
                'Selamat !',
                data.msg,
                'success'
              )
              // console.log(data.msg);
              $('#daftarCheckupBody').append(`
                <tr class='bataltr'>
                  <td>`+ data.data.nama +`</td>
                  <td> Rp. `+ data.data.harga +`</td>
                  <td> <button class='btn btn-danger btlCheckup' data-id='`+ data.data.id +`' > Delete </button>
                </tr>
                `);
              $('#totalHarga').html('Rp. '+ data.data.total);
            }

          }
      });
  });



  // $(".btlCheckup").click(function(){
  //     var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
  //     var url = $('meta[name="url"]').attr('content');
  //     var id = $(this).data('id');
  //     console.log(id);
  //     console.log('coba');
  //
  //     // console.log(url+"/admin/pasien");
  //
  //     // $.ajax({
  //     //     /* the route pointing to the post function */
  //     //     url: url+"/admin/pasien/daftar-checkup",
  //     //     type: 'POST',
  //     //     /* send the csrf-token and the input to the controller */
  //     //     data: {_token: CSRF_TOKEN, kode : kodepembayaran, jnscheckup : jnscheckup, idpasien : idpasien},
  //     //     dataType: 'JSON',
  //     //     /* remind that 'data' is the response of the AjaxController */
  //     //     success: function (data) {
  //     //       $('#jnscheckup').val('');
  //     //       // console.log(data.msg);
  //     //       $('#daftarCheckup tr:last').after(`
  //     //         <tr>
  //     //           <td>`+ data.data.nama +`</td>
  //     //           <td> Rp. `+ data.data.harga +`</td>
  //     //           <td> <button class='btn btn-danger btlCheckup' data-id='`+ data.data.id +`' > Delete </button>
  //     //         </tr>
  //     //         `);
  //     //       // $(".writeinfo").append(data.msg);
  //     //     }
  //     // });
  // });

});
