@extends('layouts.app')

@section('title', 'Employees')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <!-- PAGE CONTENT WRAPPER -->
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default"><div class="panel-body"><h3>Employees</h3></div></div>
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
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Role</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                        <tr>
                                          <td class="text-center">{{$user->id}}</td>
                                          <td class="text-center">{{$user->name}}</td>
                                          <td class="text-center">{{$user->email}}</td>
                                          <td class="text-center">{{$user->roles()->pluck('name')->implode(',') }}</td>
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