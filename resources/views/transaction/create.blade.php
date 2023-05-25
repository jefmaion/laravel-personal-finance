@extends('template.main')

@section('title')
    <i class="fa fa-money" aria-hidden="true"></i> Lançamento - Novo Lançamento
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