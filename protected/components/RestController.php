<?php
abstract class RestController extends Controller
{
    // Members
    /**
     * Default response format
     * either 'json' or 'xml'
     */
    private $format = 'json';
    /**
     * @return array action filters
     */
    public function filters()
    {
        return array();
    }

    // Actions
    abstract public function actionList();
}