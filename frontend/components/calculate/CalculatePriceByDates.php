<?php

namespace frontend\components\calculate;

class CalculatePriceByDates implements CalculateInterface
{
    private $dateStart;
    private $dateEnd;
    private $diffDays;
    private $checkDates = [];

    /**
     * CalculatePriceByDates constructor.
     * @param \DateTime $dateStart
     * @param \DateTime $dateEnd
     */
    public function __construct(\DateTime $dateStart, \DateTime $dateEnd)
    {
        $this->dateStart = $dateStart;
        $this->dateEnd = $dateEnd;
        $this->diffDays = $this->dateStart->diff($this->dateEnd);
    }

    /**
     * @param $item
     * @return int
     */
    public function getPrice($item)
    {
        $interval = new \DateInterval('P1D');
        $checkRange = new \DatePeriod($this->dateStart, $interval, $this->dateEnd);

        foreach($item['periods'] as $datePeriod)
        {
            $this->inRange($checkRange, $datePeriod);
        }
        $formatter = new \IntlDateFormatter('ru_RU', \IntlDateFormatter::FULL, \IntlDateFormatter::FULL);
        $formatter->setPattern('d MMMM');
        $item['dateStart'] = $formatter->format($this->dateStart);
        $item['dateEnd'] = $formatter->format($this->dateEnd);
        $item['priceFull'] = $this->calculate($item['periodsVias']);
        $item['price'] = 0;
        $item['diffDays'] = $this->diffDays->days;
        return $item;
    }

    /**
     * @param $checkRange
     * @param $datePeriod
     */
    private function inRange($checkRange, $datePeriod)
    {
        $currentStartDate = strtotime($datePeriod['date_start']);
        $currentEndDate = strtotime($datePeriod['date_end']);
        $checkDays = 0;
        foreach ($checkRange as $item)
        {
            if( ($currentStartDate <= strtotime($item->format('Y-m-d'))) && (strtotime($item->format('Y-m-d')) <= $currentEndDate) )
            {
                $checkDays++;
            }
        }
        $this->checkDates[$datePeriod['id']] = $checkDays;
    }

    /**
     * @param $periods
     * @return int|mixed
     */
    private function calculate($periods)
    {
        $sum = 0;
        foreach ($periods as $period)
        {
            $sum += $this->checkDates[$period['period_id']] * $period['value'];
        }
        return $sum;
    }

}