# Run quality checks

The repo has no PHPUnit, PHPStan or CS config. Available checks:

```bash
# PHP syntax; also run once with PHP 8.1, the lowest version TYPO3 12 supports
for f in $(find . -name "*.php" -not -path "./.git/*" -not -path "./.Build/*"); do php -l "$f"; done

# composer.json
composer validate --no-check-publish

# XLF and FlexForm well-formedness
for f in Resources/Private/Language/*.xlf Configuration/FlexForms/*.xml; do xmllint --noout "$f"; done
```

## Manual test (per TYPO3 major 12 / 13 / 14)

1. Page module, page with an "Owl Carousel" content element: strip once in the preview body.
2. Edit the element: strip above the FlexForm Settings fields. Other plugins' FlexForms show no
   ns_all_sliders strip (other NITSAN strips may appear for their own plugins).
3. "Start Free Trial" (as system maintainer) opens the ns_license module and its trial modal with
   ns_all_sliders preselected. Cancel; don't start a trial.
4. Deactivate ns_license (test system only): both placements show nothing and the form still saves.
5. Frontend (with gallery images in the selected folder): carousel renders; with the static template and
   with the site set.
6. Check light and dark backend themes.

Remove test content elements and gallery records afterwards. On a shared install where the extension is not
active, activate it only temporarily and set the `serverConnectionTime` cookie before the backend login,
otherwise the ns_license check may rename files of unlicensed NITSAN extensions.
