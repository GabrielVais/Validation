<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Validates whether an input is subdivision code of Belize or not.
 *
 * ISO 3166-1 alpha-2: BZ
 *
 * @see http://www.geonames.org/BZ/administrative-division-belize.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class BzSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritDoc}
     */
    protected function getDataSource(): array
    {
        return [
            'BZ', // Belize District
            'CY', // Cayo District
            'CZL', // Corozal District
            'OW', // Orange Walk District
            'SC', // Stann Creek District
            'TOL', // Toledo District
        ];
    }
}
