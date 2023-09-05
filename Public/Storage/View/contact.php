<?php

use Core\Form\Form;
use Core\Form\TextAreaField;
use Core\View;
use Models\ContactForm;

/** @var $this View */
/** @var $model ContactForm */

$this->title = 'Contact';

?>
    <h1>Contact Us</h1>

<?php $form = Form::begin('', 'post') ?>
<?= $form->field($model, 'subject'); ?>
<?= $form->field($model, 'email'); ?>
<?= new TextAreaField($model, 'body') ?>

    <button type="submit" name="submit" class="btn btn-primary">Submit</button>

<?= $form::end() ?>