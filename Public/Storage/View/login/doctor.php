<?php
use Core\Application;

use Core\View;
/** @var $this View */
$this->title='Login Doctor';
use Core\Form\Form;
    use Models\LoginForm;

    /** @var  LoginForm $model*/
    $form = Form::begin('', 'post');
?>
<h1>Login</h1>

<?php echo $form->field($model, 'email') ?>

<?php echo $form->field($model, 'password')->passwordField() ?>

<button type="submit" name="submit" class="btn btn-primary">Submit</button>

<?= Form::end(); ?>
