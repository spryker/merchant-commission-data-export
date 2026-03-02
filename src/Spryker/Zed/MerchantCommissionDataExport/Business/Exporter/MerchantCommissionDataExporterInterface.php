<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\MerchantCommissionDataExport\Business\Exporter;

use Generated\Shared\Transfer\MerchantCommissionExportRequestTransfer;
use Generated\Shared\Transfer\MerchantCommissionExportResponseTransfer;

interface MerchantCommissionDataExporterInterface
{
    public function exportByMerchantCommissionExportRequest(
        MerchantCommissionExportRequestTransfer $merchantCommissionExportRequestTransfer
    ): MerchantCommissionExportResponseTransfer;
}
