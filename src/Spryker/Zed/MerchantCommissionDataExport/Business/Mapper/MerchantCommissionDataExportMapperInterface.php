<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\MerchantCommissionDataExport\Business\Mapper;

use Generated\Shared\Transfer\DataExportConfigurationTransfer;
use Generated\Shared\Transfer\DataExportWriteResponseTransfer;
use Generated\Shared\Transfer\MerchantCommissionExportRequestTransfer;
use Generated\Shared\Transfer\MerchantCommissionExportResponseTransfer;

interface MerchantCommissionDataExportMapperInterface
{
    public function mapMerchantCommissionExportRequestTransferToDataExportConfigurationTransfer(
        MerchantCommissionExportRequestTransfer $merchantCommissionExportRequestTransfer,
        DataExportConfigurationTransfer $dataExportConfigurationTransfer
    ): DataExportConfigurationTransfer;

    public function mapDataExportWriteResponseTransferToMerchantCommissionExportResponseTransfer(
        DataExportWriteResponseTransfer $dataExportWriteResponseTransfer,
        MerchantCommissionExportResponseTransfer $merchantCommissionExportResponseTransfer
    ): MerchantCommissionExportResponseTransfer;
}
