@extends('layouts.app')

@section('title', 'Orders')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <!-- PAGE CONTENT WRAPPER -->
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default"><div class="panel-body"><h3>Orders
                            <span class="float-right"><a href="{{route('orders.create')}}" class="btn btn-success btn-sm btn-rounded">Add New</a></span></h3>
                            </div></div>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="datatable" class="table table-hover table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">ID</th>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Customer</th>
                                            <th class="text-center">Table No.</th>
                                            <th class="text-center">Waiter</th>
                                            <th class="text-center">Cashier</th>
                                            <th class="text-center">Total</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orders as $order)
                                        <tr>
                                          <td class="text-center">{{$order->id}}</td>
                                          <td class="text-center">{{$order->order_no}}</td>
                                          <td class="text-center">{{$order->customer}}</td>
                                          <td class="text-center">{{$order->table_no}}</td>
                                          <td class="text-center">{{$order->waiter->name}}</td>
                                          <td class="text-center">{{$order->cashier->name}}</td>
                                          <td class="text-center">Rp. {{number_format($order->price, 0)}}</td>
                                          <form action="{{route('updateorderstatus', $order->id)}}" method="post">
                                              {{csrf_field()}}
                                              <td class="text-center">
                                                <label for="name" hidden></label>
                                                <a href="#" id="name" class="name" data-url="{{ route('updateorderstatus', $order->id) }}" data-pk="{{ $order->id }}" data-type="select" data-title="Edit Name">{{$order->status}}</a>
                                              </td>
                                            </form>
                                            @hasrole('Waiter')
                                            <td>
                                                <button type="button" class="print btn btn-warning btn-block btn-sm">Print</button> 
                                            </td>
                                            @endhasrole
                                            @hasrole('Cashier')
                                            <td>
                                                <button type="button" class="btn btn-info btn-block btn-sm">Edit</button>
                                                <button type="button" class="print btn btn-warning btn-block btn-sm">Print</button>
                                            </td>
                                            @endhasrole
                                            @hasrole('Manager')
                                            <td>
                                                <button type="button" class="btn btn-primary btn-block btn-sm">Edit</button>
                                                <a href="{{route('orders.show', $order->order_no)}}" class="btn btn-info btn-block btn-sm">Details</a>
                                                <button type="button" class="print btn btn-warning btn-block btn-sm">Print</button>
                                                <button type="button" class="btn btn-danger btn-block btn-sm">Delete</button>
                                            </td>
                                            @endhasrole
                                        </tr>
                                        @endforeach
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
                    type:"select",
                    value: 'Active',
                    source: [
                        {value: 'Active', text: 'Active'},
                        {value: 'Finished', text: 'Finished'}
                    ]
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

        // print items
        $('.print').click(function(e) {
            e.preventDefault();
            swal({
                title: "Print this receipt?",
                text: "This is sample action you won't actually print anything!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    swal("FAKE NEWS: please connect your printer!", {
                        icon: "error",
                    });
                } else {
                    swal("OK we don't print it for you.", {icon: "success",});
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