@extends('template.main')

@section('title')
    <i class="fa fa-credit-card" aria-hidden="true"></i> Formas de Pagamento - Editar
@endsection

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="block">
            <form action="{{ route('payment.update', $payment) }}" method="POST">
                @method('PUT')
                @include('payment.form')
            </form>
        </div>
    </div>
</div>
@endsection