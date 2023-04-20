<?php
get_header();

while (have_posts()) {
    the_post();

    the_content();
} ?>

<div class="container">
    <h1>h1</h1>
    <h2>h2</h2>
    <h3>h3</h3>
    <h4>h4</h4>
    <h5>h5</h5>
    <h6>h6</h6>

    <p>test p</p>

    <div class="row">
        <div class="col col-3" style="height: 200px; background-color: red;"></div>
        <div class="col col-3" style="height: 200px; background-color: red;"></div>
        <div class="col col-3" style="height: 200px; background-color: red;"></div>
        <div class="col col-3" style="height: 200px; background-color: red;"></div>
        <div class="col col-3" style="height: 200px; background-color: red;"></div>
        <div class="col col-3" style="height: 200px; background-color: red;"></div>
    </div>

    <a href="#" class="btn">PROJECTS</a>
    <a href="#" class="btn btn--small">PROJECTS</a>
    <a href="#" class="btn btn--transparent">PROJECTS</a>
    <a href="#" class="btn btn--transparent btn--small">PROJECTS</a>
    <a href="#" class="tab-btn">PROJECTS</a>
    <a href="#" class="tab-btn tab-btn--active">PROJECTS</a>
    <a href="#" class="tab-btn tab-btn--thin">PROJECTS</a>
    <a href="#" class="tab-btn tab-btn--active tab-btn--thin">PROJECTS</a>
    <a href="#" class="btn btn--thin">PROJECTS</a>
    <a href="#" class="btn btn--small btn--thin">PROJECTS</a>
    <a href="#" class="tab-btn tab-btn--small">PROJECTS</a>
    <a href="#" class="tab-btn tab-btn--active tab-btn--small">PROJECTS</a>
    <a href="#" class="tab-btn tab-btn--popup">PROJECTS</a>
    
    <?= do_shortcode('[contact-form-7 id="17" title="Contact form 1"]'); ?>
</div>
<!-- /.container -->



<?php get_footer();