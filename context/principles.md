# ns_all_sliders — Operating Principles

*Every change to code, context or docs must serve the goals below.*

---

## Goal 1 — Nothing that works may break

The extension declares TYPO3 v12–v14 (Composer and Classic mode), see `core.md`.

- Keep every declared major working. Follow the existing version switches (`version_main` in
  `ext_localconf.php` / `tt_content.php`, `enum_exists(IconSize::class)` in `PremiumStrip`, the
  constructor/`setData()` pair in the FormEngine resolver) instead of inventing new ones.
- Lowest PHP is 8.1 (TYPO3 12): the premium-strip classes use `readonly` and constructor promotion;
  do not introduce PHP 8.2+ syntax such as DNF types.
- Both configuration paths must keep working: the classic static template and the site set
  `nitsan/ns-all-sliders`. A change to one usually needs the same change in the other.
- Existing content elements must keep rendering: CType `nsallsliders_owlcarousel` (v13+) and legacy
  `list` + `list_type=nsallsliders_owlcarousel` (v12). Never rename FlexForm field names.
- Prefer the smallest change that fixes the root cause. No drive-by refactors.
- Run `tasks/run-quality.md` and re-test the affected flow before claiming done.

## Goal 2 — Token-cost efficiency (agent context)

- **DRY context:** each fact lives in exactly ONE file. Reference, don't copy.
- **Load on demand:** read `context/features/<area>.md` for the task, not everything.
- **Prune as you go:** keep `context/session-state.md` short.

## Goal 3 — Accuracy and trust

- Answer from context + code, never from invented API, table or field names.
- Mark statements as verified live or code-read; conflicting facts across files = fix the source file.

---

## Guardrails (non-negotiable)

- FormEngine resolver priorities for `flexFormNoTabsContainer` must be unique across all installed NITSAN
  extensions (core throws on duplicates); ns_all_sliders uses 49 (see `features/premium-cta.md`).
- Installing the premium version through ns_license replaces this extension's folder: never keep user data in
  files below the extension.
- Do not change ns_license from an ns_all_sliders task; reuse its module and trial modal.
- All UI text goes into the English `Resources/Private/Language/*.xlf` files, no hard-coded labels.
  German `de.locallang*.xlf` files in this repo are legacy; Crowdin owns translations — don't edit them here
  for new labels.

---

## Apply this whenever you

- Edit `context/` or `AGENTS.md`
- Land a feature or bugfix (update the matching `context/features/*.md` + `session-state.md`)
