<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacebookPostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Nafisa',
            'email' => 'nawernafisa8@gmail.com',
            'facebook_id' => '2531578106996211',
            'user_access_token' => 'EAAFAkrzmKBIBAPPglkI0wB8vVzGZCfwGvYL4gj6lIJZBr5nEM7OvpV7UcziZCZCHZA8e9tu0GxHFHR1g6c0LGB5bZA7yy9ZB8IhdP2XMZCrZBxHTxu7RExJu5L5ZCPoe3U8uidnbeHnVkHEODG0CrsvbGkYK8qPPkPDKjllngkHQdyIMZBy1FZBlOfDk',
            'page_access_token' => 'EAAFAkrzmKBIBAJ8pAGwfsTehIXR4Xkzs2ZB2JTG5pbhhz387r2w5zTmeChSrKMhVZCC7DQ3lDxLWy3MykQlEPZBIGEBZCYl7GiyZCk5CPbrN1coIZA9HJVogsqBKglBOksSQRRsr5zXL23HKaMk40VMF7hSVwZBTxVARQHefw13QH99yvLXPqq9',
        ]);
    }
}
