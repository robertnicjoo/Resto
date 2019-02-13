@extends('layouts.app')

@section('title', 'Menu Types')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <!-- PAGE CONTENT WRAPPER -->
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default"><div class="panel-body"><h3>Menu Types</h3></div></div>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="table-responsive">
                                <table class="table datatable_simple table-hover table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Name</th>
                                            <th width="100" class="text-center">Items</th>
                                            <th width="100" class="text-center">OPTIONS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($types as $type)
                                        <tr>
                                            <form action="{{route('updatenamesajax', $type->id)}}" method="post">
                                              {{csrf_field()}}
                                              <td class="text-center">
                                                <label for="stock" hidden></label>
                                                <a href="#" id="stock" class="stock" data-url="{{ route('updatenamesajax', $type->id) }}" data-pk="{{ $type->id }}" data-type="text" data-title="Edit Stock">{{$type->name}}</a>
                                              </td>
                                            </form>
                                            <td width="100" class="text-center">{{$type->items->count()}}</td>
                                            <td width="100" class="options text-center">
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['menutypes.destroy', $type->id]]) !!}
                                                  <button data-toggle="tooltip" data-placement="left" title="Delete" class="del btn btn-danger btn-block btn-rounded btn-sm" type="submit">Delete</button>
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h4>ADD NEW TYPE</h4>
                            {{ Form::open(array('route' => 'menutypes.store')) }}
                              <div class="row">
                                <div class="col-md-12">
                                  <h5>Name</h5>
                                  {{ Form::text('name', null, array('class' => 'form-control')) }}
                                </div>
                                <div class="col-md-12 mt-2">
                                  {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
                                </div>
                              </div>
                            {{ Form::close() }}
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
<script>
    $(function(){
        //datatable + editable
        var table = $('.datatable_simple').DataTable({
            "fnRowCallback": function( nRow, mData, iDisplayIndex, iDisplayIndexFull) {
                // add x-editable
                $.fn.editable.defaults.mode = 'inline';
                $.ajaxSetup({
                     headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                product_id = $(this).data('pk');
                url = $(this).data('url');

                //make stock editable
                $('.stock').editable({
                    url: url,
                    pk: product_id,
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
    });
</script>
@endsection