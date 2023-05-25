@extends('template.main')

@section('title')
    <i class="fa fa-credit-card" aria-hidden="true"></i> Formas de Pagamento - Novo
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="block">
                <form action="{{ route('payment.store') }}" method="POST">
                    @include('payment.form')
                </form>
            </div>
        </div>
    </div>
@endsection