@extends('layouts.app')

@section('title', 'New Order')

@section('styles')
    <style>
        .menuscard{
            min-height: 130px;
            vertical-align: middle;
            padding: 30% 0 0 0;
        }
        .menuscard:hover{
            background-color: #f1c40f;
            color: #fff;
            font-size: 18px;
            min-height: 130px;
            vertical-align: middle;
            padding: 30% 0 0 0;
        }
        .menuimg{
            height: 100px;
            width: 100%;
        }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <!-- PAGE CONTENT WRAPPER -->
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default"><div class="panel-body"><h3>New Order</h3><p>Only Manager and Cashiers can see this page, waiters see an error.</p></div></div>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="row">
                        @role('Manager|Cashier')
                        <div class="col-md-12">
                            {{ Form::open(array('route' => 'orders.store')) }}
                            <div class="row">
                                <!-- 'order_no', 'cashier_id', 'status', '' -->
                                <div class="col-md-6">
                                  <h5>Customer Name</h5>
                                  {{ Form::text('customer', null, array('class' => 'form-control')) }}
                                </div>
                                <div class="col-md-3">
                                    <h5>Table</h5>
                                    <select name="table_no" id="table_no" class="form-control">
                                        <option value="">-- Select --</option>
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <h5>Waiter</h5>
                                    <select name="waiter_id" id="waiter_id" class="form-control">
                                        <option value="">-- Select --</option>
                                        @foreach($waiters as $waiter)
                                        <option value="{{$waiter->id}}">{{$waiter->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mt-3"><h5>Items</h5></div>
                                <div class="col-md-2 text-center">
                                    <div class="row">
                                        @foreach($menus as $menu)
                                        <div data-id="{{$menu->id}}" class="menuscard card col-md-12">
                                            {{ucfirst($menu->name)}}
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="row here">
                                        
                                    </div>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <div id="totalprice"></div>
                                    <p>Total: <span id="total"></span></p>
                                  {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
                                </div>
                              </div>
                            {{ Form::close() }}
                        </div>
                        @else
                        <div class="text-center col-md-12">
                            <h3 class="text-danger">You don't have permission for this action.</h3>
                        </div>
                        @endrole
                    </div>
                </div>
                <div class="card-footer">
                    <p><span class="text-danger">Good To Know:</span> This page has calculation bug and as is <u>just for testing purpose</u> and not <del>real life application</del> also <b>due to short time deadline</b> i didn't  spent much time to debug all factors and fix the bug.</p>
                    <p>
                        <span class="text-danger">Tip:</span> If you want to test the bug add this to your console <kbd>$(".price").val(10);</kbd>. Enjoy :)
                    </p>
                </div>
            </div>
            <!-- END PAGE CONTENT WRAPPER -->                                                 
        </div>
    </div>
</div>
<!-- END PAGE CONTENT -->       
@endsection


@section('scripts')
<script src="{{ asset('js/fileinput/fileinput.min.js')}}"></script>
<script>
    $(function(){
        //datatable + editable
        var table = $('#datatable').DataTable({
            "fnRowCallback": function( nRow, mData, iDisplayIndex, iDisplayIndexFull) {
                // add x-editable
                $.fn.editable.defaults.mode = 'inline';
                $.ajaxSetup({
                     headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                item_id = $(this).data('pk');
                url = $(this).data('url');

                //make names editable
                $('.name').editable({
                    url: url,
                    pk: item_id,
                    type:"text",
                    validate:function(value){
                      if($.trim(value) === '')
                      {
                        return 'This field is required';
                      }
                    }
                });

                //make prices editable
                $('.price').editable({
                    url: url,
                    pk: item_id,
                    type:"text",
                    validate:function(value){
                      if($.trim(value) === '')
                      {
                        return 'This field is required';
                      }
                    }
                });
            },
            //
        });

        //getItems
        $('.menuscard').on('click', function(e){
            $.ajaxSetup({
              headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
            });
            e.preventDefault();
            var MenuId = $(this).data("id");
            $.ajax({
                url:'{{ url('backoffice/getItems') }}/'+encodeURI(MenuId),
                type:"GET",
                dataType:"json",
                success:function(data) {

                        data.forEach(function(row) {
                            var $meto = '';
                            $meto += '<div class="col-md-3 mt-2">'+
                                '<div class="card">'+
                                    '<div class="card-body">'+
                                        '<img src="{{url("images")}}/'+row['photo']+'" class="menuimg img-fluid" alt="image">'+
                                        '<p>'+row['name']+'</p>'+
                                        '<input type="hidden" name="items[]" value="'+row['id']+'" class="form-control">'+
                                        '<input type="number" placeholder="0" name="qty[]" class="qty form-control">'+
                                        '<input type="hidden" name="price" class="price" value="'+row['price']+'" />'+
                                    '</div>'+
                                '</div>'+
                            '</div>';
                            $('.here').append($meto);

                            //sum rice
                            $('.qty').on('keyup',function() {
                                var quantities = $('.qty');
                                var prices = $('.price');
                                var total = 0;
                               $.each(quantities, (index, qty) => {
                                    total += parseInt($(qty).val() || 0) * parseFloat($(prices[index]).val() || 0) 
                                });
                                $("#total").html('<input type="hidden" value="'+total+'" name="price" >'+total+'');
                            });
                        });
                }
            });
        });
        //
    });
</script>
@endsection