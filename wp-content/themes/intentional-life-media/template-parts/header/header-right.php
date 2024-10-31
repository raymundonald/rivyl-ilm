<?php
$SVG = new SVG;
?>
<div class="col-auto">
    <div class="header-icons d-flex align-items-center">
        <a class="d-none d-lg-block" href=""><?= $SVG->search() ?></a>
        <a class="d-none d-lg-block" href=""><?= $SVG->cart() ?></a>
        <a class="d-none d-lg-block" href=""><?= $SVG->bookmark() ?></a>
        <a href=""><?= $SVG->user() ?></a>
        <button class="menu-burger" type="button" data-bs-toggle="offcanvas" data-bs-target="#sideOutMenu" aria-controls="sideOutMenu">
            <div class="icon">
                <div class="menu"></div>
            </div>
        </button>
    </div>
</div>