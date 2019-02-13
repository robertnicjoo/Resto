@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h1>Welcome,</h1>
                    <p>This is <code>testing</code> app and <code>not a real life version</code>, there will be <strong>no template</strong>, <strong>no special design</strong> just <strong class="text-primary">simple functionality tests</strong>.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">API</div>

                <div class="card-body">
                    <p>To access menus API visit this link <code>{{config('app.url')}}/api/menus</code>.</p>
                    <p>Note: based on your localhost configuration url above can be different but the endpoint is always the same <b>api/menus</b></p>
                </div>
            </div>
        </div>

        <div class="col-md-12 mt-2">
            <div class="card">
                <div class="card-header">To whom may concern</div>

                <div class="card-body">
                    <p>This is a test application, some parts may have not have full CRUD functions such as edit/update or destroy. Point of this application was ability of doing the job and not to create real-life application. Hope you enjoy it.</p>
                    <p>This app meant to run restaurant process test such as <strong>Manager</strong>, <strong>Cashiers</strong> and <strong>Waiters</strong> work process.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
