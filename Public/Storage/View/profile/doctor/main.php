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


<?php if (Application::$app->user->is_active==1) { ?>
    <section style="background-color: #eee;">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="<?= Application::$app->user->profile_pic ?>"
                                 alt="avatar"
                                 class="rounded-circle img-fluid" style="width: 150px;">
                            <h5 class="my-3"><?= ucfirst(Application::$app->user->firstname) . ' ' . ucfirst(Application::$app->user->lastname) ?></h5>
                            <p class="text-muted mb-1">Section <?= $sectionName ?></p>
                            <p class="text-muted mb-4"><?= Application::$app->user->address ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Full Name</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?= Application::$app->user->firstname . ' ' . Application::$app->user->lastname ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?= Application::$app->user->email ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Education</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?= Application::$app->user->education ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Section</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?= $sectionName ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Address</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"> <?= Application::$app->user->address ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } else {
    ?>

    <h3>
        Your account is not activated
    </h3>

<?php } ?>
