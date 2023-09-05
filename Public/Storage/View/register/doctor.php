<?php
use Core\Application;

use Core\View;
/** @var $this View */
$this->title='Register Doctor';
?>
<h1>Registration</h1>
<?php


use Core\Form\Form;
use Models\Doctor;

/** @var  Doctor $model*/

$form = Form::begin('', 'post');
?>
<div class="row">
    <div class="col">
        <?php echo $form->field($model, 'firstname') ?>
    </div>
    <div class="col">
        <?php echo $form->field($model, 'lastname') ?>
    </div>
</div>
<?php echo $form->field($model, 'email') ?>

<?php echo $form->field($model, 'password')->passwordField() ?>
<?php echo $form->field($model, 'confirmPassword')->passwordField() ?>
<button type="submit" name="submit" class="btn btn-primary">Submit</button>

<?= Form::end(); ?>
