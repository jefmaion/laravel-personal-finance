@csrf
<div class="form-group">
    <label class="form-control-label">Nome da Categoria</label>
    <x-form.input name="name"  value="{{ $category->name }}" />
</div>

<div class="form-group">
    <label class="form-control-label">Categoria</label>
    <x-form.select  name="category_id" :options="$parents" value="{{ $category->category_id }}" />
</div>

<div class="form-group">
    <x-form.checkbox name="enabled" value="{{ $category->enabled }}" label="Ativo" />
</div>



<br>

<div class="form-group">
    <a name="" id="" class="btn btn-light" href="{{ route('category.index') }}" role="button">
        <i class="fa fa-chevron-left" aria-hidden="true"></i>
        Voltar
    </a>
    <button type="submit" class="btn btn-success">
        <i class="fa fa-check" aria-hidden="true"></i>
        Salvar
    </button>
</div>