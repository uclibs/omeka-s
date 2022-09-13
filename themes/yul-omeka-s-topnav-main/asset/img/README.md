# YUL Online Exhibits Images Directory

In this folder, place any images needed for the theme.

Notably, this theme looks for the following image names in the following places:
+ In the Browse Exhibits page, the code looks for thumbnails in the order: Declarative thumb from theme settings, declarative thumb for a Site's (first) Item Set, implicit thumb for a Site's (first) Item Set's first Item's first Media's first image. If none of these can produce a thumbnail, the theme looks for images with the filename pattern `/asset/img/fallback-thumb-00.jpg'` and the number value going from `01` to `07`.
+ For the site's logo, it looks for `img/exhibitionlogo.png`. You need to customize the logo's `alt` and `title` values in `/view/layout/layout.phtml`, so you can also change the image URI there.
+ The footer for one of the theme skins has a background image, located at `/asset/img/footer-background.jpg`. The CSS for this is in `/asset/css/classic.css`.
+ The hamfisted implementation of linked images for featured exhibits (which code/markup is escaping my search right now) looks for a set of images in the filename pattern `/asset/img/featured-exhibits/featured-00.jpg` and the number value going from `01` to `07`.