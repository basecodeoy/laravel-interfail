<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Interfail\Extensions;

use BaseCodeOy\Interfail\Contracts\Extension;
use BaseCodeOy\Interfail\Data\Result;

final readonly class TotalFailuresAllowedExtension implements Extension
{
    public function __construct(
        private string $count,
    ) {
        //
    }

    #[\Override()]
    public function onSuccess(Result $result): void
    {
        //
    }

    #[\Override()]
    public function onFailure(Result $result): void
    {
        if ($result->state->totalFailures >= $this->count) {
            throw new \RuntimeException('Total number of allowed failures has been exceeded.');
        }
    }

    #[\Override()]
    public function toArray(): array
    {
        return ['count' => $this->count];
    }
}
