@include('includes.header')
@include('includes.navbar')

<!-- Modal Adicionar Curso -->
<div class="modal fade" id="addCursoModal" tabindex="-1" role="dialog" aria-labelledby="addCursoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="curso_form" action="#" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addCursoLabel">Adicionar Curso</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label>Nome do Curso</label>
                        <input type="text" name="nome" class="form-control" placeholder="Introduz o nome do curso" required>
                    </div>
                    <div class="form-group">
                        <label>Minor 1</label>
                        <input type="text" name="minor1" class="form-control" placeholder="Minor 1 (opcional)">
                    </div>
                    <div class="form-group">
                        <label>Minor 2</label>
                        <input type="text" name="minor2" class="form-control" placeholder="Minor 2 (opcional)">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar Curso</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCursoModal">
                    Adicionar Curso
                </button>
            </h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Minor 1</th>
                            <th>Minor 2</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cursos as $key => $curso)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $curso->nome }}</td>
                            <td>{{ $curso->minor1 }}</td>
                            <td>{{ $curso->minor2 }}</td>
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
    $('#curso_form').submit(function(event) {
        event.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            url: '{{ route('cursos.store') }}',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log('Curso salvo: ', response);
                location.reload();
            },
            error: function(err) {
                console.error('Erro: ', err);
            }
        });
    });
});
</script>
