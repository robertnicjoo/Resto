@extends('layouts.app')

@section('title', 'Roles & Permissions')

@section('styles')
<style>
    #buildyourformaddtitl{width: 100% !important;}
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
                        <div class="col-md-6">
                            <div class="panel panel-default"><div class="panel-body"><h3>Roles & Permissions<small class="text-info">(Full access to managers only)</small></h3></div></div>
                        </div>
                    
                        <div class="col-md-6 text-right">
                            <div class="pull-right">
                                <div class="btn-group" role="group" aria-label="...">
                                    <a href="{{ route('employees.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-users"></i> Users</a>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_group">
                                        <i class="fas fa-plus"></i> Add Permissions
                                    </button>
                                    <a href="{{ route('roles.create') }}" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Add Role</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <p><strong class="text-danger">Caution</strong> Changing any of this values will takes effect on your website immediately and might cause errors. <br> Change only if you know what you're doing. We are <strong>Strongly</strong> suggest you to leave this part untouched or ask help of <a href="https://tjd-studio.com" target="_blank" rel="nofollow">developer</a> to work on it for you.</p>
                        </div>
                    </div>

                        <!-- MODALS -->
                        <div class="modal fade" id="modal_group" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add New Permissions</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              {{ Form::open(array('route' => 'addPermissionsToRole')) }}
                              <div class="modal-body">
                                    <div id="buildyourformaddtitl">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <select name="roles" id="roles" class="w-100 form-control">
                                                    <option value="">-- Select --</option>
                                                    @foreach($roles as $role)
                                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="button" value="Add permissions" class="btn btn-success btn-sm btn-block addtitl" id="addtitl" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    {{Form::submit('Save', array('class' => 'btn btn-primary'))}}
                                </div>
                              {{Form::close()}}
                            </div>
                          </div>
                        </div>
                        <!-- MODALS -->
                </div>
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table datatable_simple table-hover table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="id text-center">ID</th>
                                            <th class="text-center">TITLE</th>
                                            <th class="text-center">Permissions</th>
                                            <th class="text-center">OPTIONS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($roles as $role)
                                        <tr>
                                            <td class="id text-center">{{$role->id}}</td>
                                            <td>{{$role->name}}</td>
                                            <td>
                                                @foreach($role->permissions as $perm)
                                                    <span class="badge badge-dark">{{$perm->name}}</span>
                                                @endforeach
                                            </td>
                                            <td class="options text-center">
                                                <a data-toggle="tooltip" data-placement="left" title="Edit" href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning btn-block btn-rounded btn-sm">
                                                    Edit</span>
                                                </a>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id]]) !!}
                                                  <button data-toggle="tooltip" data-placement="left" title="Delete" class="del btn btn-danger btn-block btn-rounded btn-sm" type="submit">Delete</button>
                                                {!! Form::close() !!}
                                            </td>
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
<script>
    $(function(){
        //datatable
        if($(".datatable").length > 0){
            $(".datatable").dataTable();
            $(".datatable").on('page.dt',function () {
                onresize(100);
            });
        }
        
        if($(".datatable_simple").length > 0){
            $(".datatable_simple").dataTable({"ordering": false, "info": false, "lengthChange": true,"searching": true});
            $(".datatable_simple").on('page.dt',function () {
                onresize(100);
            });
        }

        // add permissions to role 
        $("#addtitl").click(function() {
            var lastField = $("#buildyourformaddtitl div:last");
            var intId = (lastField && lastField.length && lastField.data("idx") + 1) || 1;
            var fieldWrapper = $("<div class=\"col-md-12\" id=\"field" + intId + "\"/>");
            fieldWrapper.data("idx", intId);
            var fName = $("<label for=\"name\">Value</label><input type=\"text\" name=\"name[]\" class=\"form-control\" />");
            var removeButton = $("<button type=\"button\" class=\"btn btn-danger\">Remove</button>");
            removeButton.click(function() {
                $(this).parent().remove();
            });
            fieldWrapper.append(fName);
            fieldWrapper.append(removeButton);
            $("#buildyourformaddtitl").append(fieldWrapper);
        });
        // delete items
        $('.del').click(function(e) {
            e.preventDefault();
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this role and permissions!",
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
                            swal("Roles Deleted Successfully.", {
                                icon: "success",
                            });
                            location.reload();
                        }
                    });
                } else {
                    swal("Your roles is safe!");
                }
            });
        });
    });
</script>
@endsection