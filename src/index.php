<?php

namespace Sample;

use Sample\Hello\SampleClass;

require 'vendor/autoload.php';

$sampleClass = new SampleClass();

echo $sampleClass->sampleMethod();
