<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('packages')->insert([
            [
                'type' => 'For startups',
                'name' => 'Pro',
                'price' => 199,
                'is_popular' => 1,
                'description' => 'Lorem ipsum dolor sit amet doloroli sitiol conse ctetur adipiscing elit.',
                'lang' => 'en',
                'category_limit' => 10,
                'features' => json_encode([
                    '0' => 'All analytics features',
                    '1' => 'Up to 1,000,000 tracked visits',
                    '2' => 'Premium support',
                    '3' => 'Up to 10 team members',
                ]),
            ],
            [
                'type' => 'For individuals',
                'name' => 'Basic',
                'price' => 99,
                'is_popular' => 0,
                'description' => 'Lorem ipsum dolor sit amet doloroli sitiol conse ctetur adipiscing elit.',
                'lang' => 'en',
                'category_limit' => 3,
                'features' => json_encode([
                    '0' => 'All analytics features',
                    '1' => 'Up to 250,000 tracked visits',
                    '2' => 'Normal support',
                    '3' => 'Up to 3 team members',
                ]),
            ],
            [
                'type' => 'For big companies',
                'name' => 'Enterprise',
                'is_popular' => 0,
                'price' => 399,
                'description' => 'Lorem ipsum dolor sit amet doloroli sitiol conse ctetur adipiscing elit.',
                'lang' => 'en',
                'category_limit' => 50,
                'features' => json_encode([
                    '0' => 'All analytics features',
                    '1' => 'Up to 5,000,000 tracked visits',
                    '2' => 'Dedicated support',
                    '3' => 'Up to 50 team members',
                ]),
            ],
            [
                'type' => 'للاعمال الجديدة',
                'name' => 'محترف',
                'is_popular' => 1,
                'price' => 199,
                'description' => 'Lorem ipsum dolor sit amet doloroli sitiol conse ctetur adipiscing elit.',
                'lang' => 'ar',
                'category_limit' => 10,
                'features' => json_encode([
                    '0' => 'جميع ميزات التحليلات',
                    '1' => 'ما يصل إلى 1,000,000 زيارة متتبعة',
                    '2' => 'دعم متميز',
                    '3' => 'ما يصل إلى 10 أعضاء فريق',
                ]),
            ],
            [
                'type' => 'للاعمال الفردية',
                'name' => 'أساسي',
                'price' => 99,
                'is_popular' => 0,
                'description' => 'Lorem ipsum dolor sit amet doloroli sitiol conse ctetur adipiscing elit.',
                'lang' => 'ar',
                'category_limit' => 3,
                'features' => json_encode([
                    '0' => 'جميع ميزات التحليلات',
                    '1' => 'ما يصل إلى 250,000 زيارة متتبعة',
                    '2' => 'دعم عادي',
                    '3' => 'ما يصل إلى 3 أعضاء فريق',
                ]),
            ],
            [
                'type' => 'للاعمال الكبيرة',
                'name' => 'مَشرُوع',
                'price' => 399,
                'is_popular' => 0,
                'description' => 'Lorem ipsum dolor sit amet doloroli sitiol conse ctetur adipiscing elit.',
                'lang' => 'ar',
                'category_limit' => 30,
                'features' => json_encode([
                    '0' => 'جميع ميزات التحليلات',
                    '1' => 'ما يصل إلى 5,000,000 زيارة متتبعة',
                    '2' => 'دعم مخصص',
                    '3' => 'ما يصل إلى 50 أعضاء فريق',
                ]),
            ],
            [
                'type' => 'Ji bo destpêkê',
                'name' => 'karekî',
                'price' => 199,
                'is_popular' => 1,
                'description' => 'Lorem ipsum dolor sit amet doloroli sitiol conse ctetur adipiscing elit.',
                'lang' => 'kur',
                'category_limit' => 10,
                'features' => json_encode([
                    '0' => 'Hemî taybetmendiyên analîtîk',
                    '1' => 'Zêdetirî 1,000,000 serdanên hatine şopandin',
                    '2' => 'Piştgiriya Premium',
                    '3' => 'Heta 10 endamên tîmê',
                ]),
            ],
            [
                'type' => 'Ji bo kesan',
                'name' => 'Bingehîn',
                'price' => 99,
                'is_popular' => 0,
                'description' => 'Lorem ipsum dolor sit amet doloroli sitiol conse ctetur adipiscing elit.',
                'lang' => 'kur',
                'category_limit' => 3,
                'features' => json_encode([
                    '0' => 'Hemî taybetmendiyên analîtîk',
                    '1' => 'Zêdetirî 250,000 serdanên hatine şopandin',
                    '2' => 'piştgiriya normal',
                    '3' => 'Heta 3 endamên tîmê',
                ]),
            ],
            [
                'type' => 'Ji bo kesan',
                'name' => 'Enterprise',
                'price' => 399,
                'is_popular' => 0,
                'description' => 'Lorem ipsum dolor sit amet doloroli sitiol conse ctetur adipiscing elit.',
                'lang' => 'kur',
                'category_limit' => 30,
                'features' => json_encode([
                    '0' => 'Hemî taybetmendiyên analîtîk',
                    '1' => 'Zêdetirî 5,000,000 serdanên hatine şopandin',
                    '2' => 'piştgiriya fedayî',
                    '3' => 'Heta 50 endamên tîmê',
                ]),
            ],
        ]);
    }
}
