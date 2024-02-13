<?php

use Carbon\Carbon;
use Carbon\CarbonInterface;

function formatDeadline($deadline) {
    $date = $deadline->isFuture()
        ? $deadline->diffForHumans(Carbon::now(), ['parts' => 2, 'short' => false, 'options' => CarbonInterface::JUST_NOW | CarbonInterface::ONE_DAY_WORDS | CarbonInterface::TWO_DAY_WORDS])
        : $deadline->diffForHumans();
    return str_replace(['from now', 'after'], ['', ''], $date);
}

function formatDate($date) {
    return $date->format('d M Y');
}

function formatDateTime($date) {
    return $date->format('d M Y, H:i A');
}
