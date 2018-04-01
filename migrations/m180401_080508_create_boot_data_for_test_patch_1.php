<?php

use yii\db\Migration;

/**
 * Class m180401_080508_create_boot_data_for_test_patch_1
 */
class m180401_080508_create_boot_data_for_test_patch_1 extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $category = [
            [
                'id' => 1,
                'tenant_id' => 1,
                'title' => 'Lap Top',
                'slug' => 'lap-top',
                'parent_id' => null,
                'status' => 1,
                'created_at' => 155572664,
                'updated_at' =>155572664,
            ],
            [
                'id' => 2,
                'tenant_id' => 1,
                'title' => 'Smart Phone',
                'slug' => 'smart-phone',
                'parent_id' => null,
                'status' => 1,
                'created_at' => 155572664,
                'updated_at' =>155572664,
            ],
            [
                'id' => 3,
                'tenant_id' => 1,
                'title' => 'Asus',
                'slug' => 'asus',
                'parent_id' => 1,
                'status' => 1,
                'created_at' => 155572664,
                'updated_at' =>155572664,
            ],

        ];
        $product = [
            [
                'id' => 1,
                'tenant_id' => 1,
                'sku' => '9908ab234s',
                'title' => 'Asus CPU i5-4600 ,i7-6400U RAM 4GB/8GB 320SSD/500HDD',
                'slug' => 'asus-cpu-i5-4600--i7-6400-ram-4gb-8gb-320ssd-500hhd',
                'description' => 'no description',
                'category_id' => 3,
                'seller_id' =>1,
                'updater_id' =>1,
                'thumbnail_base_path' => null,
                'thumbnail_path' => null,
                'start_price' => null,
                'sell_price' => 10000000,
                'quantity_available' => 100,
                'quantity_sold' => 0,
                'deal_time' => null,
                'condition_id' => 1,
                'is_free_shipping' => 0,
                'status' => 1,
                'created_at' => 155572664,
                'updated_at' => 155572664,
            ],
            [

                'id' => 2,
                'tenant_id' => 1,
                'sku' => 'poiuytrtrr',
                'title' => 'Iphone 5-5s Unlock',
                'slug' => 'iphone-5-5s-unlock',
                'description' => 'no description',
                'category_id' => 2,
                'seller_id' =>1,
                'updater_id' =>1,
                'thumbnail_base_path' => null,
                'thumbnail_path' => null,
                'start_price' => null,
                'sell_price' => 10000000,
                'quantity_available' => 100,
                'quantity_sold' => 0,
                'deal_time' => null,
                'condition_id' => 1,
                'is_free_shipping' => 0,
                'status' => 1,
                'created_at' => 155572664,
                'updated_at' => 155572664,
            ],
             [

                'id' => 3,
                'tenant_id' => 1,
                'sku' => 'poiuytrtrr',
                'title' => 'Dell 5454 RAM 4GB/8GB 320SSD/500HDD',
                'slug' => 'dell-5454-ram-4gb-8gb-320ssd-500hhd',
                'description' => 'no description',
                'category_id' => 2,
                'seller_id' =>1,
                'updater_id' =>1,
                'thumbnail_base_path' => null,
                'thumbnail_path' => null,
                'start_price' => null,
                'sell_price' => 10000000,
                'quantity_available' => 100,
                'quantity_sold' => 0,
                'deal_time' => null,
                'condition_id' => 1,
                'is_free_shipping' => 0,
                'status' => 1,
                'created_at' => 155572664,
                'updated_at' => 155572664,
            ],
        ];
        $variant = [
            [
                'id' => 1,
                'tenant_id' => 1,
                'name' => 'CPU',
                'alias' => 'cpu',
                'visible' => 1,
                'created_at' => 155572664,
                'updated_at' => 155572664,
            ],
            [
                'id' => 2,
                'tenant_id' => 1,
                'name' => 'RAM',
                'alias' => 'ram',
                'visible' => 1,
                'created_at' => 155572664,
                'updated_at' => 155572664,
            ]   
        
        ];
        $variantValue = [
            [
                'id' => 1,
                'tenant_id' => 1,
                'value' => '2GB',
                'visible' => 1,
                'created_at' => 155572664,
                'updated_at' => 155572664,
            ],
            [
                'id' => 2,
                'tenant_id' => 1,
                'value' => '4GB',
                'visible' => 1,
                'created_at' => 155572664,
                'updated_at' => 155572664,
            ],
            [
                'id' => 3,
                'tenant_id' => 1,
                'value' => 'i7-6400U',
                'visible' => 1,
                'created_at' => 155572664,
                'updated_at' => 155572664,
            ],
            [
                'id' => 4,
                'tenant_id' => 1,
                'value' => '8GB',
                'visible' => 1,
                'created_at' => 155572664,
                'updated_at' => 155572664,
            ],
            [
                'id' => 5,
                'tenant_id' => 1,
                'value' => '12 Inch',
                'visible' => 1,
                'created_at' => 155572664,
                'updated_at' => 155572664,    
            ]
        
        ];

        $this->batchInsert('{{%category}}',[
            'id',
            'tenant_id',
            'title',
            'slug',
            'parent_id',
            'status',
            'created_at',
            'updated_at'
        ],$category);

        $this->batchInsert('{{%product}}',[
            'id',
            'tenant_id',
            'sku',
            'title',
            'slug',
            'description',
            'category_id',
            'seller_id',
            'updater_id',
            'thumbnail_base_path',
            'thumbnail_path',
            'start_price',
            'sell_price',
            'quantity_available',
            'quantity_sold',
            'deal_time',
            'condition_id',
            'is_free_shipping',
            'status',
            'created_at',
            'updated_at',
        ], $product);

        $this->batchInsert('{{%variant}}',[
            'id',
            'tenant_id',
            'name',
            'alias',
            'visible',
            'created_at',
            'updated_at'
        ], $variant);

        $this->batchInsert('{{%variant_value}}',[
            'id',
            'tenant_id',
            'value',
            'visible',
            'created_at',
            'updated_at'
        ], $variantValue);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180401_080508_create_boot_data_for_test cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180401_080508_create_boot_data_for_test cannot be reverted.\n";

        return false;
    }
    */
}
