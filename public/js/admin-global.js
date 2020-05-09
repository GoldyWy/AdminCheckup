$(document).ready(function(){
    if (window.location.href.indexOf("pembayaran") > -1) {
      $('#menu-pembayaran').addClass('active');
    }

    if (window.location.href.indexOf("pasien") > -1) {
      $('#menu-pasien').addClass('active');
    }

    if (window.location.href.indexOf("user") > -1) {
      $('#menu-user').addClass('active');
    }

    if (window.location.href.indexOf("checkup") > -1) {
      $('#menu-checkup').addClass('active');
    }


    if (window.location.href.indexOf("pegawai") > -1) {
      $('#menu-pegawai').addClass('active');
    }

    if (window.location.href.indexOf("antrian") > -1) {
      $('#menu-antrian').addClass('active');
    }


});