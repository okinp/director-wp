<?php
/**
 * This is the default template file for indexes (list of blog/news posts)
 */

$index_page_title = get_the_title(get_option('page_for_posts', true));
get_header();
?>

<?php

$intro = get_page_by_title('Intro', OBJECT, 'page');
if ($intro) {
    $translatedId = apply_filters('wpml_object_id', $intro->ID, 'page');
    $intro = get_post($translatedId);
    ?>
<section class="intro">
  <div class="content">
    <span class="icon-x close-expanded-video"></span>
    <img src="<?php echo get_the_post_thumbnail_url($intro->ID); ?>">
    <div class="video-text-scroll">
      <?php echo $intro->post_content; ?>
      <p>
        <?php echo trim($intro->post_excerpt); ?>
      </p>
    </div>
  </div>
  <div class="bottom-bar bar">
    <a class="expand">
      <i class="icon-expand"></i>
    </a>
    <a class="scroll-down">
      scroll down
    </a>
  </div>
</section>
<?php }?>
<section class="portfolio">
  <div class="portfolio__slider">
    <div class="portfolio__track swiper-wrapper">
<?php
$featured_projects = get_featured_projects();
foreach ($featured_projects as $project) {
    ?>
        <div class="portfolio__item swiper-slide">
          <div class="project-card-container">
            <div class="project-card">
              <span data-src="<?php echo $project['image']; ?>" data-width=1050 data-height=590></span>
            </div>
            <a href="<?php echo $project['guid']; ?>">
              <h4><span><?php echo $project['title']; ?></span></h4>
              <div class="client">
                <span ><?php echo $project['customer'] . ', ' . $project['year'] ?></span>
              </div>
            </a>
          </div>
        </div>
<?php }?>
    </div>
  </div>
  <div class="counter">
    <span class="counter__start">01</span>
    <span class="counter__track"></span>
    <span class="counter__stop">07</span>
  </div>
</section>
<?php
$about = get_page_by_title('About', OBJECT, 'page');
if ($about) {
    $translatedId = apply_filters('wpml_object_id', $about->ID, 'page');
    $about = get_post($translatedId);
    ?>
  <section class="about">
    <div class="content">
      <img src="<?php echo get_the_post_thumbnail_url($about->ID); ?>">
      <div class="about__text">
        <p class="is-huge">CV</p>
        <p class="about__text__content">
          <?php

    $content = $about->post_content;
    $splitMoreTag = explode("<!--more-->", $content);
    echo $splitMoreTag[0];?>
            <span><?php echo $splitMoreTag[1]; ?></span>
        </p>
      </div>
    </div>
    <a href="#" class="more"><span class="icon-arrow-right"></span><span class="more__label">Read more</span></a>
  </section>
<?php }?>
<?php
$categories = get_project_categories_sorted();
if (count($categories) != 0) {
    ?>
  <section class="services">
    <div class="content">
      <ul>
        <?php foreach ($categories as $category) {?>
            <li>
              <a href="#"><?php echo $category['name'] ?></a>
              <img src="<?php echo $category['featured_image'] ?>">
            </li>
        <?php }
    ;?>
      </ul>
    </div>
    <a href="#" class="more"><span class="icon-arrow-right"></span><span class="more__label">View all
        portfolio</span></a>
  </section>
<?php }?>
<?php get_footer();?>