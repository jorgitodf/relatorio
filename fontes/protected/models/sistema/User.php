<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id_user
 * @property string $full_name
 * @property string $login
 * @property string $pwd
 * @property string $ind_status
 * @property string $create_time
 *
 * The followings are the available model relations:
 * @property UserRole[] $userRoles
 */
class User extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('full_name, login, pwd, ind_status', 'required'),
            array('full_name, create_time', 'length', 'max' => 45),
            array('login', 'length', 'max' => 15),
            array('pwd', 'length', 'max' => 8),
            array('ind_status', 'length', 'max' => 10),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_user, full_name, login, pwd, ind_status, create_time', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'userRoles' => array(self::HAS_MANY, 'UserRole', 'id_user'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id_user' => 'Id User',
            'full_name' => 'Full Name',
            'login' => 'Login',
            'pwd' => 'Pwd',
            'ind_status' => 'Ind Status',
            'create_time' => 'Create Time',
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

        $criteria->compare('id_user', $this->id_user);
        $criteria->compare('full_name', $this->full_name, true);
        $criteria->compare('login', $this->login, true);
        $criteria->compare('pwd', $this->pwd, true);
        $criteria->compare('ind_status', $this->ind_status, true);
        $criteria->compare('create_time', $this->create_time, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
