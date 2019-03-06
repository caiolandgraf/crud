<?php

use SK\Models\User;

$users = User::getAll();

?>

<div class="row mt-3">
    <div class="col-12">
        <div class="card card-info">
            <div class="card-header bg-info text-white">
                <div class="d-flex flex-column">
                    <h3 class="d-flex mb-0">Sistema de Cadastro</h3>
                    <p class="d-flex align-items-center m-0 p-0">Painel De Controle</p>
                </div>
                <span class="align-text-bottom">
                    <a class="btn btn-light float-right" href="form-add">Adicionar Usuário</a>
                </span>
            </div>

            <div class="card-body">

                <h3>Lista de Usuários</h3>

                <p>Total de usuários: <b><?php echo count($users) ?></b></p>

                <?php if (count($users) > 0): ?>

                    <table width="50%" class="table table-striped table-hover">
                        <thead class="bg-info text-white">
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Idade</th>
                            <th style="width: 120px;">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><a href="/crud/project/form-view/<?php echo $user['id'] ?>" class="username"><?php echo $user['first_name'] . ' ' . $user['last_name'] ?></a></td>
                                <td><?php echo $user['email'] ?></td>
                                <td><?php if (dateConvert($user['birthdate']) == 0000-00-00) {
                                        echo "Não Foi Possível Calcular a Idade";
                                    } else {
                                        echo calculateAge($user['birthdate']);
                                    } ?></td>
                                <td>
                                    <a href="form-edit/<?php echo $user['id'] ?>"
                                       class="btn btn-warning">
                                        <i class="fa fa-pen"></i>
                                    </a>
                                    <?php
                                    if (dateConvert($user['birthdate']) == 0000-00-00) {
                                        echo '';
                                    }
                                    ?>
                                    <a href="delete/<?php echo $user['id'] ?>"
                                       onclick="return confirm('Tem certeza de que deseja remover?');"
                                       class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>

                <?php else: ?>

                    <p>Nenhum usuário registrado</p>

                <?php endif; ?>


            </div>
        </div>
    </div>
