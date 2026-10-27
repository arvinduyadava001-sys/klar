=== KLAR & GLO ===
Requires at least: WordPress 6.0
Tested up to: 6.6
Requires PHP: 7.4
License: GPLv2 or later

The official storefront theme for KLAR & GLO — Korean-inspired skincare
(Niacinamide, Centella Asiatica, Ginseng Exosome). Sticky top announcement
bar, mega-menu navigation, full-width hero, promo tiles, product grid
("Bestsellers"), "Shop by Concern" tiles, a membership CTA band, and a
newsletter + multi-column footer — styled in a minimalist black/white/sage
palette.

This theme is an original design built for KLAR & GLO. It does not copy any
third-party brand's logo, trademark, photos, or written content. Pair it
with the included "klar-glo-products-import.csv" (WooCommerce product
importer) to load your 6 real products in one step.

== INSTALLATION ==

1. Zip the "skincare-clean" folder if it isn't already zipped.
2. In wp-admin go to Appearance > Themes > Add New > Upload Theme.
3. Upload skincare-clean.zip and click Activate.
4. (Recommended) Install the free WooCommerce plugin for a full product
   catalog, cart and checkout — the theme automatically styles WooCommerce's
   shop, product grid, single product page and cart/checkout buttons to
   match the black & white aesthetic.
5. Go to Appearance > Menus and create/assign three menus:
   - "Primary Navigation" -> main header menu (add sub-items for a
     dropdown, e.g. Skincare > Serums, Moisturizers, etc.)
   - "Footer Column 1/2/3" -> assign to the Company / Commitments /
     Customer Care footer columns.
6. Go to Appearance > Customize > Homepage Hero to set your hero image,
   title, subtitle and button link, and Announcement Bar to edit the
   rotating top messages.
7. Set a Static Front Page (Settings > Reading) OR simply leave "Your
   homepage displays: your latest posts" — front-page.php will still be
   used automatically if you create a page and assign it, or you can
   rename front-page.php to index.php behaviour if you prefer the blog
   loop as your homepage.
8. Add a custom logo at Appearance > Customize > Site Identity.
9. Set a featured image on each product/post so the grids display images
   instead of the placeholder blocks.

== FILE STRUCTURE ==

style.css              Theme stylesheet + design tokens
functions.php           Theme setup, menus, enqueue, WooCommerce hooks
header.php / footer.php Site chrome
front-page.php          Homepage (hero, promo tiles, bestsellers, concerns,
                        membership CTA)
index.php / archive.php / single.php / page.php / search.php / 404.php
inc/customizer.php      Customizer controls (hero + announcement bar)
inc/template-tags.php   Reusable helper functions
woocommerce/archive-product.php   Styled shop page override
assets/js/main.js       Mobile menu + announcement bar rotation
