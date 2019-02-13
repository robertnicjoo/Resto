@extends('layouts.app')

@section('title', 'Create New Role')

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
                            <div class="panel panel-default"><div class="panel-body"><h3>Add New Role<small class="text-info">(Full access to managers only)</small></h3></div></div>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            {{ Form::open(array('route' => 'roles.store')) }}
                              <div class="row">
                                <div class="col-md-4">
                                  <h4>Role Name</h4>
                                  {{ Form::text('name', null, array('class' => 'form-control')) }}
                                </div>
                                <div class="col-md-4">
                                    <h4>Permissions</h4>
                                  @foreach ($permissions as $permission)
                                      {{ Form::checkbox('permissions[]',  $permission->id ) }}
                                      {{ Form::label($permission->name, ucfirst($permission->name)) }}<br>
                                  @endforeach
                                </div>
                                <div class="col-md-12 mt-20">
                                  {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}
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