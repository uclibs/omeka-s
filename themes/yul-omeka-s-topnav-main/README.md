# YUL Online Exhibits

Yale University Library custom Omeka S theme for online exhibitions with top navigation. Based on [Default](https://github.com/omeka-s-themes/default) from the Omeka team.

[YUL Online Exhibits LibGuide](https://guides.library.yale.edu/onlineexhibits)

[Omeka S general information](https://omeka.org/s/)

[Omeka S developer documentation](https://omeka.org/s/docs/developer/)

## Fonts Directory

In this folder, place any webfont files you can not or may not put on the open web and want to address from your site's stylesheet(s).

## Images Directory

In this folder, place any images needed for the theme.

Notably, this theme looks for the following image names in the following places:
+ In the Browse Exhibits page, the code looks for thumbnails in the order: Declarative thumb from theme settings, declarative thumb for a Site's (first) Item Set, implicit thumb for a Site's (first) Item Set's first Item's first Media's first image. If none of these can produce a thumbnail, the theme looks for images with the filename pattern `/asset/img/fallback-thumb-00.jpg'` and the number value going from `01` to `07`.
+ For the site's logo, it looks for `img/exhibitionlogo.png`. You need to customize the logo's `alt` and `title` values in `/view/layout/layout.phtml`, so you can also change the image URI there.
+ The footer for one of the theme skins has a background image, located at `/asset/img/footer-background.jpg`. The CSS for this is in `/asset/css/classic.css`.
+ The hamfisted implementation of linked images for featured exhibits (which code/markup is escaping my search right now) looks for a set of images in the filename pattern `/asset/img/featured-exhibits/featured-00.jpg` and the number value going from `01` to `07`.

## Suppressing Nav Bar, Site Search

We have a Site just for browsing exhibits (Sites), in which we don't want the navigation menu or to allow searching. Therefore, we added a PHP conditional structure to do just this. It's based on the known slug of this Site in our instance, so won't work out of the box for you. To set it up, go to lines 83 and 99 in `/view/common/block-layout/list-of-sites.phtml` and replace our slug with yours.

## Genericizing This Theme

We think we've fully genericized this theme for public usage, but if not, please let us know at [online.exhibits@yale.edu](mailto:online.exhibits@yale.edu)