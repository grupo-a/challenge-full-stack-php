@extends('layouts.default')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="col text-center">
                    <button class="btn btn-default" onclick="openCreateStudentModal()">Adicionar Aluno</button>
                </div>
                <table class="table table-striped" id="students_table">
                    <thead></thead>
                    <tbody></tbody>
                </table>
            </div>
            <div class="modal fade" tabindex="-1" role="dialog" id="edit_student_form" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Editar Aluno</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="student_edit" action="javascript:void(0);" onsubmit="editStudent()" method="PUT">
                            <div class="modal-body">
                                @csrf
                                <input type="hidden" id="student_edit_id" name="student_edit_id" value="">
                                <div class="form-group">
                                    <label>Nome: </label>
                                    <input name="name" id="student_name" class="form-control" placeholder="Nome" required>
                                </div>
                                <div class="form-group">
                                    <label>E-mail: </label>
                                    <input name="email" id="student_email" type="text" class="form-control" placeholder="E-mail" required>
                                </div>
                                <div class="form-group">
                                    <label>RA: </label>
                                    <input type="text" id="student_ra" class="form-control" placeholder="RA" disabled>
                                </div>
                                <div class="form-group">
                                    <label>CPF: </label>
                                    <input type="text" id="student_cpf" class="form-control" placeholder="RA" disabled>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Salvar</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" tabindex="-1" role="dialog" id="create_student_form" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Criar Aluno</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="student_create" action="javascript:void(0);" onsubmit="createStudent()" method="POST">
                            <div class="modal-body">
                                @csrf
                                <div class="form-group">
                                    <label>Nome: </label>
                                    <input name="name" class="form-control" placeholder="Nome" required>
                                </div>
                                <div class="form-group">
                                    <label>E-mail: </label>
                                    <input name="email" type="text" class="form-control" placeholder="E-mail" required>
                                </div>
                                <div class="form-group">
                                    <label>RA: </label>
                                    <input name="ra" class="form-control" placeholder="RA" required>
                                </div>
                                <div class="form-group">
                                    <label>CPF: </label>
                                    <input name="cpf" class="form-control cpf" placeholder="CPF" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Salvar</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="resetCreateForm()">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.cpf').mask('000.000.000-00', {reverse: true});
            initTableStudents.init();
        });

        const initTableStudents = function () {
            const initTable = () => {
                const table = $('#students_table');
                table.dataTable({
                    responsive: true,
                    autoWidth: false,
                    paging: true,
                    searching: true,
                    processing: false,
                    serverSide: false,
                    stateSave: true,
                    ordering: true,
                    async: true,
                    ajax: {
                        url: 'http://localhost/challenge-full-stack-php/public/api/v1/students',
                        dataType: 'JSON',
                        type: 'GET',
                        beforeSend: (xhr) => {
                            xhr.setRequestHeader('Authorization', 'Bearer kP6g4NQ7wkxXo31xqzjJ1lmoc71RnZNEu8XZSTzjU2bVmuqdWRo2gzUsI1dI');
                        },
                        dataSrc: (response) => {
                            return response;
                        }
                    },
                    columns: [
                        {data: 'RA'},
                        {data: 'Nome'},
                        {data: 'CPF'},
                        {data: 'Ações'},
                    ],
                    columnDefs: [
                        {
                            targets: 0,
                            title: 'RA',
                            render: function (data, type, full, meta) {
                                return full.ra;
                            }
                        },
                        {
                            targets: 1,
                            title: 'Nome',
                            render: function (data, type, full, meta) {
                                return full.name;
                            }
                        },
                        {
                            targets: 2,
                            title: 'CPF',
                            render: function (data, type, full, meta) {
                                return full.cpf;
                            }
                        },
                        {
                            targets: 3,
                            title: 'Ações',
                            render: function (data, type, full, meta) {
                                return `
                                    <button onClick="openEditStudentModal(${full.id})">Editar</button>
                                    <button onClick="openDeleteStudentConfirmation(${full.id})">Excluir</button>
                                `;
                            }
                        }
                    ]
                })
            }

            const reloadTable = () => {
                $('#students_table').DataTable().ajax.reload(null, false);
            }

            return {
                init: () => {
                    initTable();
                },
                reload: () => {
                    reloadTable();
                }
            }
        }();

        function openCreateStudentModal() {
            $('#create_student_form').modal('show');
        }

        function openEditStudentModal(id) {
            $.ajax({
                url: 'http://localhost/challenge-full-stack-php/public/api/v1/students/' + id,
                type: 'GET',
                data: $('#student_create').serialize(),
                beforeSend: (xhr) => {
                    xhr.setRequestHeader('Authorization', 'Bearer kP6g4NQ7wkxXo31xqzjJ1lmoc71RnZNEu8XZSTzjU2bVmuqdWRo2gzUsI1dI');
                },
                success: function (data) {
                    $('#student_edit_id').val(id);
                    $('#student_name').val(data.name);
                    $('#student_email').val(data.email);
                    $('#student_ra').val(data.ra);
                    $('#student_cpf').val(data.cpf);
                    $('#edit_student_form').modal('show');
                },
                error: function (xhr, status, error) {
                    Swal.fire('Oops...', 'Ocorreu algum erro ao buscar as informações desse aluno, tente novamente.', 'error')
                },
            });
        }

        function openDeleteStudentConfirmation(id) {
            Swal.fire({
                title: "Você tem certeza?",
                text: "O aluno será excluido permanentemente!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Sim",
                cancelButtonText: "Cancelar",
                closeOnConfirm: false
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: 'http://localhost/challenge-full-stack-php/public/api/v1/students/' + id,
                        type: 'DELETE',
                        data: $('#student_edit').serialize(),
                        beforeSend: (xhr) => {
                            xhr.setRequestHeader('Authorization', 'Bearer kP6g4NQ7wkxXo31xqzjJ1lmoc71RnZNEu8XZSTzjU2bVmuqdWRo2gzUsI1dI');
                        },
                        success: function (data) {
                            Swal.fire('Sucesso', 'Aluno deletado com sucesso.', 'success');
                            initTableStudents.reload();
                        },
                        error: function (xhr, status, error) {
                            Swal.fire('Oops...', 'Ocorreu algum erro na exclusão do usuário, tente novamente.', 'error')
                        },
                    });
                }
            });
        }

        function editStudent() {
            $.ajax({
                url: 'http://localhost/challenge-full-stack-php/public/api/v1/students/' + $('#student_edit_id').val(),
                type: 'PUT',
                data: $('#student_edit').serialize(),
                beforeSend: (xhr) => {
                    xhr.setRequestHeader('Authorization', 'Bearer kP6g4NQ7wkxXo31xqzjJ1lmoc71RnZNEu8XZSTzjU2bVmuqdWRo2gzUsI1dI');
                },
                success: function (data) {
                    Swal.fire('Sucesso!', 'Aluno editado com successo!', 'success');
                    $('#edit_student_form').modal('hide');
                    initTableStudents.reload();
                },
                error: function (xhr, status, error) {
                    Swal.fire('Oops...', 'Ocorreu algum erro na edição do usuário, tente novamente.', 'error')
                },
            });
        }

        function createStudent() {
            $.ajax({
                url: 'http://localhost/challenge-full-stack-php/public/api/v1/students',
                type: 'POST',
                data: $('#student_create').serialize(),
                beforeSend: (xhr) => {
                    xhr.setRequestHeader('Authorization', 'Bearer kP6g4NQ7wkxXo31xqzjJ1lmoc71RnZNEu8XZSTzjU2bVmuqdWRo2gzUsI1dI');
                },
                success: function (data) {
                    Swal.fire('Sucesso!', 'Aluno cadastrado com successo!', 'success');
                    resetCreateForm();
                    $('#create_student_form').modal('hide');
                    initTableStudents.reload();
                },
                error: function (xhr, status, error) {
                    Swal.fire('Oops...', 'Ocorreu algum erro no cadastro do usuário, tente novamente.', 'error')
                },
            });
        }

        function resetCreateForm() {
            $('#student_create').trigger("reset");
        }
    </script>
@endsection
