<?php
namespace frontend\controllers;

use frontend\components\booking\BookingService;
use frontend\components\calculate\CalculatePriceByAccommodationOptions;
use frontend\components\calculate\CalculatePriceByDates;
use frontend\components\calculate\CalculatePriceByDay;
use frontend\components\calculate\CalculatePriceByDiscounts;
use frontend\components\repository\RepositoryInterface;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

/**
 * Booking Controller
 */
class BookingController extends Controller
{

    private $params = [];

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
        $params = [
            'dateStart' => new \DateTime(\Yii::$app->request->get('arrivalDate')),
            'dateEnd' => new \DateTime(\Yii::$app->request->get('departureDate')),
            'adultsChilds' => \Yii::$app->request->get('adultsChilds'),
            'accommodationOptions' => \Yii::$app->request->get('accommodationOptions')
        ];
        $calculator = new CalculatePriceByDay($params);
        $bookingService = (new BookingService($this->roomRepository, $calculator))->load();

        return $this->asJson(ArrayHelper::merge([
            'rooms' => $bookingService
        ],[
            'params' => $this->params
        ]));
    }

    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }
        $this->params = \Yii::$app->request->queryParams;
        return true;
    }

}
