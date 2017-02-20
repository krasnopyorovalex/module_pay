<?php

namespace frontend\components\calculate;


class CalculatePriceByDiscounts implements CalculateInterface
{

    const NOT_DISCOUNT_VALUE = 1;

    private $dateStart;
    private $dateEnd;
    private $next;

    /**
     * CalculatePriceByDiscounts constructor.
     * @param \DateTime $dateStart
     * @param \DateTime $dateEnd
     * @param CalculateInterface $next
     */
    public function __construct(\DateTime $dateStart, \DateTime $dateEnd, CalculateInterface $next)
    {
        $this->dateStart = $dateStart;
        $this->dateEnd = $dateEnd;
        $this->next = $next;
    }

    /**
     * @param $item
     * @return mixed
     */
    public function getPrice($item)
    {
        $item = $this->next->getPrice($item);
        $today = (new \DateTime())->format('Y-m-d');

        foreach ($item['discounts'] as $discount)
        {
            $percent = $discount['is_early_booking'] == 1
                ? $this->checkEarlyDiscount($discount, $today)
                : $this->checkSimpleDiscount($discount);

            $item['price'] = $item['priceFull'] * $percent;
        }

       return $item;
    }

    /**
     * @param $discount
     * @param $today
     * @return int
     */
    private function checkEarlyDiscount($discount, $today)
    {
        if( (strtotime($discount['date_start']) <= strtotime($today)) && (strtotime($today) <= strtotime($discount['date_end'])) )
        {
            return (1 - $discount['value'] / 100);
        }
        return self::NOT_DISCOUNT_VALUE;
    }

    private function checkSimpleDiscount($discount)
    {
        if(
            (strtotime($discount['date_start']) <= strtotime($this->dateStart->format('Y-m-d'))) &&
            (strtotime($this->dateEnd->format('Y-m-d')) <= strtotime($discount['date_end']))
        )
        {
            return (1 - $discount['value'] / 100);
        }
        return self::NOT_DISCOUNT_VALUE;
    }
}