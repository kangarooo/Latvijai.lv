=== Latvijai Futura ===
Contributors: latvijailv
Requires at least: 6.4
Tested up to: 7.1
Requires PHP: 8.0
Stable tag: 1.6.1
License: GNU General Public License v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Tags: dark, futuristic, custom-colors, custom-logo, custom-menu, featured-images, translation-ready, block-styles, wide-blocks, editor-style, blog, portfolio, news

A bold, futuristic classic WordPress theme for Latvijai.lv and public projects for Latvia.

== Description ==

Latvijai Futura is a self-contained WordPress theme built for a public-projects platform. It combines an obsidian and crimson palette, kinetic display typography, glass panels, an animated particle field and an orbital “LV” hero with a practical content model for projects, fields and journal stories.

The theme is designed for Latvijai.lv — a place for ideas, initiatives and people working on a stronger Latvia. All interface and demo copy is in Latvian, and the theme is ready for translation.

**Design**
* A distinctly Latvian identity: flag accents, a stylized Lielvārdes josta ornament, the eleven Latvian diacritics, a five-region index and local place names.
* Dark, editorial, futuristic layout with aurora glows, fine grid lines and animated particles.
* A rotating hero constellation: two red dots and one white dot connected by an electric Latvian-flag gradient triangle.
* Fluid hero, spotlight and footer typography that adapts to the available width.
* Unbounded, Space Grotesk and JetBrains Mono typography, loaded from Google Fonts by default.
* Responsive navigation, full-screen search and a mobile panel with keyboard support.
* Subtle reveal, counter, tilt and parallax effects that respect `prefers-reduced-motion`.
* Configurable page preloader with custom image and gradient background.
* Editor styles and a `theme.json` palette so block content matches the front end.

**Content model**
* `Projekti` custom post type with a public archive at `/projekti/`.
* `Jomas` taxonomy for filtering projects by field.
* Per-project status, location, progress and optional external URL.
* Project cards, project detail pages, related projects and share controls.
* Journal cards, reading time, categories, tags, author archives and comments.
* Styled search results, empty states, pagination and 404 page.

**Front page**
The front page is built from sections for the hero, mission and statistics, the five regions of Latvia, featured projects, spotlight, journal and a call to action. The region index pairs each region with its cities, the ticker carries Latvian place names, and the “Runā Latviski” spotlight displays the eleven Latvian diacritics. The footer closes with a stylized Lielvārdes josta band and the names of all five regions. The theme ships with thoughtful Latvian defaults, so the page is complete before any content is added.

If no published projects exist, the featured-projects section shows three clearly labelled `Paraugs` demo cards. They disappear automatically as soon as a real project is published.

== Installation ==

1. In WordPress, go to **Appearance → Themes → Add New → Upload Theme**.
2. Upload the theme ZIP file and choose **Install Now**.
3. Activate **Latvijai Futura**.
4. Visit **Settings → Permalinks** and save the settings once. This refreshes the project archive and taxonomy URLs.
5. Optional: create a page for the front page, a page for the journal and a page for “Par mums”, then assign them under **Settings → Reading** and **Appearance → Menus**.
6. Configure the theme under **Appearance → Customize → Latvijai — sākumlapa**.

For a fully Latvian site, set **Settings → General → Site Language** to `Latviešu` and use `d.m.Y.` as the date format. This translates WordPress core labels and produces Latvian-style dates in project and journal cards.

No plugins or page builder are required.

== Setting up the site ==

**Menus**
The theme registers two menu locations:
* **Galvenā navigācija** — the main header navigation.
* **Kājenes navigācija** — the footer navigation.

If no menu is assigned, the theme provides a useful fallback with Sākumlapa, Projekti, Žurnāls and Par mums. Assign custom menus under **Appearance → Menus** when the site structure is ready.

**Front page and journal**
The front page template is used automatically for the site front page. For a separate journal, create a page (for example “Žurnāls”) and select it as the **Posts page** under **Settings → Reading**. The theme's fallback navigation links to the journal section on the front page until a posts page is assigned.

