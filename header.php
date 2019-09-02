<!DOCTYPE html>
<!--[if lte IE 11]><html <?php language_attributes();?> class="no-js lte-ie11"> <![endif]-->
<!--[if gte IE 11]><!--><html <?php language_attributes();?> class="no-js"><!--<![endif]-->
<head>
<meta charset="<?php bloginfo('charset');?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="cleartype" content="on">
<title><?php bloginfo('name');?></title>
<?php wp_head();?>
</head>
<body>
  <header class="bar">
    <img class="logo" src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.svg" />
    <div class="header__tools">
    <?php
//Language Switcher - Shows next language
$languages = apply_filters('wpml_active_languages', null, 'orderby=id&order=desc');

if (!empty($languages)) {
    $numLanguages = sizeof($languages);
    $foundIndex = -1;
    foreach ($languages as $l) {
        $foundIndex += 1;
        if ($l['active']) {
            break;
        }
    }
    $nextIndex = $foundIndex + 1;
    $nextIndex = $nextIndex % $numLanguages;
    $nextLanguage = array_values($languages)[$nextIndex];
    echo '<a href="' . $nextLanguage['url'] . '" class="language-switcher">' . $nextLanguage['language_code'] . '</a>';
}
?>
      <div class="burger-button" for="burger">
        <span></span>
        <span></span>
        <span></span>
        <span class="close">close</span>
      </div>
    </div>
    <nav>
      <ul class="navlist">
        <?php

$menuItems = get_kommi_menu();

foreach ($menuItems as $navItem) {
    $children = $navItem['children'];
    echo '<li class="navlist__item">
                  <a class="navlist__item__content" href="' . $navItem['url'] . '" title="' . $navItem['title'] . '">' . $navItem['title'] . '</a>';
    if (!empty($children)) {
        echo '<ul>';
        foreach ($children as $child) {
            echo '<li>
                      <a href="' . $child['url'] . '" title="' . $child['title'] . '">' . $child['title'] . '</a>
                    </li>';
        }
        echo '</ul>';
    }
}?>
      </ul>
      <ul class="nav__terms">
        <li>
          <a href="#">terms & conditions</a>
        </li>
        <li>
          <a href="#">privacy policy</a>
        </li>
      </ul>
    </nav>
  </header>