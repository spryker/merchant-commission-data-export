<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerTest\Zed\MerchantCommissionDataExport;

use Codeception\Actor;
use Generated\Shared\Transfer\MerchantCommissionCalculationRequestItemTransfer;
use Generated\Shared\Transfer\MerchantCommissionCalculationRequestTransfer;
use Generated\Shared\Transfer\MerchantCommissionTransfer;
use Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionQuery;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\MerchantCommissionExtension\Communication\Dependency\Plugin\MerchantCommissionCalculatorPluginInterface;

/**
 * Inherited Methods
 *
 * @method void wantTo($text)
 * @method void wantToTest($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method void pause($vars = [])
 * @method \Spryker\Zed\MerchantCommissionDataExport\Business\MerchantCommissionDataExportFacadeInterface getFacade(?string $moduleName = NULL)
 *
 * @SuppressWarnings(PHPMD)
 */
class MerchantCommissionDataExportBusinessTester extends Actor
{
    use _generated\MerchantCommissionDataExportBusinessTesterActions;

    public function ensureMerchantCommissionTableIsEmpty(): void
    {
        $this->ensureDatabaseTableIsEmpty($this->getMerchantCommissionQuery());
    }

    /**
     * @param string $exportedData
     *
     * @return array<string, string>
     */
    public function parseExportedData(string $exportedData): array
    {
        $parsedExportedData = array_map('str_getcsv', explode(PHP_EOL, trim($exportedData)));

        $header = array_shift($parsedExportedData);
        array_walk($parsedExportedData, function (&$dataRow) use ($header): void {
            $dataRow = array_combine($header, $dataRow);
        });

        return $parsedExportedData;
    }

    public function getMerchantCommissionCalculatorPlugin(int $calculatedAmount, string $calculatorPluginType): MerchantCommissionCalculatorPluginInterface
    {
        return new class ($calculatedAmount, $calculatorPluginType) extends AbstractPlugin implements MerchantCommissionCalculatorPluginInterface
        {
            /**
             * @var int
             */
            protected int $calculatedAmount;

            /**
             * @var string
             */
            protected string $calculatorPluginType;

            public function __construct(int $calculatedAmount, string $calculatorPluginType)
            {
                $this->calculatedAmount = $calculatedAmount;
                $this->calculatorPluginType = $calculatorPluginType;
            }

            public function getCalculatorType(): string
            {
                return $this->calculatorPluginType;
            }

            public function calculateMerchantCommission(
                MerchantCommissionTransfer $merchantCommissionTransfer,
                MerchantCommissionCalculationRequestItemTransfer $merchantCommissionCalculationRequestItemTransfer,
                MerchantCommissionCalculationRequestTransfer $merchantCommissionCalculationRequestTransfer
            ): int {
                return $this->calculatedAmount;
            }

            public function transformAmountForPersistence(float $merchantCommissionAmount): int
            {
                return (int)$merchantCommissionAmount;
            }

            public function transformAmountFromPersistence(int $merchantCommissionAmount): float
            {
                return (float)$merchantCommissionAmount;
            }

            public function formatMerchantCommissionAmount(int $merchantCommissionAmount, ?string $currencyIsoCode = null): string
            {
                return (string)$merchantCommissionAmount;
            }
        };
    }

    protected function getMerchantCommissionQuery(): SpyMerchantCommissionQuery
    {
        return SpyMerchantCommissionQuery::create();
    }
}
