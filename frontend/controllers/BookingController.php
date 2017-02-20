<?php
namespace frontend\controllers;

use frontend\components\booking\BookingService;
use frontend\components\calculate\CalculatePriceByAccommodationOptions;
use frontend\components\calculate\CalculatePriceByDates;
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
        $calculator = new CalculatePriceByDates(
            new \DateTime(\Yii::$app->request->get('arrivalDate')),
            new \DateTime(\Yii::$app->request->get('departureDate'))
        );
        $calculator = new CalculatePriceByAccommodationOptions(
            \Yii::$app->request->get('adultsChilds'),
            \Yii::$app->request->get('accommodationOptions'),
            $calculator
        );
        $calculator = new CalculatePriceByDiscounts(
            new \DateTime($this->params['arrivalDate']),
            new \DateTime($this->params['departureDate']),
            $calculator
        );
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
