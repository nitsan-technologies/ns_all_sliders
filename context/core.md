# ns_all_sliders — Core facts

## Identity

| Item | Value |
|---|---|
| Extension key | `ns_all_sliders` |
| Composer name | `nitsan/ns-all-sliders` |
| Title (ext_emconf) / product name | TYPO3 All-in-One Slider Extension / All in One Slider |
| Namespace | `Nsallsliders\NsAllSliders\` → `Classes/` (note the unusual vendor casing) |
| Version (ext_emconf) | 14.1.0 (latest tag 14.0.0) |
| Repository | https://github.com/nitsan-technologies/ns_all_sliders (default branch `master`) |
| Licensing status | **Freemium** — this repo is the free version; premium is sold by T3Planet |
| Premium product | https://t3planet.com/typo3-slider-extension (composer homepage; demo hosts outdated) |

## Compatibility

| Source | TYPO3 | PHP |
|---|---|---|
| `ext_emconf.php` | `12.0.0-14.9.99` | not declared |
| `composer.json` | `^12 \|\| ^13 \|\| ^14` | not declared |
| ns_license 14.5.4 (dependency) | `12.4.18-14.9.99` | not declared (TYPO3 12 needs 8.1+) |

- Effective minimum is **TYPO3 12.4.18** because of ns_license; the extension's own constraint still says 12.0.0.
- Premium-strip classes need PHP 8.1+.

## Dependencies

| Package | Constraint | Why |
|---|---|---|
| `typo3/cms-core` | see above | core |
| `nitsan/ns-license` / `ns_license` | `^14.5.4` / `14.5.4-14.9.99` | TYPO3 Shop module + free-trial deep link (see `features/premium-cta.md`) |

Bundled: Owl Carousel 2 under `Resources/Public/slider/owl.carousel/`, Fancybox under
`Resources/Public/slider/Fancybox/`. Optional Google Fonts Open Sans (loaded over http/https from the
controller).

## Tooling

- No PHPUnit, PHPStan, CS fixer or package.json in the repo. `composer.json` has a `.Build/` vendor/web-dir
  config for standalone installs.
- CI: `.github/workflows/ter-release.yml` only (publishes tags to TER with tailor).
- `.gitattributes` export-ignores `.crowdin.yml`, `.github/`, `AGENTS.md`, `CLAUDE.md`, `context/`, `tasks/` and
  itself, so they are not in the GitHub/Composer archive or the TER package.
- Translations: Crowdin (`.crowdin.yml`); English sources in `Resources/Private/Language/*.xlf`. Legacy
  `de.locallang*.xlf` files are also in the repo.

## Conventions

- PHP: 4 spaces; only the premium-strip classes declare `strict_types`.
- FlexForm / XLF: tabs. TypoScript: mixed.
- Public assets in `Resources/Public/{Icons,Css,slider}/`; strip CSS
  `Resources/Public/Css/backend-premium-strip.css`.

## Known issues (existing, not fixed)

All code-read unless marked.

- The free version only ships the Owl Carousel plugin; the product name still markets Nivo, Royal, Sliderjs and
  Slick (those live in the premium package / other extensions).
- `OwlController::listAction()` builds a large inline `<script>` with FlexForm values concatenated into JS
  (string settings such as `navElement`, `animateOut`, `navContainer` are not escaped).
- It loads `fonts.googleapis.com` over plain `http://` when the backend request is not HTTPS, and always loads
  several Owl Carousel CSS files plus optional Fancybox on every request of a page that contains the plugin.
- Gallery TCA still lists `fal_media` and `description`/`disable` in search fields while `ext_tables.sql` only
  has `title` and `image`; `Icons.php` registers an SVG with `BitmapIconProvider`.
- Page wizard TSconfig still sets `CType = list` + `list_type` (v12 style) even when the site set imports it on
  v13/v14 CType installs.
- README badges show v13.0.1 / GPL-3.0; demo links use `demo.t3planet.com`.
