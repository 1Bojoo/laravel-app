@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Zweryfikuj swój adres email') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Link weryfikacyjny został wysłany w wiadomości na Twój adres email.') }}
                        </div>
                    @endif

                    {{ __('Zanim przejdziesz dalej, sprawdź, czy w wiadomości e-mail znajduje się link weryfikacyjny.') }}
                    {{ __('Jeżeli nie otrzymałeś wiadomości e-mail') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Kliknij tutaj aby ponownie wysłać link weryfiacyjny') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
