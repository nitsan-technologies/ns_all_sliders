<?php

declare(strict_types=1);

namespace Nsallsliders\NsAllSliders\EventListener;

use Nsallsliders\NsAllSliders\Backend\PremiumStrip;
use TYPO3\CMS\Backend\View\Event\PageContentPreviewRenderingEvent;
use TYPO3\CMS\Core\Page\PageRenderer;

/**
 * Adds the premium strip to the Page module preview of the Owl Carousel content element.
 */
final class PremiumStripPreview
{
    public function __construct(
        private readonly PremiumStrip $premiumStrip,
        private readonly PageRenderer $pageRenderer,
    ) {}

    public function __invoke(PageContentPreviewRenderingEvent $event): void
    {
        if ($event->getTable() !== 'tt_content' || !$this->isOwlCarousel($event)) {
            return;
        }

        $strip = $this->premiumStrip->render();
        if ($strip === '') {
            return;
        }

        $this->pageRenderer->addCssFile(PremiumStrip::STYLESHEET);
        $event->setPreviewContent($strip . ($event->getPreviewContent() ?? ''));
    }

    /**
     * TYPO3 v13+ exposes the record type on the event, v12 only passes the record row.
     * Elements not yet migrated still use list + list_type.
     */
    private function isOwlCarousel(PageContentPreviewRenderingEvent $event): bool
    {
        $record = $event->getRecord();
        $row = is_array($record) ? $record : (method_exists($record, 'toArray') ? $record->toArray() : []);

        $recordType = method_exists($event, 'getRecordType')
            ? (string)$event->getRecordType()
            : (string)($row['CType'] ?? '');
        if ($recordType === PremiumStrip::PLUGIN_SIGNATURE) {
            return true;
        }

        $listType = $row['list_type'] ?? '';
        if (is_array($listType)) {
            $listType = (string)($listType[0] ?? '');
        }

        return $recordType === 'list' && $listType === PremiumStrip::PLUGIN_SIGNATURE;
    }
}
