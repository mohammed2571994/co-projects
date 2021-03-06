@extends('theme.default')

@section('head')
    <link href="{{ asset('theme/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('heading')
    {{ __('Show Newsletter') }}
@endsection


@section('content')
    <div class="container">
        <div class="py-8">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Newsletter Details') }}</div>
                        <div class="card-body">
                            <h4 class="card-title">{{ $newsletter->title }}</h4>
                            <p class="card-text">{{$newsletter->body, 60}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
