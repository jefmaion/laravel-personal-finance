@extends('template.main')

@section('title')
<i class="fas fa-money-bill    "></i> Lançamentos - Importar
@endsection

@section('content')
<div class="row">
	
	<div class="col-lg-12">
		<div class="block">

			
			<form action="{{ route('transaction.import.upload') }}" method="POST" enctype="multipart/form-data">
				@csrf
				<div class="form-group">
					<input id="my-input" class="form-control-file" type="file" name="report">
				</div>
				<button type="submit" class="btn btn-primary">Submit</button>
			</form>

			@if(isset($data))
			<hr>
			<form action="{{ route('transaction.import.save') }}" method="POST">
				@csrf
				<table class="table table-sm">
					<thead>
						<tr>
							<th width="10%">Data</th>
							<th width="30%">Descrição</th>
							<th width="7%">Valor</th>
							<th width="9%">Tipo</th>
							<th width="9%">Tipo</th>
							<th width="9%">Forma</th>
							<th>Categoria</th>
							<th>Observação</th>
						</tr>
					</thead>
					<tbody>
						@foreach($data as $i => $item)
						<tr>
							<td scope="row"><input type="date" class="form-control" name="import[{{ $i }}][date]" value="{{ $item['date'] }}" ></td>
							<td><input type="text" class="form-control description" name="import[{{ $i }}][description]" value="{{ $item['description'] }}"></td>
							<td><input type="text" class="form-control" name="import[{{ $i }}][value]" value="{{ $item['value'] }}"></td>
							<td><x-form.select name="import[{{ $i }}][type]" :options="[['R', 'Receitas'], ['D', 'Despesas']]" value="{{ $item['type'] }}" /></td>
							<td><x-form.select name="import[{{ $i }}][account_id]" :options="$accounts" value="1" /></td>
							<td><x-form.select name="import[{{ $i }}][payment_id]" :options="$payments" value="{{ $item['payment_id'] }}"  /></td>
							
							<td>
								<select class="form-control {{ ($errors->has('category_id') ? 'is-invalid' : null) }}" name="import[{{ $i }}][category_id]" id="">
									<option></option>
									@foreach($categories as $cat)
									<optgroup label="{{ $cat->name }}">
										@foreach($cat->subcategories as $sub)
										<option value="{{ $sub->id }}">{{
											$sub->name }}</option>
										@endforeach
									</optgroup>
									@endforeach
						
								</select>
							</td>
							<td><input type="text" class="form-control" name="import[{{ $i }}][comments]" value=""></td>
						</tr>
						@endforeach
					
					</tbody>
				</table>

				<button type="submit" class="btn btn-primary">Submit</button>
			</form>

			@endif

		</div>
	</div>

</div>




@endsection

@section('scripts')
<script src="{{ asset('js/jquery.autocomplete.js') }}"></script>
<script>
    $('.description').autocomplete({
        serviceUrl: '{{ route('transaction.description') }}',
        onSelect: function (suggestion) {
            // alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
        }
    });
</script>

@endsection

@section('css')
<style>
    .autocomplete-suggestions {
        border: 1px solid #999;
        background: #2d3035;;
        cursor: default;
        overflow: auto;
    }

    .autocomplete-suggestion {
        padding: 2px 5px;
        white-space: nowrap;
        overflow: hidden;
    }

    .autocomplete-selected {
        background: #343a40;;
    }

    .autocomplete-suggestions strong {
        font-weight: bold;
        /* color: #3399FF; */
    }
</style>
@endsection