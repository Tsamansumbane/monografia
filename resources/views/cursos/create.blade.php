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
                        <input type="text" name="nome" class="form-control" placeholder="Nome do curso" required>
                    </div>

                    <div class="form-group">
                        <label>Minor 1</label>
                        <input type="text" name="minor1" class="form-control" placeholder="Minor 1">
                    </div>

                    <div class="form-group">
                        <label>Minor 2</label>
                        <input type="text" name="minor2" class="form-control" placeholder="Minor 2">
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

<!-- Modal Editar Curso -->
<div class="modal fade" id="editCursoModal" tabindex="-1" role="dialog" aria-labelledby="editCursoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="edit_curso_form" action="#" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="curso_id" id="edit_curso_id">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCursoLabel">Editar Curso</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label>Nome do Curso</label>
                        <input type="text" name="nome" id="edit_nome" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Minor 1</label>
                        <input type="text" name="minor1" id="edit_minor1" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Minor 2</label>
                        <input type="text" name="minor2" id="edit_minor2" class="form-control">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Atualizar Curso</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container-fluid">
    <!-- Card Tabela Cursos -->
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
                <table class="table table-bordered" id="cursosTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Minor 1</th>
                            <th>Minor 2</th>
                            <th>EDIT</th>
                            <th>DELETE</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cursos as $key => $curso)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $curso->nome }}</td>
                            <td>{{ $curso->minor1 }}</td>
                            <td>{{ $curso->minor2 }}</td>
                            <td>
                                <button 
                                    class="btn btn-success edit-curso-btn" 
                                    data-id="{{ $curso->id }}" 
                                    data-nome="{{ $curso->nome }}" 
                                    data-minor1="{{ $curso->minor1 }}" 
                                    data-minor2="{{ $curso->minor2 }}"
                                    data-toggle="modal" 
                                    data-target="#editCursoModal">
                                    EDITAR
                                </button>
                            </td>
                            <td>
                                <button class="btn btn-danger delete-curso-btn" data-id="{{ $curso->id }}">APAGAR</button>
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
$(document).ready(function() {

    // Adicionar Curso
    $('#curso_form').submit(function(event) {
        event.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: '{{ route("cursos.store") }}',
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

    // Preencher modal de edição
    $('.edit-curso-btn').click(function() {
        $('#edit_curso_id').val($(this).data('id'));
        $('#edit_nome').val($(this).data('nome'));
        $('#edit_minor1').val($(this).data('minor1'));
        $('#edit_minor2').val($(this).data('minor2'));
    });

    // Atualizar Curso
    $('#edit_curso_form').submit(function(event) {
        event.preventDefault();

        var id = $('#edit_curso_id').val();
        var formData = new FormData();
        formData.append('nome', $('#edit_nome').val());
        formData.append('minor1', $('#edit_minor1').val());
        formData.append('minor2', $('#edit_minor2').val());
        formData.append('_token', "{{ csrf_token() }}");
        formData.append('_method', 'PUT');

        $.ajax({
            url: '/cursos/' + id,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log('Curso atualizado: ', response);
                location.reload();
            },
            error: function(err) {
                console.error('Erro: ', err);
            }
        });
    });

    // Deletar Curso
    $('.delete-curso-btn').click(function() {
        if(!confirm('Tem certeza que deseja apagar este curso?')) return;
        var id = $(this).data('id');
        $.ajax({
            url: '/cursos/' + id,
            type: 'POST',
            data: {_method: 'DELETE', _token: "{{ csrf_token() }}"},
            success: function(response) {
                console.log('Curso deletado: ', response);
                location.reload();
            },
            error: function(err) {
                console.error('Erro: ', err);
            }
        });
    });

});
</script>
