@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <!-- PAGE CONTENT WRAPPER -->
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default"><div class="panel-body"><h3>Order Details</h3></div></div>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <div class="row">
                                    <div class="col-md-3">
                                        <h6>Customer</h6>
                                        <p>{{$order->customer}}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <h6>Order Number</h6>
                                        <p>{{$order->order_no}}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <h6>Order Time</h6>
                                        <p>{{$order->created_at->format('Y m, d H:m:s A')}}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <h6>Order Status</h6>
                                        <p>{{$order->status}}</p>
                                    </div>
                                </div>
                                <table id="datatable" class="table table-hover table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Item</th>
                                            <th class="text-center">Qty</th>
                                            <th class="text-center">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->items as $index => $item)
                                        @foreach($item->items as $index => $itt)
                                        <tr>
                                          <td class="text-center">{{$index+1}}</td>
                                          <td class="text-center">{{$itt->name}}</td>
                                          <td class="text-center">{{$item->quantity}}</td>
                                          <td class="text-center">Rp. {{number_format($itt->price*$item->quantity, 0)}}</td>
                                        </tr>
                                        @endforeach
                                        @endforeach
                                        <tr class="text-right">
                                            <th colspan="3">
                                                Total
                                            </th>
                                            <td>
                                                Rp. {{number_format($order->price, 0)}}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
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

        // delete items
        $('.del').click(function(e) {
            e.preventDefault();
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this type!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: $(this).closest('form').attr('action'),
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(result) {
                            swal("Menu Type Deleted Successfully.", {
                                icon: "success",
                            });
                            location.reload();
                        }
                    });
                } else {
                    swal("Your Menu type is safe!");
                }
            });
        });

        //photo
        $("#photo").fileinput({
            showUpload: false,
            showCaption: false,
            maxFileCount: 1,
            browseClass: "btn btn-danger",
            allowedFileExtensions: ["jpg", "png"]
        });
    });
</script>
@endsection