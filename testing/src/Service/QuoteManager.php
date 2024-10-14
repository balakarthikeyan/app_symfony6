<?php

namespace App\Service;

use App\Entity\Quote;
use Symfony\Component\DependencyInjection\ServiceLocator;

class QuoteManager
{

    public function __construct(private ServiceLocator $QuoteFetcherLocator) {}

    public function fetchQuote(string $isbn)
    {

        $vendorQuoteFetcher = $this->QuoteFetcherLocator->get($isbn);

        $vendorQuoteFetcher->fetch($isbn);
    }
}
