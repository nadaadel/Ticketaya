<?php

use Illuminate\Database\Seeder;
use App\Article;
class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Article::create([
           'title'=>'Mohamed Salah indicates he has not forgiven Sergio Ramos following Champions League final clash',
           'description'=>'
           Mohamed Salah says he has not buried the hatchet with Sergio Ramos following their tangle in the Champions League final which left the Liverpool forward injured.
           Ramos came in for criticism following Real Madrid\'s 3-1 win in Kiev last month as he was involved in a challenge with Reds talisman Salah that left the Egypt international in tears as he departed with an injured shoulder.
           Spain captain Ramos was accused by some critics of deliberately causing the injury and was later involved in an incident with Liverpool goalkeeper Loris Karius, whose two mistakes then allowed Madrid to claim a third-straight European title.',
           'photo'=>'photo',
           'user_id'=>'1',
           'category_id'=>'1',


       ]);
    }
}
