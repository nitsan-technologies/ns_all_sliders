<?php

namespace Nsallsliders\NsAllSliders\Domain\Model;

use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Gallery
 */
class Gallery extends AbstractEntity
{
    /**
     * image
     *
     * @var ObjectStorage<FileReference>|null
     */
    protected ?ObjectStorage $image = null;

    /**
     * Returns the image
     *
     * @return ObjectStorage|null $image
     */
    public function getImage(): ?ObjectStorage
    {
        return $this->image;
    }

    /**
     * Sets the image
     *
     * @param ObjectStorage $image
     * @return void
     */
    public function setImage(ObjectStorage $image): void
    {
        $this->image = $image;
    }
}
