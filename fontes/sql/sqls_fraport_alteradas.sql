begin
	declare iniTurno varchar(8);
	declare fimTurno varchar(8);
	declare retorno varchar(10);
	declare sumHoras int;
	declare countDias int;
	declare iCount int;
	declare horaIniACUMULADA int;
	declare horaFimACUMULADA int;
	declare horaCalc int;
	declare minutoCalc int;
	declare segundoCalc int;
	declare dataCalcIni datetime;
	declare dataCalcFim datetime;
	declare dataProxima datetime;

	-- Calcula inicio e termino do Turno do calendario
	if (iCalendar = 1) then
    -- Central de Serviço
		set iniTurno = '07:00:00';
		set fimTurno = '19:00:00';
	elseif (iCalendar = 2) then
			-- Analise&Suporte
			set iniTurno = '08:00:00';
			set fimTurno = '18:00:00';
	else
    -- Suporte24H
		set iniTurno = '00:00:00';
		set fimTurno = '23:59:59';
	end if;
  
	if (abs(datediff(dtFim,dtIni)) = 0) then
		-- Tratando DataHora inicial
  	if (fnctimetoint(dtIni) < fnctime2toint(iniTurno)) then
			-- Se o tempo é ANTERIOR ao HorarioTrabalho
			set dataCalcIni = timestampadd(hour,substring(iniTurno,1,2),date(dtIni));
		else
			if (fnctimetoint(dtIni) > fnctime2toint(fimTurno)) then
				-- Se o tempo é POSTERIOR ao HorarioTrabalho
				set dataCalcIni = timestampadd(hour,substring(iniTurno,1,2),date(dtIni));
			else
				set dataCalcIni = dtIni;
			end if;
		end if;
		-- Tratando DataHora final
		if (fnctimetoint(dtFim) > fnctime2toint(fimTurno)) then
			-- Se o tempo é POSTERIOR ao HorarioTrabalho
			if (fnctimetoint(dtIni) > fnctime2toint(fimTurno)) then
				set dataCalcFim = timestampadd(hour,substring(iniTurno,1,2),date(dtIni));
			else
				set dataCalcFim = timestampadd(hour,substring(fimTurno,1,2),date(dtFim));
			end if;
		else
			if (fnctimetoint(dtFim) < fnctime2toint(iniTurno)) then
				-- Se o tempo é ANTERIOR ao HorarioTrabalho
				set dataCalcFim = timestampadd(hour,substring(iniTurno,1,2),date(dtIni));
			else
				set dataCalcFim = dtFim;
			end if;
		end if;
		set retorno = timediff(dataCalcFim,dataCalcIni);
  else
    /*-->> Método para cálculo de HORAS*/
    -- Soma Horas finais do primeiro Dia
    set horaIniACUMULADA = (hour(dtIni) * 3600) + (minute(dtIni) * 60) + second(dtIni);
    set dataCalcFim = cast(concat(year(dtIni),'-',month(dtIni),'-',day(dtIni),' ',fimTurno) as datetime);
    set horaFimACUMULADA = (hour(dataCalcFim) * 3600) + (minute(dataCalcFim) * 60) + second(dataCalcFim);
    set sumHoras = horaFimACUMULADA - horaIniACUMULADA;
    
    set iCount = 1;
    set countDias = abs(datediff(dtFim,dtIni));
  	while (iCount <= countDias) do
    	set dataProxima = date_add(dtIni, interval iCount day);
      -- Veriricar se a Proxima Data eh igual a Data Fim
      if (date(dataProxima)=date(dtFim)) then
      	set dataCalcIni = cast(concat(year(dataProxima),'-',month(dataProxima),'-',day(dataProxima),' ',iniTurno) as datetime);
        set horaIniACUMULADA = (hour(dataCalcIni) * 3600) + (minute(dataCalcIni) * 60) + second(dataCalcIni);
        set horaFimACUMULADA = (hour(dtFim) * 3600) + (minute(dtFim) * 60) + second(dtFim);
        set sumHoras = sumHoras + (horaFimACUMULADA - horaIniACUMULADA);
      else
        -- Verificar FDS
        if (dayofweek(dataProxima)<>1 and dayofweek(dataProxima)<>7) then
      		-- Verificar Feriado
        	if ((select count(*) from ios_feriados where dt_feriado = date(dataProxima)) <= 0) then
            set dataCalcIni = cast(concat(year(dataProxima),'-',month(dataProxima),'-',day(dataProxima),' ', iniTurno) as datetime);
            set dataCalcFim = cast(concat(year(dataProxima),'-',month(dataProxima),'-',day(dataProxima),' ', fimTurno) as datetime);
            set horaIniACUMULADA = (hour(dataCalcIni) * 3600) + (minute(dataCalcIni) * 60) + second(dataCalcIni);
            set horaFimACUMULADA = (hour(dataCalcFim) * 3600) + (minute(dataCalcFim) * 60) + second(dataCalcFim);
            set sumHoras = sumHoras + (horaFimACUMULADA - horaIniACUMULADA);
          end if;
        end if;
      end if;
      set iCount = iCount + 1;
    end while;

  	/*-->> Método para cálculo de HORAS*/
    set horaCalc = floor(sumHoras / 3600);
    set sumHoras = sumHoras - (horaCalc * 3600);
    set minutoCalc = floor(sumHoras / 60);
    set sumHoras = sumHoras - (minutoCalc * 60);
    set segundoCalc = sumHoras;
		if (horaCalc < 100) then
			set retorno = concat(lpad(horaCalc,2,'0'),':',lpad(minutoCalc,2,'0'),':',lpad(segundoCalc,2,'0'));
		else 
			set retorno = concat(lpad(horaCalc,3,'0'),':',lpad(minutoCalc,2,'0'),':',lpad(segundoCalc,2,'0'));
		end if;
	end if;

 	return retorno;
