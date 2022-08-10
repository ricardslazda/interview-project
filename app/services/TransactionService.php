<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Transaction;
use App\Repositories\TransactionRepository;
use App\Structures\TransactionSearchFilter;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\Persistence\Mapping\MappingException as MappingExceptionAlias;
use JetBrains\PhpStorm\Pure;

class TransactionService
{
    private TransactionRepository $transactionRepository;

    #[Pure] public function __construct()
    {
        $this->transactionRepository = new TransactionRepository();
    }

    /**
     * @throws MappingExceptionAlias
     * @throws ORMException
     */
    public function saveFromCsv(array $requestData)
    {
        $tmpName = $requestData['fuelTransactions']['tmp_name'];
        $transactions = array_map('str_getcsv', file($tmpName));

        $allowedTransactions = $this->filterTransactionsAllowedFuelTypes($transactions);

        $this->transactionRepository->saveInBatch($allowedTransactions, 10);
    }

    /**
     * @throws ORMException
     */
    public function getFilteredTransactions(array $request): array
    {
        $transactionSearchFilter = new TransactionSearchFilter();

        $transactionSearchFilter->from = $request['from'];
        $transactionSearchFilter->to = $request['to'];
        $transactionSearchFilter->fuelCard = $request['fuelCard'];
        $transactionSearchFilter->vehicleNumber = $request['vehicle'];
        $transactionSearchFilter->productType = $request['productType'];

        return $this->transactionRepository->getByFilter($transactionSearchFilter);
    }

    private function filterTransactionsAllowedFuelTypes(array $transactions): array
    {
        $filteredArray = [];

        foreach ($transactions as $transaction) {
            if (in_array($transaction[4], Transaction::ALLOWED_FUEL_TYPES_VALUES)) {
                $filteredArray[] = $transaction;
            }
        }

        return $filteredArray;
    }
}