**Projects**
1. Go to **Projekti → Pievienot jaunu**.
2. Add a title, description, excerpt and featured image.
3. Choose one or more **Jomas** (fields).
4. In **Projekta detaļas**, set the status (`Ideja`, `Izstrādē`, `Aktīvs`, `Pabeigts`), location, progress percentage and optional external project URL.
5. Publish. The project appears on the front page (the three newest projects) and in the `/projekti/` archive.

Recommended featured image size: 1400 × 900 px. The theme also creates cropped `latvijai-card` (760 × 500) and `latvijai-wide` (1680 × 940) image sizes.

**Journal**
Add standard WordPress posts, categories, tags and featured images. The journal archive, single-post layout, related posts, comments and share controls are styled by the theme.

**Site identity**
Set the site title, tagline and optional custom logo under **Appearance → Customize → Site Identity**. If no logo is uploaded, the theme renders its own geometric Latvijai mark.

== Customizer options ==

All theme options live under **Appearance → Customize → Latvijai — sākumlapa**:

* **Hero sadaļa** — eyebrow, three title lines, intro text, two buttons and status text.
* **Statistika** — four numeric or symbolic statistics with labels.
* **Fokusa projekts** — spotlight title, description, button label and URL.
* **Aicinājums pievienoties** — call-to-action title, description, buttons and meta line.
* **Kontakti un sociālie tīkli** — footer text, contact email, location, coordinates, donation URL and social profiles.

The header donation button uses the **Ziedošanas saite** setting. Social icons are hidden automatically when their URL is empty.

== Typography and privacy ==

The theme loads Unbounded, Space Grotesk and JetBrains Mono from Google Fonts by default and adds preconnect hints to improve loading. Requesting fonts from Google may share the visitor's IP address with Google.

To disable the Google Fonts request, add this to a child theme's `functions.php` or a small site-specific plugin:

    add_filter( 'latvijai_enable_google_fonts', '__return_false' );

The site will then use the system font fallbacks declared in the theme.

To serve locally hosted fonts instead, filter the stylesheet URL:

    add_filter( 'latvijai_fonts_url', function () {
        return get_stylesheet_directory_uri() . '/assets/fonts/fonts.css';
    } );

The three typefaces are distributed under the SIL Open Font License 1.1. They are not bundled with the theme.

== Accessibility ==

The theme includes skip navigation, visible focus treatment, semantic landmarks, labelled controls, keyboard-operable menus and search, and support for reduced motion. Core comment-form labels follow the active WordPress locale. The theme's own strings are in Latvian.

== Browser support ==

Latvijai Futura targets current evergreen versions of Chrome, Edge, Firefox and Safari. Older browsers receive a readable, simplified layout without the decorative motion.

== Frequently asked questions ==

**Why do I see demo project cards?**
The demo cards appear only when there are no published projects. Add and publish a project under **Projekti → Pievienot jaunu** and they will be replaced automatically.

**Why does the project archive return a 404?**
Open **Settings → Permalinks** and save once. The theme flushes its rewrite rules on activation, but a later permalink change can require a manual refresh.

**Can I use a page builder?**
Yes, the theme follows standard WordPress templates and includes block editor styles. The bundled front page is intentionally self-contained, so page-builder content is better used on standard pages.

**Can I override the default strings?**
Yes. Every interface string uses the `latvijai-futura` text domain, and all templates are child-theme friendly.

== Credits ==

* Design and development: Latvijai.lv.
* Typefaces: Unbounded, Space Grotesk and JetBrains Mono via Google Fonts, licensed under the SIL Open Font License 1.1.
* Icons: original inline SVG artwork created for this theme.
* Screenshot: the theme's front page with Latvijai.lv content. No stock photography is bundled.

== License ==

Latvijai Futura is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 2 of the License, or (at your option) any later version.

This theme is distributed in the hope that it will be useful, but without any warranty; without even the implied warranty of merchantability or fitness for a particular purpose. See the GNU General Public License for more details:

https://www.gnu.org/licenses/gpl-2.0.html

== Changelog ==

= 1.6.1 =
* The homepage headline "Būvējam Latviju nākotnei" is now in Latvian flag colours: carmine – white – carmine (Pantone 201 C), in both dark and light mode. In light mode the white line has a carmine outline so it stays visible.
* New Customizer checkbox "Virsraksts Latvijas karoga krāsās" (on by default) to switch back to the previous white / outline style.
* Fixed the long marks on Ā, Ē, Ū in the headline being cut off at the top.

