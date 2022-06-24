<?php
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Faker\Generator as faker;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // $tag = ['coding','laravel','css','js','vue'];

        // foreach ($tags as $tag){
        //     $new_tag = new Tag();
        //     $new_tag->name = $tag;
        //     $new_tag->slug = Str::slug($new_tag->name);
        //     $new_tag->save();
        // }

        for ($i=0; $i<10;$i++){
            $tag = new Tag();
            $tag->name =  $faker->word();
            $tag->slug = Str::slug($tag->name, '-');
            $tag->save();
            }
        
        }
    

    
}
