<?php

/**
 * This is the model class for table "role_action".
 *
 * The followings are the available columns in table 'role_action':
 * @property integer $idrole_action
 * @property integer $id_role
 * @property integer $id_action
 *
 * The followings are the available model relations:
 * @property Action $idAction
 * @property Role $idRole
 */
class RoleAction extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'role_action';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('idrole_action, id_role, id_action', 'required'),
            array('idrole_action, id_role, id_action', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('idrole_action, id_role, id_action', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'idAction' => array(self::BELONGS_TO, 'Action', 'id_action'),
            'idRole' => array(self::BELONGS_TO, 'Role', 'id_role'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'idrole_action' => 'Idrole Action',
            'id_role' => 'Id Role',
            'id_action' => 'Id Action',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('idrole_action', $this->idrole_action);
        $criteria->compare('id_role', $this->id_role);
        $criteria->compare('id_action', $this->id_action);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return RoleAction the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