end





CREATE DEFINER=`root`@`localhost` FUNCTION `fncTime2ToIntNew`(tTime varchar(20)) RETURNS int(11)
begin
  declare iHour int;
  declare iMinute int;
  declare iSecond int;
  declare total int;
  declare verifica varchar(3);
  
  set iHour = fncsplitstring(tTime,':',1);
  set verifica = CAST(LEFT(fncsplitstring(tTime,':',1), 1) AS CHAR);
  set iMinute = fncsplitstring(tTime,':',2);
  set iSecond = fncsplitstring(tTime,':',3);
  if (verifica = '-' or verifica <> 0) then
	 set total = ((iHour * -3600) + (iMinute * -60) + (-iSecond));
  else
	 set total = (iHour * 3600) + (iMinute * 60) + iSecond;
  end if;
return total; 
END

SELECT 
    t.tn AS tn,
    t.id AS ticket_id,
    t.title AS title,
    tt.name AS type_name,
    tp.name AS priority_name,
    ts.name AS state_name,
    s.name AS service_name,
    t.create_time AS create_time,
    q1.name AS queue_create_name,
    pp.name_ownwer AS name_ownwer,
    pp.create_time AS date_first_owner,
    pf.queue_name AS first_queue_name,
    res1.state AS first_resolution,
    res1.data_resolucao AS date_first_resolution,
    res1.fila_resolucao AS queue_first_resolution,
    res1.atendente_resolucao AS atendente_first_resolution,
    res2.state AS resolution,
    res2.data_resolucao AS date_resolution,
    res2.fila_resolucao AS queue_resolution,
    res2.atendente_resolucao AS atendente_resolution,
    ate.data_encerramento AS data_encerramento,
    sla.name AS sla,
    FNCTOTALHORASUTEISKPI(1, t.create_time, res1.data_resolucao) AS timeResolution,
    FNCTEMPONAFILACS(t.id, 23) AS timeQueueCS,
    FNCCALCTEMSLARESTANTE(t.sla_id, FNCTEMPONAFILACS(t.id, 23)) AS time_rest_sla,
    FNCTEMPOPENDENTENAFILA(t.id, 23) AS timePendingQueueCS,
    CASE t.service_id
        WHEN 147 THEN 1
        WHEN 148 THEN 1
        WHEN 149 THEN 1
        WHEN 150 THEN 1
        WHEN 151 THEN 1
        WHEN 154 THEN 1
        WHEN 152 THEN 1
        WHEN 155 THEN 1
        WHEN 153 THEN 1
        WHEN 156 THEN 1
        ELSE 0
    END AS service_id,
    CASE res2.queue_id
        WHEN 22 THEN 1
        WHEN 23 THEN 1
        ELSE 0
    END AS queue_id,
    res2.queue_id
