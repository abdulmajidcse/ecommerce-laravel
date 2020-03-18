    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <!--fontawesome icon cdn-->
    <script src="https://kit.fontawesome.com/71910267df.js" crossorigin="anonymous"></script>
    <!-- toastr js -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- sweetalert js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js" integrity="sha256-JirYRqbf+qzfqVtEE4GETyHlAbiCpC005yBTa4rj6xg=" crossorigin="anonymous"></script>
    <!-- frontend js -->
    <script type="text/javascript" src="{{ asset('frontend/js/script.js') }}"></script>
    <!-- custom js -->
    <script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>

    <script type="text/javascript">
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

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //add to cart**********
        function addToCart(product_id){
          $.post( "{{ URL::to('/carts/store') }}", 
            { id: product_id })
          .done(function( data ) {
            data = JSON.parse(data);
            $('.cart-items').html(data.items);
            toastr["success"](data.message, "Success!");
          })
          .fail(function() {
            alert( "Something went wrong!" );
          });
        };//end of add to cart**********

        //show total cart items by jquery
        var cartItems = {{ App\Cart::totalItems() }};
        if (cartItems) {
          $('.cart-items').html(cartItems);
        }

        $(document).ready(function(){
          

          //select all district by division**********
          $("#division_id").change(function(){
            var division_id = $(this).val();
            var option = "";
            $.get(
              "{{ URL::to('/user/district/select') }}/"+division_id,
              function(data){
                data = JSON.parse(data);
                data.forEach(function(element){
                  option += "<option value='"+element.id+"'>"+element.name+"</option>";
                });
                $("#district_id").html(option);
            }
            );
          });//end of select all district by division**********


          //select all district by division in profile edit**********
          $(".division_id").change(function(){
            var division_id = $(this).val();
            $.get(
              "{{ URL::to('/user/edit-profile/district/select') }}/"+division_id,
              function(data){
                $(".districtByDivision").html(data);
            }
            );
          });//end of select all district by division in profile edit**********

          //select all district by division in profile edit**********
          $("#payment_method_id").change(function(){
            var payment_method_id = $(this).val();
            $.get(
              "{{ URL::to('/checkout/select-payment-method') }}/"+payment_method_id,
              function(data){
                $("#payment_box").html(data);
            }
            );
          });//end of select all district by division in profile edit**********

        });
    
    </script>