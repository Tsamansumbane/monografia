@include('includes.header')
@include('includes.navbar')

<div class="modal fade" id="whitelistModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Adicionar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="whitelistForm" action="{{ route('tipos.store') }}" method="POST">
                @csrf
                <div class="modal-body">

              

                    <div class="form-group">
                        <label>Tipo</label>
                        <input type="text" name="nome" class="form-control" id="nome" placeholder="Introduza o tipo" value="{{ old('nome') }}">
        
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary" id="submitButton">
                        Registar
                        <span id="loadingSpinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#whitelistModal">
                    Adicionar tipo
                </button>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tipo</th>
                            <th>EDIT</th>
                            <th>DELETE</th>
                        </tr>
                    </thead>
                    <tbody>
                    {{-- Iterar sobre os dados da whitelist --}}
                    @foreach ($tipo as $tipo)
                            <tr>
                                <td>{{ $tipo->id }}</td>
                                <td>{{ $tipo->nome }}</td>
                                <td>
                                    <form action="#" method="GET">
                                        <button type="submit" class="btn btn-success">EDITAR</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="#" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">APAGAR</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                       
                            
                       
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('includes.scripts')
@include('includes.footer')

<script>
    @if (session('modal_open'))
        const modal = new bootstrap.Modal(document.getElementById('whitelistModal'));
        modal.show();
    @endif

    document.getElementById('whitelistForm').onsubmit = function() {
        const button = document.getElementById('submitButton');
        const spinner = document.getElementById('loadingSpinner');
        button.disabled = true;
        spinner.style.display = 'inline-block';
    };
</script>
