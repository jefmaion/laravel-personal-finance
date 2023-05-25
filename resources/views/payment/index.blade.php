@extends('template.main')

@section('title')
<i class="fa fa-credit-card" aria-hidden="true"></i> Formas de Pagamento
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="block">
            <a name="" id="" class="btn btn-success" href="{{ route('payment.create') }}" role="button"><i class="fa fa-plus" aria-hidden="true"></i> Novo</a>
            <hr>
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Nome</th>
                        <th>Status</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.13.1/r-2.4.0/datatables.min.css" />
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/v/bs4/dt-1.13.1/r-2.4.0/datatables.min.js"></script>
    <script>
        $('table').DataTable({
            order: [],
            pageLength: 10,
            lengthMenu: [
                [5,10, 25, 50, -1],
                [5,10, 25, 50, 'Tudo'],
            ],
            columnDefs: [
                { className: "align-middle", targets: "_all" },
            ],
            deferRender:true,
            processing:true,
            responsive:true,
            pagingType: $(window).width() < 768 ? 'simple' : 'simple_numbers',
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.1/i18n/pt-BR.json'
            },
            lengthChange: true,
            ajax: '{{ route('payment.index') }}',
            columns: [
                {data: 'name'},
                {data: 'status'}
            ],
        });
    </script>
@endsection