<div class="dropdown pull-right dropdown-filter">
    <button class="btn dropdown-toggle btn-primary btn-flat btn-sm btn-filter" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Ordenar por
    </button>
    <div class="dropdown-menu dropdown-menu-filter">
        <a class="dropdown-item" href="{{route($url, ['categoria' => Request::input('categoria'), 'q' => Request::input('q'), 'filtrar' => 'Menor preço', 'page' => Request::input('page')])}}">Menor preço</a>
        <a class="dropdown-item" href="{{route($url, ['categoria' => Request::input('categoria'), 'q' => Request::input('q'), 'filtrar' => 'Ordem alfabética', 'page' => Request::input('page')])}}">Ordem alfabética</a>
        <a class="dropdown-item" href="{{route($url, ['categoria' => Request::input('categoria'), 'q' => Request::input('q'), 'filtrar' => 'Mais novos', 'page' => Request::input('page')])}}">Mais novos</a>
    </div>
</div>