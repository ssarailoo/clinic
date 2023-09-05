<?php

use Core\Application;

use Core\View;

/** @var $this View */
$this->title = 'Login';
?>
<h1>Contact Us</h1>
<form action="" method="post">
    <div class="mb-3">
        <label>Email</label>
        <input type="text" name="email" class="form-control">
    </div>
    <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control">
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>