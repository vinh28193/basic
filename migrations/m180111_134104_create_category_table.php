<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%category}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%category}}`
 * - `{{%user}}`
 */
class m180111_134104_create_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(512)->notNull(),
            'alias' => $this->string(1024)->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $this->tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%category}}');
    }
}
