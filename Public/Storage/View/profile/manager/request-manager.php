<?php
use Core\Application;

use Core\View;
use  Core\Form;

$managers=Application::$app->database->all('managers');


/** @var $this View */
$this->title = 'Request Managers ';
?>
<h1>Request Of Managers</h1>
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

    <?php foreach ($managers as $key=>$manager){?>
        <tr>
            <th scope="row"><?= $key+1 ?></th>
            <td><?= $manager->firstname ?></td>
            <td><?= $manager->lastname ?></td>
            <td><?= $manager->email ?></td>
            <td><?= $manager->is_active==0 ? "Not Active": "Active" ?></td>
            <?php Core\form\Form::begin('profile-manager-request-manager-accept','post') ?>
            <td>
                <button type="submit" name="accept" value="<?= $manager->id ?>">
                    Accept
                </button>
            </td>
            <?= Core\form\Form::end() ?>
            <?php Core\form\Form::begin('profile-manager-request-manager-decline','post') ?>
            <td>
                <button type="submit" name="accept" value="<?= $manager->id ?>">
                    Decline
                </button>
            </td>
            <?= Core\form\Form::end() ?>


        </tr>
    <?php } ?>
    </tbody>

</table>