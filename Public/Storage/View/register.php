<?php
use Core\Application;

use Core\View;
/** @var $this View */
$this->title='Register';
?>
<h1>Contact Us</h1>
<?php

use core\form\InputField;
use core\form\Form;

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

<?php echo $form->field($model, 'password') ?>
<?php echo $form->field($model, 'confirmPassword') ?>
<button type="submit" name="submit" class="btn btn-primary">Submit</button>

<?php Form::end(); ?>
