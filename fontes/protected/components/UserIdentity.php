<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */

class UserIdentity extends CUserIdentity {

    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    public function authenticate() {
        $users = array(
            // username => password
            'cvm' => 'CVMios123',
            'iphan' => 'IPHANios123',
            'terracap' => 'Terracap@123',
            'ancine' => 'ANCINEios123',
            'Ancine' => 'Ancine@123',
            'ios' => 'IOS@123',
            'anatel' => 'Anatel@123',
            'fraport' => 'Fraport@123',
            'funarte' => 'Funarte@123'
        );
        if (!isset($users[$this->username]))
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        elseif ($users[$this->username] !== $this->password)
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        else {
            $this->errorCode = self::ERROR_NONE;
            switch ($users[$this->username]) {
                case 'cvm': 
                    $this->setState('id_perfil',array('1'));
                    break;
                case 'iphan': 
                    $this->setState('id_perfil',array('2'));
                    break;
                case 'terracap':
                    $this->setState('id_perfil',array('3'));
                    break;
                case 'ancine': 
                    $this->setState('id_perfil',array('4'));
                    break;
                case 'fraport':
                    $this->setState('id_perfil',array('6'));
                    break;
                case 'funarte':
                    $this->setState('id_perfil',array('5'));
                    break;
                case 'Ancine':
                    $this->setState('id_perfil',array('7'));
                    break;
                case 'anatel':
                    $this->setState('id_perfil',array('8'));
                    break;
                default:
                    $this->setState('id_perfil',array('0'));
                    break;
            }
        }
        return !$this->errorCode;
    }

}
