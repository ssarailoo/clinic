<?php

use Core\Application;

use Core\Form\Form;
use Core\View;
use Models\Doctor;
use Models\Manager;


/** @var $model Manager */

/** @var $this View */
$this->title = 'Profile Manager';
?>
    <h1>Profile Manager</h1>


<?php if (Application::$app->user->is_active==1) { ?>
    <section style="background-color: #eee;">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <h5 class="my-3"><?= ucfirst(Application::$app->user->firstname) . ' ' . ucfirst(Application::$app->user->lastname) ?></h5>
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
