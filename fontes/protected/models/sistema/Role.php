<?php

/**
 * This is the model class for table "role".
 *
 * The followings are the available columns in table 'role':
 * @property integer $id_role
 * @property string $name
 * @property string $ind_status
 *
 * The followings are the available model relations:
 * @property RoleAction[] $roleActions
 * @property UserRole[] $userRoles
 */
class Role extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'role';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_role, name', 'required'),
            array('id_role', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 45),
            array('ind_status', 'length', 'max' => 10),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_role, name, ind_status', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'roleActions' => array(self::HAS_MANY, 'RoleAction', 'id_role'),
            'userRoles' => array(self::HAS_MANY, 'UserRole', 'id_role'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id_role' => 'Id Role',
            'name' => 'Name',
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

        $criteria->compare('id_role', $this->id_role);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('ind_status', $this->ind_status, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Role the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
