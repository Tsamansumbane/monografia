@include('includes.header')
@include('includes.navbar')

<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Carregar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="monografia_form" action="#" method="POST" enctype="multipart/form-data">
                <input type="hidden" value="{{ csrf_token() }}" name="_token" class="form-control">

                <div class="modal-body">
                    <div class="form-group">
                        <label>Curso</label>
                        <input type="text" name="curso" class="form-control" id="curso" placeholder="Introduz o curso">
                    </div>

                    <div class="form-group">
                        <label>Ficheiro</label>
                        <input type="file" class="form-control" name="choosefile" id="choosefile">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" name="save_monografia" class="btn btn-primary">Registar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
                    Registar monografia
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
                            <th>Ficheiro</th>
                            <th>EDIT</th>
                            <th>DELETE</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($monografias as $key => $item)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $item->curso }}</td>
                            <td>
                                <a href="{{ url($item->ficheiro) }}" target="_blank">Baixar</a>
                            </td>
                            <td>
                                <form action="..." method="post">
                                    <input type="hidden" name="edit_id" value="{{$item->ficheiro}}">
                                    <button type="submit" name="edit_btn" class="btn btn-success">EDITAR</button>
                                </form>
                            </td>
                            <td>
                                <form action="..." method="post">
                                    <button type="submit" name="delete_btn" class="btn btn-danger">APAGAR</button>
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
                    // Fechar modal e limpar formulário
                    $('#monografia_form')[0].reset();
                    $('#addadminprofile').modal('hide');

                    // Adicionar linha na tabela
                    var tableBody = $('#dataTable tbody');
                    var rowCount = tableBody.find('tr').length + 1;

                    var newRow = `
                        <tr>
                            <td>${rowCount}</td>
                            <td>${response.curso}</td>
                            <td><a href="/monografias/${response.file}" target="_blank">Baixar</a></td>
                            <td>
                                <form action="..." method="post">
                                    <input type="hidden" name="edit_id" value="${response.file}">
                                    <button type="submit" name="edit_btn" class="btn btn-success">EDITAR</button>
                                </form>
                            </td>
                            <td>
                                <form action="..." method="post">
                                    <button type="submit" name="delete_btn" class="btn btn-danger">APAGAR</button>
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
