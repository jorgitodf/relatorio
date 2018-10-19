<?php

/**
 * IosFormatter class
 */
class FksFormatter {

    /**
     * Formatar CPF
     * @param string $cpf
     * @return string
     */
    public static function formatarCPF($cpf) {
        if (!empty($cpf)){
            $str = str_replace('-', '', str_replace('.', '', $cpf));
            return substr($str, 0, 3) . '.' . substr($str, 3, 3) . '.' .
                    substr($str, 6, 3) . '-' . substr($str, 9, 2);
        } else 
            return '';
    }

    /**
     * Formatar CNPJ
     * @param string $cnpj
     * @return string
     */
    public static function formatarCNPJ($cnpj) {
        $str = str_replace('/', '', str_replace('-', '', str_replace('.', '', $cnpj)));
        return substr($str, 0, 2) . '.' . substr($str, 2, 3) . '.' .
                substr($str, 5, 3) . '/' . substr($str, 8, 4) . '-' .
                substr($str, 12, 2);
    }
    
    /**
     * Formatar Telefone
     * @param string $ctelefone
     * @return string
     */
    public static function formatarTelefone($telefone) {
        $str = str_replace('(', '', str_replace(')', '', str_replace('-', '', $telefone)));
        return '(' . substr($str, 0, 2) . ')' . substr($str, 2, 4) . '-' .
                substr($str, 6, 4);
    }

    /**
     * Converte Data(BR) para Data(EN)
     * @param string $date
     * @return DateTime
     */
    public static function StrToDate($date) {
        $ar = explode('/',$date);
        return $ar[2].'-'.$ar[1].'-'.$ar[0];
    }

    /**
     * Converte Data(EN) para Data(BR)
     * @param string $date
     * @return DateTime
     */
    public static function DtEnToBr($date) {
        $ar = explode('-',$date);
        return $ar[2].'/'.$ar[1].'/'.$ar[0];
    }

    /**
     * Converte Data(BR) para Data(EN)
     * @param string $date
     * @return DateTime
     */
    public static function StrToDateTime($date) {
        return date('Y-m-d H:i:s', CDateTimeParser::parse($date, Yii::app()->params['dtTimeFormat']));
    }

    /**
     * Formatar Data&Hora
     * Param Format: dd/MM/yyyy hh:mm:ss
     * Return Format: 1d 5h 2m
     * @param string $dataHora
     * @return string
     */
    public static function formatarDateTimeToWorkingTime($dataHora) {
        $iDt = CDateTimeParser::parse($dataHora, 'dd/MM/yyyy hh:mm:ss');
        $iNow = time();
        $diff = $iNow - $iDt;
        $workTime = date('YmdHis', $diff); //19700103183540
        $y = 1970;
        $wY = substr($workTime, 0,4);// Year
        $wM = substr($workTime, 4,2);// Month
        $wD = substr($workTime, 6,2);// Day
        $wH = substr($workTime, 8,2);// Hour
        $wI = substr($workTime, 10,2);// Minute

        if ($wD - 1 > 0){
            $workTime = ($wD - 1) . "d ";
        }
        $workTime .= $wH . "h ";
        $workTime .= $wI . "m";
        
        return $workTime;
    }

    /**
     * Formata a Data do formato dd/mm/yyyy para yyy-mm-dd (default SQL)
     * @param datetime $dataHora
     */
    public static function formatarDateToSQLDate($dataHora) {
        // retorna a data como inteiro
        return date('Y-m-d', CDateTimeParser::parse($dataHora, Yii::app()->locale->getDateFormat(Yii::app()->params['dtFormat'])));
    }

    /**
     * Formata a Data/Hora do formato YYYY-MM-DD HH:MM:SS para dd/mm/yyyy hh:mm:ss
     * @param DateTime $dateTime
     * @return string
     */
    public static function formatarDataHora($dateTime){
        $res = '';
        if (!empty($dateTime)){
            $dt = new DateTime($dateTime);
            $res = $dt->format('d/m/Y H:i:s');
        }
        return $res;
    }
    
    /**
     * Converte Inteiro para Data no formato YYYY-MM-DD.
     * @param int $dataInteiro
     * @return string
     */
    public static function intToDate($dataInteiro) {
        return date('Y-m-d', ($dataInteiro - 25569) * 86400);
    }

    /**
     * Converte Data no formato YYYY-MM-DD para inteiro
     * @param int $dataInteiro
     * @return string
     */
    public static function dateToInt($data) {
        return strtotime($data);
    }

    /**
     * Converte Hora no formato HH:MM:SS para inteiro
     * @param int $dataInteiro
     * @return string
     */
    public static function timeToInt($hora) {
        $hr = explode(':', $hora);
        return ($hr[0] * 3600) + ($hr[1] * 60) + $hr[2];
    }

    /**
     * Converte Hora no formato HH:MM:SS para Minutos (inteiro)
     * @param int $dataInteiro
     * @return string
     */
    public static function hoursToMinutes($hora) {
        $hr = explode(':', $hora);
        return ($hr[0] * 60) + $hr[1] + ($hr[2] / 60);
    }

