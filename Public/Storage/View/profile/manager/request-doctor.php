<?php

use Core\Application;

use Core\View;
use  Core\Form;

$doctors=Application::$app->database->all('doctors');


/** @var $this View */
$this->title = 'Request Doctors ';
?>
<h1>Request Of Doctors</h1>
<table class="table">
    <thead class="thead-dark">
    <tr>
        <th scope="col">#</th>
        <th scope="col">Firstname</th>
        <th scope="col">Lastname</th>
        <th scope="col">Email</th>
        <th scope="col">Status</th>
        <th scope="col">Accept</th>
        <th scope="col">Decline</th>

    </tr>
    </thead>
    <tbody>

    <?php foreach ($doctors as $key=>$doctor){?>
        <tr>
            <th scope="row"><?= $key+1 ?></th>
            <td><?= $doctor->firstname ?></td>
            <td><?= $doctor->lastname ?></td>
            <td><?= $doctor->email ?></td>
            <td><?= $doctor->is_active==0 ? "Not Active": "Active" ?></td>
            <?php Core\form\Form::begin('profile-manager-request-doctor-accept','post') ?>
            <td>
                <button type="submit" name="accept" value="<?= $doctor->id ?>">
                    Accept
                </button>
            </td>
            <?= Core\form\Form::end() ?>
            <?php Core\form\Form::begin('profile-manager-request-doctor-decline','post') ?>
            <td>
                <button type="submit" name="accept" value="<?= $doctor->id ?>">
                    Decline
                </button>
            </td>
            <?= Core\form\Form::end() ?>


        </tr>
    <?php } ?>
    </tbody>

</table>