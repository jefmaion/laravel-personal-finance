@extends('template.main')

@section('title')
<i class="fa fa-list" aria-hidden="true"></i> Categorias - Informações
@endsection

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class=" block user-block">

            <h2 class="card-title mt-2">
                <i class="fa fa-dot-circle-o" aria-hidden="true"></i> {{ $category->name }}
            </h2>

            {{-- <p class="card-text">
                Grupo com acesso total ao sistema
            </p> --}}

            <p class="contributions text-center mt-0">
                @if($category->enabled)
                    <i class="fa fa-thumbs-up text-success" aria-hidden="true"></i>
                @else
                    <i class="fa fa-thumbs-down text-danger" aria-hidden="true"></i>
                @endif

                {{ $category->status }}
            </p>

            <p class="card-center">
                {{ $category->created_at->diffForHUmans() }} | {{ $category->updated_at->diffForHUmans() }}
            </p>

            <a href="{{ route('category.index') }}" class="btn btn-secondary">
                <i class="fa fa-chevron-left" aria-hidden="true"></i>
                Voltar
            </a>



            <div class="btn-group">

                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-cogs" aria-hidden="true"></i>
                    Ações
                </button>

                <div class="dropdown-menu" x-placement="bottom-start"
                    style="position: absolute; transform: translate3d(0px, 40px, 0px); top: 0px; left: 0px; will-change: transform;">

                    <a class="dropdown-item" href="{{ route('category.edit', $category) }}">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                        Editar Categoria
                    </a>

                    <a class="dropdown-item" data-toggle="modal" data-target="#modal-delete-{{ $category->id }}"
                        href="#">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                        Excluir Categoria
                    </a>

                </div>
            </div>



        </div>
    </div>
</div>

<div class="modal fasde" id="modal-delete-{{ $category->id }}" tabindex="-1" role="dialog"
    aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content   ">
            <div class="modal-header border-0 ">
                <h5 class="modal-title">
                    <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                    Excluir Registro
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body m-4 text-center">
                <p class="">Deseja excluir esse registro?</p>
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('category.destroy', $category) }}" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fa fa-times" aria-hidden="true"></i> Fechar
                    </button>

                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-trash" aria-hidden="true"></i> Excluir
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection