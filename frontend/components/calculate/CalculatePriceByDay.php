<?php

namespace frontend\components\calculate;

use common\models\Periods;
use yii\helpers\ArrayHelper;

class CalculatePriceByDay implements CalculateInterface
{

    const IS_EARLY = 1;

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
        $periodsValues = ArrayHelper::index($item['periodsVias'], 'period_id');
        $userCheckedAll = array_sum($this->accommodationOptions) + $this->adultsChilds;

        $formatter = new \IntlDateFormatter('ru_RU', \IntlDateFormatter::FULL, \IntlDateFormatter::FULL);
        $formatter->setPattern('d MMMM');
        $item['dateStart'] = $formatter->format($this->dateStart);
        $item['dateEnd'] = $formatter->format($this->dateEnd);

        //////////remove discount if elapsed date
        $today = strtotime((new \DateTime())->format('Y-m-d'));
        foreach ($item['discounts'] as $key => $discount) {
            if ($today > strtotime($discount['date_end'])) {
                unset($item['discounts'][$key]);
            }
        }
        //////////

        $pricesList = [];
        $pricesFullList = [];
        foreach ($checkRange as $day) {
            $price = $this->inPeriods($day, $item, $periodsValues);

            $priceFull = $price = $this->checkAccommodationOptions($price, $item, $userCheckedAll, $day);

            $price = $this->checkDiscounts($day, $price, $item);

            if ($this->adultsChilds < $item['max_peoples']) {
                $priceFull = $priceFull * $item['max_peoples'];
                $price = $price * $item['max_peoples'];
            }

            array_push($pricesList, $price);
            array_push($pricesFullList, $priceFull);
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
        foreach ($item['periods'] as $period) {
            if ((strtotime($period['date_start']) <= $day) && ($day <= strtotime($period['date_end']))) {
                return $periodsValues[$period['id']]['value'];
            }
        }
        return 0;
    }

    /**
     * @param $price
     * @param $item
     * @param $userCheckedAll
     * @param $day
     * @return float|int|mixed
     */
    private function checkAccommodationOptions($price, $item, $userCheckedAll, $day)
    {
        if (($this->adultsChilds > $item['max_peoples_adults']) || ($userCheckedAll > $item['max_peoples'])) {
            return 0;
        }

        $basicPlaceList = ArrayHelper::index($item['accommodationOptions'], 'id');

        foreach ($this->accommodationOptions as $key => $value) {
            $priceAO = $this->getPriceAO($item, $day, $key);

            if (!$value && !isset($priceAO)) {
                return 0;
            }

            if (($this->adultsChilds <= $item['max_peoples_adults']) && $basicPlaceList[$key]['is_basic_place']) {
                $price = ($price - $priceAO * $value);
            } elseif (!$basicPlaceList[$key]['is_basic_place']) {
                $price = ($price + $priceAO * $value);
            }

            if (($basicPlaceList[$key]['is_basic_place'] && (($this->adultsChilds + $value) > $item['max_peoples']))) {
                return 0;
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
        $today = strtotime((new \DateTime())->format('Y-m-d'));
        $day = strtotime($day->format('Y-m-d'));
        $percent = 0;
        foreach ($item['discounts'] as $key => $discount) {
            if (
                ($discount['is_early_booking'] == self::IS_EARLY) &&
                (strtotime($discount['date_start']) <= $today) &&
                ($today <= strtotime($discount['date_end']))
            ) {
                $percent += $discount['value'];
            } elseif (
                ($discount['is_early_booking'] != self::IS_EARLY) &&
                (strtotime($discount['date_start']) <= $day) &&
                ($day <= strtotime($discount['date_end']))
            ) {
                $percent += $discount['value'];
            }
        }
        return $price * (1 - $percent / 100);
    }

    /**
     * @param $room
     * @param $day
     * @param $keyAO
     * @return int|mixed
     */
    private function getPriceAO($room, $day, $keyAO)
    {
        $periods = Periods::find()->asArray()->all();
        $roomAOPrices = ArrayHelper::map(
            $room['accommodationOptionsVias'],
            function ($item) {
                return $item['accommodation_option_id'] . '__' . $item['period_id'];
            },
            'value'
        );

        $day = strtotime($day->format('Y-m-d'));

        foreach ($periods as $period) {
            if (isset($roomAOPrices[$keyAO . '__' . $period['id']]) && (strtotime(
                        $period['date_start']
                    ) <= $day) && ($day <= strtotime($period['date_end']))) {
                return $roomAOPrices[$keyAO . '__' . $period['id']];
            }
        }

        return 0;
    }
}