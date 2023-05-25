@csrf
<div class="row">


    <div class="form-group col-4">
        <label class="form-control-label">Data</label>
        <x-form.input type="date" name="date" value="{{ $transaction->date->format('Y-m-d') ?? date('Y-m-d') }}" />
    </div>



    <div class="form-group col-4">
        <label for="">Tipo</label>
        <x-form.select  name="type" :options="[['R', 'Receitas'], ['D', 'Despesas']]" value="{{ old('type', $transaction->type) }}" />

    </div>

    <div class="form-group col-4">
        <label class="form-control-label">Valor R$</label>
        <x-form.input type="text" class="money" name="value" value="{{ old('value', $transaction->value) }}" />
    </div>

    <div class="form-group col-12">
        <label class="form-control-label">Descrição</label>
        <x-form.input type="text" class="font-weight-bold" name="description" value="{{ old('description', $transaction->description) }}" />
    </div>



    <div class="form-group col-6">
        <label class="form-control-label">Categoria</label>
        <x-form.select  name="category_id" :options="$categories" value="{{ old('category_id', $transaction->category_id) }}" />
    </div>


    <div class="form-group col-3">
        <label class="form-control-label">Conta</label>
        <x-form.select  name="account_id" :options="$accounts" value="{{ old('account_id', $transaction->account_id) }}" />
    </div>

    <div class="form-group col-3">
        <label class="form-control-label">Forma</label>
        <x-form.select  name="payment_id" :options="$payments" value="{{ old('payment_id', $transaction->payment_id) }}" />
    </div>

    


    <div class="form-group col-12">
        <label for="">Informações Complementares</label>
        <textarea class="form-control" name="comments" id="" rows="3">{{ old('comments', $transaction->comments) }}</textarea>
    </div>

    

    <div class="form-group col-6 d-flex align-items-center">
        <x-form.checkbox name="is_paid" value="{{ $transaction->is_paid }}" label="Pago" />
    </div>

 

    {{-- <div class="form-group col-6 mx-auto">
        <label class="form-control-label">Data do Pagamento</label>
        <x-form.input type="date" name="date" value="{{ $transaction->date->format('Y-m-d') ?? date('Y-m-d') }}" />
    </div> --}}



    @if($transaction->id == null)
        
        
    <div class="form-group col-12 d-flex align-items-center">
        <x-form.checkbox name="repeat" value="{{ $transaction->is_paid }}" label="Repetir Lançamento" />
    </div>
        

        <div class="container-repeat form-group col-2">
            <label class="form-control-label">Repetir</label>
            <x-form.input type="text" name="num_repeat" />
        </div>

        <div class="container-repeat form-group col-4">
            <label for="">Período</label>
            <x-form.select  name="period" :options="[['1', 'Mensal'], ['2', 'Bimestral'], ['3', 'Trimestral'], ['6', 'Semestral']]"  />
        </div>
    @endif

    <div class="form-group col-12">
        <br>
        <a name="" id="" class="btn btn-light" href="{{ route('transaction.index') }}" role="button">
            <i class="fa fa-chevron-left" aria-hidden="true"></i>
            Voltar
        </a>
        <button type="submit" class="btn btn-success">
            <i class="fa fa-check" aria-hidden="true"></i>
            Salvar
        </button>
    </div>

</div>



@section('scripts')
<script src="{{ asset('js/jquery.mask.min.js') }}"></script>
<script src="{{ asset('js/jquery.mask.config.js') }}"></script>
<script>
    $('[name="repeat"]').change(function (e) { 
        e.preventDefault();
        if(!$(this).prop('checked')) {
            $('.container-repeat').fadeOut()
            $('.container-repeat input').attr('disabled', true);
            $('.container-repeat select').attr('disabled', true);
        } else {
            $('.container-repeat').fadeIn()
            $('.container-repeat input').attr('disabled', false);
            $('.container-repeat select').attr('disabled', false);
        }
    });
</script>
@endsection