<?php
$prevMonth = DateTime::createFromFormat("Y-m-d", $date->format("Y-m-d"))->sub(new DateInterval('P01M'));
$nextMonth = DateTime::createFromFormat("Y-m-d", $date->format("Y-m-d"))->add(new DateInterval('P01M'));
$prevYear = DateTime::createFromFormat("Y-m-d", $date->format("Y-m-d"))->sub(new DateInterval('P01Y'));
$nextYear = DateTime::createFromFormat("Y-m-d", $date->format("Y-m-d"))->add(new DateInterval('P01Y'));
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
    </style>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <nav class="navbar navbar-dark bg-dark">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <form method="POST" action="/<?= $prevYear->format("Y") ?>/<?= $prevYear->format("n") ?>">
                            <input type="hidden" name="year" value="<?= $prevYear->format("Y") ?>">
                            <input type="hidden" name="month" value="<?= $prevYear->format("n") ?>">
                            <input type="submit" name="back" value="&#8810;" class="btn btn-link text-decoration-none">
                        </form>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="/<?= $prevMonth->format("Y") ?>/<?= $prevMonth->format("n") ?>">
                            <input type="hidden" name="year" value="<?= $prevMonth->format("Y") ?>">
                            <input type="hidden" name="month" value="<?= $prevMonth->format("n") ?>">
                            <input type="submit" name="back" value="&#60;" class="btn btn-link text-decoration-none">
                        </form>
                    </li>
                    <li class="nav-item text-light py-2 px-3">
                        <?= $date->format("Y-m") ?>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="/<?= $nextMonth->format("Y") ?>/<?= $nextMonth->format("n") ?>">
                            <input type="hidden" name="year" value="<?= $nextMonth->format("Y") ?>">
                            <input type="hidden" name="month" value="<?= $nextMonth->format("n") ?>">
                            <input type="submit" name="back" value="&#62;" class="btn btn-link text-decoration-none">
                        </form>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="/<?= $nextYear->format("Y") ?>/<?= $nextYear->format("n") ?>">
                            <input type="hidden" name="year" value="<?= $nextYear->format("Y") ?>">
                            <input type="hidden" name="month" value="<?= $nextYear->format("n") ?>">
                            <input type="submit" name="back" value="&#8811;" class="btn btn-link text-decoration-none">
                        </form>
                    </li>
                </ul>
                <ul class="nav nav-pills float-right">
                    <li>
                        <a class='dropdown-item text-light' href='<?= site_url('/uk') ?>'>Українська</a>
                    </li>
                    <li>
                        <a class='dropdown-item text-light' href='<?= site_url('/en') ?>'>English</a>
                    </li>
                    <li>
                        <a class='dropdown-item text-light' href='<?= site_url('/ru') ?>'>Русский</a>
                    </li>
                </ul>
            </nav>
        </div>