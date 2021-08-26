<?php

namespace App\Controllers;

use App\Models\pubdomStat;
use CodeIgniter\API\ResponseTrait;
use DateTime;

class Home extends BaseController
{
	//для виведення чистого JSON у функції getDomCapacity
	use ResponseTrait;

	public function index()
	{
		$model = new pubdomStat();

		$date = DateTime::createFromFormat("Y-m-d", date("Y-m-01"));
		$month = DateTime::createFromFormat("Y-m", date("Y-m"));

		// Додати перевірку правильності параметрів місяця та року
		if(isset($_POST['month']) and isset($_POST['year'])) {
			$date->setDate($_POST['year'], $_POST['month'], 1);
			$month->setDate($_POST['year'], $_POST['month'], 1);
		}

		$p_host = (isset($_GET['p_host'])) ? substr(htmlspecialchars(stripslashes(trim($_GET['p_host']))),0,20) : "ua";

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

	public function getDomCapacity($p_host) {
		$model = new pubdomStat();

		//var_dump($p_host);

		//$p_host = (isset($_GET['p_host'])) ? substr(htmlspecialchars(stripslashes(trim($_GET['p_host']))),0,20) : "ua";

		$json = $model->getPubdomCapacity($p_host);

		//header('Content-Type: application/json; charset=UTF-8');
		//echo $json;
		return $this->response->setJSON($json);
	}
}
