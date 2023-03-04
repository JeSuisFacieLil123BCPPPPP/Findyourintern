<?php

namespace Database\Seeders;

use App\Models\Filiere;
use Illuminate\Database\Seeder;

class FiliereSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'name' => 'Dynamique de  Population et planification Régionale',
                'entity_id' => 1,
            ],
            [
                'id' => 2,
                'name' => 'Environnement, Hygiène et Santé publique',
                'entity_id' => 2,
            ],
            [
                'id' => 3,
                'name' => 'Administration Générale',
                'entity_id' => 4,
            ],
            [
                'id' => 4,
                'name' => 'Administration des Finances',
                'entity_id' => 4,
            ],
            [
                'id' => 5,
                'name' => 'Assistant de Direction',
                'entity_id' => 4,
            ],
            [
                'id' => 6,
                'name' => 'Sciences et Techniques de l’Information documentaire',
                'entity_id' => 4,
            ],
            [
                'id' => 7,
                'name' => 'Administration des Réseaux informatiques',
                'entity_id' => 5,
            ],
            [
                'id' => 8,
                'name' => 'Analyse Informatique et Programmation',
                'entity_id' => 5,
            ],
            [
                'id' => 9,
                'name' => 'Assurance
                ',
                'entity_id' => 5,
            ],
            [
                'id' => 10,
                'name' => 'Banque et Finance du Marché ',
                'entity_id' => 5,
            ],
            [
                'id' => 11,
                'name' => ' Banque et Institutions des Micro finances',
                'entity_id' => 5,
            ],
            [
                'id' => 12,
                'name' => 'Force de Vente (Marketing)',
                //'logo' => 'https://res.cloudinary.com/ddt7qfshl/image/upload/v1667429815/ressources/logo_entities/qgue2d7wum4nqxi3frz4.jpg',
                'entity_id' => 5,
            ],
            [
                'id' => 13,
                'name' => 'Gestion des Ressources Humaines
                ',
                'entity_id' => 5,
                //'logo' => 'https://res.cloudinary.com/ddt7qfshl/image/upload/v1667430150/ressources/logo_entities/dfslpergr60obcamenob.jpg',
            ],
            [
                'id' => 14,
                'name' => 'Gestion des Transports',
                'entity_id' => 5,
                //'logo' => 'https://res.cloudinary.com/ddt7qfshl/image/upload/v1667430167/ressources/logo_entities/avhztmkwzxnbphntok0o.jpg',
            ],
            [
                'id' => 15,
                'name' => 'Gestion de Logistique',
                'entity_id' => 5,
                //'logo' => 'https://res.cloudinary.com/ddt7qfshl/image/upload/v1667430182/ressources/logo_entities/g3ui1o1q4b5uvcljtg7x.jpg',
            ],
            [
                'id' => 16,
                'name' => 'Statistique Economique et Sectorielle',
                'entity_id' => 5,
                //'logo' => 'https://res.cloudinary.com/ddt7qfshl/image/upload/v1667430208/ressources/logo_entities/r8uauc1yyrvqctnm60lp.jpg',
            ],
            [
                'id' => 17,
                'name' => 'Statistique Démographique et Sociale
                ',
                'entity_id' => 5,
               // 'logo' => 'https://res.cloudinary.com/ddt7qfshl/image/upload/v1667430294/ressources/logo_entities/hlrmt6qsfrhpc547xhpy.png',
            ],
            [
                'id' => 18,
                'name' => 'Planification et Gestion des projets',
                'entity_id' => 5,
               // 'logo' => 'https://res.cloudinary.com/ddt7qfshl/image/upload/v1667430316/ressources/logo_entities/witbrchrslbji7mfcfhr.png',
            ],
            [
                'id' => 19,
                'name' => 'Planification et Economie du Développement Durable ',
                'entity_id' => 5,
                //'logo' => 'https://res.cloudinary.com/ddt7qfshl/image/upload/v1667430359/ressources/logo_entities/zwsqetbrgwx8fqqlhxqt.png',
            ],
            [
                'id' => 20,
                'name' => 'Développement Local et Régional ',
                'entity_id' => 5,
               // 'logo' => 'https://res.cloudinary.com/ddt7qfshl/image/upload/v1667430364/ressources/logo_entities/sxappgwqj5gyisnyxttz.jpg',
            ],
            [
                'id' => 21,
                'name' => 'Gestion comptable et financière
                ',
                'entity_id' => 5,
                //'logo' => 'https://res.cloudinary.com/ddt7qfshl/image/upload/v1667430402/ressources/logo_entities/rl9frvyf0pylfqns10ok.png',
            ],
            [
                'id' => 22,
                'name' => 'Mathématique-Informatique',
                'entity_id' => 6,
                //'logo' => 'https://res.cloudinary.com/ddt7qfshl/image/upload/v1667430416/ressources/logo_entities/ss7x421ss0fkfyfbiqg9.png',
            ],
            [
                'id' => 23,
                'name' => 'Physique Chimie',
                'entity_id' => 6,
               // 'logo' => 'https://res.cloudinary.com/ddt7qfshl/image/upload/v1667430427/ressources/logo_entities/cy9akv4t5jokj2acippw.png',
            ],
            [
                'id' => 24,

                'name' => 'Sciences de la Vie et de la Terre',
                'entity_id' => 6,
                //'logo' => 'https://res.cloudinary.com/ddt7qfshl/image/upload/v1667430446/ressources/logo_entities/odpbsnw49ldowkpashft.jpg',
            ],
            [
                'id' => 25,
                'name' => '
                Journaliste',
                'entity_id' => 7,
                //'logo' => 'https://res.cloudinary.com/ddt7qfshl/image/upload/v1667430463/ressources/logo_entities/trlvgvsw3bcptujuyikt.jpg',
            ],
            [
                'id' => 26,
                'name' => '
                Scénariste multimédia
                ',
                'entity_id' => 7,
                //'logo' => 'https://res.cloudinary.com/ddt7qfshl/image/upload/v1667430478/ressources/logo_entities/by73lexp5omolryyz1ya.png',
            ],
            [
                'id' => 27,
                'name' => '
                Gestion du patrimoine culturel',
                'entity_id' => 8,
            ],
            [
                'id' => 28,
                'name' => 'Génie civil',
                'entity_id' => 9,
            ],
            [
                'id' => 29,
                'name' => 'Génie Electrique',
                'entity_id' => 9,
            ],
            [
                'id' => 30,
                'name' => 'Génie mécanique et Energétique',
                'entity_id' => 9,
            ],
            [
                'id' => 31,
                'name' => 'Génie Informatique et Télécom',
                'entity_id' => 9,
            ],
            [
                'id' => 32,
                'name' => 'Génie de l\'Environnement',
                'entity_id' => 9,
            ],
            [
                'id' => 33,
                'name' => 'Génie Chimique procédés',
                'entity_id' => 9,
            ],
            [
                'id' => 34,
                'name' => 'Génie Logiciel',
                'entity_id' => 20,
            ],
            [
                'id' => 35,
                'name' => 'Sécurité Informatique',
                'entity_id' => 20,
            ],
            [
                'id' => 36,
                'name' => 'Internet et Mutimédia',
                'entity_id' => 20,
            ],
        ];
      Filiere::insert($data);
    }
}
