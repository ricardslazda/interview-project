<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Transaction;
use App\Structures\TransactionSearchFilter;
use Core\EntityManagerSingleton;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\Persistence\Mapping\MappingException;
use Exception;

class TransactionRepository
{
    /**
     * @throws ORMException
     * @throws MappingException
     * @throws Exception
     */
    public function saveInBatch(array $transactions, int $batchSize)
    {
        for ($i = 1; $i < count($transactions); $i++) {
            $transaction = new Transaction();

            $transaction->setDate(buildDateTime($transactions[$i][0], $transactions[$i][1]));
            $transaction->setCardNumber($transactions[$i][2]);
            $transaction->setVehicleNumber($transactions[$i][3]);
            $transaction->setProduct($transactions[$i][4]);
            $transaction->setAmount((float)$transactions[$i][5]);
            $transaction->setTotalSum((float)$transactions[$i][6]);
            $transaction->setCurrency($transactions[$i][7]);
            $transaction->setCountry($transactions[$i][8]);
            $transaction->setCountryIso($transactions[$i][9]);
            $transaction->setFuelStation($transactions[$i][10]);


            EntityManagerSingleton::instance()->persist($transaction);
            if (($i % $batchSize) === 0) {
                EntityManagerSingleton::instance()->flush();
                EntityManagerSingleton::instance()->clear();
            }
        }
        EntityManagerSingleton::instance()->flush();
        EntityManagerSingleton::instance()->clear();
    }

    /**
     * @throws ORMException
     */
    public function getAllSortedByTime(): array
    {
        return EntityManagerSingleton::instance()->createQueryBuilder()
            ->select("t")
            ->from(Transaction::class, "t")
            ->orderBy("t.date", "ASC")
            ->getQuery()
            ->getResult();
    }

    /**
     * @throws ORMException
     */
    public function getByFilter(TransactionSearchFilter $filter)
    {
        $query = EntityManagerSingleton::instance()->createQueryBuilder();

        $query = $query->select("t")
            ->from(Transaction::class, "t");

        if ($filter->from) {
            $query = $query->andWhere("t.date >= :from")
                ->setParameter('from', $filter->from);
        };

        if ($filter->to) {
            $query = $query->andWhere("t.date <= :to")
                ->setParameter('to', $filter->to);
        };

        if ($filter->vehicleNumber) {
            $query = $query->andWhere("t.vehicleNumber = :vehicleNumber")
                ->setParameter('vehicleNumber', $filter->vehicleNumber);
        };

        if ($filter->fuelCard) {
            $query = $query->andWhere("t.cardNumber = :cardNumber")
                ->setParameter("cardNumber", $filter->fuelCard);
        }

        if ($filter->productType) {
            $query = $query->andWhere("t.product = :product")
                ->setParameter("product", $filter->productType);
        }

        return $query->getQuery()
            ->getResult();
    }
}