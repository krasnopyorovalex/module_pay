<?php

namespace frontend\components\calculate;


class CalculatePriceByAccommodationOptions implements CalculateInterface
{

    private $next;
    private $adultsChilds;
    private $accommodationOptions;
    private $prices = [];

    public function __construct($adultsChilds, $accommodationOptions, CalculateInterface $next)
    {
        $this->next = $next;
        $this->adultsChilds = $adultsChilds;
        $this->accommodationOptions = $accommodationOptions;
    }

    /**
     * @param $item
     * @return mixed
     */
    public function getPrice($item)
    {
        $item = $this->next->getPrice($item);
        $userCheckedAll = array_sum($this->accommodationOptions) + $this->adultsChilds;
        if( ($this->adultsChilds > $item['max_peoples_adults']) || ($userCheckedAll > $item['max_peoples']) )
        {
            $item['priceFull'] = 0;
            return $item;
        }

        $this->loadPrices($item['accommodationOptionsVias']);
        foreach ($item['accommodationOptions'] as $accommodationOption)
        {
            if($this->accommodationOptions[$accommodationOption['id']])
            {
                $this->prices[$accommodationOption['id']]
                    ? ($item['priceFull'] += $this->accommodationOptions[$accommodationOption['id']] * $this->prices[$accommodationOption['id']] * $item['diffDays'])
                    : $item['priceFull'] = 0;
            }
        }
        return $item;
    }

    private function loadPrices($prices)
    {
        foreach ($prices as $price)
        {
            $this->prices[$price['accommodation_option_id']] = $price['value'];
        }
    }
}