<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\MerchantCommissionDataExport\Business\Mapper;

use Generated\Shared\Transfer\DataExportConfigurationTransfer;
use Generated\Shared\Transfer\DataExportConnectionConfigurationTransfer;
use Generated\Shared\Transfer\DataExportFormatConfigurationTransfer;
use Generated\Shared\Transfer\DataExportWriteResponseTransfer;
use Generated\Shared\Transfer\ErrorTransfer;
use Generated\Shared\Transfer\MerchantCommissionExportRequestTransfer;
use Generated\Shared\Transfer\MerchantCommissionExportResponseTransfer;
use Generated\Shared\Transfer\MessageTransfer;

class MerchantCommissionDataExportMapper implements MerchantCommissionDataExportMapperInterface
{
    public function mapMerchantCommissionExportRequestTransferToDataExportConfigurationTransfer(
        MerchantCommissionExportRequestTransfer $merchantCommissionExportRequestTransfer,
        DataExportConfigurationTransfer $dataExportConfigurationTransfer
    ): DataExportConfigurationTransfer {
        $dataExportFormatConfigurationTransfer = (new DataExportFormatConfigurationTransfer())
            ->setType($merchantCommissionExportRequestTransfer->getFormatOrFail());

        $dataExportConnectionConfigurationTransfer = (new DataExportConnectionConfigurationTransfer())
            ->setType($merchantCommissionExportRequestTransfer->getConnectionOrFail());

        return $dataExportConfigurationTransfer
            ->setFormat($dataExportFormatConfigurationTransfer)
            ->setConnection($dataExportConnectionConfigurationTransfer)
            ->setDestination($merchantCommissionExportRequestTransfer->getDestinationOrFail())
            ->setFields($merchantCommissionExportRequestTransfer->getFields());
    }

    public function mapDataExportWriteResponseTransferToMerchantCommissionExportResponseTransfer(
        DataExportWriteResponseTransfer $dataExportWriteResponseTransfer,
        MerchantCommissionExportResponseTransfer $merchantCommissionExportResponseTransfer
    ): MerchantCommissionExportResponseTransfer {
        foreach ($dataExportWriteResponseTransfer->getMessages() as $messageTransfer) {
            $errorTransfer = $this->mapMessageTransferToErrorTransfer($messageTransfer, new ErrorTransfer());
            $merchantCommissionExportResponseTransfer->addError($errorTransfer);
        }

        return $merchantCommissionExportResponseTransfer;
    }

    protected function mapMessageTransferToErrorTransfer(MessageTransfer $messageTransfer, ErrorTransfer $errorTransfer): ErrorTransfer
    {
        return $errorTransfer
            ->setMessage($messageTransfer->getValue())
            ->setParameters($messageTransfer->getParameters());
    }
}
