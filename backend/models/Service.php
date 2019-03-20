<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "price".
 *
 * @property int $id ID
 * @property int $code Код
 * @property int $price Цена
 * @property string $desc Описание
 * @property int $status Статус (включена/выключена)
 * @property string $data_duration Срок действия
 * @property string $city Город действия
 */
class Service extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'price';
    }

    public static function queryHistory($id)
    {
        $query = (new \yii\db\Query())
            ->select(['*'])
            ->from('history')->where(['id' => $id])->orderBy(['data_edit' => SORT_DESC])->all();
        return $query;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'price', 'status', 'data_duration'], 'required'],
            [['code', 'price', 'status'], 'integer'],
            [['desc'], 'string'],
            [['code', 'price', 'status', 'data_duration'], 'safe'],
            [['city'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Код',
            'price' => 'Цена',
            'desc' => 'Описание',
            'status' => 'Статус',
            'data_duration' => 'Срок действия',
            'city' => 'Город действия',
        ];
    }

    //Для API фильтрация, из-за пустого возврата работает...
    public function formName()
    {
        return '';
    }

    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            Yii::$app->session->setFlash('success', 'Запись добавлена');
        } else {
            $res = [];
            foreach ($changedAttributes as $change => $val) {
                if (trim($val) != trim($this->{$change})) {
                    $res[$change] = $val . ' -> ' . $this->{$change};
                }
            }
            if (!empty($res)) {
                Yii::$app->db->createCommand()->insert('history', [
                    'price' => $res['price'],
                    'desc' => $res['desc'],
                    'status' => $res['status'],
                    'data_edit' => date("Y-m-d H:i:s"),
                    'city' => $res['city'],
                    'id' => $this->id,
                    'user' => Yii::$app->user->identity->username,
                    'data_duration' => $res['data_duration']
                ])->execute();
            }
            Yii::$app->session->setFlash('success', 'Запись обновлена');
        }

        parent::afterSave($insert, $changedAttributes);
    }
}
