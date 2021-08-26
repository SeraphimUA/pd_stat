<?php

namespace App\Controllers;

use App\Models\pubdomStat;

use DateTime;

class Home extends BaseController
{
	public function index()
	{
		$model = new pubdomStat();

		$date = DateTime::createFromFormat("Y-m-d", date("Y-m-01"));
		$month = DateTime::createFromFormat("Y-m", date("Y-m"));

		if(isset($_POST['month']) and isset($_POST['year'])) {
			$date->setDate($_POST['year'], $_POST['month'], 1);
			$month->setDate($_POST['year'], $_POST['month'], 1);
		}

		$p_host = (isset($_GET['p_host'])) ? $_GET['p_host'] : "ua";

        $data = [
            'stat' => $model->getCapacity($date->format("Y-m-d")),
            'title' => 'Stat',
			'date' => $month,
			'd_measure' => $date,
			'p_host' => $p_host
        ];

		echo view('header', $data);
		echo view('overview', $data);
		// var_dump($data['stat']['stat']);
		echo view('footer');
		// return view('welcome_message');
	}

	public function getDomainInfo() {

	}
}
