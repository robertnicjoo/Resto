@extends('layouts.app')

@section('title', 'Menu Items')

@section('styles')
  <style>
      /* Bootstrap fileinput */
    .file-input {
      overflow-x: auto;
    }
    .file-loading {
      top: 0;
      right: 0;
      width: 25px;
      height: 25px;
      font-size: 999px;
      text-align: right;
      color: #fff;
      background: transparent url(../img/fileinput/loading.gif) top left no-repeat;
      border: none;
    }
    .btn-file {
      position: relative;
      overflow: hidden;
    }
    .btn-file input[type=file] {
      position: absolute;
      top: 0;
      right: 0;
      min-width: 100%;
      min-height: 100%;
      text-align: right;
      filter: alpha(opacity=0);
      opacity: 0;
      background: none repeat scroll 0 0 transparent;
      cursor: inherit;
      display: block;
    }
    .file-caption .glyphicon {
      display: inline-block;
      min-width: 18px;
      float: left;
      margin-top: 2px;
    }
    .file-caption-name {
      display: inline-block;
      float: left;
      overflow: hidden;
      white-space: nowrap;
      text-overflow: ellipsis;
      width: 85%;
    }
    .file-error-message {
      background-color: #f2dede;
      color: #a94442;
      text-align: center;
      border-radius: 0px;
      padding: 5px;
    }
    .file-caption-disabled {
      background-color: #EEE;
      cursor: not-allowed;
      opacity: 1;
    }
    .file-input .btn .disabled,
    .file-input .btn[disabled] {
      cursor: not-allowed;
    }
    .file-preview {
      border-radius: 0px;
      border: 1px solid #ddd;
      padding: 5px;
      width: 100%;
      margin-bottom: 5px;
    }
    .file-preview-frame {
      display: table;
      margin: 10px;
      height: 160px;
      border: 1px solid #d5d5d5;
      box-shadow: 0px 1px 1px 0 rgba(0, 0, 0, 0.1);
      padding: 3px;
      float: left;
      text-align: center;
    }
    .file-preview-frame:hover {
      background-color: #F5F5F5;
    }
    .file-preview-image {
      height: 150px;
      vertical-align: text-center;
    }
    .file-preview-text {
      display: table-cell;
      width: 150px;
      height: 150px;
      color: #428bca;
      font-size: 11px;
      vertical-align: middle;
      text-align: center;
    }
    .file-preview-other {
      display: table-cell;
      width: 150px;
      height: 150px;
      font-family: Monaco,Consolas,monospace;
      font-size: 11px;
      vertical-align: middle;
      text-align: center;
    }
    .file-input-new .close,
    .file-input-new .file-preview,
    .file-input-new .fileinput-remove-button,
    .file-input-new .fileinput-upload-button,
    .file-input-new .glyphicon-file {
      display: none;
    }
    .loading {
      background: transparent url(../img/loading.gif) no-repeat scroll center center content-box !important;
    }
    .wrap-indicator {
      font-weight: 700;
      color: #245269;
      cursor: pointer;
    }
    /* END Bootstrap fileinput */
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
                            <div class="panel panel-default"><div class="panel-body"><h3>Menu Items</h3></div></div>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="table-responsive">
                                <table id="datatable" class="table table-hover table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="120" class="text-center">Photo</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Price</th>
                                            <th class="text-center">Type</th>
                                            <th width="100" class="text-center">OPTIONS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($items as $item)
                                        <tr>
                                          <td width="120">
                                            <img class="img-fluid" src="{{url('images')}}/{{$item->photo}}" alt="{{$item->name}}">
                                          </td>
                                            <form action="{{route('updateitemnames', $item->id)}}" method="post">
                                              {{csrf_field()}}
                                              <td class="text-center">
                                                <label for="name" hidden></label>
                                                <a href="#" id="name" class="name" data-url="{{ route('updateitemnames', $item->id) }}" data-pk="{{ $item->id }}" data-type="text" data-title="Edit Name">{{$item->name}}</a>
                                              </td>
                                            </form>

                                            <form action="{{route('updatepricesajax', $item->id)}}" method="post">
                                              {{csrf_field()}}
                                              <td class="text-center">
                                                <label for="price" hidden></label>
                                                Rp. <a href="#" id="price" class="price" data-url="{{ route('updatepricesajax', $item->id) }}" data-pk="{{ $item->id }}" data-type="number" data-title="Edit Price">{{number_format($item->price,0)}}</a>
                                              </td>
                                            </form>
                                            <td width="100" class="text-center">{{$item->type->name}}</td>
                                            <td width="100" class="options text-center">
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['menus.destroy', $item->id]]) !!}
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
                            <h4>ADD Item</h4>
                            {{ Form::open(array('route' => 'menus.store', 'files' => true)) }}
                              <div class="row">
                                <div class="col-md-12">
                                  <h5>Name</h5>
                                  {{ Form::text('name', null, array('class' => 'form-control')) }}
                                </div>
                                <div class="col-md-12">
                                  <h5>Price</h5>
                                  {{ Form::number('price', null, array('class' => 'form-control')) }}
                                </div>
                                <div class="col-md-12">
                                  <h5>Photo</h5>
                                  {{ Form::file('photo', array('class' => 'form-control', 'id' => 'photo')) }}
                                </div>
                                <div class="col-md-12">
                                    <h5>Type</h5>
                                    <select name="type_id" id="type_id" class="form-control">
                                        <option value="">-- Select --</option>
                                        @foreach($types as $type)
                                        <option value="{{$type->id}}">{{$type->name}}</option>
                                        @endforeach
                                    </select>
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