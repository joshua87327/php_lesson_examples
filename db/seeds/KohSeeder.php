<?php


use Phinx\Seed\AbstractSeed;
use App\Rank;

class KohSeeder extends AbstractSeed
{
    public function run()
    {
        $team = Rank::getTeam();
        //truncate table first
        $this->execute('TRUNCATE TABLE struts2');
        //generate seeding data
        $data = [];
        for ($i = 0; $i < 50; $i++) {
            $rand_keys = array_rand($team);
            $data[] = [
                'name' => $team[$rand_keys],
                'flag' => '0370fa58be225feb01fdc6ff77cd6dcc36b28e5d',
            ];
        }
        $table = $this->table('struts2');
        $table->insert($data)
            ->save();
        $this->execute('TRUNCATE TABLE aspx');
        //generate seeding data
        $data1 = [];
        for ($i = 0; $i < 50; $i++) {
            $rand_keys = array_rand($team);
            $data1[] = [
                'name' => $team[$rand_keys],
                'flag' => '0370fa58be225feb01fdc6ff77cd6dcc36b28e5d',
            ];
        }
        $table = $this->table('aspx');
        $table->insert($data1)
            ->save();
        $this->execute('TRUNCATE TABLE wordpress');
        //generate seeding data
        $data2 = [];
        for ($i = 0; $i < 50; $i++) {
            $rand_keys = array_rand($team);
            $data2[] = [
                'name' => $team[$rand_keys],
                'flag' => '0370fa58be225feb01fdc6ff77cd6dcc36b28e5d',
            ];
        }
        $table = $this->table('wordpress');
        $table->insert($data2)
            ->save();
    }
}
