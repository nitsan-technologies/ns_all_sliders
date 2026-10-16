# ns_all_sliders — Session state

## 2026-10-16 — ns_license integration + premium strip + agent context

- Branch `feature/ns-license-premium-strip` from `master` (aa48a26).
- Added `nitsan/ns-license ^14.5.4` / `ns_license 14.5.4-14.9.99` (effective minimum TYPO3 12.4.18).
  Version 14.0.0 → 14.1.0.
- Premium strip with "Start Free Trial" → ns_license module `?trial=ns_all_sliders#free-section` in the Page
  module preview and above the single-sheet FlexForm, team-wide wording and design (see
  `features/premium-cta.md`). Resolver `flexFormNoTabsContainer` priority 49.
- Verified live on TYPO3 14.3.7 classic: extension temporarily added to `PackageStates.php`, gallery table
  created temporarily, `serverConnectionTime` cookie set before login, temporary system-maintainer admin and
  test element uid 90. All removed (table dropped); `PackageStates.php` and `settings.php` restored
  byte-identical; no other extension's files changed; the extension is **not active** in that install.
  PHP 8.4 and 8.1 lint clean.
- Created agent context (`AGENTS.md`, `CLAUDE.md`, `context/`, `tasks/`) and `.gitattributes`; no previous
  context existed. Added "ns_all_sliders 49" to the `flexFormNoTabsContainer` lists of sibling extensions.
- Open: ns_license 14.5.4 not yet published; v12/v13 not tested; frontend only code-read.
