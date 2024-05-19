@extends('layouts.admin')
@section('admin_content')
@push('title') <title>Email verification link has been sent to your email.</title> @endpush


    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h3>Verify your email address!</h3></div>
                    <div class="card-body">
                        @if (session()->has('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{route('verification.resend') }}"> 
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>

@endsection