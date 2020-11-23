@extends('admin.layouts.master')

@section('content')
    @if(isset($new) && $new == 0)
		@include('admin.product.search_catalog')
	@endif
	@if(isset($new) && $new == 1)
		{!! Form::open(['route' => 'admin.catalog.product.store', 'files' => true, 'id' => 'form-ajax-upload', 'data-toggle' => 'validator']) !!}
			@include('admin.product._form')
		{!! Form::close() !!}
	@endif
    <div id="variationModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                {!! Form::open(['route' => 'admin.stock.inventory.combinations','id'=> 'combinations-form','type'=>'post']) !!}
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-title" id="my-modal-title">Select Variations</h5>
                        
                    </div>
                    <div class="modal-body">
                            <div class="modal-body">
                                <div class="variants-body">
                                    @if(isset($attributes) and $attributes != null)
                                        @foreach($attributes as $attribute)
                                            <div class="form-group half-2">
                                                {!! Form::label($attribute->name, $attribute->name, ['class' => 'with-help']) !!}
                                                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.set_attribute') }}"></i>
                                                <select class="form-control select2-set_attribute" id="{{ $attribute->name }}" name="{{ $attribute->id }}[]" multiple='multiple' placeholder="{{ trans('app.placeholder.attribute_values') }}">
                                                    @foreach($attribute->attributeValues as $attributeValue)
                                                        <option value="{{ $attributeValue->id }}">{{ $attributeValue->value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" type="button" onClick="getMessage()" class="btn btn-primary btn-flat btn-lg create-combinations next-step">Add</button>       
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    
@endsection

@section('page-script')
	@include('plugins.dropzone-upload')
  @include('plugins.dynamic-inputs')

    <script language="javascript" type="text/javascript">
      ;(function($, window, document) {

        // Dynamically set get the value from row 1 and set to other rows
        $(document).on("change","#variantsTable > tbody tr:first input.sku",function(){
            var value = $(this).val();
            $('input.sku').each(function(){
                if($(this).val() == '') $(this).val(value);
            })
        });

        $(document).on("change","#variantsTable > tbody tr:first select.condition",function(){
            var value = $(this).val();
            console.log(value);
            $('select.condition').each(function(){
                $(this).val(value);
            })
        });

        $(document).on('change',"#variantsTable > tbody tr:first input.quantity",function(){
            var value = $(this).val();
            $('input.quantity').each(function(){
                if($(this).val() == '') $(this).val(value);
            })
        });

        $(document).on('change',"#variantsTable > tbody tr:first input.purchasePrice",function(){
            var value = $(this).val();
            $('input.purchasePrice').each(function(){
                if($(this).val() == '') $(this).val(value);
            })
        });

        $(document).on('change',"#variantsTable > tbody tr:first input.salePrice",function(){
            var value = $(this).val();
            $('input.salePrice').each(function(){
                if($(this).val() == '') $(this).val(value);
            })
        });

        $(document).on('change',"#variantsTable > tbody tr:first input.offerPrice",function(){
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

      function getMessage() {
          console.log($('#combinations-form').serialize())
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
               type:'POST',
               url:'/admin/stock/inventory/combinations',
               data:$('#combinations-form').serialize(),
               success:function(data) {
                //    console.log(data)
                  $("#combinations").html(data.html);
               }
            });
            $('.first-tab').removeClass('active')
            $('#variation-tab').removeClass('active')
            $('#variations').hide()
            $('#userProfile').addClass('active')
            $('.second-tab').addClass('active')
            $('.single-inventory').addClass('hidden')
            $('#has_variant').prop('checked', true)
            $('input[name="has_variant"]').val(1)
         }

         $('#has_variant').iCheck('uncheck'); 
        
         $('#has_variant').on('ifClicked', function(event){
            $('.add-variations').toggleClass('hidden')
            $('.single-inventory').toggleClass('hidden')
            if($('.single-stock').attr('required'))
            {
                $('.single-stock').removeAttr('required')
            }
            else
            {
                $('.single-stock').attr('required', 'required')
            }
            if($('.single-price').attr('required'))
            {
                $('.single-price').removeAttr('required')
            }
            else
            {
                $('.single-price').attr('required', 'required')
            }
        });
        

    </script>
@endsection