<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comment}}`.
 */
class m210407_052506_create_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%comment}}', [
            'id'         => $this->primaryKey(), // Основной ключ - id Элемента
            'text'       => $this->string(),     // Строка        - Текст коментария
            'user_id'    => $this->integer(),    // Целое число   - Автор
            'post_id' => $this->integer(),    // Целое число   - Артикул
            'status'     => $this->integer(),    // Целое число   - Статус
            'date'       => $this->dateTime(),   // Дата_Время    - Время создания
        ]);

        // создание индекса для столбца user_id
        // creates index for column 'user_id'
        $this->createIndex(
            'idx-post-user_id',
            'comment',
            'user_id',
        );

        // добавление внешнего ключа для таблицы 'user'
        // add foreign key for table 'user'
        $this->addForeignKey(
            'fk-post-user_id',
            'comment',
            'user_id',
            'user',
            'id',
            'CASCADE',
        );

        // создание индекса для столбца 'post_id'
        // creates index for column 'post_id'
        $this->createIndex(
            'idx-post_id',
            'comment',
            'post_id',
        );

        // добавление внешнего ключа для таблицы 'post'
        // add foreign key for table 'post'
        $this->addForeignKey(
            'fk-post_id',
            'comment',
            'post_id',
            'post',
            'id',
            'CASCADE',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%comment}}');
    }
}
