<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContactMessage;

class ContactMessageSeeder extends Seeder {
    public function run() {
        ContactMessage::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '+212600000000',
            'message' => 'Ceci est un message de test.'
        ]);
    }
}
