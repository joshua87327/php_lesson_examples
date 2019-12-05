<?php


use Phinx\Seed\AbstractSeed;

class TeamSeeder extends AbstractSeed
{
    public function run()
    {
        //'truncate'table'first'
        $this->execute('TRUNCATE TABLE team');
        //'generate'seeding'data
        $faker = Faker\Factory::create();
        $data = [];
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'name' => $faker->unique()->firstName,
                'flag' => $faker->unique()->sha1,
            ];
        }
        $team = $this->table('team');
        $team->insert($data)
             ->save();
    }
}

