<?php
/**
 * Created by PhpStorm.
 * User: rafya
 * Date: 07/08/2018
 * Time: 22:15
 */

if (isset($_SESSION['info'])) {

    ?>

    <div class="alert alert-info">
        <?php print $_SESSION['info'] ?>
    </div>

    <?php
}

unset($_SESSION['info'])

?>