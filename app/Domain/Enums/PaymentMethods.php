<?php

namespace App\Domain\Enums;

enum PaymentMethods: int
{
    case CREDIT_CARD = 1;
    case DEBIT_CARD = 2;
    case PIX = 3;
    case MONEY = 4;
}
