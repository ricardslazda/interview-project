<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Repositories\TransactionRepository;
use App\Services\TransactionService;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\Persistence\Mapping\MappingException;
use JetBrains\PhpStorm\Pure;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class TransactionController
{
    private TransactionService $transactionService;
    private TransactionRepository $transactionRepository;

    #[Pure] public function __construct()
    {
        $this->transactionService = new TransactionService();
        $this->transactionRepository = new TransactionRepository();
    }

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError|ORMException
     */
    function actionIndex(): void
    {
        $transactions = isset($_GET['submit']) ? $this->transactionService->getFilteredTransactions($_GET) : $this->transactionRepository->getAllSortedByTime();

        renderTemplate('transaction/index.html', ["transactions" => $transactions, "filters" => $_GET]);
    }

    /**
     * @throws MappingException
     * @throws ORMException
     */
    function actionHandleTransactionUpload(): void
    {
        $this->transactionService->saveFromCsv($_FILES);

        header('Location: transactions');
    }
}