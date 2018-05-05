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
        $tenant = [
            [
                'tenant_id' => 1,
                'tenant_code' => 'basic.beta.vn',
                'tenant_name' => 'BASIC DEV',
                'tenant_name_short' => 'basic',
                'language_code' => 'en',
                'run_mode' => 'dev',
                'created_at' => 1102697940,
                'updated_at' => 1176451486,
            ]
        ];

        $users = [
            [
                'id' => 1,
                'tenant_id' => 1,
                'username' => 'webmaster',
                'email' => 'webmaster@example.org',
                'phone' => '627.761.2083',
                'oauth_id' => '123456789123456',
                'oauth_secret' => 'iGVQfwmmxbj1KL_m2I_eMAuVDixVpIma',
                'access_token' => 'tWJ2c-BlPnztzXPoc1CXNdPzOwLBrjwZqvLAqEURjCUIrQsIDHODIsg9YXu1wOo24p8UD5JZc12j-DluycYdVZo1tsGUKASZFpnJ',
                'auth_key' => '9vo2yirCvnX6lFMXjxUhPlf3uu7XNSOv',
                'password_hash' => '$2y$13$VnLT62YdhKy.RHHDLN0MEezggGKZZKQFmPVu5d.5ODTwBGSx7WcW6',
                'password_reset_token' => 'FuLEb2xvDWL6XLTmdY1lVeyJru7EIgm9Sj6zhXko36PUvYoFn8mXA7_ww3ej',
                'status' => 1,
                'created_at' => 155572664,
                'verified_at' => 1195929933,
            ],
            [
                'id' => 2,
                'tenant_id' => 1,
                'username' => 'manager',
                'email' => 'manager@example.org',
                'phone' => '789-427-7483 x60418',
                'oauth_id' => '123456789123456',
                'oauth_secret' => 'gmKQZvLTHBzwy4cjpZAOUuiFIeTL_94t',
                'access_token' => 'hNr69kh01nP1P_LnpHhiXEPdxgdtjA81s7LqLPEbRBV05P_mTiFjm_9MJV3PwADMPhNzZurOqsbB6fUHuLou7AAM-N778cKBMAvL',
                'auth_key' => 'mquOqrDK7lK4QcgYfyLCdUQKfUCpRILH',
                'password_hash' => '$2y$13$N785qekuqJzo2CsP7K0g/.KtWZ8SwZtqITdTPrHBFITYjX9WYnl5i',
                'password_reset_token' => '_cCJoNGS-kiKQdEaVa1_xLzWou7unSWZplctVmcKB_fFAriN5sl-0l8_hR82',
                'status' => 1,
                'created_at' => 458502022,
                'verified_at' => 955095939,
            ],
            [
                'id' => 3,
                'tenant_id' => 1,
                'username' => 'user',
                'email' => 'user@example.org',
                'phone' => '(381) 831-8712 x45152',
                'oauth_id' => '123456789123456',
                'oauth_secret' => 'AxB2f_zgMhobWm69_9b3N99GYNFS97Qj',
                'access_token' => '2rtqpcOYCbxd5IpRk8NvoXvobRoixnHXtl4WlRGzYDHvWOYJ0sPsX4IxEx3o0r4lvGkEIpR-nv_9fFxTtt7_NHPwkTKr5kj7mCVm',
                'auth_key' => 'ZMKD1WLDwAxpWj5cs5LWRKrmnuWp8sN_',
                'password_hash' => '$2y$13$tJKZTKUQ5DBFWNkkjd0goup.p8Tx5d9Mj/wWL6Vv8/Q038zk7g5.6',
                'password_reset_token' => 'HOm3BvV_BZk4HzINBEu7tPvnflYme0h2v2mAOE-CrITGUnmt_bWI4EnqwH0F',
                'status' => 1,
                'created_at' => 1494302731,
                'verified_at' => 929949710,
            ],
        ];

        $userProfile = [
            [
                'user_id' => 1,
                'tenant_id' => 1,
                'first_name' => 'Clovis',
                'last_name' => 'Mueller',
                'avatar_path' => '?89116',
                'avatar_base_url' => 'http://lorempixel.com/450/450',
                'identity_code' => 'BI',
                'birthday' => 987328783,
                'address' => '814 Juliet Via Suite 358
        Eltonhaven, KY 16580',
                'bio' => 'I should like to drop the jar for fear of killing.',
                'locale' => 'am_ET',
                'gender' => 0,
                'updated_at' => 593793304,
            ],
            [
                'user_id' => 2,
                'tenant_id' => 1,
                'first_name' => 'Elliot',
                'last_name' => 'Treutel',
                'avatar_path' => '?33226',
                'avatar_base_url' => 'http://lorempixel.com/450/450',
                'identity_code' => 'VA',
                'birthday' => 353668320,
                'address' => '22008 Mable Via Suite 676
        Lake Kylaview, VA 01928',
                'bio' => 'CHAPTER XII. Alice\'s Evidence \'Here!\' cried Alice, with a.',
                'locale' => 'sq_AL',
                'gender' => 1,
                'updated_at' => 670133392,
            ],
            [
                'user_id' => 3,
                'tenant_id' => 1,
                'first_name' => 'Davin',
                'last_name' => 'Swaniawski',
                'avatar_path' => '?59505',
                'avatar_base_url' => 'http://lorempixel.com/450/450',
                'identity_code' => 'MV',
                'birthday' => 823979327,
                'address' => '5894 Hickle Vista Apt. 236
        North Janickview, WA 69479-7825',
                'bio' => 'She took down a very melancholy voice. \'Repeat, "YOU ARE.',
                'locale' => 'ur_IN',
                'gender' => 0,
                'updated_at' => 949723362,
            ]
        ];

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
                'thumbnail_base_path' => 'uploads',
                'thumbnail_path' => 'products/no-product.jpg',
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
                'thumbnail_base_path' => 'uploads',
                'thumbnail_path' => 'products/no-product.jpg',
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
                'thumbnail_base_path' => 'uploads',
                'thumbnail_path' => 'products/no-product.jpg',
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

        $this->batchInsert('{{%tenant}}',[
           'tenant_id',
            'tenant_code',
            'tenant_name',
            'tenant_name_short',
            'language_code',
            'run_mode',
            'created_at',
            'updated_at',
        ],$tenant);

        $this->batchInsert('{{%user}}',[
            'id',
            'tenant_id',
            'username',
            'email',
            'phone',
            'oauth_id',
            'oauth_secret',
            'access_token',
            'auth_key',
            'password_hash',
            'password_reset_token',
            'status',
            'created_at',
            'verified_at',
        ],$users);

        $this->batchInsert('{{%user_profile}}',[
            'user_id',
            'tenant_id',
            'first_name',
            'last_name',
            'avatar_path',
            'avatar_base_url',
            'identity_code',
            'birthday',
            'address',
            'bio',
            'locale',
            'gender',
            'updated_at',
        ],$userProfile);

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
