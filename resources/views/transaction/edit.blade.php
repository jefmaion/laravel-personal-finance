@extends('template.main')

@section('title')
    <i class="fa fa-money" aria-hidden="true"></i> Lançamentos - Editar
@endsection

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="block">
            <form action="{{ route('transaction.update', $transaction) }}" method="POST">
                @method('PUT')
                @include('transaction.form')
            </form>
        </div>
    </div>
</div>
@endsection