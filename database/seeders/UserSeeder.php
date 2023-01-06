<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'employment_category_id' => 1,
            'employment_type' => 'Sofkul',
            'email' => 'admin@hrms.com',
            'password' => bcrypt('12345678'),
            'role_id'=>1,
            'account_status'=>1,
        ]);
        
    }
}
