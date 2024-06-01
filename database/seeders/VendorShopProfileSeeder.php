<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorShopProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
           $user = User::where('email', 'vendor@gmail.com')->first();
           $vendor = new Vendor();
           $vendor->banner = 'uploads/560437902_dinersclub.png';
           $vendor->phone = '01222222';
           $vendor->address = 'Rangpur';
           $vendor->email = 'vendor@gmail.com';
           $vendor->description = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat, ab earum. Tenetur, possimus quo. Necessitatibus eveniet laudantium exercitationem voluptas enim corrupti quaerat maxime sapiente nisi blanditiis. Ipsa similique quod fugit!';
           $vendor->fb_link = 'http://localhost:8000/admin/vendor-profile';
           $vendor->tw_link = 'http://localhost:8000/admin/vendor-profile';
           $vendor->insta_link = 'http://localhost:8000/admin/vendor-profile';
           $vendor->user_id = $user->id;
           $vendor->save();
    }
}
