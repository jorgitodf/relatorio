<?php

/**
 * This is the model class for table "action".
 *
 * The followings are the available columns in table 'action':
 * @property integer $id_action
 * @property string $name
 * @property string $controller_action
 * @property string $ind_status
 *
 * The followings are the available model relations:
 * @property Menu[] $menus
 * @property RoleAction[] $roleActions
 */
class Action extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'action';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_action, name, controller_action', 'required'),
            array('id_action', 'numerical', 'integerOnly' => true),
            array('name, controller_action', 'length', 'max' => 45),
            array('ind_status', 'length', 'max' => 10),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_action, name, controller_action, ind_status', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'menus' => array(self::HAS_MANY, 'Menu', 'id_action'),
            'roleActions' => array(self::HAS_MANY, 'RoleAction', 'id_action'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id_action' => 'Id Action',
            'name' => 'Name',
            'controller_action' => 'Controller Action',
            'ind_status' => 'Ind Status',
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

        $criteria->compare('id_action', $this->id_action);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('controller_action', $this->controller_action, true);
        $criteria->compare('ind_status', $this->ind_status, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Action the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
