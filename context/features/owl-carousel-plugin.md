# Feature — Owl Carousel plugin

*Status: Done (free version). Code-read (2026-10-16); content element, edit form and Page module preview seen
on v14.3.7, frontend rendering not fully tested.*

## Editor flow

1. Include the static template "All Sliders" or the site set `nitsan/ns-all-sliders`.
2. Create gallery records (`tx_nsallsliders_domain_model_gallery`) in a folder: title + image.
3. Add the content element "Owl Carousel" (wizard group plugins, CType `nsallsliders_owlcarousel` on v13+).
4. In the plugin options: select the storage folder of images, set height/width, and configure Owl Carousel
   options (autoPlay, items, navigation, lazyLoad, lightbox/thumbs when present, …). Empty FlexForm values
   fall back to TypoScript / site-set constants (`plugin.tx_nsallsliders_owlcarousel.settings.*`).

## Rendering

- `listAction()` restricts the gallery repository to `settings.storage_pid_images` when set, then
  `findAll()`.
- Loads Owl Carousel CSS/JS (and optional Fancybox / thumbs / bundled jQuery when enabled) through
  `PageRenderer`, then injects an inline init script with the resolved options.
- `Templates/Owl/List.html` loops the galleries into the carousel markup.

## Settings paths

| Classic | Site set |
|---|---|
| `plugin.tx_nsallsliders_owlcarousel.view.*` | `ns_all_sliders.view.*` |
| `plugin.tx_nsallsliders_owlcarousel.persistence.storagePid` | `ns_all_sliders.persistence.*` |
| `plugin.tx_nsallsliders_owlcarousel.settings.*` (`jQuery`, `Con…` defaults) | `ns_all_sliders.owlcarousel.*` |

## Page module preview

No dedicated Fluid preview template. The premium strip fills the preview body via
`PageContentPreviewRenderingEvent` (see `premium-cta.md`).
