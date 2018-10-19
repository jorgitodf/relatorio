<?php

class FksUtils {

    /**
     * Converte Array do List
     * @param array $array
     * @return string
     */
    public static function arrayToList($array) {
        $lst = "'" . implode("','", $array) . "'";
        return $lst;
    }

    /**
     * Compara os arrays
     * @param type $arrayA
     * @param type $arrayB
     * @return type
     */
    public static function arrayIdenticals($arrayA, $arrayB) {
        sort($arrayA);
        sort($arrayB);
        return $arrayA == $arrayB;
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
     * Converte Inteiro para formato HH:MM:SS
     * @param int $dataInteiro
     * @return string
     */
    public static function intToTime($hora) {
        $isNegativo = '';
        if ($hora < 0 ){
            $isNegativo = '-';
        }
        $sumHoras = abs($hora);
        $horaCalc = floor($sumHoras / 3600);
        $sumHoras = $sumHoras - ($horaCalc * 3600);
        $minutoCalc = floor($sumHoras / 60);
        $sumHoras = $sumHoras - ($minutoCalc * 60);
        $segundoCalc = $sumHoras;
        
        return $isNegativo . str_pad($horaCalc, 2, '0', STR_PAD_LEFT) . ':' . 
                str_pad($minutoCalc, 2, '0', STR_PAD_LEFT) . ':' . 
                str_pad($segundoCalc, 2, '0', STR_PAD_LEFT);
    }


    public static function calculaTempoTotalAtendimento($tempoAberto, $tempoAtendido = null)
    {
        $total = 0;

        $ha = explode(':', $tempoAberto);
        $ta = ($ha[0] * 3600) + ($ha[1] * 60) + $ha[2];

        if ($tempoAtendido != null) {
            $hat = explode(':', $tempoAtendido);
            $tat = ($hat[0] * 3600) + ($hat[1] * 60) + $hat[2];
        } else {
            $tat = 0;
        }

        if ($tat != 0) {
            $total = ($tat + $ta);
        } else {
            $total = $ta;
        }

        return FksUtils::intToTime($total);
    }

    public static function calculaTempoTotalAtendimentoAncine($tempoAberto, $tempoAtendido = null)
    {
        $total = 0;

        $ha = explode(':', $tempoAberto);
        $ta = ($ha[0] * 3600) + ($ha[1] * 60) + $ha[2];

        if ($tempoAtendido != null) {
            $hat = explode(':', $tempoAtendido);
            $tat = ($hat[0] * 3600) + ($hat[1] * 60) + $hat[2];
        } else {
            $tat = 0;
        }

        if ($tat >= $ta) {
            $total = ($tat - $ta);
        } else {
            $total = ($ta - $tat);
        }

        return FksUtils::intToTime($total);
    }

    public static function calculaTempoTotalAtendimentoAncineV2($tempoAberto, $tempoPendente, $tempoFilasAncine = null)
    {
        $total = 0;
        $total2 = 0;

        $ha = explode(':', $tempoAberto);
        $ta = ($ha[0] * 3600) + ($ha[1] * 60) + $ha[2];

        $hp = explode(':', $tempoPendente);
        $tp = ($hp[0] * 3600) + ($hp[1] * 60) + $hp[2];

        if ($tempoFilasAncine != null) {
            $hat = explode(':', $tempoFilasAncine);
            $tat = ($hat[0] * 3600) + ($hat[1] * 60) + $hat[2];
        } else {
            $tat = 0;
        }

        if ($ta >= $tp) {
            $total = ($ta - $tp);
        } else {
            $total = ($tp - $ta);
        }

        if ($tat >= $total) {
            $total2 = ($tat - $total);
        } else {
            $total2 = ($total - $tat);
        }

        return FksUtils::intToTime($total2);
    }

    public static function calculaTempoTotalAtendimentoAncineV3($tempoAberto, $tempoFilasAncine)
    {
        $total = 0;

        $ha = explode(':', $tempoAberto);
        $ta = ($ha[0] * 3600) + ($ha[1] * 60) + $ha[2];

        $haFa = explode(':', $tempoFilasAncine);
        $taFa = ($haFa[0] * 3600) + ($haFa[1] * 60) + $haFa[2];

        if ($taFa >= $ta) {
            $total = ($taFa - $ta);
        } else {
            $total = ($ta - $taFa);
        }

        return FksUtils::intToTime($total);
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
        $sumHoras -= ($hour * 60);
        $min = floor($sumHoras);
        $sumHoras -= $min;
        $sec = round($sumHoras * 60);
        return (substr(str_pad($hour, 2, '0', STR_PAD_LEFT), 0, 2) .
                ":" . substr(str_pad($min, 2, '0', STR_PAD_LEFT), 0, 2) .
                ":" . substr(str_pad($sec, 2, '0', STR_PAD_LEFT), 0, 2));
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

    /**
     * Converte Data(BR) para Data(EN)
     * @param string $date
     * @return DateTime
     */
    public static function StrToDate($date) {
        $ar = explode('/', $date);
        return $ar[2] . '-' . $ar[1] . '-' . $ar[0];
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
     * Converte Data(EN) para Data(BR)
     * @param string $date
     * @return DateTime
     */
    public static function StrToDataHora($date) {
        return date('d/m/Y H:i:s', $date);
    }

    /**
     * Converte o Intervalo de Tempo para Descritivo do Tempo de Trabalho
     * Ex.: 1 ano 4 meses 29 dias 04h 57m 09s
     * @param DateInterval $dateInterval
     * @return string
     */
    public static function dateIntervalToWorkTime($dateInterval) {
        $workTime = '';
        if ($dateInterval->y > 0) {
            $workTime .= $dateInterval->y . ($dateInterval->y <= 1 ? ' ano ' : ' anos ');
        }
        if ($dateInterval->m > 0) {
            $workTime .= $dateInterval->m . ($dateInterval->m <= 1 ? ' mês ' : ' meses ');
        }
        if ($dateInterval->d > 0) {
            $workTime .= $dateInterval->d . ($dateInterval->d <= 1 ? ' dia ' : ' dias ');
        }
        if ($dateInterval->h > 0) {
            $workTime .= $dateInterval->h . 'h ';
        }
        if ($dateInterval->i > 0) {
            $workTime .= $dateInterval->i . 'm ';
        }
        if ($dateInterval->s > 0) {
            $workTime .= $dateInterval->s . 's ';
        }
        return $workTime;
    }

    /**
     * Converte o Intervalo de Tempo para Segundos
     * @param DateInterval $dateInterval
     * @return int
     */
    public static function dateIntervalToSecond($dateInterval) {
        $second = 0;
        $second += ($dateInterval->y * 3.154e+7) + ($dateInterval->m * 2.628e+6) +
                ($dateInterval->d * 86400) + ($dateInterval->h * 3600) +
                ($dateInterval->i * 60) + ($dateInterval->s);

        return $second;
    }

    /**
     * Converte o Intervalo de Tempo para Minutos
     * @param DateInterval $dateInterval
     * @return int
     */
    public static function dateIntervalToMinute($dateInterval) {
        $minute = 0;
        $minute += ($dateInterval->y * 525600) + ($dateInterval->m * 43800) +
                ($dateInterval->d * 1440) + ($dateInterval->h * 60) +
                $dateInterval->i + ($dateInterval->s * 0.0166667);

        return $minute;
    }

    /**
     * Retorna a diferenca entre Datas
     * @param string $dateIni
     * @param string $dateFim
     * @return DateInterval
     */
    public static function dateDiff($dateIni, $dateFim) {
        $dt1 = new DateTime($dateIni);
        $dt2 = new DateTime($dateFim);

        return $dt2->diff($dt1);
    }

    /**
     * Retorna o tempo no formato HH:MM:SS com base nas horas úteis.
     * Exemplo:
     *      horasUteis('2016-01-23 07:29:45', '2016-01-24 20:45:01', 
     *   array('ini'=>'07:30:00','fim'=>'20:30:00'),
     *   array('2016-01-01','2016-02-09'));
     * 
     * @param string $dtIni
     * @param string $dtFim
     * @param array $expediente
     * @param array $feriados
     * @return int Minutes
     */
    public static function horasUteis($dtIni, $dtFim, $expediente, $feriados) {
        $dtInicial = new DateTime($dtIni);
        $nextDate = new DateTime($dtIni);
        $dtFinal = new DateTime($dtFim);
        $diff = $dtFinal->diff($dtInicial);

        $sumHoras = 0;
        $tempoTotal = 0;
        // Obtem o horario de inicio e termino do expediente
        $iniExp = $expediente[0];
        $fimExp = $expediente[1];

        for ($i = 0; $i <= ($diff->days); $i++) {
            // verificar se data é Final de Semana ou Feriado
            if ((!in_array($nextDate->format('Y-m-d'), $feriados)) &&
                    (date('w', $nextDate->getTimestamp()) > 0) &&
                    (date('w', $nextDate->getTimestamp()) < 6)) {
                // verifica se a dataProxima é dtIni
                if ($dtFinal->format('Y-m-d') == $dtInicial->format('Y-m-d')) {
                    // verifica se Hora é menor que inicio Expediente
                    if (IosUtils::timeToInt($dtInicial->format('H:i:s')) < IosUtils::timeToInt($iniExp)) {
                        $dataCalcIni = new DateTime($dtInicial->format('Y-m-d') . ' ' . $iniExp);
                    } else {
                        $dataCalcIni = $dtInicial;
                    }
                    if (IosUtils::timeToInt($dtFinal->format('H:i:s')) > IosUtils::timeToInt($fimExp)) {
                        $dataCalcFim = new DateTime($dtFinal->format('Y-m-d') . ' ' . $fimExp);
                    } else {
                        $dataCalcFim = $dtFinal;
                    }
                    // verifica se dataProxima é dtFim
                } elseif ($nextDate->format('Y-m-d') == $dtFinal->format('Y-m-d')) {
                    $nextDate = $dtFinal;
                    // verifica se Hora é maior que fim Expediente
                    if (IosUtils::timeToInt($nextDate->format('H:i:s')) > IosUtils::timeToInt($fimExp)) {
                        $dataCalcFim = new DateTime($nextDate->format('Y-m-d') . ' ' . $fimExp);
                    } else {
                        $dataCalcFim = $nextDate;
                    }
                    $dataCalcIni = new DateTime($nextDate->format('Y-m-d') . ' ' . $iniExp);
                } else {
                    $dataCalcIni = new DateTime($nextDate->format('Y-m-d') . ' ' . $iniExp);
                    $dataCalcFim = new DateTime($nextDate->format('Y-m-d') . ' ' . $fimExp);
                }
                $horaIni = IosUtils::timeToInt($dataCalcIni->format('H:i:s'));
                $horaFim = IosUtils::timeToInt($dataCalcFim->format('H:i:s'));
                $sumHoras += ($horaFim - $horaIni);
            }

            $nextDate->add(new DateInterval('P1D'));
        }
        $hour = floor($sumHoras / 3600);
        $sumHoras -= ($hour * 3600);
        $min = (int) ($sumHoras / 60);
        $sumHoras -= ($min * 60);
        $sec = $sumHoras;

        return (substr(str_pad($hour, 2, '0', STR_PAD_LEFT), 0, 2) .
                ":" . substr(str_pad($min, 2, '0', STR_PAD_LEFT), 0, 2) .
                ":" . substr(str_pad($sec, 2, '0', STR_PAD_LEFT), 0, 2));
    }

}
