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
                        <input type="text" name="minor1" class="form-control" placeholder="Minor 1" required>
                    </div>

                    <div class="form-group">
                        <label>Minor 2</label>
                        <input type="text" name="minor2" class="form-control" placeholder="Minor 2" required>
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
                            <th>Minors</th>
                            <th>EDIT</th>
                            <th>DELETE</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cursos as $key => $curso)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $curso->nome }}</td>
                            <td>
                                @foreach($curso->minores as $minor)
                                    {{ $minor->nome }}@if(!$loop->last), @endif
                                @endforeach
                            </td>
                            <td>
                                <button 
                                    class="btn btn-success edit-curso-btn" 
                                    data-id="{{ $curso->id }}" 
                                    data-nome="{{ $curso->nome }}" 
                                    data-minor1="{{ $curso->minores[0]->nome ?? '' }}" 
                                    data-minor2="{{ $curso->minores[1]->nome ?? '' }}"
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
