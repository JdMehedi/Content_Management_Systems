<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\Tag;
use App\Category;
class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category1= Category::create([
            'name'=>'News'
        ]);

            $author1 = App\User::create([
                'name'=>'Mehedi hasan',
                'email'=>'mehedi@gmail.com',
                'password'=> '12345678'

            ]);

            $author2 = App\User::create([
                'name'=>'Mehedi milon',
                'email'=>'mehedi1@gmail.com',
                'password'=> '12345678'

            ]);

            $author3 = App\User::create([
                'name'=>'Mehedi ',
                'email'=>'mehedi2@gmail.com',
                'password'=> '12345678'

            ]);

            $author4 = App\User::create([
                'name'=>' Hasan',
                'email'=>'mehedi3@gmail.com',
                'password'=> '12345678'

            ]);

        $category2= Category::create([
            'name'=>'Design'
        ]);
        $category3= Category::create([
            'name'=>'Partnership'
        ]);
        $category4= Category::create([
            'name'=>'Laravel'
        ]);
      

        $post1 = Post::create([
            'title'=>'We relocated our office to a new designed garage',
            'description'=>'Lorem ipusm doller',
            'content'=> 'Lorem ipusm doller',
            'category_id'=>$category1->id,
            'image'=>'posts/6.jpg',
            'user_id'=>$author1->id 

        ]);
        $post2 = $author2->posts()->create([
            'title'=>'Top 5 brilliant content marketing strategies',
            'description'=>'Lorem ipusm doller',
            'content'=> 'Lorem ipusm doller',
            'category_id'=>$category2->id,
            'image'=>'posts/7.jpg'

        ]);
        $post3 = $author3->posts()->create([
            'title'=>'Best practices for minimalist design with example',
            'description'=>'Lorem ipusm doller',
            'content'=> 'Lorem ipusm doller',
            'category_id'=>$category3->id,
            'image'=>'posts/8.jpg'

        ]);

        $post4 = $author4->posts()->create([
            'title'=>'Best practices for minimalist design with example',
            'description'=>'Lorem ipusm doller',
            'content'=> 'Lorem ipusm doller',
            'category_id'=>$category4->id,
            'image'=>'posts/9.jpg'

        ]);

        $tag1= Tag::create([
            'name'=>'Job'
        ]);

        $tag2= Tag::create([
            'name'=>'Record'
        ]);

        $tag3= Tag::create([
            'name'=>'Customers'
        ]);
        $tag4= Tag::create([
            'name'=>'Seller'
        ]);


        $post1->tags()->attach([$tag1->id, $tag2->id]);
        $post2->tags()->attach([$tag2->id, $tag3->id]);
        $post3->tags()->attach([$tag1->id, $tag3->id]);
        $post4->tags()->attach([$tag3->id, $tag4->id]);
    }
}
