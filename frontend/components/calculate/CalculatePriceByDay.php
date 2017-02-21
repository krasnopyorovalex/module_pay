<?php

namespace frontend\components\calculate;

use yii\helpers\ArrayHelper;

class CalculatePriceByDay implements CalculateInterface
{

    private $dateStart;
    private $dateEnd;
    private $adultsChilds;
    private $accommodationOptions;
    private $diffDays;

    /**
     * CalculatePriceByDay constructor.
     * @param array $params
     */
    public function __construct(array $params)
    {
        $this->dateStart = $params['dateStart'];
        $this->dateEnd = $params['dateEnd'];
        $this->adultsChilds = $params['adultsChilds'];
        $this->accommodationOptions = $params['accommodationOptions'];
        $this->diffDays = $this->dateStart->diff($this->dateEnd);
    }

    /**
     * @param $item
     * @return mixed
     */
    public function getPrice($item)
    {
        $interval = new \DateInterval('P1D');
        $checkRange = new \DatePeriod($this->dateStart, $interval, $this->dateEnd);
        $periodsValues = ArrayHelper::index($item['periodsVias'],'period_id');
        $userCheckedAll = array_sum($this->accommodationOptions) + $this->adultsChilds;

        $formatter = new \IntlDateFormatter('ru_RU', \IntlDateFormatter::FULL, \IntlDateFormatter::FULL);
        $formatter->setPattern('d MMMM');
        $item['dateStart'] = $formatter->format($this->dateStart);
        $item['dateEnd'] = $formatter->format($this->dateEnd);

        $pricesList = [];
        $pricesFullList = [];
        foreach ($checkRange as $day)
        {
            $price = $this->inPeriods($day, $item, $periodsValues);
            $priceFull = $price = $this->checkAccommodationOptions($price, $item, $userCheckedAll);
            $price = $this->checkDiscounts($day, $price, $item);
            array_push($pricesList,$price);
            array_push($pricesFullList,$priceFull);
        }
        $item['price'] = array_sum($pricesList);
        $item['priceFull'] = array_sum($pricesFullList);
        $item['diffDays'] = $this->diffDays->days;

        return $item;
    }

    /**
     * @param $day
     * @param $item
     * @param $periodsValues
     * @return int
     */
    private function inPeriods($day, $item, $periodsValues)
    {
        $day = strtotime($day->format('Y-m-d'));
        foreach ($item['periods'] as $period)
        {
            if( (strtotime($period['date_start']) <= $day) && ($day <= strtotime($period['date_end'])) )
            {
                return $periodsValues[$period['id']]['value'];
            }
        }
        return 0;
    }

    /**
     * @param $price
     * @param $item
     * @param $userCheckedAll
     * @return int
     */
    private function checkAccommodationOptions($price, $item, $userCheckedAll)
    {
        if( ($this->adultsChilds > $item['max_peoples_adults']) || ($userCheckedAll > $item['max_peoples']) )
        {
            return 0;
        }

        $itemAccommodationOptions = ArrayHelper::index($item['accommodationOptionsVias'],'accommodation_option_id');
        foreach ($this->accommodationOptions as $key => $value)
        {
            $price = ($value && isset($itemAccommodationOptions[$key]['value']))
                ? ($price + $itemAccommodationOptions[$key]['value'] * $value)
                : $price;
            if($value && !isset($itemAccommodationOptions[$key]['value']))
            {
                $price = 0;
            }
        }
        return $price;
    }

    /**
     * @param $day
     * @param $price
     * @param $item
     * @return mixed
     */
    private function checkDiscounts($day, $price, $item)
    {
        $day = strtotime($day->format('Y-m-d'));
        $percent = 0;
        foreach ($item['discounts'] as $discount)
        {
            if( (strtotime($discount['date_start']) <= $day) && ($day <= strtotime($discount['date_end'])) )
            {
                $percent += $discount['value'];
            }
        }
        return $price * (1 - $percent / 100);
    }

}