@extends('template.main')

@section('title')
    <i class="fa fa-money" aria-hidden="true"></i> Lançamento - Novo Lançamento
@endsection

@section('breadcrumb')
<ul class="breadcrumb">
	<li class="breadcrumb-item"><a href="#">Home</a></li>
	<li class="breadcrumb-item"><a href="{{ route('transaction.index') }}">Lançamentos</a></li>
	<li class="breadcrumb-item active">Adicionar</li>
  </ul>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="block">
                <form action="{{ route('transaction.store') }}" method="POST">
                    @include('transaction.form')
                </form>
            </div>
        </div>
    </div>
@endsection