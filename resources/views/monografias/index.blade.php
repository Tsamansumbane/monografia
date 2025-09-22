@include('includes.header')
@include('includes.navbar')

<!-- Modal Adicionar Monografia -->
<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Carregar Monografia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="monografia_form" action="#" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <!-- Curso -->
                    <div class="form-group">
                        <label>Curso</label>
                        <select name="curso_id" id="curso_id" class="form-control" required>
                            <option value="">Selecione um curso</option>
                            @foreach($cursos as $curso)
                                <option value="{{ $curso->id }}">{{ $curso->nome }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Minor dependente -->
                    <div class="form-group">
                        <label>Minor</label>
                        <select name="minor_id" id="minor_id" class="form-control" required>
                            <option value="">Selecione primeiro o curso</option>
                        </select>
                    </div>

                    <!-- Ficheiro -->
                    <div class="form-group">
                        <label>Ficheiro</label>
                        <input type="file" class="form-control" name="choosefile" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Registar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Tabela Monografias -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
                    Registar Monografia
                </button>
            </h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Curso</th>
                            <th>Minor</th>
                            <th>Ficheiro</th>
                            <th>EDIT</th>
                            <th>DELETE</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($monografias as $key => $item)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $item->curso->nome ?? '' }}</td>
                            <td>{{ $item->minor->nome ?? '' }}</td>
                            <td><a href="{{ url($item->ficheiro) }}" target="_blank">Baixar</a></td>
                            <td>
                                <form action="#" method="post">
                                    <input type="hidden" name="edit_id" value="{{ $item->id }}">
                                    <button type="submit" class="btn btn-success">EDITAR</button>
                                </form>
                            </td>
                            <td>
                                <form action="#" method="post">
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
$(document).ready(function() {

    // Carregar minors ao selecionar curso
    $('#curso_id').change(function() {
        var cursoId = $(this).val();
        if(cursoId) {
            $.ajax({
                url: '/monografias/minors/' + cursoId,
                type: 'GET',
                success: function(minors) {
                    var options = '<option value="">Selecione um minor</option>';
                    minors.forEach(function(minor){
                        options += `<option value="${minor.id}">${minor.nome}</option>`;
                    });
                    $('#minor_id').html(options);
                }
            });
        } else {
            $('#minor_id').html('<option value="">Selecione primeiro o curso</option>');
        }
    });

    // Submeter monografia
    $('#monografia_form').submit(function(event) {
        event.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            url: '{{ route('monografias.store') }}',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if(response.status) {
                    $('#monografia_form')[0].reset();
                    $('#addadminprofile').modal('hide');

                    // Adicionar nova linha na tabela
                    var tableBody = $('#dataTable tbody');
                    var rowCount = tableBody.find('tr').length + 1;
                    var newRow = `
                        <tr>
                            <td>${rowCount}</td>
                            <td>${response.monografia.curso.nome}</td>
                            <td>${response.monografia.minor.nome}</td>
                            <td><a href="${response.monografia.ficheiro}" target="_blank">Baixar</a></td>
                            <td>
                                <form action="#" method="post">
                                    <input type="hidden" name="edit_id" value="${response.monografia.id}">
                                    <button type="submit" class="btn btn-success">EDITAR</button>
                                </form>
                            </td>
                            <td>
                                <form action="#" method="post">
                                    <button type="submit" class="btn btn-danger">APAGAR</button>
                                </form>
                            </td>
                        </tr>
                    `;
                    tableBody.append(newRow);

                    alert(response.message);
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                alert('Ocorreu um erro: ' + error);
            }
        });
    });
});
</script>
