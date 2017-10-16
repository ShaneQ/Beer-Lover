<?php
class Blog extends CI_Controller {

    public function index()
    {
        echo 'Hello World!';
    }
    public function comments()
    {
        echo 'Look at this!';
    }

    public function shoes($sandals, $id)
    {
        echo $sandals;
        echo $id;
    }

}