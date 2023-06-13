@extends('layouts.app')

@section('title', 'Dashboard')

@if (auth()->user()->level == 'Super Admin')

    @section('contents')
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Welcome Message</h6>
                    </div>
                    <div class="card-body">
                        Welcome to Super Admin Dashboard
                    </div>
                </div>
            </div>
        </div>
    @endsection

@else

@endif


@extends('layouts.app')

@section('title', 'Dashboard')

@if (auth()->user()->level == 'Penjual')

    @section('contents')
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        SELAMAT DATANG!
                    </div>
                </div>
            </div>
        </div>
    @endsection

@else

@endif


