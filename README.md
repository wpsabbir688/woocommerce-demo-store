# WooCommerce Demo Store

A complete, original WooCommerce demo store project: the **ShopNest** theme plus
fictional demo products you can import into any WordPress + WooCommerce site.

This repo contains **theme code, demo content and docs only**. It does not
contain WordPress core, the WooCommerce plugin, uploads, or any credentials —
install those separately by following the steps below.

## What's inside

```
shopnest/                  Original WooCommerce theme (no page builder required)
  style.css                Theme header + all styles
  functions.php            WooCommerce support, Customizer options, shop display
  front-page.php           Hero, shop-by-category, featured, promos, best sellers
  woocommerce.php          WooCommerce wrapper (hooks-first, no template overrides)
  header.php / footer.php  Header (logo, menus, cart link) / footer
  index.php / page.php / single.php / search.php / 404.php
demo-content/
  products.csv             14 fictional products in WooCommerce import format
```

### The ShopNest theme

- Hooks-first WooCommerce support: `add_theme_support( 'woocommerce' )`,
  gallery zoom/lightbox/slider, wrappers in `woocommerce.php` (plus the
  before/after main-content hooks as a fallback for the plugin's own
  templates). No wholesale template overrides.
- Responsive homepage: hero, shop-by-category tiles, featured grid, promo
  banners, best-seller grid.
- Styled shop archive grid, single product, cart and checkout pages.
- Customizer options (Appearance → Customize → ShopNest Options): accent
  color, header layout (standard / centered), hero text, footer text.
- Works standalone with WordPress + WooCommerce. No Elementor or any page
  builder is required.

### Demo products

14 fictional products in 3 categories, USD prices, 4 on sale, 4 featured:

| Category       | Products |
| -------------- | -------- |
| Apparel        | Everyday Cotton Tee, Classic Denim Jacket, Relaxed Linen Shirt, Cozy Knit Sweater, Trail Runner Hoodie |
| Home & Living  | Ceramic Pour-Over Set, Woven Throw Blanket, Wooden Desk Lamp, Stoneware Mug Set of 4, Linen Cushion Cover Pair |
| Accessories    | Slim Leather Wallet, Everyday Canvas Backpack, Insulated Steel Bottle, Classic Round Sunglasses |

Product images are stable placeholder URLs (`picsum.photos` seeded images).
They are placeholders on purpose — replace them with real product photos
before using this store for anything real.

## Setup

### 1. Install WordPress + WooCommerce

Install WordPress (6.4+ recommended, PHP 8.1+), then install and activate
the **WooCommerce** plugin. Run the WooCommerce setup wizard (or skip it —
the demo works with default settings; currency defaults to USD).

### 2. Install the ShopNest theme

- Copy the `shopnest/` folder into `wp-content/themes/`, **or** zip the
  `shopnest/` folder and upload it via Appearance → Themes → Add New → Upload.
- Activate **ShopNest** under Appearance → Themes.

### 3. Import the demo products

1. In wp-admin, go to **Products → Import**.
2. Choose `demo-content/products.csv` from this repo and click Continue.
3. On the column-mapping screen, click **Run the Importer** (the CSV headers
   already match WooCommerce's native format, so no remapping is needed).
4. Wait for the "Import complete" message (14 products imported). On large
   catalogs the importer may process in batches — re-running the import is
   safe: rows whose SKU already exists are skipped, not duplicated.

> Image URL note: WooCommerce's importer sideloads remote images through
> WordPress, which requires the image URL to end in a file extension. That
> is why every image in `products.csv` ends in `.jpg` — extension-less
> placeholder URLs are rejected with "not allowed to upload this file type".

> WP-CLI alternative (for developers): the CSV can also be imported with
> WooCommerce's `WC_Product_CSV_Importer` class via a small PHP runner, or
> products can be recreated with `wp wc product create`. The wp-admin import
> above is the supported path.

### 4. Set up the homepage and menus

1. Create a page titled **Home** (no content needed — the theme's homepage
   template renders the hero, categories and product grids).
2. Go to **Settings → Reading** and set "Your homepage displays" to
   **A static page → Home**.
3. Go to **Appearance → Menus**, create a menu with **Home**, **Shop**,
   **Cart**, **Checkout**, and assign it to **Primary Menu**.
4. Optional: Appearance → Customize → ShopNest Options to change the accent
   color, header layout, hero text or footer text.

### 5. Verify

Visit the homepage, the Shop page, a single product page and the Cart page.
Add a product to the cart and confirm checkout loads. If anything looks off,
check that WooCommerce is active and that the theme (not a different theme)
is the active one.

## Demo data disclaimer

Everything in this repo is **fictional demo data**: invented product names,
prices, descriptions and placeholder images. There are no real brands, no
customer reviews, no testimonials, no sales figures and no business claims.
Do not present this demo as a real store. Replace the demo content with
real products, photos and policies before launching anything public.

## Tested with

- WordPress 7.1.3, WooCommerce 11.2.1, PHP 8.3 (local lab, 2026-10-24)
- Theme activates with zero PHP errors; homepage, shop, single product and
  cart pages return HTTP 200 with the theme's markup.

## License

Theme code is released under the GNU General Public License v2 or later.
Demo content (names, descriptions, CSV) is fictional placeholder data,
free to use and replace.
