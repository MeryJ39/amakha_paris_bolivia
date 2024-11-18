<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Insertar productos de ejemplo
        DB::table('products')->insert([
            [
                'name' => 'Colonia Mujer 521 SEXY 15ml',
                'description' => 'Oriental Floral Femenino. La fragancia se lanzó en 2004. La fragancia transmite un aura misteriosa de sensualidad. Se siente extremadamente femenina y seductora, y su perfume es el complemento esencial para reflejar la sensualidad y sofisticación que la caracterizan.',
                'price' => 100.00, // Precio en BS
                'stock' => 50, // Cantidad en inventario
                'image' => 'https://res.cloudinary.com/dqyo3iajp/image/upload/v1731713014/156996-1200-auto_xrggqq.png',
                'subcategory_id' => 1, // Relación con subcategoría 'Hombres' de 'Perfumes'
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Colonia Mujer 521 VIP 15ml',
                'description' => 'El perfume de la mujer auténtica e intrépida, con su fragancia floral golosa, aporta un toque dulce y cautivador a tu día. Esta combinación única de notas florales y golosas crea una experiencia olfativa encantadora que refleja la personalidad vibrante y segura de la mujer moderna. Las notas florales aportan una sensación de frescura y feminidad, mientras que las notas golosas añaden un dulzor reconfortante e irresistible. El resultado es una fragancia a la vez sofisticada y acogedora, perfecta para cualquier ocasión en la que quieras destacar y dejar huella.',
                'price' => 100.00, // Precio en BS
                'stock' => 50, // Cantidad en inventario
                'image' => 'https://res.cloudinary.com/dqyo3iajp/image/upload/v1731713190/158694-1200-auto_x3cmli.webp',
                'subcategory_id' => 1, // Relación con subcategoría 'Hombres' de 'Perfumes'
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Colonia Hombre 521 MEN 15ml',
                'description' => 'Almizcle Floral Amaderado para Hombres. La fragancia se lanzó en 1999. Fragancia irresistible, sorprendentemente masculina, diferente y atractiva. Ideal para el hombre cosmopolita y urbano que huye de lo tradicional sin descuidar la sofisticación y la elegancia.',
                'price' => 100.00, // Precio en BS
                'stock' => 50, // Cantidad en inventario
                'image' => 'https://res.cloudinary.com/dqyo3iajp/image/upload/v1731713338/157688-800-auto_xogfkv.webp',
                'subcategory_id' => 2, // Relación con subcategoría 'Femeninos' de 'Perfumes'
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Colonia Hombre 521 VIP 15ml',
                'description' => 'Oriental Amaderado Masculino. La fragancia se lanzó en 2011. Es la fragancia del hombre VIP: divertido, elegante y carismático, despierta el deseo allá donde va.',
                'price' => 100.00, // Precio en BS
                'stock' => 50, // Cantidad en inventario
                'image' => 'https://res.cloudinary.com/dqyo3iajp/image/upload/v1731713448/159626-800-auto_jth5cw.webp',
                'subcategory_id' => 2, // Relación con subcategoría 'Femeninos' de 'Perfumes'
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Shampoo Miel Capilar',
                'description' => 'Champú para el cabello con miel: para agregar brillo, emoliencia e hidratación al cabello. Activos: Miel, Quinua, Proteína de Trigo y Pantenol. Beneficios: Potente sistema de nutrición capilar que ayuda a fortalecer el folículo, reduce la porosidad del cabello y aporta suavidad e hidratación. Lo que da como resultado brillo, emoliencia e hidratación al cabello. Se recomienda utilizar la línea completa de Hair Honey para obtener resultados aún mejores.',
                'price' => 172.00, // Precio en BS
                'stock' => 100, // Cantidad en inventario
                'image' => 'https://res.cloudinary.com/dqyo3iajp/image/upload/v1731713637/159378-800-auto_yjaawp.png',
                'subcategory_id' => 5, // Relación con subcategoría 'Champús' de 'Cuidado Capilar'
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Acondicionador Miel Capilar',
                'description' => 'Acondicionador de cabello con miel: para agregar brillo, emoliencia e hidratación al cabello. Activos: Miel, Macadamia, Manteca de Cupuaçu y Aminoácidos. Beneficios: Potente sistema de nutrición capilar que reduce la porosidad y fortalece la hebra, reduce el frizz y las puntas abiertas, aportando brillo, emoliencia e hidratación al cabello. Se recomienda utilizar la línea completa de Hair Honey para obtener resultados aún mejores.',
                'price' => 180.50, // Precio en BS
                'stock' => 100, // Cantidad en inventario
                'image' => 'https://res.cloudinary.com/dqyo3iajp/image/upload/v1731713689/159384-800-auto_mc4ipa.png',
                'subcategory_id' => 5, // Relación con subcategoría 'Acondicionadores' de 'Cuidado Capilar'
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}