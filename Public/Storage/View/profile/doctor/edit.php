<?php

use Core\Application;

use Core\Form\Form;
use Core\View;
use Models\Doctor;

$sectionName = Application::$app->database->select('sections', ['column' => 'id', 'operation' => '=', 'value' => Application::$app->user->section_id], 'name');


$sections = Application::$app->database->all('sections', '*');


/** @var $model Doctor */

/** @var $this View */
$this->title = 'Profile Doctor';
?>
    <h1>Profile Doctor</h1>




<?php if (Application::isAccActivated()) { ?>
    <?php $form = Form::begin("", "post"); ?>

    <?= $form->field($model, 'education'); ?>
    <?= $form->field($model, 'medical_code'); ?>
    <?= $form->field($model, 'address'); ?>
    <?= $form->field($model, "section_id")->selectOptions($sections, 'id', 'name') ?>
    <?= $form->field($model, "profile_pic")->fileField() ?>
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    <?= $form::end() ?>
<?php } else {
    ?>

    <h3>
        Your account is not activated
    </h3>

<?php } ?>