<?php

namespace Database\Seeders;

use Illuminate\Support\Str;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;
use App\Models\User;
use App\Models\Company;
use App\Models\Admin;
use App\Models\Student;
use App\Models\Phone;

use App\Models\Image;
use App\Models\Comments;
use App\Models\Realisations;

use App\Models\Subcategory;
use App\Models\Category;
use App\Models\File;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    //des entreprises
    User::factory()
      ->count(3)
      ->state(new Sequence(
        [
          'user_type' => 'company',
        ]
      ))->has(Company::factory(), 'company')->has(Phone::factory(), 'phone')->create();
    // des administrateurs
    User::factory()
      ->count(3)
      ->state(new Sequence(
        [
          'user_type' => 'admin',
        ]
      ))->has(Admin::factory(), 'admin')->has(Phone::factory(), 'phone')->create();

    // des étudiants
    User::factory()
      ->count(3)
      ->state(new Sequence(
        [
          'user_type' => 'student',
        ]
      ))->has(Student::factory(), 'student')->has(Phone::factory(), 'phone')->create();
    //comptes users normaux
    User::factory()
      ->count(3)
      ->state(new Sequence(
        [
          'user_type' => 'normal',
        ]
      ))->has(Phone::factory(), 'phone')->create();

    //un user
    $user = User::factory()
      ->state(new Sequence(
        [
          'user_type' => 'student',
        ]
      ))->has(Phone::factory(), 'phone')->create();

    //des categories
    /*$categories = Category::factory()
      ->count(4)->create();

    //des sous-categories
    $subcategories = Subcategory::factory()
      ->count(3)
      ->for(Category::factory()->create())
      ->create();
    //une sous-categorie
    $subcategorie = Subcategory::factory()
      ->for(Category::factory()->create())
      ->create();*/

      $this->call([
       EntitySeeder::class,
       FiliereSeeder::class
    ]);
    //des realisations
    /*$realisations = Realisations::factory()
      ->count(3)
      ->for(Subcategory::factory()->for(Category::factory()->create())->create(), 'subcategory')
      ->for($user, 'user')
      ->has(File::factory(), 'video')
      ->has(File::factory(), 'documents')
      ->create();
    //une realisation
    $realisation = Realisations::factory()
      ->for(Subcategory::factory()->for(Category::factory()->create())->create(), 'subcategory')
      ->for($user, 'user')->create();
     // ->has(File::factory(), 'file')->create();

    //des images
    $images = Image::factory()->count(3)->for(
      $realisation,
      'imageable'
    )->create();

    //un user qui like et qui envoie yun message
    User::factory()
      ->state(new Sequence(
        [
          'user_type' => 'student',
        ]
      ))
      ->hasAttached($realisation, ['nbr_like' => 300], 'realisationLike',)
      ->hasAttached($user, ['body' => Str::random(10),], 'messageSend',)
      ->create();
      
    //des commentaires d'un user
    Comments::factory()->count(3)->state(new Sequence(
      [
        'realisation_id' => 1,
        'realisation_id' => 2,
        'realisation_id' => 3,
      ]
    ))->for($user, 'user')->create();*/
  }
}
