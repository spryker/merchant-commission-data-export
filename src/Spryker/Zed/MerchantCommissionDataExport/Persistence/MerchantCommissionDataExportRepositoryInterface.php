<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\MerchantCommissionDataExport\Persistence;

use Generated\Shared\Transfer\DataExportBatchTransfer;
use Generated\Shared\Transfer\DataExportConfigurationTransfer;

interface MerchantCommissionDataExportRepositoryInterface
{
    public function getMerchantCommissionData(
        DataExportConfigurationTransfer $dataExportConfigurationTransfer
    ): DataExportBatchTransfer;
}
