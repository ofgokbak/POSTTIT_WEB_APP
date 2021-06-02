<?php

use Illuminate\Database\Seeder;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Posts::create([
            'user_id' => 1,
            'title' => 'Next-gen console SSDs are changing how games are written, and that could be good for PC',
            'description' => 'It will still be several months before next-generation game consoles arrive, but already much has been made about the shift to NVMe SSD storage, and the potential implication that could have for PC gaming. The PlayStation 5 and Xbox Series X are essentially PCs in console digs, after all. It will take some time to realize the full impact of this shift, but in the meantime, one interesting bit of information has emerged—Epic Games revealed it rewrote key parts of Unreal Engine 5 "with the PlayStation 5 in mind.',
            'vote_count' => 24,
            'topic' => 'Gaming',
            'image' => 'uploads/aLycAy7iBcVb6SOal3pQDkGG5dlg6h8HuD486Uyc.jpeg'

        ]);

        App\Posts::create([
            'user_id' => 1,
            'title' => 'Next-gen console SSDs are changing how games are written, and that could be good for PC',
            'description' => 'It will still be several months before next-generation game consoles arrive, but already much has been made about the shift to NVMe SSD storage, and the potential implication that could have for PC gaming. The PlayStation 5 and Xbox Series X are essentially PCs in console digs, after all. It will take some time to realize the full impact of this shift, but in the meantime, one interesting bit of information has emerged—Epic Games revealed it rewrote key parts of Unreal Engine 5 "with the PlayStation 5 in mind.',
            'vote_count' => 24,
            'topic' => 'Gaming',
            'image' => 'uploads/aLycAy7iBcVb6SOal3pQDkGG5dlg6h8HuD486Uyc.jpeg'

        ]);

        App\Posts::create([
            'user_id' => 1,
            'title' => 'Next-gen console SSDs are changing how games are written, and that could be good for PC',
            'description' => 'It will still be several months before next-generation game consoles arrive, but already much has been made about the shift to NVMe SSD storage, and the potential implication that could have for PC gaming. The PlayStation 5 and Xbox Series X are essentially PCs in console digs, after all. It will take some time to realize the full impact of this shift, but in the meantime, one interesting bit of information has emerged—Epic Games revealed it rewrote key parts of Unreal Engine 5 "with the PlayStation 5 in mind.',
            'vote_count' => 24,
            'topic' => 'Gaming',
            'image' => 'uploads/aLycAy7iBcVb6SOal3pQDkGG5dlg6h8HuD486Uyc.jpeg'

        ]);
    }
}
