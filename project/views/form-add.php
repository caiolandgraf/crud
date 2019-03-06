<?php

use SK\Entities\User;
use SK\Entities\Address;
use SK\Models\User as UserModel;
use SK\Models\Address as AddressModel;

$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// take the form data
//user
$first_name = isset($_POST['first_name']) ? $_POST['first_name'] : null;
$last_name = isset($_POST['last_name']) ? $_POST['last_name'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;
$gender = isset($_POST['gender']) ? $_POST['gender'] : null;
$document = isset($_POST['document']) ? $_POST['document'] : null;
$birthdate = isset($_POST['birthdate']) ? $_POST['birthdate'] : null;

//address
$sql = "SELECT max(id) FROM users";
$result = mysqli_query($link, $sql) or die ("Não deu certo... >" . mysqli_error($link));
$dado = mysqli_fetch_array($result);
$id = $dado[0] + 1;
$street = isset($_POST['street']) ? $_POST['street'] : null;
$number = isset($_POST['number']) ? $_POST['number'] : null;
$complement = isset($_POST['complement']) ? $_POST['complement'] : null;

// validation (very simple, just to avoid empty data)
if (count($_POST)) {
    if (empty($first_name) || empty($last_name) || empty($gender)) {
        echo "Volte e preencha todos os campos";
        exit;
    }
}

if (count($_POST)) {
    if (isCpfValid($document)) {
    } else {
        echo '<div class="card-footer">
                    <a href="/crud/project/form-add" class="btn btn-danger"><i class="fa fa-hand-point-left"></i><br> <b>Favor Informe Um CPF Válido</b><br></a>
                    </div>';
        return;
    }
}


if (count($_POST)) {
    $user = new User($first_name, $last_name, $email, $gender, $document, $birthdate);
    $address = new Address($id, $street, $number, $complement);
    UserModel::Insert($user);
    AddressModel::Insert($address);
    header("Location: /crud/project");
}


?>

<div class="row">
    <div class="col-12">

        <div class="card card-info mt-3">
            <div class="card-header bg-info text-white">
                <div class="d-flex flex-column">
                    <h3 class="d-flex mb-0">Sistema de Cadastro</h3>
                    <p class="d-flex align-items-center m-0 p-0"> Cadastro de Usuário</p>
                </div>
            </div>
            <form method="post">
                <div class="card-body">
                    <div class="row">

                        <div class="form-group col-6">
                            <label for="name">Nome: </label>
                            <input type="text" name="first_name" id="first_name" class="form-control">
                        </div>
                        <div class="form-group col-6">
                            <label for="name">Sobrenome: </label>
                            <input type="text" name="last_name" id="last_name" class="form-control">
                        </div>
                        <div class="form-group col-6">
                            <label for="email">Email: </label>
                            <input type="text" name="email" id="email" class="form-control">
                        </div>
                        <div class="form-group col-6">
                            <label for="email">*CPF: </label>
                            <input type="text" name="document" id="document" class="form-control">
                        </div>

                        <div class="form-group col-6">
                            <label for="birthdate">*Data de Nascimento: </label>
                            <input class="form-control" type="text" name="birthdate" id="birthdate"
                                   placeholder="dd/mm/yy">
                        </div>

                        <div class="form-group col-6">
                            <div for="gender">Gênero:</div>
                            <div class="form-check">
                                <input type="radio" name="gender" id="gener_m" value="m" class="form-check-input">
                                <label for="gener_m" class="form-check-label">Masculino </label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="gender" id="gener_f" value="f" class="form-check-input">
                                <label for="gener_f" class="form-check-label">Feminino </label>
                            </div>
                        </div>

                        <!--ADDRESS-->

                        <div class="form-group col-6">
                            <label for="name">Rua: </label>
                            <input type="text" name="street" id="street" class="form-control">
                        </div>
                        <div class="form-group col-6">
                            <label for="email">Número Do Estabelecimento: </label>
                            <input type="text" name="number" id="number" class="form-control">
                        </div>
                        <div class="form-group col-6">
                            <label for="email">*Complemento: </label>
                            <input type="text" name="complement" id="complement" class="form-control">
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <a href="/crud/project" class="btn btn-danger"><i class="fa fa-hand-point-left"></i> Voltar</a>
                    <span class="float-right">
                        <button type="submit" class="btn btn-success">
                            Cadastrar <i class="fa fa-paper-plane"></i>
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>
