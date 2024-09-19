<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'SACHEÌ‚S DE MEL CAPILAR - 300 G - 10 SACHEÌ‚S',
            'slug' => 'sache-mel-capilar-300g-10-saches',
            'details' => 'Sachets de mel capilar para cuidado del cabello',
            'description' => 'Sachets de mel capilar de 300g, ideal para tratamiento intensivo del cabello.',
            'price' => 120.00,
            'precio_venta' => 200.00,
            'shipping_cost' => 50.00,
            'sku' => 'CAP-MEL-300G',
            'stock' => 38,
            'category_id' => 1, // Asumo que Capilar tiene ID 1
            'brand_id' => 1, // Asumo que la marca tiene ID 1
            'image_path' => 'Imagen (9).png'
        ]);
        Product::create([
            'name' => 'Condicionador Mel Capilar 300ml',
            'slug' => 'condicionador-mel-capilar-300ml',
            'details' => 'Condicionador de mel para el cabello',
            'description' => 'Condicionador de mel capilar en presentación de 300ml, para un cabello suave y manejable.',
            'price' => 80.00,
            'precio_venta' => 150.00,
            'shipping_cost' => 30.00,
            'sku' => 'COND-MEL-300ML',
            'stock' => 31,
            'category_id' => 1,
            'brand_id' => 1,
            'image_path' => 'Imagen (10).png'
        ]);
        Product::create([
            'name' => 'Shampoo shower Gel imortal 3x1 (cabelo, barba e corpo) 300ml',
            'slug' => 'shampoo-shower-gel-imortal-300ml',
            'details' => 'Shampoo y gel de ducha 3 en 1',
            'description' => 'Shampoo y gel de ducha 3 en 1 para cabello, barba y cuerpo en presentación de 300ml.',
            'price' => 100.00,
            'precio_venta' => 180.00,
            'shipping_cost' => 40.00,
            'sku' => 'SHAM-IMORTAL-300ML',
            'stock' => 23,
            'category_id' => 1,
            'brand_id' => 2, // Asumo que la marca tiene ID 2
            'image_path' => 'Imagen (2).png'
        ]);
        Product::create([
            'name' => 'CREMES DENTAL PERFECT SMILE 50G',
            'slug' => 'cremes-dental-perfect-smile-50g',
            'details' => 'Crema dental para una sonrisa perfecta',
            'description' => 'Crema dental Perfect Smile de 50g para una limpieza efectiva y blanqueamiento dental.',
            'price' => 60.00,
            'precio_venta' => 120.00,
            'shipping_cost' => 20.00,
            'sku' => 'CREME-PERFECT-50G',
            'stock' => 58,
            'category_id' => 2, // Asumo que Higiene personal tiene ID 2
            'brand_id' => 3, // Asumo que la marca tiene ID 3
            'image_path' => 'Imagen (3).png'
        ]);
        Product::create([
            'name' => 'FRESH COTTON - DESODORANTE ANTITRANSPIRANTE 150ML',
            'slug' => 'fresh-cotton-desodorante-150ml',
            'details' => 'Desodorante antitranspirante Fresh Cotton',
            'description' => 'Desodorante antitranspirante Fresh Cotton de 150ml para una protección duradera.',
            'price' => 75.00,
            'precio_venta' => 140.00,
            'shipping_cost' => 25.00,
            'sku' => 'DESODOR-FRESH-150ML',
            'stock' => 34,
            'category_id' => 2,
            'brand_id' => 3,
            'image_path' => 'Imagen (6).png'
        ]);
        Product::create([
            'name' => 'Steady Skin - 90 Cápsulas',
            'slug' => 'steady-skin-90-capsulas',
            'details' => 'Suplemento nutricional Steady Skin',
            'description' => 'Steady Skin en presentación de 90 cápsulas para mejorar la salud de la piel.',
            'price' => 200.00,
            'precio_venta' => 350.00,
            'shipping_cost' => 60.00,
            'sku' => 'STEADY-SKIN-90CAP',
            'stock' => 40,
            'category_id' => 3, // Asumo que Nutricional tiene ID 3
            'brand_id' => 4, // Asumo que la marca tiene ID 4
            'image_path' => 'Imagen (4).png'
        ]);
        Product::create([
            'name' => 'BLUE CALM - 30 CAPSULAS',
            'slug' => 'blue-calm-30-capsulas',
            'details' => 'Suplemento nutricional Blue Calm',
            'description' => 'Blue Calm en presentación de 30 cápsulas para promover la calma y el bienestar.',
            'price' => 150.00,
            'precio_venta' => 280.00,
            'shipping_cost' => 50.00,
            'sku' => 'BLUE-CALM-30CAP',
            'stock' => 27,
            'category_id' => 3,
            'brand_id' => 4,
            'image_path' => 'Imagen (13).png'
        ]);
        Product::create([
            'name' => 'Healthy Woman - 30 Cápsulas De 500mg',
            'slug' => 'healthy-woman-30-capsulas-500mg',
            'details' => 'Suplemento nutricional Healthy Woman',
            'description' => 'Healthy Woman en presentación de 30 cápsulas de 500mg para el bienestar femenino.',
            'price' => 180.00,
            'precio_venta' => 320.00,
            'shipping_cost' => 55.00,
            'sku' => 'HEALTHY-WOMAN-30CAP',
            'stock' => 22,
            'category_id' => 3,
            'brand_id' => 4,
            'image_path' => 'Imagen (4).webp'
        ]);
        Product::create([
            'name' => '521 VIP BLACK 15ML - MASCULINO',
            'slug' => '521-vip-black-15ml-masculino',
            'details' => 'Perfume masculino 521 VIP Black',
            'description' => 'Perfume masculino 521 VIP Black en presentación de 15ml para una fragancia sofisticada.',
            'price' => 250.00,
            'precio_venta' => 400.00,
            'shipping_cost' => 70.00,
            'sku' => '521-VIP-BLK-15ML',
            'stock' => 117,
            'category_id' => 4, // Asumo que Perfumes tiene ID 4
            'brand_id' => 5, // Asumo que la marca tiene ID 5
            'image_path' => 'Imagen (5).webp'
        ]);
        Product::create([
            'name' => 'AMAKHA 521 FOR WOMAN - PARFUM 15ML',
            'slug' => 'amankha-521-for-woman-15ml',
            'details' => 'Perfume femenino AMAKHA 521',
            'description' => 'Perfume femenino AMAKHA 521 en presentación de 15ml para una fragancia elegante.',
            'price' => 240.00,
            'precio_venta' => 390.00,
            'shipping_cost' => 65.00,
            'sku' => 'AMAKHA-521-WOMAN-15ML',
            'stock' => 98,
            'category_id' => 4,
            'brand_id' => 5,
            'image_path' => 'Imagen (5).png'
        ]);
        Product::create([
            'name' => 'Fortune 15ml',
            'slug' => 'fortune-15ml',
            'details' => 'Perfume Fortune 15ml',
            'description' => 'Perfume Fortune en presentación de 15ml con una fragancia sofisticada.',
            'price' => 230.00,
            'precio_venta' => 380.00,
            'shipping_cost' => 60.00,
            'sku' => 'FORTUNE-15ML',
            'stock' => 77,
            'category_id' => 4,
            'brand_id' => 5,
            'image_path' => 'Imagen (3).webp'
        ]);
        Product::create([
            'name' => '521 sexy men parfum 15ml - masculino',
            'slug' => '521-sexy-men-parfum-15ml',
            'details' => 'Perfume masculino 521 Sexy Men',
            'description' => 'Perfume masculino 521 Sexy Men en presentación de 15ml para una fragancia cautivadora.',
            'price' => 220.00,
            'precio_venta' => 370.00,
            'shipping_cost' => 55.00,
            'sku' => '521-SEXY-MEN-15ML',
            'stock' => 92,
            'category_id' => 4,
            'brand_id' => 5,
            'image_path' => 'Imagen (6).webp'
        ]);
        Product::create([
            'name' => 'GEL REDUTOR DE MEDIDAS - MENTOL E CAÌ‚NFORA - 500g',
            'slug' => 'gel-reductor-medidas-mentol-canfora-500g',
            'details' => 'Gel redutor de medidas con mentol y cánfora',
            'description' => 'Gel redutor de medidas con mentol y cánfora en presentación de 500g para reducción de medidas y tonificación.',
            'price' => 180.00,
            'precio_venta' => 320.00,
            'shipping_cost' => 55.00,
            'sku' => 'GEL-REDUCTOR-500G',
            'stock' => 49,
            'category_id' => 5, // Asumo que Produtos diversos tiene ID 5
            'brand_id' => 6, // Asumo que la marca tiene ID 6
            'image_path' => 'Imagen (7).png'
        ]);
        Product::create([
            'name' => 'HYALU DAY- SKIN ALPHA- CREME ANTISSINAIS 30G COM FPS 30',
            'slug' => 'hyalu-day-skin-alpha-creme-antiarrugas-30g',
            'details' => 'Creme antiarrugas con FPS 30',
            'description' => 'Creme antienvejecimiento Hyalu Day-Skin Alpha de 30g con protección solar FPS 30.',
            'price' => 220.00,
            'precio_venta' => 370.00,
            'shipping_cost' => 60.00,
            'sku' => 'HYALU-DAY-30G',
            'stock' => 20,
            'category_id' => 5,
            'brand_id' => 6,
            'image_path' => 'Imagen (7).webp'
        ]);
    }
}
