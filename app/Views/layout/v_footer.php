  </section><!-- /.content -->
  </div><!-- /.container -->
  </div><!-- /.content-wrapper -->
  <footer class="main-footer">
      <div class="container">
          <div class="pull-right hidden-xs">
              <b>Version</b> 2.3.0
          </div>
          <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
      </div><!-- /.container -->
  </footer>
  </div><!-- ./wrapper -->




  <!-- jQuery 2.1.4 -->
  <script src="<?= base_url() ?>/template/plugins/jQuery/jQuery-2.1.4.min.js"></script> <!-- Bootstrap 3.3.5 -->
  <script src="<?= base_url() ?>/template/bootstrap/js/bootstrap.min.js">
  </script>
  <!-- DataTables -->
  <script src="<?= base_url() ?>/template/plugins/datatables/jquery.dataTables.min.js"> </script>
  <script src="<?= base_url() ?>/template/plugins/datatables/dataTables.bootstrap.min.js"></script>
  <!-- SlimScroll -->
  <script src="<?= base_url() ?>/template/plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="<?= base_url() ?>/template/plugins/fastclick/fastclick.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url() ?>/template/dist/js/app.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?= base_url() ?>/template/dist/js/demo.js"></script>
  <!-- page script -->
  <script>
      $(function() {
          $("#example1").DataTable();
          $('#example2').DataTable({
              "paging": true,
              "lengthChange": false,
              "searching": false,
              "ordering": true,
              "info": true,
              "autoWidth": false
          });
      });
  </script>

  <script>
      window.setTimeout(function() {
          $('.alert').fadeTo(500, 0).slideUp(500, function() {
              $(this).remove();
          });
      }, 3000);
  </script>
  </body>

  </html>