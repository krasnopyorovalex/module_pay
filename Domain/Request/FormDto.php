<?php

namespace Domain\Request;

use yii\web\Request;

/**
 * Class FormDto
 * @package Domain\Request
 */
class FormDto
{
    public $arrivalDate;
    public $departureDate;
    public $adultsChild;
    public $accommodationOptions = [];


    private function __construct()
    {

    }

    /**
     * @param Request $request
     * @return FormDto
     */
    public static function fromRequest(Request $request)
    {
        $self = new self();
        $self->arrivalDate = $request->get('arrivalDate');
        $self->departureDate = $request->get('departureDate');
        $self->adultsChild = $request->get('adultsChilds') ? $request->get('adultsChilds') : 1;
        $self->accommodationOptions = $request->get('accommodationOptions');

        return $self;
    }
}