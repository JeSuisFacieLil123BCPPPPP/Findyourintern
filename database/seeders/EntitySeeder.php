<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Entity;
class EntitySeeder extends Seeder
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
                'name' => 'CEFORP Centre de Formation et de Recherche en matière de Population',
                'logo' => 'https://res.cloudinary.com/ddt7qfshl/image/upload/v1667428232/ressources/logo_entities/lcf1ado331vu36qqxee3.png',
            ],
            [
                'id' => 2,
                'name' => 'CIFRED Centre inter-facultaire de Formation et de Recherche en environnement pour le Développement durable',
                'logo' => 'https://res.cloudinary.com/ddt7qfshl/image/upload/v1667428910/ressources/logo_entities/kbtjyvqja7wxbeufwked.jpg',
            ],
            [
                'id' => 3,
                'name' => 'EDP-ECD Ecole Doctorale Pluridisciplinaire : Espace, Culture et Développement',
                'logo' => 'https://res.cloudinary.com/ddt7qfshl/image/upload/v1667429029/ressources/logo_entities/dwk99mn4dtkzdgps6sgk.png',
            ],
            [
                'id' => 4,
                'name' => 'ENAM Ecole Nationale d\'Administration et de Magistrature',
                'logo' => 'https://res.cloudinary.com/ddt7qfshl/image/upload/v1667429188/ressources/logo_entities/arxdvdhreipnlfjm4w4f.jpg',
            ],
            [
                'id' => 5,
                'name' => 'ENEAM Ecole Nationale d \'Economie Appliquée et de Management',
                'logo' => 'https://res.cloudinary.com/ddt7qfshl/image/upload/v1667429257/ressources/logo_entities/yka9qg5pturg3w91ij5o.png',
            ],
            [
                'id' => 6,
                'name' => 'ENS Ecole Normale Supérieure',
                'logo' => 'https://res.cloudinary.com/ddt7qfshl/image/upload/v1667429400/ressources/logo_entities/odhcfbcp8hwmycpfeabz.jpg',
            ],
            [
                'id' => 7,
                'name' => 'ENSTIC Ecole Nationale des Sciences et Techniques de l\'Information et de la Communication',
                'logo' => 'https://res.cloudinary.com/ddt7qfshl/image/upload/v1667429450/ressources/logo_entities/mj1g6ommoh6akqo0kotl.jpg',
            ],
            [
                'id' => 8,
                'name' => 'EPA Ecole du Patrimoine Africain',
                'logo' => 'https://res.cloudinary.com/ddt7qfshl/image/upload/v1667429552/ressources/logo_entities/vomdheenbtpkqut5khnu.jpg',
            ],
            [
                'id' => 9,
                'name' => 'EPAC Ecole Polytechnique d\'Abomey-Calavi
                ',
                'logo' => 'https://res.cloudinary.com/ddt7qfshl/image/upload/v1667429766/ressources/logo_entities/h2auez7cma9sec5uodrf.jpg',
            ],
            [
                'id' => 10,
                'name' => 'FADESP Faculté de Droit et de Sciences Politiques',
                'logo' => 'https://res.cloudinary.com/ddt7qfshl/image/upload/v1667429783/ressources/logo_entities/tfesfxbnywjblwt2zpcx.png',
            ],
            [
                'id' => 11,
                'name' => 'FASEG Faculte des Sciences Economiques et de Gestion',
                'logo' => 'https://res.cloudinary.com/ddt7qfshl/image/upload/v1667429797/ressources/logo_entities/xvvmtyoqzpczczm1n0jy.jpg',
            ],
            [
                'id' => 12,
                'name' => 'FASHS Faculté des Sciences Humaines et Sociales',
                'logo' => 'https://res.cloudinary.com/ddt7qfshl/image/upload/v1667429815/ressources/logo_entities/qgue2d7wum4nqxi3frz4.jpg',
            ],
            [
                'id' => 13,
                'name' => 'FAST Faculté des Sciences et Techniques
                ',
                'logo' => 'https://res.cloudinary.com/ddt7qfshl/image/upload/v1667430150/ressources/logo_entities/dfslpergr60obcamenob.jpg',
            ],
            [
                'id' => 14,
                'name' => 'FLASH/CU **********',
                'logo' => 'https://res.cloudinary.com/ddt7qfshl/image/upload/v1667430167/ressources/logo_entities/avhztmkwzxnbphntok0o.jpg',
            ],
            [
                'id' => 15,
                'name' => 'FLLAC Faculté des Lettres Langues Arts et Communication',
                'logo' => 'https://res.cloudinary.com/ddt7qfshl/image/upload/v1667430182/ressources/logo_entities/g3ui1o1q4b5uvcljtg7x.jpg',
            ],
            [
                'id' => 16,
                'name' => 'FSA Faculté des Sciences Agronomiques',
                'logo' => 'https://res.cloudinary.com/ddt7qfshl/image/upload/v1667430208/ressources/logo_entities/r8uauc1yyrvqctnm60lp.jpg',
            ],
            [
                'id' => 17,
                'name' => 'FSS Faculté des Sciences de la santé
                ',
                'logo' => 'https://res.cloudinary.com/ddt7qfshl/image/upload/v1667430294/ressources/logo_entities/hlrmt6qsfrhpc547xhpy.png',
            ],
            [
                'id' => 18,
                'name' => 'HERCI Haute Ecole Régionale de Commerce International',
                'logo' => 'https://res.cloudinary.com/ddt7qfshl/image/upload/v1667430316/ressources/logo_entities/witbrchrslbji7mfcfhr.png',
            ],
            [
                'id' => 19,
                'name' => 'IC INSTITUT CHINOIS',
                'logo' => 'https://res.cloudinary.com/ddt7qfshl/image/upload/v1667430359/ressources/logo_entities/zwsqetbrgwx8fqqlhxqt.png',
            ],
            [
                'id' => 20,
                'name' => 'IFRI Institut de Formation et de Recherche en Informatique',
                'logo' => 'https://res.cloudinary.com/ddt7qfshl/image/upload/v1667430364/ressources/logo_entities/sxappgwqj5gyisnyxttz.jpg',
            ],
            [
                'id' => 21,
                'name' => 'IGATE Institut de Géographie de l\'Aménagement du Territoire et de l\'Environnement
                ',
                'logo' => 'https://res.cloudinary.com/ddt7qfshl/image/upload/v1667430402/ressources/logo_entities/rl9frvyf0pylfqns10ok.png',
            ],
            [
                'id' => 22,
                'name' => 'ILACI Institut de Langue Arabe et Culture Islamique',
                'logo' => 'https://res.cloudinary.com/ddt7qfshl/image/upload/v1667430416/ressources/logo_entities/ss7x421ss0fkfyfbiqg9.png',
            ],
            [
                'id' => 23,
                'name' => 'IMSP Institut de Mathématiques et de Sciences Physiques',
                'logo' => 'https://res.cloudinary.com/ddt7qfshl/image/upload/v1667430427/ressources/logo_entities/cy9akv4t5jokj2acippw.png',
            ],
            [
                'id' => 24,

                'name' => 'INE Institut National de l\'Eau',
                'logo' => 'https://res.cloudinary.com/ddt7qfshl/image/upload/v1667430446/ressources/logo_entities/odpbsnw49ldowkpashft.jpg',
            ],
            [
                'id' => 25,
                'name' => '
                INJEPS Institut National de la Jeunesse, de l\'Education Physique et du Sport',
                'logo' => 'https://res.cloudinary.com/ddt7qfshl/image/upload/v1667430463/ressources/logo_entities/trlvgvsw3bcptujuyikt.jpg',
            ],
            [
                'id' => 26,
                'name' => 'INMAAC Institut National des Métiers d\'Art, d\'Archéologie et de la Culture
                ',
                'logo' => 'https://res.cloudinary.com/ddt7qfshl/image/upload/v1667430478/ressources/logo_entities/by73lexp5omolryyz1ya.png',
            ],
            [
                'id' => 27,
                'name' => '
                INMeS Institut National Médico-Sanitaire',
                'logo' => 'https://res.cloudinary.com/ddt7qfshl/image/upload/v1667430515/ressources/logo_entities/yjr83kjctvs194efocis.jpg',
            ],
            [
                'id' => 28,
                'name' => 'IRSP Institut Régional de Santé Publique',
                'logo' => 'https://res.cloudinary.com/ddt7qfshl/image/upload/v1667430534/ressources/logo_entities/xybrnpzfausrontlg32o.png',
            ],
            [
                'id' => 29,
                'name' => 'UNESCO Chaire UNESCO Bénin',
                'logo' => 'https://res.cloudinary.com/ddt7qfshl/image/upload/v1667430554/ressources/logo_entities/qgvyx8uf7a4aahma4dpe.jpg',
            ],
        ];
       Entity::insert($data);
    }
}
//EPAC Ecole Polytechnique d'Abomey-Calavi



