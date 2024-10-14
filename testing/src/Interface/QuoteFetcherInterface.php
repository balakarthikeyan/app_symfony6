<?php

namespace App\Interface;

use App\Entity\Quote;

class QuoteFetcherInterface
{
	public function fetchQuote(int $id) {}
}
