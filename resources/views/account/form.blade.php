@csrf
<div class="form-group">
    <label class="form-control-label">Nome da Conta</label>
    <x-form.input name="name"  value="{{ $account->name }}" />
</div>

<div class="form-group">
    <x-form.checkbox name="enabled" value="{{ $account->enabled }}" label="Ativo" />
</div>

<br>

<div class="form-group">
    <a name="" id="" class="btn btn-light" href="{{ route('account.index') }}" role="button">
        <i class="fa fa-chevron-left" aria-hidden="true"></i>
        Voltar
    </a>
    <button type="submit" class="btn btn-success">
        <i class="fa fa-check" aria-hidden="true"></i>
        Salvar
    </button>
</div>