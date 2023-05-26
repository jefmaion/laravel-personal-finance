@extends('template.main')

@section('title')
<i class="fas fa-money-bill    "></i> Lançamentos
@endsection

@section('content')
<div class="row">
	<div class="col-lg-9">
		<div class="block">

			<div class="row">
				<div class="col-7 d-flex align-items-end">
					<div class="dropdown float-left mr-2">
						<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
							data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Ações
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
							<h6 class="dropdown-header">Marcar/Desmarcar</h6>
							<a class="dropdown-item select-checkbox" href="#" data-value="true">
								<i class="fa fa-check-circle" aria-hidden="true"></i>
								Marcar Tudo
							</a>
							<a class="dropdown-item select-checkbox" href="#" data-value="false">
								<i class="fa fa-circle-o" aria-hidden="true"></i>
								Desmarcar Tudo
							</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#" onclick="pay(1)">
								<i class="fa fa-check" aria-hidden="true"></i>
								Pagar
							</a>
							<a class="dropdown-item" href="#" onclick="pay(0)">
								<i class="fa fa-times" aria-hidden="true"></i>
								Remover Pagamento
							</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-delete-selected">
								<i class="fa fa-trash-o" aria-hidden="true"></i>
								Excluir</a>
						</div>
					</div>
		
					<a name="" id="" class="btn btn-success" href="{{ route('transaction.create') }}" role="button"><i class="fa fa-plus" aria-hidden="true"></i> Novo Lançamento</a>

				</div>
				<div class="col">
					{{-- <label class="form-control-label">De</label> --}}
					<x-form.input type="date" class="range" name="date-from" value="{{ $dateFrom }}" />
				</div>
				<div class="col">
					{{-- <label class="form-control-label">Até</label> --}}
					<x-form.input type="date" class="range" name="date-to" value="{{ $dateTo }}" />
				</div>
				<div class="col d-flex align-items-end">
					<a name="" id="" class="btn btn-secondary btn-block" href="#" onclick="location.reload()" role="button">
						<i class="fa fa-refresh" aria-hidden="true"></i>
					</a>
				</div>
			</div>

			
			<hr>
			<form method="POST" id="form">
				@csrf
				<table class="table table-striped" id="table-transaction">
					<thead class="thead-dark">
						<tr>
							<th>
							
								Data
							</th>

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
						<div class="number text-{{ ($incomes - $expenses) < 0 ? 'danger' : 'success'  }}">R$ {{
							currency($incomes -
							$expenses) }}</div>
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



<!-- Modal -->
<div class="modal fasde" id="modal-delete-selected" tabindex="-1" role="dialog"
    aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content   ">
            <div class="modal-header border-0 ">
                <h5 class="modal-title">
                    <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                    Excluir Registros
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body m-4 text-center">
                <p class="">Deseja excluir os registros selecionados?</p>
            </div>
            <div class="modal-footer border-0">
                
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fa fa-times" aria-hidden="true"></i> Fechar
                    </button>

                    <button type="button" class="btn btn-primary" onclick="deleteAll()">
                        <i class="fa fa-trash" aria-hidden="true"></i> Excluir
                    </button>
                
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
	$('#table-transaction').DataTable({
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

		$('.range').change(function (e) { 
			e.preventDefault();

			from 	 = $('[name="date-from"]').val()
			to   	 = $('[name="date-to"]').val()
			endpoint = '{{ route('transaction.index') }}?from=' + from + '&to=' + to;

			table = $('#table-transaction').DataTable();
			table.ajax.url(endpoint).load();
		});

		function deleteAll() {
			$('#form').attr('action', '{{ url("transaction/actions/delete") }}')
			$('#form').submit();
        }

        function pay(status) {
			$('#form').attr('action', '{{ url("transaction/actions/pay") }}/' + status)
			$('#form').submit();
        }


		
		
</script>
@endsection