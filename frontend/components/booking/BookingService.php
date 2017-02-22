<?php namespace frontend\components\booking;

use frontend\components\calculate\CalculateInterface;
use frontend\components\repository\RepositoryInterface;

class BookingService implements BookingInterface
{
    /**
     * @var RepositoryInterface
     */
    private $roomRepository;
    /**
     * @var array
     */
    private $items = [];
    /**
     * @var CalculateInterface
     */
    private $calculator;

    public function __construct(
        RepositoryInterface $roomRepository,
        CalculateInterface $calculator
    )
    {
        $this->roomRepository = $roomRepository;
        $this->calculator = $calculator;
    }

    public function run()
    {
        foreach ($this->roomRepository->getAll() as $item)
        {
            array_push($this->items, $this->calculator->getPrice($item));
        }
        return $this->items;
    }
}