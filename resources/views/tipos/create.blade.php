@include('includes.header')
@include('includes.navbar')

<!-- Modal Adicionar Tipo -->
<div class="modal fade" id="addTipoModal" tabindex="-1" role="dialog" aria-labelledby="addTipoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="tipo_form" action="#" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addTipoLabel">Adicionar Tipo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label>Nome do Tipo</label>
                        <input type="text" name="nome" class="form-control" id="nome" placeholder="Introduz o nome do tipo" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar Tipo</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container-fluid">

    <!-- Card Tabela Tipos -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addTipoModal">
                    Adicionar Tipo
                </button>
            </h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tiposTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>EDIT</th>
                            <th>DELETE</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tipos as $key => $item)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $item->nome }}</td>
                            <td>
                                <form action="#" method="post">
                                    <input type="hidden" name="edit_id" value="{{ $item->id }}">
                                    <button type="submit" class="btn btn-success">EDITAR</button>
                                </form>
                            </td>
                            <td>
                                <form action="#" method="post">
                                    <input type="hidden" name="delete_id" value="{{ $item->id }}">
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
<!-- /.container-fluid -->

@include('includes.scripts')
@include('includes.footer')

<script>
$(document).ready(function() {
    $('#tipo_form').submit(function(event) {
        event.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            url: '{{ route('tipos.store') }}',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log('Tipo salvo: ', response);
                location.reload(); // Recarrega a página para mostrar o novo tipo
            },
            error: function(err) {
                console.error('Erro: ', err);
            }
        });
    });
});
</script>
