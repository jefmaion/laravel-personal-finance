@extends('template.main')

@section('title')
    <i class="fa fa-money" aria-hidden="true"></i> Contas - Editar Conta
@endsection

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="block">
            <form action="{{ route('account.update', $account) }}" method="POST">
                @method('PUT')
                @include('account.form')
            </form>
        </div>
    </div>
</div>
@endsection