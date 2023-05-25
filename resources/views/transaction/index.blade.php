@extends('template.main')

@section('title')
    <i class="fas fa-money-bill    "></i> Lançamentos
@endsection

@section('content')
<div class="row">
    <div class="col-lg-9">
        <div class="block">

          <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Dropdown button
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item select-checkbox" href="#" data-value="true">Marcar Tudo</a>
              <a class="dropdown-item select-checkbox" href="#" data-value="false">Desmarcar Tudo</a>
              <a class="dropdown-item" href="#" onclick="pay()">Something else here</a>
            </div>
          </div>

            <a name="" id="" class="btn btn-success" href="{{ route('transaction.create') }}" role="button"><i class="fa fa-plus" aria-hidden="true"></i> Novo Lançamento</a>
            <hr>
            <form action="" id="form">
              @csrf
              <table class="table table-striped">
                  <thead class="thead-dark">
                      <tr>
                          <th>Data</th>
                          
                          <th>Descrião</th>
                          <th>Categoria</th>
                          <th>Tipo</th>
                          <th>Valor</th>
                          <th>Status</th>
                      </tr>
                  </thead>
              </table>
            </form>
        </div>
    </div>
    <div class="col ">


        <div class="row">
            <div class="col-md-12 d-flex">
                <div class="statistic-block flex-fill block">
                  <div class="progress-details d-flex align-items-end justify-content-between">
                    <div class="title">
                      <div class="icon"><i class="icon-paper-and-pencil"></i></div><strong>Saldo</strong>
                    </div>
                    <div class="number text-{{ ($incomes - $expenses) < 0 ? 'danger' : 'success'  }}">R$ {{ currency($incomes - $expenses) }}</div>
                  </div>

                </div>
              </div>
              <div class="col-md-12">
                <div class="statistic-block flex-fill block">
                  <div class="progress-details d-flex align-items-end justify-content-between">
                    <div class="title ">
                      <div class="icon "><i class="icon-contract"></i></div><strong>Receitas</strong>
                    </div>
                    <div class="number text-success">R$ {{ currency($incomes) }}</div>
                  </div>
                 
                </div>
              </div>

            <div class="col-md-12 ">
              <div class="statistic-block flex-fill block">
                <div class="progress-details d-flex align-items-end justify-content-between">
                  <div class="title">
                    <div class="icon"><i class="icon-user-1"></i></div><strong>Despesas</strong>
                  </div>
                  <div class="number text-danger">R$ {{ currency($expenses) }}</div>
                </div>
              </div>
            </div>
            
            
            
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
            ajax: '{{ route('transaction.index') }}',
            columns: [
                {data: 'date'},
                {data: 'description'},
                {data: 'category'},
                {data: 'type'},
                {data: 'value'},
                {data: 'status'},
            ],
        });

        $('.select-checkbox').click(function (e) { 
          e.preventDefault();
          $('.checkbox').prop('checked', $(this).data('value'))
        });

        function pay() {
          $.ajax({
            type: "POST",
            url: "{{ route('transaction.pay') }}",
            data: $('#form').serialize(),
            success: function (response) {
              console.log(response)
            }
          });
        }
    </script>
@endsection