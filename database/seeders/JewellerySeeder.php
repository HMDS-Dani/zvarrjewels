<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class JewellerySeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Admin User
        User::updateOrCreate(
            ['email' => 'admin@zvarr.com'],
            [
                'name' => 'Zvarr Admin',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );

        // 2. Create Sample Customer User
        User::updateOrCreate(
            ['email' => 'customer@zvarr.com'],
            [
                'name' => 'Ayesha Khan',
                'password' => Hash::make('password123'),
                'role' => 'customer',
            ]
        );

        // 3. Create Categories matching Zvarr Bio
        $categories = [
            [
                'name' => 'Pendants',
                'slug' => 'pendants',
                'description' => 'Heart, floral, and minimalist everyday aesthetic pendants.',
                'image' => 'https://images.unsplash.com/photo-1599643478518-a784e5dc4c8f?w=600&auto=format&fit=crop&q=80',
            ],
            [
                'name' => 'Rings',
                'slug' => 'rings',
                'description' => 'Trendy stackable, solitaire, and crystal adjustable rings.',
                'image' => 'https://images.unsplash.com/photo-1605100804763-247f67b3557e?w=600&auto=format&fit=crop&q=80',
            ],
            [
                'name' => 'Necklaces',
                'slug' => 'necklaces',
                'description' => 'Layered gold chains, lockets, and elegant choker sets.',
                'image' => 'https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?w=600&auto=format&fit=crop&q=80',
            ],
            [
                'name' => 'Earrings',
                'slug' => 'earrings',
                'description' => 'Dainty hoops, pearl studs, and floral drop earrings.',
                'image' => 'https://images.unsplash.com/photo-1630019852942-f89202989a59?w=600&auto=format&fit=crop&q=80',
            ],
            [
                'name' => 'Bracelets & Cuffs',
                'slug' => 'bracelets',
                'description' => 'Watch display cuffs, tulip charm bracelets, and tennis chains.',
                'image' => 'https://images.unsplash.com/photo-1611591475152-478311394749?w=600&auto=format&fit=crop&q=80',
            ],
        ];

        foreach ($categories as $catData) {
            $category = Category::updateOrCreate(['slug' => $catData['slug']], $catData);

            if ($category->slug === 'pendants') {
                Product::updateOrCreate(['slug' => 'elegant-heart-pendant-gold'], [
                    'category_id' => $category->id,
                    'name' => 'Elegant Heart Pendant Chain',
                    'slug' => 'elegant-heart-pendant-gold',
                    'description' => 'Premium 18K gold-plated lightweight heart pendant. Waterproof, anti-tarnish, and perfect for daily wear or gifting.',
                    'price' => 1999.00,
                    'discount_price' => 2499.00,
                    'stock' => 18,
                    'material' => '18K Gold Plated Stainless Steel (Anti-Tarnish)',
                    'image' => 'https://images.unsplash.com/photo-1599643478518-a784e5dc4c8f?w=800&auto=format&fit=crop&q=80',
                    'is_featured' => true,
                ]);

                Product::updateOrCreate(['slug' => 'vintage-floral-bloom-pendant'], [
                    'category_id' => $category->id,
                    'name' => 'Vintage Floral Bloom Pendant',
                    'slug' => 'vintage-floral-bloom-pendant',
                    'description' => 'Delicate engraved flower pendant with sparkling crystal center on a sleek dainty chain.',
                    'price' => 2299.00,
                    'discount_price' => 2799.00,
                    'stock' => 14,
                    'material' => 'Gold Plated Anti-Allergy Alloy',
                    'image' => 'https://images.unsplash.com/photo-1602751584552-8ba73aad10e1?w=800&auto=format&fit=crop&q=80',
                    'is_featured' => true,
                ]);
            }

            if ($category->slug === 'bracelets') {
                Product::updateOrCreate(['slug' => 'pink-tulip-fairy-bracelet'], [
                    'category_id' => $category->id,
                    'name' => 'Pink Tulip Charm Fairy Bracelet',
                    'slug' => 'pink-tulip-fairy-bracelet',
                    'description' => 'As pretty as pink tulips! Rose gold linked chain featuring delicate pastel pink enamel tulips and crystal accents.',
                    'price' => 2199.00,
                    'discount_price' => 2599.00,
                    'stock' => 25,
                    'material' => 'Rose Gold Plated & Pastel Enamel',
                    'image' => 'https://images.unsplash.com/photo-1611591475152-478311394749?w=800&auto=format&fit=crop&q=80',
                    'is_featured' => true,
                ]);

                Product::updateOrCreate(['slug' => 'trendy-watch-display-cuff'], [
                    'category_id' => $category->id,
                    'name' => 'Trendy Watch Display Bangle Cuff',
                    'slug' => 'trendy-watch-display-cuff',
                    'description' => 'Chic minimalist open cuff bangle designed to pair seamlessly with your favorite wristwatch for a stacked luxury look.',
                    'price' => 1799.00,
                    'discount_price' => null,
                    'stock' => 20,
                    'material' => 'High Polish 18K Gold Plated',
                    'image' => 'https://images.unsplash.com/photo-1573408301185-9146fe634ad0?w=800&auto=format&fit=crop&q=80',
                    'is_featured' => true,
                ]);
            }

            if ($category->slug === 'rings') {
                Product::updateOrCreate(['slug' => 'celestial-sparkle-stackable-ring'], [
                    'category_id' => $category->id,
                    'name' => 'Celestial Sparkle Stackable Ring',
                    'slug' => 'celestial-sparkle-stackable-ring',
                    'description' => 'Adjustable premium crystal ring with micro-pave zirconia stones. Gives a high-end luxury diamond feel.',
                    'price' => 1499.00,
                    'discount_price' => 1899.00,
                    'stock' => 30,
                    'material' => 'AAA Zirconia & 18K Gold Finish',
                    'image' => 'https://images.unsplash.com/photo-1605100804763-247f67b3557e?w=800&auto=format&fit=crop&q=80',
                    'is_featured' => true,
                ]);
            }

            if ($category->slug === 'necklaces') {
                Product::updateOrCreate(['slug' => 'dainty-layered-herringbone-choker'], [
                    'category_id' => $category->id,
                    'name' => 'Dainty Layered Herringbone Choker',
                    'slug' => 'dainty-layered-herringbone-choker',
                    'description' => 'Sleek liquid-gold snake chain choker. Premium shine that never fades and elevates every outfit.',
                    'price' => 2499.00,
                    'discount_price' => 2999.00,
                    'stock' => 15,
                    'material' => 'Titanium Steel 18K Gold Plated',
                    'image' => 'https://images.unsplash.com/photo-1599643478518-a784e5dc4c8f?w=800&auto=format&fit=crop&q=80',
                    'is_featured' => true,
                ]);
            }

            if ($category->slug === 'earrings') {
                Product::updateOrCreate(['slug' => 'baroque-pearl-twisted-hoops'], [
                    'category_id' => $category->id,
                    'name' => 'Baroque Pearl Twisted Hoops',
                    'slug' => 'baroque-pearl-twisted-hoops',
                    'description' => 'French vintage inspired gold twisted hoops with detachable freshwater baroque pearls.',
                    'price' => 1899.00,
                    'discount_price' => null,
                    'stock' => 12,
                    'material' => 'Freshwater Pearl & Gold Alloy',
                    'image' => 'https://images.unsplash.com/photo-1630019852942-f89202989a59?w=800&auto=format&fit=crop&q=80',
                    'is_featured' => true,
                ]);
            }
        }
    }
}
