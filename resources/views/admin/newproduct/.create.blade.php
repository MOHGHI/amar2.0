@extends('admin.layouts.master')

@section('content')

	@if(isset($new) && $new == 0)
		@include('admin.product.search_catalog')
	@endif
	@if(isset($new) && $new == 1)
		
			@include('admin.product._form')
		
	@endif
@endsection

@section('page-script')
	@include('plugins.dropzone-upload')
	

  
    @include('plugins.dynamic-inputs')

    <script language="javascript" type="text/javascript">
      ;(function($, window, document) {

        // Dynamically set get the value from row 1 and set to other rows
        $("#variantsTable > tbody tr:first input.sku").change(function(){
            var value = $(this).val();
            $('input.sku').each(function(){
                if($(this).val() == '') $(this).val(value);
            })
        });

        $("#variantsTable > tbody tr:first select.condition").change(function(){
            var value = $(this).val();
            console.log(value);
            $('select.condition').each(function(){
                $(this).val(value);
            })
        });

        $("#variantsTable > tbody tr:first input.quantity").change(function(){
            var value = $(this).val();
            $('input.quantity').each(function(){
                if($(this).val() == '') $(this).val(value);
            })
        });

        $("#variantsTable > tbody tr:first input.purchasePrice").change(function(){
            var value = $(this).val();
            $('input.purchasePrice').each(function(){
                if($(this).val() == '') $(this).val(value);
            })
        });

        $("#variantsTable > tbody tr:first input.salePrice").change(function(){
            var value = $(this).val();
            $('input.salePrice').each(function(){
                if($(this).val() == '') $(this).val(value);
            })
        });

        $("#variantsTable > tbody tr:first input.offerPrice").change(function(){
            var value = $(this).val();
            $('input.offerPrice').each(function(){
                if($(this).val() == '') $(this).val(value);
            })
        });

        // Remove table rows
        $(".deleteThisRow").click(function(event) {
            $($(this).closest("tr")).remove();
            return false;
        });

        // Display Offer dates
        $('input.offerPrice').each(function(){
            if($(this).val() != '') {
                $("#offerDates").show();
                $('#offer_start').attr('required', 'required');
                $('#offer_end').attr('required', 'required');
                return false;
            }
        });
        $(".offerPrice,.deleteThisRow").keyup(checkOfferPrice);
        $(".deleteThisRow").click(checkOfferPrice);

        function checkOfferPrice() {
            $('input[name^="offer_price"]').each(function() {
                if($(this).val()){
                    $("#offerDates").show();
                    $('#offer_start').attr('required', 'required');
                    $('#offer_end').attr('required', 'required');
                    return false;
                }
                $('#offer_start').removeAttr('required');
                $('#offer_end').removeAttr('required');
                $("#offerDates").hide();
            });
        }

        // Appy styleing for images upload button
        $("input:file").change(function (){

            if ($(this).val()) {
                // $(this).parent().append("<img src="+$(this).val()+" />");
                $(this).parent().css('background', '#dcdcdc');
            }else{
                $(this).parent().css('background', '#fff');
            }
        });
      }(window.jQuery, window, document));
    </script>


@endsection