
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>

    <script type="text/javascript" src="js/stacktable.js"></script>
    <script type="text/javascript" src="js/notify.js"></script>
    <script src="js/bootbox.min.js"></script>
    <script src="js/typeahead.js"></script>
    <script type="text/javascript">
      $.ajax({
        method:"POST",
        url:"class/scriptObtenerEstudiantesPorNombre.php",
        dataType: "json",
        success:function (respuesta) {

          var $input = $("#busqueda");
          $input.typeahead({
            source: respuesta
          });
          $input.change(function() {
            var current = $input.typeahead("getActive");
            if (current) {
              // Some item from your model is active!
              if (current.name == $input.val()) {
                // This means the exact match is found. Use toLowerCase() if you want case insensitive match.
              } else {
                // This means it is only a partial match, you can either add a new item
                // or take the active if you don't want new items
              }
            } else {
              // Nothing is active so it is a new value (or maybe empty value)
            }
          });


        },
        error:function (error,error1,error2) {
          console.log(error2);
        }
      })


    </script>
</body>

</html>