FROM
    ticket t
        JOIN
    ticket_type tt ON (tt.id = t.type_id)
        JOIN
    ticket_priority tp ON (tp.id = t.ticket_priority_id)
        JOIN
    ticket_state ts ON (ts.id = t.ticket_state_id)
        LEFT JOIN
    service s ON (s.id = t.service_id)
JOIN
    (SELECT 
        MIN(th2.ticket_id) AS ticket_id,
            th2.queue_id AS queue_create_id
    FROM
        ticket_history th2
    WHERE
        th2.history_type_id = 1
    GROUP BY th2.ticket_id) qc ON (qc.ticket_id = t.id)
        JOIN
    queue q1 ON (q1.id = qc.queue_create_id)
JOIN
    (SELECT 
        MIN(th.ticket_id) AS ticket_id,
            th.queue_id AS queue,
            CONCAT(u.first_name, ' ', u.last_name) AS name_ownwer,
            th.create_time AS create_time
    FROM
        ticket_history th
    JOIN users u ON (u.id = th.owner_id)
    WHERE
        th.history_type_id = 23 AND th.owner_id <> 1
    GROUP BY th.ticket_id) pp ON (pp.ticket_id = t.id)
JOIN
    (SELECT 
        MIN(th.ticket_id) AS ticket_id,
            th.queue_id AS queue,
            q.name AS queue_name,
            th.queue_id AS queue_id,
            th.create_time AS create_time
    FROM
        ticket_history th
	JOIN queue q ON (q.id = th.queue_id)
    WHERE
        th.history_type_id = 16
    GROUP BY th.ticket_id) pf ON (pf.ticket_id = t.id)
LEFT JOIN
    (SELECT 
        MIN(th.ticket_id) AS ticket_id,
            q.name AS fila_resolucao,
            th.queue_id AS queue_id,
            CONCAT(u.first_name, ' ', u.last_name) AS atendente_resolucao,
            ts.name AS state,
            th.create_time AS data_resolucao
    FROM
        ticket_history th
	JOIN users u ON (u.id = th.owner_id)
	JOIN queue q ON (q.id = th.queue_id)
	JOIN ticket_state ts ON (ts.id = th.state_id)
    WHERE
        th.history_type_id = 27 AND th.state_id IN (5,12) AND th.queue_id = 11
    GROUP BY th.ticket_id) res1 ON (res1.ticket_id = t.id)
LEFT JOIN
    (SELECT 
        MAX(th.id) AS history_id,
            th.ticket_id AS id_ticket,
            th.history_type_id,
            th.state_id,
            th.ticket_id AS ticket_id,
            q.name AS fila_resolucao,
            th.queue_id AS queue_id,
            CONCAT(u.first_name, ' ', u.last_name) AS atendente_resolucao,
            ts.name AS state,
            th.create_time AS data_resolucao
    FROM
        ticket_history th
    JOIN (SELECT 
        MAX(id) AS history_id, ticket_id AS ticket_id
    FROM
        ticket_history
    WHERE
        history_type_id = 27 AND state_id IN (5,12)
    GROUP BY ticket_id) ur ON (th.id = ur.history_id)
    JOIN users u ON (u.id = th.owner_id)
    JOIN ticket_state ts ON (ts.id = th.state_id)
    JOIN queue q ON (q.id = th.queue_id)
    WHERE
        th.history_type_id = 27 AND th.state_id IN (5,12)
    GROUP BY th.ticket_id) res2 ON (res2.id_ticket = t.id)
LEFT JOIN
    sla ON (sla.id = t.sla_id)
JOIN
    (SELECT 
        MAX(th1.ticket_id) AS ticket_id,
            th1.queue_id,
            th1.change_time AS data_encerramento
    FROM
        ticket_history th1
    WHERE
        th1.history_type_id = 27 AND th1.state_id = 10 AND th1.queue_id = 9
    GROUP BY th1.ticket_id) ate ON (t.id = ate.ticket_id)
WHERE
    ate.data_encerramento BETWEEN '2018-02-01 00:00:00' AND '2018-02-27 23:59:59' AND res2.queue_id NOT IN (11)
ORDER BY t.id;



