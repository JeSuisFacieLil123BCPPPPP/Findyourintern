<?php

namespace App\Http\Controllers\IA;

use App\Models\Offre;
use Rubix\ML\Classifiers\KNearestNeighbors;
use Rubix\ML\CrossValidation\Metrics\Accuracy;
use Rubix\ML\Datasets\Labeled;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Rubix\ML\Transformers\TextNormalizer;
use Rubix\ML\Transformers\TfIdfTransformer;

class JobOfferValidatorController extends Controller
{
    public function train()
    {
        // Charger les données
        $jobOffers = Offre::all();
        $messages = [];

        foreach ($jobOffers as $jobOffer) {
            $title = $jobOffer->title;
            $description = $jobOffer->description;

            // Ajouter le message à la liste
            $messages[] = [
                "$title $description",
                $jobOffer->active ? 'active' : 'desactive'
            ];
        }

        // Créer un dataset Rubix ML
        $dataset = Labeled::fromIterator($messages)->apply(
            new TextNormalizer(),
            new TfIdfTransformer()
        );

        // Créer le modèle de classification
        $classifier = new KNearestNeighbors(3);

        // Entraîner le modèle en utilisant une validation croisée
        $validator = new Accuracy();
       

$predictions = $estimator->predict($ $dataset);

$metric = new Accuracy();

$score = $metric->score($predictions, $dataset->labels());



       // $score = $validator->test($classifier, $dataset);

        // Sauvegarder le modèle
        $modelPath = storage_path('app/job-offer-validator.model');
        $classifier->save($modelPath);

        return "Modèle entraîné avec succès. Score de validation croisée : $score";
    }

    public function predict(Request $request)
    {
        // Charger le modèle entraîné
        $modelPath = storage_path('app/job-offer-validator.model');
        $classifier = KNearestNeighbors::load($modelPath);

        // Prétraiter le message
        $title = $request->input('title');
        $description = $request->input('description');
        $message = "$title $description";
        $message = (new TextNormalizer())->transform([$message]);
        $message = (new TfIdfTransformer())->transform($message);

        // Prédire la classe du message
        $prediction = $classifier->predict($message)[0];

        return $prediction == 'desactive' ? 'Offre d\'emploi non valide' : 'Offre d\'emploi valide';
    }
}
