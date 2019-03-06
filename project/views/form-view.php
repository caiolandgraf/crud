<?php

use SK\Entities\User;
use SK\Entities\Address;
use SK\Models\User as UserModel;
use SK\Models\Address as AddressModel;

$user = new User();
//$address = new Address();


// takes the URL ID
$id = getParamUrl(4);
$address_id = $id;

// valid ID
if (empty($id)) {
    echo "ID para válidação não definido";
    exit;
}

if (count($_POST) > 0) {
    try {
        $user = new User;
        $user->setId($id);
        $user->setFirstName($_POST['first_name']);
        $user->setLastName($_POST['last_name']);
        $user->setEmail($_POST['email']);
        $user->setGender($_POST['gender']);
        $user->setDocument($_POST['document']);
        $user->setBirthday($_POST['birthdate']);
        UserModel::Update($user);
        $address = new Address;
        $address->setAddressStreet($_POST['street']);
        $address->setAddressNumber($_POST['number']);
        $address->setAddressComplement($_POST['complement']);
        AddressModel::Update($address);
        header("Location: /crud/project");
    } catch (\Exception $e) {
        echo "<p>Erro ao Visualizar o usuário!</p>";
        exit;
    }
}

$user = UserModel::FindId($id);
$address = AddressModel::AddressByUser($user);

// if the fetch () method does not return an array, then the ID does not correspond to a valid user
if (!is_array($user)) {
    echo "Usuário não encontrado";
    exit;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de cadastro.</title>
    <link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/plugins/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="../vendor/fortawesome/font-awesome/css/all.min.css">
</head>
<body>
<div class="container">

    <div class="row">
        <div class="col-12">

            <div class="card card-info mt-3">
                <div class="card-header bg-info text-white">
                    <h3>Sistema de Cadastro</h3>
                    <h5>Visualização de Usuário</h5>
                </div>
                <form method="post">
                    <div class="card-body">
                        <div class="row">

                            <div class="form-group col-6">
                                <label for="name">Nome: </label>
                                <input type="text" name="first_name" id="first_name" class="form-control"
                                       value="<?php echo $user['first_name']; ?>" disabled>
                            </div>
                            <div class="form-group col-6">
                                <label for="name">Sobrenome: </label>
                                <input type="text" name="last_name" id="last_name" class="form-control"
                                       value="<?php echo $user['last_name']; ?>" disabled>
                            </div>
                            <div class="form-group col-6">
                                <label for="email">*Email: </label>
                                <input type="text" name="email" id="email" class="form-control"
                                       value="<?php echo $user['email']; ?>" disabled>
                            </div>

                            <div class="form-group col-6">
                                <label for="birthdate">*Data de Nascimento: </label>
                                <input type="text" name="birthdate" id="birthdate" placeholder="dd/mm/yyyy"
                                       value="<?php echo dateConvert($user['birthdate']); ?>" class="form-control"
                                       disabled>
                            </div>

                            <div class="form-group col-6">
                                <p>Gênero:</p>
                                <div class="form-check">
                                    <input type="radio" name="gender" id="gener_m" class="form-check-input"
                                           value="m" <?php if ($user['gender'] == 'm'): ?> checked="checked" <?php endif; ?>
                                           disabled>
                                    <label class="form-check-label" for="gener_m">Masculino </label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" name="gender" id="gener_f" class="form-check-input"
                                           value="f" <?php if ($user['gender'] == 'f'): ?> checked="checked" <?php endif; ?>
                                           disabled>
                                    <label class="form-check-label" for="gener_f">Feminino </label>
                                </div>
                            </div>

                            <div class="form-group col-6">
                                <label for="name">*CPF: </label>
                                <input type="text" name="document" id="document" class="form-control"
                                       value="<?php echo $user['document']; ?>" disabled>
                            </div>

                            <input type="hidden" name="id" value="<?php echo $id ?>">


                            <!--ADDRESS-->

                            <div class="form-group col-6">
                                <label for="name">Rua: </label>
                                <input type="text" name="street" id="street" class="form-control"
                                       value="<?php echo $address['street']; ?>" disabled>
                            </div>
                            <div class="form-group col-6">
                                <label for="email">Número Do Estabelecimento: </label>
                                <input type="text" name="number" id="number" class="form-control"
                                       value="<?php echo $address['number']; ?>" disabled>
                            </div>
                            <div class="form-group col-6">
                                <label for="email">*Complemento: </label>
                                <input type="text" name="complement" id="complement" class="form-control"
                                       value="<?php echo $address['complement']; ?>" disabled>
                            </div>
                        </div>


                    </div>
            </div>
            <div class="card-footer">
                <a href="/crud/project" class="btn btn-danger"><i class="fa fa-hand-point-left"></i> Voltar</a>
            </div>
            </form>
        </div>
    </div>
