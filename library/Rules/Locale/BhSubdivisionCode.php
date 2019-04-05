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
 * Validates whether an input is subdivision code of Bahrain or not.
 *
 * ISO 3166-1 alpha-2: BH
 *
 * @see http://www.geonames.org/BH/administrative-division-bahrain.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class BhSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritDoc}
     */
    protected function getDataSource(): array
    {
        return [
            '13', // Capital
            '14', // Southern
            '15', // Muharraq
            '17', // Northern
        ];
    }
}
