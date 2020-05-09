$(document).ready(function(){
  // var id = this.href.substring(this.href.lastIndexOf('/') + 1);
  var url = $(location).attr('href'),
      parts = url.split("/"),
      last_part = parts[parts.length-1];


  // show();
  function show(){
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var url = $('meta[name="url"]').attr('content');
    var kodepembayaran = $('#kodepembayaran').val();

    $.ajax({
        /* the route pointing to the post function */
        url: url+"/antrian",
        type: 'POST',
        /* send the csrf-token and the input to the controller */
        data: {_token: CSRF_TOKEN, id : last_part },
        dataType: 'JSON',
        /* remind that 'data' is the response of the AjaxController */
        success: function (data) {
          var antrian = ``;
          var terpanggil = ``;
          var selanjutnya = ``;
          // console.log(data.time);




          if (data.antrian != null) {
            $.each(data.antrian, function(k, v) {
              // if (k == 0) {
              //   antrian += `<li class="list-group-item list-group-item-warning">`+ v.nomor_antrian +`</li>`;
              // }else{
              //   antrian += `<li class="list-group-item list-group-item-secondary">`+ v.nomor_antrian +`</li>`;
              // }
              antrian += `<tr>
                            <td class="text-center" style="font-size: 27px;">`+ v.nomor_antrian +`</td>
                            <td class="text-center" style="font-size: 27px;">`+ data.jnscheckup[0]['nama_jns_checkup'] +`</td>
                          </tr>`
            });

            selanjutnya += `<h2 style="color: white;" class="m-0">Antrian Selanjutnya : `+ data.antrian[0]['nomor_antrian'] +` </h2>`;


          }else{
            antrian += `<tr>
                          <td class="text-center" style="font-size: 27px;" colspan="2">Tidak ada antrian</td>

                        </tr>`;

            selanjutnya +=  `<h2 style="color: white;" class="m-0">Antrian Selanjutnya : </h2>`;
          }

          if (data.terpanggil != null) {
            terpanggil += `<h1 style='font-size:160px; font-weight:bold'>`+data.terpanggil.nomor_antrian+`</h1>`;
            // console.log(data.terpanggil.nomor_antrian);
          }else{
            terpanggil += `<h1>Antrian belum dimulai</h1>`;
          }
          $('#listTerpanggil').html(terpanggil);
          $('#listAntrian').html(antrian);
          $('#antrianSelanjutnya').html(selanjutnya);
          $('#time').html(`<h4 class="m-0">`+ data.time +`</h4>`);
          // console.log(antrian);
        }


    });


  }
      setInterval(show,1000);
  // console.log(last_part);


});
