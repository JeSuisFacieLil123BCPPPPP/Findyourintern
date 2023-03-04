<?php
namespace App\Http\Services;
use Rubix\ML\Datasets\Labeled;
use Rubix\ML\Extractors\CSV;
use Rubix\ML\Transformers\NumericStringConverter;


class RandomForestPrediction{

    public function essaie(){

        $dataset = Labeled::fromIterator(new CSV('example.csv', true))->apply(new NumericStringConverter());
    }
  

}