= 1.6.0 =
* Added a light colour scheme. Customizer → Latvijai — sākumlapa → "Krāsu režīms": Tumšs (default), Gaišs, or Automātiski (follows the visitor's device setting).
* Optional sun / moon switch in the header lets visitors change between light and dark; their choice is remembered in the browser and applied before the page paints (no flash).
* The big feature panels and project / post card images stay dark in light mode so the artwork keeps its look.
* Theme colours are now driven by colour tokens, so background particles, borders, glass panels and shadows all follow the active scheme.
* The default preloader background follows the colour scheme; custom preloader colours are still respected.

= 1.5.0 =
* Added the Latvian national flag as a thin strip at the very top of the header (carmine – white – carmine, official 2 : 1 : 2 proportions, Pantone 201 C #9D2235).
* The flag sits inside the fixed header, so it stays visible while scrolling and works with the WordPress admin bar.
* New Customizer section "Latvijas karogs galvenē": turn the flag on/off and set its height (4–60 px, default 20 px).
* Page content, the mobile menu and anchor scrolling are offset by the flag height so nothing is hidden under the header.
* The flag keeps its colours in Windows High Contrast mode and when printing, and is announced to screen readers as "Latvijas valsts karogs".
* Updated the 1200 × 900 theme screenshot to show the header flag.

= 1.4.1 =
* Fixed the Customizer showing no options: preloader colour fields now use the colour picker control (a JS error previously stopped the Customizer from loading).
* Preloader image is now chosen from the Media Library instead of typing a URL.
* Default preloader dots now use Latvian flag colours: carmine – white – carmine.
* Preloader dots and "Lādē Latviju…" text are now centred together instead of being split to the top and bottom of the screen.
* Bigger preloader dots (22 px) and "Lādē Latviju…" text.
* A custom preloader image now fills the full screen width (cropped to fit the screen height if needed).
* Updated the 1200 × 900 theme screenshot to show the preloader.

= 1.4.0 =
* Added a configurable page preloader with custom image upload and gradient background colours.
* Preloader respects `prefers-reduced-motion` and minimum display duration setting.
* Customizer section “Prelādētājs” under “Latvijai — sākumlapa” panel.
* Updated the 1200 × 900 theme screenshot.

= 1.3.0 =
* Added a second red dot to the hero orb, so two red dots and one white dot now fly around the LV monogram.
* Connected the dots with an animated electric triangle gradient in Latvian flag colours.
* Added a travelling light pulse around the triangle and a soft breathing motion to the constellation.
* The effect is disabled for visitors who prefer reduced motion.
* Updated the 1200 × 900 theme screenshot.

= 1.2.0 =
* Added a stylized Lielvārdes josta ornament and a five-region line to the footer.
* Added the eleven Latvian diacritics to the “Runā Latviski” spotlight.
* Expanded the ticker and region index with Latvian cities: Daugavpils, Liepāja, Jelgava, Valmiera, Rēzekne, Ventspils, Jūrmala and Cēsis.
* Added a “Novadi” link to the fallback navigation and changed the third statistic to five regions.
* Updated Latvian time labels, footer wording and section copy.
* Updated the 1200 × 900 theme screenshot.

= 1.1.0 =
* Added the “Viena Latvija. Pieci reģioni.” identity section for Rīga, Kurzeme, Zemgale, Vidzeme and Latgale.
* Added Latvian flag accents to the hero and regional panel.
* Expanded the home-page ticker with Latvian region names.
* Updated Latvian interface copy and footer wording.
* Updated the 1200 × 900 theme screenshot.

= 1.0.0 =
* Initial release.
* Futuristic front page with hero, mission, projects, spotlight, journal and call to action.
* Projects custom post type, Jomas taxonomy and project metadata.
* Project and journal archives, single templates, search, 404 and comments.
* Full customizer controls, demo project fallback, responsive navigation and reduced-motion support.

== Contact ==

For questions about this theme, contact info@latvijai.lv or visit https://latvijai.lv.
