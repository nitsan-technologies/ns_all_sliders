# ns_all_sliders — Architecture

One Extbase content-element plugin (Owl Carousel), one gallery table, no backend module. Backend additions:
the premium strip in the Page module preview and above the single-sheet FlexForm.

## Configuration

| File | What |
|---|---|
| `ext_localconf.php` | Plugin `Owlcarousel` as `list_type` on ≤ v12, as `PLUGIN_TYPE_CONTENT_ELEMENT` on v13+; FormEngine `nodeResolver` 1792125810 (`flexFormNoTabsContainer`, priority 49) |
| `Configuration/TCA/Overrides/tt_content.php` | `registerPlugin()`; v12 FlexForm via `addPiFlexFormValue` on list subtype; v13+ CType + FlexForm file (v13 also `addToAllTCAtypes` Configuration tab) |
| `Configuration/TCA/tx_nsallsliders_domain_model_gallery.php` | Gallery record (`title`, `image` FAL); languages and enable fields |
| `ext_tables.sql` | Gallery table |
| `Configuration/FlexForms/Owlcarousel.xml` | Single sheet `sDEF` ("Settings"): storage folder, height/width, Owl Carousel options (autoPlay, items, navigation, lazyLoad, …) |
| `Configuration/page.tsconfig` | Wizard item `nsallsliders_owlcarousel` in group `plugins` (still writes list + list_type) |
| `Configuration/TCA/Overrides/sys_template.php`, `Configuration/TypoScript/` | Static template "All Sliders"; view/persistence/settings constants |
| `Configuration/Sets/NsAllSliders/` | Site set `nitsan/ns-all-sliders`; imports page TSconfig; settings for view, persistence and Owl defaults |
| `Configuration/Services.yaml` | Autowires `Classes/*`; tags `PremiumStripPreview` for `PageContentPreviewRenderingEvent` |
| `Configuration/Icons.php` | `ext-owl-carousel-icon` |
| `ext_conf_template.txt` | Optional jQuery include |

## Classes

| Class | Role |
|---|---|
| `Controller\OwlController` | `listAction`: loads Owl/Fancybox assets, builds inline Owl init JS from FlexForm + constants, lists gallery records from the selected storage folder |
| `Domain\Model\Gallery`, `Domain\Repository\GalleryRepository` | Gallery image records |
| `Backend\PremiumStrip` | Strip HTML + trial URL; `''` when the ns_license route is missing |
| `Form\Resolver\PremiumStripFlexFormNoTabsContainerResolver`, `Form\Container\PremiumStripFlexFormNoTabsContainer` | Strip above the FlexForm fields |
| `EventListener\PremiumStripPreview` | Strip in the Page module preview |

## Views and assets

- Frontend: `Templates/Owl/List.html` → `Layouts/Default.html`.
- Public: `slider/owl.carousel/` (library), `slider/Fancybox/`, `Icons/`, `Css/backend-premium-strip.css`.
