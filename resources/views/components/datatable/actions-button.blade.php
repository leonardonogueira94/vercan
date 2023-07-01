<div class="dropdown d-flex justify-content-center">
    <button class="btn btn-sm btn-default dropdown-toggle" type="button" id="dropdownMenu5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    </button>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="{{ $showRoute }}">Ver</a>
      <a class="dropdown-item" href="{{ $editRoute }}">Editar</a>
      <div class="dropdown-divider"></div>
      <form class="dropdown-item" method="POST" action="{{ $deleteRoute }}">
        @csrf
        @method('DELETE')
        <button class="btn btn-link">Excluir</button>
      </form>
    </div>
  </div>