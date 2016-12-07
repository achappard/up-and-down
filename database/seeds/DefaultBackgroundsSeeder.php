<?php

use Illuminate\Database\Seeder;

class DefaultBackgroundsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('backgrounds')->insert([
            ['url' => 'https://c2.staticflickr.com/4/3709/10240389155_9db25ce670_h.jpg'],
            ['url' => 'https://c2.staticflickr.com/6/5775/31312494772_ccfb805b00_h.jpg'],
            ['url' => 'https://c2.staticflickr.com/6/5587/31453822595_8a6245cdc3_h.jpg'],
            ['url' => 'https://c2.staticflickr.com/6/5481/31091124240_73817d6a9a_h.jpg'],
            ['url' => 'https://c2.staticflickr.com/6/5605/31425639376_6d05d70176_h.jpg'],
            ['url' => 'https://c2.staticflickr.com/6/5471/30626741034_1924ff8f8e_h.jpg'],
            ['url' => 'https://c2.staticflickr.com/6/5722/30646961803_8112538e53_h.jpg'],
            ['url' => 'https://c2.staticflickr.com/6/5527/31306895122_d414c53bf3_h.jpg'],
            ['url' => 'https://c2.staticflickr.com/6/5778/31342531091_1d64879249_h.jpg'],
            ['url' => 'https://c2.staticflickr.com/6/5616/30658824543_d35454c981_h.jpg'],
            ['url' => 'https://c2.staticflickr.com/6/5721/31462067225_e61cdc0890_h.jpg'],
            ['url' => 'https://c2.staticflickr.com/6/5603/31089163120_49b1912842_h.jpg'],
            ['url' => 'https://c2.staticflickr.com/6/5737/31084948020_fd19ff5ba4_h.jpg'],
            ['url' => 'https://c2.staticflickr.com/6/5565/31423493126_eab5234cbc_h.jpg'],
        ]);
    }
}