    /**
     * Converte Minutos (inteiro) para o formato HH:MM:SS
     * @param int $minutos
     * @return string
     */
    public static function minutesToHours($minutos) {
        $sumHoras = $minutos;
        $hour = floor($sumHoras / 60);
        $sumHoras -=  ($hour * 60);
        $min = floor($sumHoras);
        $sumHoras -=  $min;
        $sec = round($sumHoras * 60);
        return (substr(str_pad($hour, 2, '0', STR_PAD_LEFT),0,2) . 
                ":" . substr(str_pad($min, 2, '0', STR_PAD_LEFT),0,2) . 
                ":" . substr(str_pad($sec, 2, '0', STR_PAD_LEFT),0,2));
    }

    /**
     * Adiciona X meses ao Ano/Mes. AnoMes format: YYYYMM.
     * @param int $value
     */
    public static function addMesAno($anoMes, $value) {
        $ano = substr($anoMes, 0, 4); // 201508
        $mes = substr($anoMes, 4, 2);
        if ($value > 0) {
            $mod = ($value % 12);
            $quo = floor($value / 12);

            $ano += $quo;
            if ((($mes + $mod) - 12) <= 0) {
                $mes += $mod;
            } else {
                $mes = ($mes + $mod) - 12;
                $ano += 1;
            }
        }
        return sprintf("%04d", $ano) . sprintf("%02d", $mes);
    }

    /**
     * Remove X meses ao Ano/Mes. AnoMes format: YYYYMM.
     * @param int $value
     */
    public static function remMesAno($anoMes, $value) {
        $ano = substr($anoMes, 0, 4); // 201508
        $mes = substr($anoMes, 4, 2);
        $mod = ($value % 12);
        $quo = floor($value / 12);

        if (($mes - $value) < 0) {
            $mes = 12 - abs($mes - $value) + 1;
            $ano = $ano - 1 - ($quo);
        } else {
            $mes = $mes - 1;
        }
        return sprintf("%04d", $ano) . sprintf("%02d", $mes);
    }

    /**
     * Adiciona o Valor na Data, apartir da Parte
     * Ex.: dateAdd(date(),30,'day');
     * @param timestamp $date
     * @param int $value
     * @param string $part
     * @return DateTime
     */
    public static function dateAdd($dateTime, $value, $part = 'day') {
        $dt = new DateTime($dateTime);
        switch ($part) {
            case 'day':
                $dt->add(new DateInterval('P' . $value . 'D'));
                break;
            case 'month':
                $dt->add(new DateInterval('P' . $value . 'M'));
                break;
            case 'year':
                $dt->add(new DateInterval('P' . $value . 'Y'));
                break;
            case 'hour':
                $dt->add(new DateInterval('PT' . $value . 'H'));
                break;
            case 'minute':
                $dt->add(new DateInterval('PT' . $value . 'M'));
                break;
            case 'second':
                $dt->add(new DateInterval('PT' . $value . 'S'));
                break;
        }
        return $dt;
    }

    /**
     * Subtrai o Valor na Data, apartir da Parte
     * Ex.: dateSub(date(),30,'day');
     * @param timestamp $date
     * @param int $value
     * @param string $part
     * @return DateTime
     */
    public static function dateSub($dateTime, $value, $part = 'day') {
        $dt = new DateTime($dateTime);
        switch ($part) {
            case 'day':
                $dt->sub(new DateInterval('P' . $value . 'D'));
                break;
            case 'month':
                $dt->sub(new DateInterval('P' . $value . 'M'));
                break;
            case 'year':
                $dt->sub(new DateInterval('P' . $value . 'Y'));
                break;
            case 'hour':
                $dt->sub(new DateInterval('PT' . $value . 'H'));
                break;
            case 'minute':
                $dt->sub(new DateInterval('PT' . $value . 'M'));
                break;
            case 'second':
                $dt->sub(new DateInterval('PT' . $value . 'S'));
                break;
        }
        return $dt;
    }

    /**
     * Retorna a Sigla do Mes informado
     * @param int $value
     */
    public static function nameOfNumberMonth($number) {
        $sg = '';
        switch ($number) {
            case -2:
                $sg = 'Out';
                break;
            case -1:
                $sg = 'Nov';
                break;
            case 0:
                $sg = 'Dez';
                break;
            case 1:
                $sg = 'Jan';
                break;
            case 2:
                $sg = 'Fev';
                break;
            case 3:
                $sg = 'Mar';
                break;
            case 4:
                $sg = 'Abr';
                break;
            case 5:
                $sg = 'Mai';
                break;
            case 6:
                $sg = 'Jun';
                break;
            case 7:
                $sg = 'Jul';
                break;
            case 8:
                $sg = 'Ago';
                break;
            case 9:
                $sg = 'Set';
                break;
            case 10:
                $sg = 'Out';
                break;
            case 11:
                $sg = 'Nov';
                break;
            case 12:
                $sg = 'Dez';
                break;
            default:
                break;
        }
        return $sg;
    }

    
}
