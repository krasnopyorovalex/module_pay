<?php
namespace frontend\controllers;

use frontend\components\booking\BookingService;
use frontend\components\calculate\CalculatePriceByDates;
use frontend\components\repository\RepositoryInterface;
use yii\web\Controller;

/**
 * Booking Controller
 */
class BookingController extends Controller
{

    /**
     * @var RepositoryInterface
     */
    protected $roomRepository;

    public function __construct($id, $module, RepositoryInterface $roomRepository, $config = [])
    {
        $this->roomRepository = $roomRepository;
        parent::__construct($id, $module, $config);
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        return $this->asJson($this->roomRepository->getAll());
    }

    public function actionTest()
    {
        $calculator = new CalculatePriceByDates(
            new \DateTime('2017-05-24'),
            new \DateTime('2017-05-27')
        );
        $bookingService = (new BookingService($this->roomRepository, $calculator))->load();
        print_r($bookingService);
    }
}
