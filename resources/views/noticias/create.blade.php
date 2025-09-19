@include('includes.header')
@include('includes.navbar')

<!-- Modal Adicionar Notícia -->
<div class="modal fade" id="addNoticiaModal" tabindex="-1" role="dialog" aria-labelledby="addNoticiaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="noticia_form" action="#" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addNoticiaLabel">Adicionar Anúncio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label>Tipo</label>
                        <select name="tipo_id" class="form-control" required>
                            <option value="">Selecione um tipo</option>
                            @foreach ($tipos as $tipo)
                                <option value="{{ $tipo->id }}">{{ $tipo->nome }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Nome do Anúncio</label>
                        <input type="text" name="nome" class="form-control" placeholder="Nome do anúncio" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar Anúncio</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNoticiaModal">
                    Adicionar Anúncio
                </button>
            </h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="noticiasTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tipo</th>
                            <th>Nome</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($noticias as $key => $item)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $item->tipo->nome }}</td>
                            <td>{{ $item->nome }}</td>
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
$(document).ready(function() {
    $('#noticia_form').submit(function(event) {
        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: '{{ route('noticias.store') }}',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log('Anúncio salvo: ', response);
                location.reload();
            },
            error: function(err) {
                console.error('Erro: ', err);
            }
        });
    });
});
</script>
