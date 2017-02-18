<?php

namespace frontend\components\calculate;


interface CalculateInterface
{

    /**
     * @param $item
     * @return mixed
     */
    public function getPrice($item);

}