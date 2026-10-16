# Feature — Premium strip and ns_license free trial

*Status: Done. Verified live on TYPO3 14.3.7 (2026-10-16): strip in the Page module preview and above the
FlexForm fields (Plugin tab); the button opens the ns_license module with "All in One Slider
(ns_all_sliders)" preselected in Free Trial mode. Requires ns_license 14.5.4 (deep-link support) to be
released. v12/v13 not tested.*

## Licensing status

Freemium. Premium product (T3Planet): All in One Slider — https://t3planet.com/typo3-slider-extension
(not linked from the UI; the trial stays inside the TYPO3 backend). The free repo only ships Owl Carousel;
other slider libraries are premium / separate extensions.

## Dependency

`composer.json` `"nitsan/ns-license": "^14.5.4"`, `ext_emconf.php` `'ns_license' => '14.5.4-14.9.99'`. Raises
the effective minimum TYPO3 version to 12.4.18 (see `core.md`).

## Placements

| Place | Position |
|---|---|
| Page module, preview of an Owl Carousel content element | Below the element header, as the preview body |
| Content element edit form, **Plugin** tab | Above the Settings fields |

Not shown on gallery records or other content elements.

## How it works

- `Backend\PremiumStrip::render()`: `actions-rocket` icon, headline and description on two lines,
  `btn btn-primary` "Start Free Trial →" (the arrow is `aria-hidden` markup). Link = route
  `nitsan_nslicensemodule` + `trial=ns_all_sliders` + `#free-section`, same frame. Returns `''` without
  ns_license, so neither placement shows anything.
- Preview: `EventListener\PremiumStripPreview` listens to `PageContentPreviewRenderingEvent` (after
  `typo3-backend/fluid-preview/content`), matches CType `nsallsliders_owlcarousel` or legacy
  `list` + `list_type`, prepends the strip and adds the stylesheet through `PageRenderer`.
- Edit form: the FlexForm has one sheet, so core uses `flexFormNoTabsContainer`. `ext_localconf.php`
  registers `Form\Resolver\PremiumStripFlexFormNoTabsContainerResolver` for that node, priority **49**
  (taken: ns_news_comments 40, ns_event 41, ns_gallery 42, ns_helpdesk 43, ns_social_login 44, ns_faq 45,
  ns_open_streetmap 46, ns_comments 47, ns_timeline 48; duplicates make core throw). It matches
  `tt_content.pi_flexform` of CType `nsallsliders_owlcarousel` (or legacy `list` + list_type), not inline
  children, and returns `Form\Container\PremiumStripFlexFormNoTabsContainer`, which prepends the strip and
  adds the stylesheet. If the FlexForm ever gets a second sheet, core switches to `flexFormTabsContainer`
  and the strip disappears from the form.

## Strip

- Labels in `locallang.xlf`: `premium.strip.headline` "You're using the free version of All Sliders",
  `premium.strip.description` "Unlock premium features and get more out of All Sliders.",
  `premium.strip.trial` "Start Free Trial".
- `Resources/Public/Css/backend-premium-strip.css`: `.ns-all-sliders-premium-strip` — team-wide design
  (light-blue card `#e7f2fc`, border `#8eb6e8`, 4px `#2b6cb0` left accent, 6px radius, padding 14px 18px,
  `light-dark()` for dark mode, button `#007bff` / hover `#0062cc`); inset 16px inside the FlexForm panel.
- Measured on v14.3.7: 401×155px in the edit form (435px panel, button wraps below the text at that width);
  335×155px in the Page module preview.
- ns_license's module requires system maintainer access; other users get access denied after clicking.
