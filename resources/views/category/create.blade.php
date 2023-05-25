@extends('template.main')

@section('title')
    <i class="fa fa-list" aria-hidden="true"></i> Categorias - Nova Categoria
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="block">
                <form action="{{ route('category.store') }}" method="POST">
                    @include('category.form')
                </form>
            </div>
        </div>
    </div>
@endsection