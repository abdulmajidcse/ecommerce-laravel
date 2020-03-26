    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <!--fontawesome icon cdn-->
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('adminlink/js/sb-admin-2.min.js') }}"></script>
    <!-- toastr js -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- sweetalert js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js" integrity="sha256-JirYRqbf+qzfqVtEE4GETyHlAbiCpC005yBTa4rj6xg=" crossorigin="anonymous"></script>

    <!--ckeditor-->
    <script src="https://cdn.ckeditor.com/ckeditor5/18.0.0/classic/ckeditor.js"></script>

    <script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>

    <script type="text/javascript">

      ClassicEditor
      .create( document.querySelector( '#editor' ) )
      .then( editor => {
              console.log( editor );
      } )
      .catch( error => {
              console.error( error );
      } );

        //form submit message**********
        @if(Session::has('message'))
          var type = "{{ Session::get('alert-type') }}";
          switch(type){
            case 'success':
              toastr["success"]("{{ Session::get('message') }}", "Success!");
              break;
            case 'info':
              toastr["info"]("{{ Session::get('message') }}", "Information!");
              break;
            case 'warning':
              toastr["warning"]("{{ Session::get('message') }}", "Warning!");
              break;
            case 'error':
              toastr["error"]("{{ Session::get('message') }}", "Error!");
          }
        @endif //end of form submit message**********

        $(document).ready(function(){
          //select all district by division**********
          $("#division_id").change(function(){
            var division_id = $(this).val();
            $.get(
              "{{ URL::to('/district/select') }}/"+division_id,
              function(data){
                $("#districtByDivision").html(data);
            }
            );
          });//end of select all district by division**********
        });
    
    </script>