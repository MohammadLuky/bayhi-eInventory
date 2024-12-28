  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
      <strong>Copyright &copy; IT-Bayt Alhikmah 2023.</strong>
      E-Inventory.
      <div class="float-right d-none d-sm-inline-block">
          <b>Version</b> v.1.0
      </div>
  </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->
  <!-- jQuery -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.all.min.js" integrity="sha256-mW1wrhuKp2Cl0DCVr/7+GTdl168ZrmB6FayoMAlSmH0=" crossorigin="anonymous"></script>
  <script src="<?= base_url('assets/admin_lte/') ?>plugins/toastr/toastr.min.js"></script>
  <script src="<?= base_url('assets/admin_lte/') ?>plugins/jquery/jquery.min.js"></script>
  <script src="<?= base_url('assets/admin_lte/') ?>dist/js/pages/dashboard2.js"></script>
  <!-- Bootstrap -->
  <script src="<?= base_url('assets/admin_lte/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Select2 -->
  <script src="<?= base_url('assets/admin_lte/') ?>plugins/select2/js/select2.full.min.js"></script>
  <!-- Bootstrap4 Duallistbox -->
  <script src="<?= base_url('assets/admin_lte/') ?>plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
  <!-- InputMask -->
  <script src="<?= base_url('assets/admin_lte/') ?>plugins/moment/moment.min.js"></script>
  <script src="<?= base_url('assets/admin_lte/') ?>plugins/inputmask/jquery.inputmask.min.js"></script>
  <!-- date-range-picker -->
  <script src="<?= base_url('assets/admin_lte/') ?>plugins/daterangepicker/daterangepicker.js"></script>
  <!-- bootstrap color picker -->
  <script src="<?= base_url('assets/admin_lte/') ?>plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="<?= base_url('assets/admin_lte/') ?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Bootstrap Switch -->
  <script src="<?= base_url('assets/admin_lte/') ?>plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
  <!-- BS-Stepper -->
  <script src="<?= base_url('assets/admin_lte/') ?>plugins/bs-stepper/js/bs-stepper.min.js"></script>
  <!-- dropzonejs -->
  <script src="<?= base_url('assets/admin_lte/') ?>plugins/dropzone/min/dropzone.min.js"></script>
  <!-- DataTables -->
  <script src="<?= base_url('assets/admin_lte/') ?>plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url('assets/admin_lte/') ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url('assets/admin_lte/') ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?= base_url('assets/admin_lte/') ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="<?= base_url('assets/admin_lte/') ?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?= base_url('assets/admin_lte/') ?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="<?= base_url('assets/admin_lte/') ?>plugins/jszip/jszip.min.js"></script>
  <script src="<?= base_url('assets/admin_lte/') ?>plugins/pdfmake/pdfmake.min.js"></script>
  <script src="<?= base_url('assets/admin_lte/') ?>plugins/pdfmake/vfs_fonts.js"></script>
  <script src="<?= base_url('assets/admin_lte/') ?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="<?= base_url('assets/admin_lte/') ?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="<?= base_url('assets/admin_lte/') ?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="<?= base_url('assets/admin_lte/') ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url('assets/admin_lte/') ?>dist/js/adminlte.js"></script>

  <!-- PAGE PLUGINS -->
  <!-- jQuery Mapael -->
  <script src="<?= base_url('assets/admin_lte/') ?>plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
  <script src="<?= base_url('assets/admin_lte/') ?>plugins/raphael/raphael.min.js"></script>
  <script src="<?= base_url('assets/admin_lte/') ?>plugins/jquery-mapael/jquery.mapael.min.js"></script>
  <script src="<?= base_url('assets/admin_lte/') ?>plugins/jquery-mapael/maps/usa_states.min.js"></script>
  <!-- ChartJS -->
  <script src="<?= base_url('assets/admin_lte/') ?>plugins/chart.js/Chart.min.js"></script>
  <script src="<?= base_url('assets/') ?>admin2/js/my_js.js"></script>
  <script>
      // js mengambil file upload jpg ke form input
      $('.custom-file-input').on('change', function() {
          let fileName = $(this).val().split('\\').pop();
          $(this).next('.custom-file-label').addClass("selected").html(fileName);
      });
  </script>
  <script>
      // js DataTables
      $(function() {
          $("#tabelAsetAll").DataTable({
              "responsive": true,
              "lengthChange": false,
              "autoWidth": false,
              "ordering": true,
              "info": true,
          });
      });
      $(function() {
          $("#data_unit").DataTable({
              "responsive": true,
              "lengthChange": false,
              "autoWidth": false,
              "ordering": true,
              "info": true,
          });
      });
      $(function() {
          $("#data_aset").DataTable({
              "responsive": true,
              "lengthChange": false,
              "autoWidth": false,
              "ordering": true,
              "info": true,
          });
      });
  </script>

  <script>
      // js memanggil select 2
      // cara mengambil value select 2 ke form input menggunakan element data-text

      $(document).ready(function() {
          $('#jenis_aset_id').select2();
          $('#jenis_aset_id').on('select2:select', function(e) {
              var selectedOption = $(this).find(':selected');
              var selectedText = selectedOption.data('text');
              $('#jenis_aset_id_text').val(selectedText);
          });
      });

      $(document).ready(function() {
          $('#unit_id').select2();
          $('#gedung_unit_id').select2();
          $('#gedung_id').select2();
          $('#kelompok_id').select2();
          $('#peran_id').select2();
          $('#satuan_aset').select2();
          $('#status_kepemilikan').select2();
          $('#pic_subunit').select2();
          $('#kepala_unit').select2();
          $('#sarpras_unit').select2();
          $('#ket_aset').select2();
          $('#satuan_barang').select2();
          $('#pilih_unit_atk').select2();
          $('#pilih_atk').select2();
          $('#proses_validasi').select2();
          $('#satuan_barang_pengambilan').select2();
          $('#atk_stok').select2();
          $('#satuan_pembelian').select2();
      });

      // Mengambil data dari Select2 ke beberapa input
      $(document).ready(function() {
          $('#ruang_sub_unit').select2();
          $('#pilih_pic').select2();

          $('#ruang_sub_unit').on('select2:select', function(e) {
              var selectedOption = $(this).find(':selected');
              var selectedText = selectedOption.data('text');
              $('#ruang_sub_unit_text').val(selectedText);
          });

          $('#pilih_pic').on('select2:select', function(e) {
              var selectedOption = $(this).find(':selected');
              var selectedText = selectedOption.data('text');
              $('#pilih_pic_text').val(selectedText);
          });
      });


      $(document).ready(function() {
          $('#aset_sub_unit').select2();

          $('#aset_sub_unit').on('select2:select', function(e) {
              var selectedOption = e.params.data;
              var value1 = selectedOption.element.dataset.value1;
              var value2 = selectedOption.element.dataset.value2;
              var value3 = selectedOption.element.dataset.value3;

              // Mengambil data ke Form Input PIC
              var value4 = selectedOption.element.dataset.value4;
              var value5 = selectedOption.element.dataset.value5;
              var value6 = selectedOption.element.dataset.value6;

              // Masukkan nilai ke input hidden
              $('#value_aset_input1').val(value1);
              $('#value_aset_input2').val(value2);
              $('#value_aset_input3').val(value3);

              // Masukkan nilai ke form Input PIC
              $('#value_aset_input4').val(value4);
              $('#namaPIC').val(value5);
              $('#namaUnit').val(value6);

          });
      });

      // Perkalian nilai pada form input Pengajuan ATK
      $(document).ready(function() {
          $('#pilih_atk').select2();

          $('#pilih_atk').on('select2:select', function(e) {
              var selectedOption = $(this).find(':selected');
              var selectHarga = selectedOption.data('harga');
              $('#harga_satuan_atk_pengajuan').val(selectHarga);
          });

          $('#harga_satuan_atk_pengajuan, #jumlah_atk').on('input', function() {
              var angka1 = parseFloat($('#harga_satuan_atk_pengajuan').val()) || 0;
              var angka2 = parseFloat($('#jumlah_atk').val()) || 0;
              var hasil = angka1 * angka2;

              $('#total_harga_pengajuan').val(hasil);
          });
      });

      // Perkalian nilai pada form input Pengambilan ATK
      $(document).ready(function() {
          $('#pilih_atk_pengambilan').select2();

          $('#pilih_atk_pengambilan').on('select2:select', function(e) {
              var idatk = $(this).val();
              var selectedOption = e.params.data;
              var hargapengajuan = selectedOption.element.dataset.hargapengajuan;
              var jumlahpengajuan = selectedOption.element.dataset.jumlahpengajuan;
              var satuanbarang1 = selectedOption.element.dataset.satuanbarang1;
              var totalpengajuan = selectedOption.element.dataset.totalpengajuan;
              var hargabrg1 = selectedOption.element.dataset.hargabrg1;

              $.ajax({
                  url: '<?= base_url("admin/hitungATKdiAmbil"); ?>',
                  type: 'POST',
                  data: {
                      id_barang: idatk
                  },
                  dataType: 'json',
                  success: function(response) {
                      jumlahATKdiambil = response.jumlah;
                      $('#jumlah_atk_diambil').val(jumlahATKdiambil);
                  }
              });

              $('#harga_satuan_atk_pengambilan1').val(hargapengajuan);
              $('#jumlah_atk_pengajuan').val(jumlahpengajuan);
              $('#satuan_barang_pengajuan').val(satuanbarang1);
              $('#satuan_barang_diambil').val(satuanbarang1);
              $('#total_harga_pengambilan1').val(totalpengajuan);
              $('#harga_satuan_atk_pengambilan2').val(hargabrg1);

              $('#harga_satuan_atk_pengambilan2, #jumlah_atk_pengambilan').on('input', function() {
                  var angka1 = parseFloat($('#harga_satuan_atk_pengambilan2').val()) || 0;
                  var angka2 = parseFloat($('#jumlah_atk_pengambilan').val()) || 0;
                  var hasil = angka1 * angka2;

                  $('#total_harga_pengambilan2').val(hasil);
              });


              $('#jumlah_atk_pengambilan').on('input', function() {
                  var jumlahAtkPengambilan = parseInt($(this).val());
                  var stokBarang = jumlahpengajuan - jumlahATKdiambil; // Gantilah dengan stok barang yang sesuai.

                  if (jumlahAtkPengambilan > stokBarang) {
                      $(this).val(stokBarang);
                      alert('Jumlah barang tidak mencukupi. Maksimal ' + stokBarang + ' ATK yang dapat diambil. Sesuai dengan barang yang diajukan');
                      var angka1 = parseFloat($('#harga_satuan_atk_pengambilan2').val()) || 0;
                      var angka2 = parseFloat($('#jumlah_atk_pengambilan').val()) || 0;
                      var hasil = angka1 * angka2;

                      $('#total_harga_pengambilan2').val(hasil);
                  }
              });

          });
      });
      $(document).ready(function() {
          $('#harga_satuan_atk_pengambilan3, #jumlah_atk_pengambilan2').on('input', function() {
              var angka1 = parseFloat($('#harga_satuan_atk_pengambilan3').val()) || 0;
              var angka2 = parseFloat($('#jumlah_atk_pengambilan2').val()) || 0;
              var hasil = angka1 * angka2;

              $('#total_harga_pengambilan3').val(hasil);
          });

          $('#jumlah_atk_pengambilan2').on('input', function() {
              var jumlahAtkPengambilan = parseInt($(this).val());
              var stokBarang = ($('#jumlah_atk_pengajuan').val() - $('#jumlah_atk_diambil1').val());

              if (jumlahAtkPengambilan > stokBarang) {
                  $(this).val(stokBarang);
                  alert('Jumlah barang tidak mencukupi. Maksimal ' + stokBarang + ' ATK yang dapat diambil. Sesuai dengan barang yang diajukan');
                  var angka1 = parseFloat($('#harga_satuan_atk_pengambilan3').val()) || 0;
                  var angka2 = parseFloat($('#jumlah_atk_pengambilan2').val()) || 0;
                  var hasil = angka1 * angka2;

                  $('#total_harga_pengambilan3').val(hasil);
              }
          });
      });
      $(document).ready(function() {
          $('#jumlah_pembelian, #harga_pembelian').on('input', function() {
              var angka1 = parseFloat($('#jumlah_pembelian').val()) || 0;
              var angka2 = parseFloat($('#harga_pembelian').val()) || 0;
              var hasil = angka1 * angka2;

              $('#total_pembelian').val(hasil);
          });
      });
  </script>
  <script>
      //fungsi mengambil data saat klik edit data pada Modal
      function edit_sub_unit(id_sub_unit) {
          $('#ruang_sub_unit1' + id_sub_unit).select2();
          $('#unit_id1' + id_sub_unit).select2();
          $('#pic_subunit1' + id_sub_unit).select2();
          $('#ruang_sub_unit1' + id_sub_unit).on('select2:select', function(e) {
              var selectedOption = $(this).find(':selected');
              var selectedText = selectedOption.data('text');
              $('#ruang_sub_unit1_text' + id_sub_unit).val(selectedText);
          });
      }

      function edit_unit(id_unit) {
          $('#gedung_unit_id1' + id_unit).select2();
          $('#sarpras_unit2' + id_unit).select2();
          $('#kepala_unit2' + id_unit).select2();
      }

      function edit_ruang(id_ruang) {
          $('#gedung_id1' + id_ruang).select2();
      }

      function edit_jenis_aset(id_jenis) {
          $('#kelompok_id1' + id_jenis).select2();
      }

      function edit_peran(id_pengguna) {
          $('#peran_id1' + id_pengguna).select2();
      }

      function edit_satuan_brg(id_atk) {
          $('#satuan_barang1' + id_atk).select2();
      }


      // Filtering Form Bertingkat
      $(document).ready(function() {
          $('#kondisi_aset').select2();
          $('#input_tindakan').hide();

          $('#kondisi_aset').change(function() {
              var pilih_kondisi = $(this).val();
              if (pilih_kondisi === 'Rusak Ringan' || pilih_kondisi === 'Rusak Berat' || pilih_kondisi === 'Baik' || pilih_kondisi === 'Perbaikan') {
                  $('#input_tindakan').show();

              } else {
                  $('#input_tindakan').hide();
              }
          });
      });

      // Filter dan Load Data aset di menu Kondisi pada Role Admin
      $(document).ready(function() {
          $('#pilih_sub_unit1').select2();

          function liveSearch() {
              var keyword = $('#searchInput').val().toLowerCase();

              $('#TabelKondisiAset tbody tr').each(function() {
                  var rowText = $(this).text().toLowerCase();

                  if (rowText.indexOf(keyword) === -1) {
                      $(this).hide();
                  } else {
                      $(this).show();
                  }
              });
          }

          $('#searchInput').on('keyup', liveSearch);

          $('#pilih_sub_unit1').on('change', function() {
              var selectedValue = $(this).val();
              $.ajax({
                  url: '<?= base_url("admin/load_data_aset") ?>',
                  method: 'POST',
                  data: {
                      selectedValue: selectedValue
                  },
                  success: function(response) {
                      $('#TabelKondisiAset tbody').empty();
                      $('#TabelKondisiAset tbody').html(response);
                      liveSearch();
                  }
              });

          });
      });

      // Filter dan Load Data aset di menu Kondisi pada Role Sub Unit
      $(document).ready(function() {
          $('#kondisi_subUnit_inRole').select2();

          function liveSearch() {
              var keyword = $('#searchInput').val().toLowerCase();

              $('#TabelKondisiAset_perSubUnit tbody tr').each(function() {
                  var rowText = $(this).text().toLowerCase();

                  if (rowText.indexOf(keyword) === -1) {
                      $(this).hide();
                  } else {
                      $(this).show();
                  }
              });
          }

          $('#searchInput').on('keyup', liveSearch);

          $('#kondisi_subUnit_inRole').on('change', function() {
              var selectedValue = $(this).val();
              $.ajax({
                  url: '<?= base_url("subunit/load_data_aset") ?>',
                  method: 'POST',
                  data: {
                      selectedValue: selectedValue
                  },
                  success: function(response) {
                      $('#TabelKondisiAset_perSubUnit tbody').empty();
                      $('#TabelKondisiAset_perSubUnit tbody').html(response);
                      liveSearch();
                  }
              });

          });
      });

      // Filter dan Load data aset di menu Hasil inputan aset pada Role Admin
      $(document).ready(function() {
          $('#pilih_sub_unit2').select2();

          function liveSearch() {
              var keyword = $('#searchInput').val().toLowerCase();

              $('#TabelHasilInput tbody tr').each(function() {
                  var rowText = $(this).text().toLowerCase();

                  if (rowText.indexOf(keyword) === -1) {
                      $(this).hide();
                  } else {
                      $(this).show();
                  }
              });
          }

          $('#searchInput').on('keyup', liveSearch);

          $('#pilih_sub_unit2').on('change', function() {
              var selectedValue = $(this).val();
              $.ajax({
                  url: '<?= base_url("admin/load_all_aset") ?>',
                  method: 'POST',
                  data: {
                      selectedValue: selectedValue
                  },
                  success: function(response) {
                      $('#TabelHasilInput tbody').empty();
                      $('#TabelHasilInput tbody').html(response);
                      liveSearch();
                  }
              });

          });
      });

      // Filter dan Load data aset di menu Hasil inputan aset pada Role Subunit
      $(document).ready(function() {
          $('#subUnit_inRole').select2();

          function liveSearch() {
              var keyword = $('#searchInput').val().toLowerCase();

              $('#TabelAset_perSubUnit tbody tr').each(function() {
                  var rowText = $(this).text().toLowerCase();

                  if (rowText.indexOf(keyword) === -1) {
                      $(this).hide();
                  } else {
                      $(this).show();
                  }
              });
          }

          $('#searchInput').on('keyup', liveSearch);

          $('#subUnit_inRole').on('change', function() {
              var selectedValue = $(this).val();
              $.ajax({
                  url: '<?= base_url("subunit/load_all_aset") ?>',
                  method: 'POST',
                  data: {
                      selectedValue: selectedValue
                  },
                  success: function(response) {
                      $('#TabelAset_perSubUnit tbody').empty();
                      $('#TabelAset_perSubUnit tbody').html(response);
                      liveSearch();
                  }
              });

          });
      });

      // Filter dan Load data aset di menu Rekap Kondisi Aset
      $(document).ready(function() {
          $('#pilih_sub_unit3').select2();
          $('#pilih_sub_unit3').on('change', function() {
              var selectedValue = $(this).val();
              $.ajax({
                  url: '<?= base_url("admin/load_kondisi_aset") ?>',
                  method: 'POST',
                  data: {
                      selectedValue: selectedValue
                  },
                  success: function(response) {
                      $('#data_aset tbody').empty();
                      $('#data_aset tbody').html(response);
                  }
              });
          });

      });

      // Filter dan Load data aset di menu Rekap Kondisi Rusak pada Aset
      $(document).ready(function() {
          $('#pilih_sub_unit4').select2();
          $('#pilih_sub_unit4').on('change', function() {
              var selectedValue = $(this).val();
              $.ajax({
                  url: '<?= base_url("admin/load_AsetNonAktif") ?>',
                  method: 'POST',
                  data: {
                      selectedValue: selectedValue
                  },
                  success: function(response) {
                      $('#data_aset tbody').empty();
                      $('#data_aset tbody').html(response);
                  }
              });
          });

      });

      // Filter by Unit dan load data aset di menu rekap 
      $(document).ready(function() {
          $('#filter_unit').select2();
          $('#filter_unit').on('change', function() {
              var getIDunit = $(this).val();
              //   console.log(getIDunit);
              $.ajax({
                  url: '<?= base_url("admin/aset_rekapByUnit") ?>',
                  method: 'POST',
                  data: {
                      getIDunit: getIDunit
                  },
                  success: function(result) {
                      //   console.log(result);
                      HasilFilterByUnit(result)
                  }
              })
          });

          function HasilFilterByUnit(result) {
              var HasilFilter = document.getElementById('hasilFilterUnit');
              HasilFilter.innerHTML = result;
          }
      });

      // Filter dan Load Data Pengambilan ATK
      $(document).ready(function() {
          $('#unit_validasi_pengambilan').select2();

          function liveSearch() {
              var keyword = $('#searchInput').val().toLowerCase();

              $('#TabelPengambilanATK tbody tr').each(function() {
                  var rowText = $(this).text().toLowerCase();

                  if (rowText.indexOf(keyword) === -1) {
                      $(this).hide();
                  } else {
                      $(this).show();
                  }
              });
          }

          $('#searchInput').on('keyup', liveSearch);

          $('#unit_validasi_pengambilan').on('change', function() {
              var selectedValue = $(this).val();
              $.ajax({
                  url: '<?= base_url("admin/load_pengambilanATK") ?>',
                  method: 'POST',
                  data: {
                      selectedValue: selectedValue
                  },
                  success: function(response) {
                      $('#TabelPengambilanATK tbody').empty();
                      $('#TabelPengambilanATK tbody').html(response);
                      liveSearch();
                  }
              });

          });
      });

      //   Menampilkan Tombol Hapus jika tidak ada data Menu Gedung Role Admin
      $(document).ready(function() {
          $('.delete-gedung').on('click', function() {
              var GedungId = $(this).data('gedungid');
              $.ajax({
                  url: '<?= base_url('admin/HitungDataGedung/') ?>' + GedungId,
                  type: 'GET',
                  dataType: 'json',
                  success: function(data) {
                      if (data.count_ruang == 0 && data.count_sub_unit == 0 && data.count_aset == 0) {
                          $('.konfirmasi-hapus-gedung').show();
                          $('.konfirmasi-gedung1').show();
                          $('.konfirmasi-gedung2').hide();
                          $('.paragraf-gedung1').show();
                          $('.paragraf-gedung2').hide();
                      } else {
                          $('.paragraf-gedung1').hide();
                          $('.paragraf-gedung2').show();
                          $('.konfirmasi-gedung2').show();
                          $('.konfirmasi-gedung1').hide();
                          $('.konfirmasi-hapus-gedung').hide();
                      }
                  }
              })
          });
      });

      //   Menampilkan Tombol Hapus jika tidak ada data Menu Ruang Role Admin
      $(document).ready(function() {
          $('.delete-ruang').on('click', function() {
              var RuangId = $(this).data('ruangid');
              $.ajax({
                  url: '<?= base_url('admin/HitungDataRuang/') ?>' + RuangId,
                  type: 'GET',
                  dataType: 'json',
                  success: function(data) {
                      if (data.count_sub_unit == 0 && data.count_aset == 0) {
                          $('.konfirmasi-hapus-ruang').show();
                          $('.konfirmasi-ruang1').show();
                          $('.konfirmasi-ruang2').hide();
                          $('.paragraf-ruang1').show();
                          $('.paragraf-ruang2').hide();
                      } else {
                          $('.paragraf-ruang1').hide();
                          $('.paragraf-ruang2').show();
                          $('.konfirmasi-ruang2').show();
                          $('.konfirmasi-ruang1').hide();
                          $('.konfirmasi-hapus-ruang').hide();
                      }
                  }
              })
          });
      });

      //   Menampilkan Tombol Hapus jika tidak ada data Menu Unit Role Admin
      $(document).ready(function() {
          $('.delete-unit').on('click', function() {
              var UnitId = $(this).data('unitid');
              $.ajax({
                  url: '<?= base_url('admin/HitungDataUnit/') ?>' + UnitId,
                  type: 'GET',
                  dataType: 'json',
                  success: function(data) {
                      if (data.count_sub_unit == 0 && data.count_aset == 0) {
                          $('.konfirmasi-hapus-unit').show();
                          $('.konfirmasi-unit1').show();
                          $('.konfirmasi-unit2').hide();
                          $('.paragraf-unit1').show();
                          $('.paragraf-unit2').hide();
                      } else {
                          $('.paragraf-unit1').hide();
                          $('.paragraf-unit2').show();
                          $('.konfirmasi-unit2').show();
                          $('.konfirmasi-unit1').hide();
                          $('.konfirmasi-hapus-unit').hide();
                      }
                  }
              })
          });
      });

      //   Menampilkan Tombol Hapus jika tidak ada data Menu Sub Unit Role Admin
      $(document).ready(function() {
          $('.delete-subunit').on('click', function() {
              var SubUnitId = $(this).data('subunitid');
              $.ajax({
                  url: '<?= base_url('admin/HitungDataSubUnit/') ?>' + SubUnitId,
                  type: 'GET',
                  dataType: 'json',
                  success: function(data) {
                      if (data.count_aset == 0) {
                          $('.konfirmasi-hapus-subunit').show();
                          $('.konfirmasi-subunit1').show();
                          $('.konfirmasi-subunit2').hide();
                          $('.paragraf-subunit1').show();
                          $('.paragraf-subunit2').hide();
                      } else {
                          $('.paragraf-subunit1').hide();
                          $('.paragraf-subunit2').show();
                          $('.konfirmasi-subunit2').show();
                          $('.konfirmasi-subunit1').hide();
                          $('.konfirmasi-hapus-subunit').hide();
                      }
                  }
              })
          });
      });

      //   Menampilkan Tombol Hapus jika tidak ada data Menu Jenis Aset Role Admin
      $(document).ready(function() {
          $('.delete-kelompok').on('click', function() {
              var KelompokId = $(this).data('kelompokid');
              $.ajax({
                  url: '<?= base_url('admin/HitungDataKelompok/') ?>' + KelompokId,
                  type: 'GET',
                  dataType: 'json',
                  success: function(data) {
                      if (data.count_kelompok == 0 && data.count_aset == 0) {
                          $('.konfirmasi-hapus-kelompok').show();
                          $('.konfirmasi-kelompok1').show();
                          $('.konfirmasi-kelompok2').hide();
                          $('.paragraf-kelompok1').show();
                          $('.paragraf-kelompok2').hide();
                      } else {
                          $('.paragraf-kelompok1').hide();
                          $('.paragraf-kelompok2').show();
                          $('.konfirmasi-kelompok2').show();
                          $('.konfirmasi-kelompok1').hide();
                          $('.konfirmasi-hapus-kelompok').hide();
                      }
                  }
              })
          });
      });

      //   Menampilkan Tombol Hapus jika tidak ada data Menu Jenis Aset Role Admin
      $(document).ready(function() {
          $('.delete-jenis').on('click', function() {
              var JenisId = $(this).data('jenisid');
              $.ajax({
                  url: '<?= base_url('admin/HitungDataJenis/') ?>' + JenisId,
                  type: 'GET',
                  dataType: 'json',
                  success: function(data) {
                      if (data.count_aset == 0) {
                          $('.konfirmasi-hapus-jenis').show();
                          $('.konfirmasi-jenis1').show();
                          $('.konfirmasi-jenis2').hide();
                          $('.paragraf-jenis1').show();
                          $('.paragraf-jenis2').hide();
                      } else {
                          $('.paragraf-jenis1').hide();
                          $('.paragraf-jenis2').show();
                          $('.konfirmasi-jenis2').show();
                          $('.konfirmasi-jenis1').hide();
                          $('.konfirmasi-hapus-jenis').hide();
                      }
                  }
              })
          });
      });

      // Menampilkan Tombol Hapus jika tidak ada data Menu Data ATK Role Admin
      $(document).ready(function() {
          $('.delete-atk').on('click', function() {
              var ATKid = $(this).data('atkid');
              console.log(ATKid);
              $.ajax({
                  url: '<?= base_url('admin/HitungATK/'); ?>' + ATKid,
                  type: 'GET',
                  dataType: 'json',
                  success: function(data) {
                      if (data.count_atk == 0) {
                          $('.konfirmasi-hapus-atk').show();
                          $('.konfirmasi-atk1').show();
                          $('.konfirmasi-atk2').hide();
                          $('.paragraf-atk1').show();
                          $('.paragraf-atk2').hide();
                      } else {
                          $('.paragraf-atk1').hide();
                          $('.paragraf-atk2').show();
                          $('.konfirmasi-atk2').show();
                          $('.konfirmasi-atk1').hide();
                          $('.konfirmasi-hapus-atk').hide();
                      }
                  }
              });
          });
      });

      // Filterisasi Data Aset by Sub Unit Pada role Unit
      $(document).ready(function() {
          $('#PilihSubUnit1').select2();

          function liveSearch() {
              var keyword = $('#searchInput').val().toLowerCase();

              $('#tabelAsetUnit tbody tr').each(function() {
                  var rowText = $(this).text().toLowerCase();

                  if (rowText.indexOf(keyword) === -1) {
                      $(this).hide();
                  } else {
                      $(this).show();
                  }
              });
          }

          $('#searchInput').on('keyup', liveSearch);

          $('#PilihSubUnit1').on('change', function() {
              var PilihSubUnit1 = $(this).val();
              $.ajax({
                  url: '<?= base_url("unit/LoadAsetUnit") ?>',
                  method: 'POST',
                  data: {
                      PilihSubUnit1: PilihSubUnit1
                  },
                  success: function(response) {
                      $('#tabelAsetUnit tbody').empty();
                      $('#tabelAsetUnit tbody').html(response);
                      liveSearch();
                  }
              });
          });

      });
  </script>

  <script>
      // JS Admin Aset
      // Menampilkan Tombol Hapus jika tidak ada data Menu Gedung
      $(document).ready(function() {
          $('.delete-gedung').on('click', function() {
              var GedungId = $(this).data('gedungid');
              $.ajax({
                  url: '<?= base_url('adminaset/HitungDataGedung/') ?>' + GedungId,
                  type: 'GET',
                  dataType: 'json',
                  success: function(data) {
                      if (data.count_ruang == 0 && data.count_sub_unit == 0 && data.count_aset == 0) {
                          $('.konfirmasi-hapus-gedung').show();
                          $('.konfirmasi-gedung1').show();
                          $('.konfirmasi-gedung2').hide();
                          $('.paragraf-gedung1').show();
                          $('.paragraf-gedung2').hide();
                      } else {
                          $('.paragraf-gedung1').hide();
                          $('.paragraf-gedung2').show();
                          $('.konfirmasi-gedung2').show();
                          $('.konfirmasi-gedung1').hide();
                          $('.konfirmasi-hapus-gedung').hide();
                      }
                  }
              })
          });
      });

      //   Menampilkan Tombol Hapus jika tidak ada data Menu Ruang
      $(document).ready(function() {
          $('.delete-ruang').on('click', function() {
              var RuangId = $(this).data('ruangid');
              $.ajax({
                  url: '<?= base_url('adminaset/HitungDataRuang/') ?>' + RuangId,
                  type: 'GET',
                  dataType: 'json',
                  success: function(data) {
                      if (data.count_sub_unit == 0 && data.count_aset == 0) {
                          $('.konfirmasi-hapus-ruang').show();
                          $('.konfirmasi-ruang1').show();
                          $('.konfirmasi-ruang2').hide();
                          $('.paragraf-ruang1').show();
                          $('.paragraf-ruang2').hide();
                      } else {
                          $('.paragraf-ruang1').hide();
                          $('.paragraf-ruang2').show();
                          $('.konfirmasi-ruang2').show();
                          $('.konfirmasi-ruang1').hide();
                          $('.konfirmasi-hapus-ruang').hide();
                      }
                  }
              })
          });
      });

      //   Menampilkan Tombol Hapus jika tidak ada data Menu Unit
      $(document).ready(function() {
          $('.delete-unit').on('click', function() {
              var UnitId = $(this).data('unitid');
              $.ajax({
                  url: '<?= base_url('adminaset/HitungDataUnit/') ?>' + UnitId,
                  type: 'GET',
                  dataType: 'json',
                  success: function(data) {
                      if (data.count_sub_unit == 0 && data.count_aset == 0) {
                          $('.konfirmasi-hapus-unit').show();
                          $('.konfirmasi-unit1').show();
                          $('.konfirmasi-unit2').hide();
                          $('.paragraf-unit1').show();
                          $('.paragraf-unit2').hide();
                      } else {
                          $('.paragraf-unit1').hide();
                          $('.paragraf-unit2').show();
                          $('.konfirmasi-unit2').show();
                          $('.konfirmasi-unit1').hide();
                          $('.konfirmasi-hapus-unit').hide();
                      }
                  }
              })
          });
      });

      //   Menampilkan Tombol Hapus jika tidak ada data Menu Sub Unit
      $(document).ready(function() {
          $('.delete-subunit').on('click', function() {
              var SubUnitId = $(this).data('subunitid');
              $.ajax({
                  url: '<?= base_url('adminaset/HitungDataSubUnit/') ?>' + SubUnitId,
                  type: 'GET',
                  dataType: 'json',
                  success: function(data) {
                      if (data.count_aset == 0) {
                          $('.konfirmasi-hapus-subunit').show();
                          $('.konfirmasi-subunit1').show();
                          $('.konfirmasi-subunit2').hide();
                          $('.paragraf-subunit1').show();
                          $('.paragraf-subunit2').hide();
                      } else {
                          $('.paragraf-subunit1').hide();
                          $('.paragraf-subunit2').show();
                          $('.konfirmasi-subunit2').show();
                          $('.konfirmasi-subunit1').hide();
                          $('.konfirmasi-hapus-subunit').hide();
                      }
                  }
              })
          });
      });

      //   Menampilkan Tombol Hapus jika tidak ada data Menu Kelompok Aset
      $(document).ready(function() {
          $('.delete-kelompok').on('click', function() {
              var KelompokId = $(this).data('kelompokid');
              $.ajax({
                  url: '<?= base_url('adminaset/HitungDataKelompok/') ?>' + KelompokId,
                  type: 'GET',
                  dataType: 'json',
                  success: function(data) {
                      if (data.count_kelompok == 0 && data.count_aset == 0) {
                          $('.konfirmasi-hapus-kelompok').show();
                          $('.konfirmasi-kelompok1').show();
                          $('.konfirmasi-kelompok2').hide();
                          $('.paragraf-kelompok1').show();
                          $('.paragraf-kelompok2').hide();
                      } else {
                          $('.paragraf-kelompok1').hide();
                          $('.paragraf-kelompok2').show();
                          $('.konfirmasi-kelompok2').show();
                          $('.konfirmasi-kelompok1').hide();
                          $('.konfirmasi-hapus-kelompok').hide();
                      }
                  }
              })
          });
      });

      //   Menampilkan Tombol Hapus jika tidak ada data Menu Jenis Aset
      $(document).ready(function() {
          $('.delete-jenis').on('click', function() {
              var JenisId = $(this).data('jenisid');
              $.ajax({
                  url: '<?= base_url('adminaset/HitungDataJenis/') ?>' + JenisId,
                  type: 'GET',
                  dataType: 'json',
                  success: function(data) {
                      if (data.count_aset == 0) {
                          $('.konfirmasi-hapus-jenis').show();
                          $('.konfirmasi-jenis1').show();
                          $('.konfirmasi-jenis2').hide();
                          $('.paragraf-jenis1').show();
                          $('.paragraf-jenis2').hide();
                      } else {
                          $('.paragraf-jenis1').hide();
                          $('.paragraf-jenis2').show();
                          $('.konfirmasi-jenis2').show();
                          $('.konfirmasi-jenis1').hide();
                          $('.konfirmasi-hapus-jenis').hide();
                      }
                  }
              })
          });
      });

      // Filter dan Load data aset di menu Hasil inputan aset
      $(document).ready(function() {
          $('#filter_subUnit').select2();

          function liveSearch() {
              var keyword = $('#searchInput').val().toLowerCase();

              $('#TabelHasilInput tbody tr').each(function() {
                  var rowText = $(this).text().toLowerCase();

                  if (rowText.indexOf(keyword) === -1) {
                      $(this).hide();
                  } else {
                      $(this).show();
                  }
              });
          }

          $('#searchInput').on('keyup', liveSearch);

          $('#filter_subUnit').on('change', function() {
              var selectedValue = $(this).val();
              $.ajax({
                  url: '<?= base_url("adminaset/load_all_aset") ?>',
                  method: 'POST',
                  data: {
                      selectedValue: selectedValue
                  },
                  success: function(response) {
                      $('#TabelHasilInput tbody').empty();
                      $('#TabelHasilInput tbody').html(response);
                      liveSearch();
                  }
              });

          });
      });

      // Filter dan Load Data aset di menu Kondisi
      $(document).ready(function() {
          $('#filter_subUnit1').select2();

          function liveSearch() {
              var keyword = $('#searchInput').val().toLowerCase();

              $('#TabelKondisiAset tbody tr').each(function() {
                  var rowText = $(this).text().toLowerCase();

                  if (rowText.indexOf(keyword) === -1) {
                      $(this).hide();
                  } else {
                      $(this).show();
                  }
              });
          }

          $('#searchInput').on('keyup', liveSearch);

          $('#filter_subUnit1').on('change', function() {
              var selectedValue = $(this).val();
              $.ajax({
                  url: '<?= base_url("adminaset/load_data_aset") ?>',
                  method: 'POST',
                  data: {
                      selectedValue: selectedValue
                  },
                  success: function(response) {
                      $('#TabelKondisiAset tbody').empty();
                      $('#TabelKondisiAset tbody').html(response);
                      liveSearch();
                  }
              });

          });
      });

      // Filter by Unit dan load data aset di menu rekap 
      $(document).ready(function() {
          $('#filter_unitAdminAset').select2();
          $('#filter_unitAdminAset').on('change', function() {
              var getIDunit = $(this).val();
              //   console.log(getIDunit);
              $.ajax({
                  url: '<?= base_url("adminaset/aset_rekapByUnit") ?>',
                  method: 'POST',
                  data: {
                      getIDunit: getIDunit
                  },
                  success: function(result) {
                      //   console.log(result);
                      HasilFilterByUnit(result)
                  }
              })
          });

          function HasilFilterByUnit(result) {
              var HasilFilter = document.getElementById('hasilFilterUnit');
              HasilFilter.innerHTML = result;
          }
      });

      // Filter dan Load data aset di menu Rekap Kondisi Aset
      $(document).ready(function() {
          $('#filter_subUnit2').select2();
          $('#filter_subUnit2').on('change', function() {
              var selectedValue = $(this).val();
              $.ajax({
                  url: '<?= base_url("adminaset/load_kondisi_aset") ?>',
                  method: 'POST',
                  data: {
                      selectedValue: selectedValue
                  },
                  success: function(response) {
                      $('#data_aset tbody').empty();
                      $('#data_aset tbody').html(response);
                  }
              });
          });

      });

      // Filter dan Load data aset di menu Rekap Kondisi Rusak pada Aset
      $(document).ready(function() {
          $('#filter_subUnit3').select2();
          $('#filter_subUnit3').on('change', function() {
              var selectedValue = $(this).val();
              $.ajax({
                  url: '<?= base_url("adminaset/load_AsetNonAktif") ?>',
                  method: 'POST',
                  data: {
                      selectedValue: selectedValue
                  },
                  success: function(response) {
                      $('#data_aset tbody').empty();
                      $('#data_aset tbody').html(response);
                  }
              });
          });

      });
  </script>

  <script>
      // JS Admin ATK
      // Menampilkan Tombol Hapus jika tidak ada data Menu Data ATK Role Admin
      $(document).ready(function() {
          $('.delete-atk').on('click', function() {
              var ATKid = $(this).data('atkid');
              console.log(ATKid);
              $.ajax({
                  url: '<?= base_url('adminatk/HitungATK/'); ?>' + ATKid,
                  type: 'GET',
                  dataType: 'json',
                  success: function(data) {
                      if (data.count_atk == 0) {
                          $('.konfirmasi-hapus-atk').show();
                          $('.konfirmasi-atk1').show();
                          $('.konfirmasi-atk2').hide();
                          $('.paragraf-atk1').show();
                          $('.paragraf-atk2').hide();
                      } else {
                          $('.paragraf-atk1').hide();
                          $('.paragraf-atk2').show();
                          $('.konfirmasi-atk2').show();
                          $('.konfirmasi-atk1').hide();
                          $('.konfirmasi-hapus-atk').hide();
                      }
                  }
              });
          });
      });

      // Perkalian nilai pada form input Pengambilan ATK
      $(document).ready(function() {
          $('#pilih_atk_pengambilan').select2();

          $('#pilih_atk_pengambilan').on('select2:select', function(e) {
              var idatk = $(this).val();
              var selectedOption = e.params.data;
              var hargapengajuan = selectedOption.element.dataset.hargapengajuan;
              var jumlahpengajuan = selectedOption.element.dataset.jumlahpengajuan;
              var satuanbarang1 = selectedOption.element.dataset.satuanbarang1;
              var totalpengajuan = selectedOption.element.dataset.totalpengajuan;
              var hargabrg1 = selectedOption.element.dataset.hargabrg1;

              $.ajax({
                  url: '<?= base_url("adminatk/hitungATKdiAmbil"); ?>',
                  type: 'POST',
                  data: {
                      id_barang: idatk
                  },
                  dataType: 'json',
                  success: function(response) {
                      jumlahATKdiambil = response.jumlah;
                      $('#jumlah_atk_diambil').val(jumlahATKdiambil);
                  }
              });

              $('#harga_satuan_atk_pengambilan1').val(hargapengajuan);
              $('#jumlah_atk_pengajuan').val(jumlahpengajuan);
              $('#satuan_barang_pengajuan').val(satuanbarang1);
              $('#satuan_barang_diambil').val(satuanbarang1);
              $('#total_harga_pengambilan1').val(totalpengajuan);
              $('#harga_satuan_atk_pengambilan2').val(hargabrg1);

              $('#harga_satuan_atk_pengambilan2, #jumlah_atk_pengambilan').on('input', function() {
                  var angka1 = parseFloat($('#harga_satuan_atk_pengambilan2').val()) || 0;
                  var angka2 = parseFloat($('#jumlah_atk_pengambilan').val()) || 0;
                  var hasil = angka1 * angka2;

                  $('#total_harga_pengambilan2').val(hasil);
              });


              $('#jumlah_atk_pengambilan').on('input', function() {
                  var jumlahAtkPengambilan = parseInt($(this).val());
                  var stokBarang = jumlahpengajuan - jumlahATKdiambil; // Gantilah dengan stok barang yang sesuai.

                  if (jumlahAtkPengambilan > stokBarang) {
                      $(this).val(stokBarang);
                      alert('Jumlah barang tidak mencukupi. Maksimal ' + stokBarang + ' ATK yang dapat diambil. Sesuai dengan barang yang diajukan');
                      var angka1 = parseFloat($('#harga_satuan_atk_pengambilan2').val()) || 0;
                      var angka2 = parseFloat($('#jumlah_atk_pengambilan').val()) || 0;
                      var hasil = angka1 * angka2;

                      $('#total_harga_pengambilan2').val(hasil);
                  }
              });

          });
      });

      // Filter dan Load Data Pengambilan ATK
      $(document).ready(function() {
          $('#filterPengambilanATKUnit').select2();

          function liveSearch() {
              var keyword = $('#searchInput').val().toLowerCase();

              $('#TabelPengambilanATK tbody tr').each(function() {
                  var rowText = $(this).text().toLowerCase();

                  if (rowText.indexOf(keyword) === -1) {
                      $(this).hide();
                  } else {
                      $(this).show();
                  }
              });
          }

          $('#searchInput').on('keyup', liveSearch);

          $('#filterPengambilanATKUnit').on('change', function() {
              var selectedValue = $(this).val();
              $.ajax({
                  url: '<?= base_url("adminatk/load_pengambilanATK") ?>',
                  method: 'POST',
                  data: {
                      selectedValue: selectedValue
                  },
                  success: function(response) {
                      $('#TabelPengambilanATK tbody').empty();
                      $('#TabelPengambilanATK tbody').html(response);
                      liveSearch();
                  }
              });

          });
      });
  </script>

  <script>
      // JS Sub Unit
      // Perkalian nilai pada form input Pengambilan ATK
      $(document).ready(function() {
          $('#pilih_atk_pengambilan').select2();

          $('#pilih_atk_pengambilan').on('select2:select', function(e) {
              var idatk = $(this).val();
              var selectedOption = e.params.data;
              var hargapengajuan = selectedOption.element.dataset.hargapengajuan;
              var jumlahpengajuan = selectedOption.element.dataset.jumlahpengajuan;
              var satuanbarang1 = selectedOption.element.dataset.satuanbarang1;
              var totalpengajuan = selectedOption.element.dataset.totalpengajuan;
              var hargabrg1 = selectedOption.element.dataset.hargabrg1;

              $.ajax({
                  url: '<?= base_url("subunit/hitungATKdiAmbil"); ?>',
                  type: 'POST',
                  data: {
                      id_barang: idatk
                  },
                  dataType: 'json',
                  success: function(response) {
                      jumlahATKdiambil = response.jumlah;
                      $('#jumlah_atk_diambil').val(jumlahATKdiambil);
                  }
              });

              $('#harga_satuan_atk_pengambilan1').val(hargapengajuan);
              $('#jumlah_atk_pengajuan').val(jumlahpengajuan);
              $('#satuan_barang_pengajuan').val(satuanbarang1);
              $('#satuan_barang_diambil').val(satuanbarang1);
              $('#total_harga_pengambilan1').val(totalpengajuan);
              $('#harga_satuan_atk_pengambilan2').val(hargabrg1);

              $('#harga_satuan_atk_pengambilan2, #jumlah_atk_pengambilan').on('input', function() {
                  var angka1 = parseFloat($('#harga_satuan_atk_pengambilan2').val()) || 0;
                  var angka2 = parseFloat($('#jumlah_atk_pengambilan').val()) || 0;
                  var hasil = angka1 * angka2;

                  $('#total_harga_pengambilan2').val(hasil);
              });


              $('#jumlah_atk_pengambilan').on('input', function() {
                  var jumlahAtkPengambilan = parseInt($(this).val());
                  var stokBarang = jumlahpengajuan - jumlahATKdiambil; // Gantilah dengan stok barang yang sesuai.

                  if (jumlahAtkPengambilan > stokBarang) {
                      $(this).val(stokBarang);
                      alert('Jumlah barang tidak mencukupi. Maksimal ' + stokBarang + ' ATK yang dapat diambil. Sesuai dengan barang yang diajukan');
                      var angka1 = parseFloat($('#harga_satuan_atk_pengambilan2').val()) || 0;
                      var angka2 = parseFloat($('#jumlah_atk_pengambilan').val()) || 0;
                      var hasil = angka1 * angka2;

                      $('#total_harga_pengambilan2').val(hasil);
                  }
              });

          });
      });
  </script>
  <script>
      // js mengambil data sweatAlert 2 notifikasi setelah ganti password
      const flashData_ok = $('.flash-data-ok').data('flashdata');
      if (flashData_ok) {
          Swal.fire({
              title: 'Selamat',
              text: flashData_ok,
              icon: 'success',
              confirmButtonText: 'OK'
          }).then(() => {
              window.location.href = '<?= base_url('auth/logout'); ?>';
          });
      }

      // js memanggil datepicker
      $('#reservationdate').datetimepicker({
          format: 'L'
      });
      $('#reservationdatetime').datetimepicker({
          icons: {
              time: 'far fa-clock'
          }
      });

      // js merefresh
      function refreshPage() {
          location.reload();
      }

      $(function() {
          var Toast = Swal.mixin({
              toast: true,
              position: 'top',
              showConfirmButton: false,
              timer: 3500
          });
          const Error_pesan = $('.pesan-eror').data('pesaneror');
          if (Error_pesan) {
              Toast.fire({
                  icon: 'error',
                  title: Error_pesan
              })
          }
      });
  </script>
  </body>

  </html>