@extends('layouts.app')

@section('title', 'Update Role Permissions')

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
                            <div class="panel panel-default"><div class="panel-body"><h3>AUpdate Role Permissions<small class="text-info">(Full access to managers only)</small></h3></div></div>
                        </div>
                    
                        <div class="col-md-12">
                            <p><strong class="text-danger">Caution</strong> Changing any of this values will takes effect on your website immediately and might cause errors. <br> Change only if you know what you're doing.</p>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            {{ Form::model($role, array('route' => array('roles.update', $role->id), 'method' => 'PUT')) }}
                              <div class="row">
                                  <div class="col-md-6">
                                    {{ Form::label('name', 'Name') }}
                                    {{ Form::text('name', null, array('class' => 'form-control')) }}
                                  </div>
                                  <div class="col-md-6 mt-20">
                                      <h5><b>Assign Permissions (use CTR+click to select multiple)</b></h5>
                                      @foreach ($permissions as $permission)
                                      <div class="form-check">
                                        {{Form::checkbox('permissions[]',  $permission->id, $role->permissions ) }}
                                        <label class="form-check-label" for="{{$permission->id}}">
                                          {{ucfirst($permission->name)}}
                                        </label>
                                      </div>
                                      @endforeach
                                  </div>
                                  <div class="col-md-12 mb-20 mt-20">
                                    {{ Form::submit('Update', array('class' => 'btn btn-success')) }}
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