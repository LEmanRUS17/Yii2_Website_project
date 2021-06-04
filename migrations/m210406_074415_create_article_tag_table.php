<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%article_tag}}`.
 */
class m210406_074415_create_article_tag_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Создание полей таблицы:
        $this->createTable('{{%article_tag}}', [
            'id'     => $this->primaryKey(), // Основной ключ - id Элемента
            'article_id'=> $this->integer(),
            'tag_id' => $this->integer()
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'tag_article_article_id',
            'article_tag',
            'article_id'
        );


        // add foreign key for table `user`
        $this->addForeignKey(
            'tag_article_id', // "условное имя" ключа
            'article_tag',    // название текущей таблицы
            'article_id',     // имя поля в текущей таблице, которое будет ключом
            'article',        // имя таблицы, с которой хотим связаться
            'id',          // поле таблицы, с которым хотим связаться
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            'idx_tag_id',
            'article_tag',
            'tag_id'
        );


        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-tag_id', // "условное имя" ключа
            'article_tag',  // название текущей таблицы
            'tag_id',    // имя поля в текущей таблице, которое будет ключом
            'tag',       // имя таблицы, с которой хотим связаться
            'id',        // поле таблицы, с которым хотим связаться
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%article_tag}}');
    }
}
