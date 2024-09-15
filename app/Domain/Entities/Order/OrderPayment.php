<?php

namespace App\Domain\Entities\Order;

use App\Domain\Enums\PaymentStatus;
use App\Domain\Enums\PaymentMethods;
use App\Domain\Exceptions\PaymentStatusException;

class OrderPayment
{
    public function __construct(private PaymentMethods $method, private PaymentStatus $status) {}
    public function getMethod(): PaymentMethods
    {
        return $this->method;
    }
    public function getStatus(): PaymentStatus
    {
        return $this->status;
    }

    public function changePaymentStatus(PaymentStatus $newStatus): void
    {
        if ($this->status === $newStatus) {
            throw new PaymentStatusException('Payment status cannot be changed to the same status');
        }
        if ($this->status === PaymentStatus::CANCELLED) {
            throw new PaymentStatusException('Cannot change payment status of a cancelled order');
        }

        if ($this->status === PaymentStatus::PAID) {
            throw new PaymentStatusException('Cannot change payment status of a paid order');
        }
        $this->status = $newStatus;
    }
}
