<?php
use Core\Application;
use Core\Form\Form;
use Core\View;
use Models\Section;
/** @var $this View */
/** @var $model Section */
$sections=Application::$app->database->all('sections');

$this->title = 'Section Panel ';
?>
<h1>Section Panel</h1>
<?php $form = Form::begin('profile-manager-section-panel-create', 'post'); ?>
<?= $form->field($model, 'name'); ?>
<button name="create">Create</button>
<?= $form::end() ?>
<hr>
<table class="table">
    <thead class="thead-dark">
    <tr>
        <th scope="col">#</th>
        <th scope="col">Section Name</th>
        <th scope="col">Delete</th>
        <th scope="col">Edit</th>
    </tr>
    </thead>
    <tbody>

    <?php foreach ($sections as $key=>$section){?>
    <tr>
        <th scope="row"><?= $key+1 ?></th>
        <td><?= $section->name ?></td>
        <?php Form::begin('/profile-manager-section-panel-delete','post')?>
        <td>
            <button type="submit" name="delete" value="<?= $section->id ?>">
                Delete
            </button>

        </td>
        <?= Form::end() ?>
        <?php Form::begin('/profile-manager-section-panel-edit','post')?>
        <td>
            <input type="text" name="name">
            <button type="submit" name="edit" value="<?= $section->id ?>">
               Edit
            </button>
        </td>
        <?= Form::end() ?>
    </tr>
    <?php } ?>
    </tbody>

</table>

