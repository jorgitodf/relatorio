--
-- Scripts inicial INCRA
-- Database version: 5.7

--
-- Criacao do usuário da aplicacao
-- create user if not exists `u_dashotrs`@`%` identified by 'd@2h0t5s';

--
-- Atribuicao de permissoes ao usuario da aplicacao
-- * Observar que NÃO utilizamos a opção GRANT OPTION.
-- grant select, execute, show view, create temporary tables on otrs.* to `u_dashotrs`@`%`;
-- Lembrando que ALL PRIVILEGES, concede direitos a todos os privilégios no nivel de tabela.
-- grant all privileges on otrs.* to `u_franklin`@`%`;

--
-- Tabelas
drop table if exists ios_feriados;
create table ios_feriados (
  dt_feriado date not null,
  name_feriado varchar(50) default null,
  primary key (dt_feriado)
);

--
-- Funções
drop function if exists fncIntToHours;

DELIMITER $$

create definer=`u_dashotrs`@`%` function fncIntToHours(dtData int) returns integer
    comment 'Retorna somente as Horas. Segundos são desconsiderados.'
begin
    declare sumHoras int;
    declare horaCalc int;
    declare minutoCalc int;
    /*-->> Método para cálculo de HORAS*/
    set sumHoras = dtData;
    set horaCalc = floor(sumHoras / 3600);
    set sumHoras = sumHoras - (horaCalc * 3600);
    set minutoCalc = (floor(sumHoras / 60) * 0.01666);
    return (horaCalc + minutoCalc);
end
$$
DELIMITER ;

drop function if exists fncIntToTime;

DELIMITER $$

create definer=`u_dashotrs`@`%` function fncIntToTime(dtData int) returns varchar(20) charset utf8
    comment 'Retorna Hora no formato HH:MM:SS'
begin
    declare sumHoras int;
    declare horaCalc int;
    declare minutoCalc int;
    declare segundoCalc int;
    /*-->> Método para cálculo de HORAS*/
    set sumHoras = dtData;
    set horaCalc = floor(sumHoras / 3600);
    set sumHoras = sumHoras - (horaCalc * 3600);
    set minutoCalc = floor(sumHoras / 60);
    set sumHoras = sumHoras - (minutoCalc * 60);
    set segundoCalc = sumHoras;
    -- RETURN CAST(CONCAT(lpad(horaCalc,2,'0'),':',lpad(minutoCalc,2,'0'),':',lpad(segundoCalc,2,'0')) AS TIME);
    return concat(lpad(horaCalc,2,'0'),':',lpad(minutoCalc,2,'0'),':',lpad(segundoCalc,2,'0'));
end
$$
DELIMITER ;

drop function if exists fncTimeToInt;

DELIMITER $$

create definer=`u_dashotrs`@`%` function fncTimeToInt(dtData datetime) returns int(11)
	comment 'Retorna Data/Hora no formato inteiro'
begin
	return hour(dtData) * 3600 + minute(dtData) * 60 + second(dtData);
end
$$
DELIMITER ;

drop function if exists fncTime2ToInt;

DELIMITER $$

create definer=`u_dashotrs`@`%` function fncTime2ToInt(tTime varchar(20)) returns int(11)
	comment 'Retorna Hora no formato inteiro'
begin
	declare iHour int;
    declare iMinute int;
    declare iSecond int;
    set iHour = fncsplitstring(tTime,':',1);
    set iMinute = fncsplitstring(tTime,':',2);
    set iSecond = fncsplitstring(tTime,':',3);
	return (iHour * 3600) + (iMinute * 60) + iSecond;
end
$$
DELIMITER ;

drop function if exists fncSplitString;

DELIMITER $$

create definer=`u_dashotrs`@`%` function fncSplitString (s varchar(1024), del char(1), i int) returns varchar(1024)
deterministic -- always returns same results for same input parameters
	comment 'Retorna Split da String'
begin
	declare n int ;
	-- get max number of items
	set n = length(s) - length(replace(s, del, '')) + 1;
	if i > n then
		return null ;
	else
		return substring_index(substring_index(s, del, i) , del , -1 ) ;        
	end if;
end
$$
DELIMITER ;

set global log_bin_trust_function_creators=1;
drop function if exists fnRemTagHtml;
DELIMITER $$
create definer=`u_dashotrs`@`%` function fnRemTagHtml( Dirty varchar(4000) )
returns varchar(4000)
deterministic 
	comment 'Remove as tag HTML do texto'
begin
  declare iStart, iEnd, iLength int;
    while locate( '<', Dirty ) > 0 and locate( '>', Dirty, locate( '<', Dirty )) > 0 do
      begin
        set iStart = locate( '<', Dirty ), iEnd = locate( '>', Dirty, locate('<', Dirty ));
        set iLength = ( iEnd - iStart) + 1;
        if iLength > 0 then
          begin
            set Dirty = insert( Dirty, iStart, iLength, '');
          end;
        end if;
      end;
    end while;
    return Dirty;
end;
$$
DELIMITER ;

drop function if exists fncTotalHorasUteis;

DELIMITER $$

create definer=`u_dashotrs`@`%` function fncTotalHorasUteis(iCalendar int, dtIni datetime, dtFim datetime) returns varchar(10) charset utf8
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
        -- SET retorno = CAST(CONCAT(horaCalc,':',minutoCalc,':',segundoCalc) AS TIME);
        set retorno = concat(horaCalc,':',minutoCalc,':',segundoCalc);
	end if;

  	return retorno;
end
$$
DELIMITER ;

drop function if exists fncTempoPendente;

DELIMITER $$

create definer=`u_dashotrs`@`%` function fncTempoPendente(idTicket int) returns varchar(10) charset utf8
begin
  /* Criando variaveis do loop */
  declare done int default false;
  declare historyId int;
  declare stateId int;
  declare queueId int;
  declare calendarId int;
  declare historyCreateTime datetime;
  declare historyChangeTime datetime;
  declare tempoTotal int;

  declare historyIdOld int;
  declare stateIdOld int;
  declare queueIdOld int;
  declare historyCreateTimeOld datetime;
  declare historyChangeTimeOld datetime;
  
  /* Criando Cursor para o LOOP */
  declare crHISTORY_TICKET cursor for select 
        th.id as history_id,
		coalesce(s.calendar_name,1) as calendar_id,
        th.state_id, 
        th.queue_id,
        th.create_time as history_create_time,
        th.change_time as history_change_time
   from ticket_history th
   join ticket t on th.ticket_id = t.id
   left join sla s on t.sla_id = s.id
  where 1 = 1
    and th.ticket_id = idTicket
    and history_type_id in (1,16,27)
  order by th.id;
  -- DECLARE EXIT HANDLER FOR NOT FOUND BEGIN END;
  declare continue handler for not found set done = true;

  /* Inicializando variaveis */
  set tempoTotal = 0;
  set historyIdOld = 0;
  set stateIdOld = 0;
  set queueIdOld = 0;
  set historyCreateTimeOld = curdate();
  set historyChangeTimeOld = curdate();

  open crHISTORY_TICKET;

  -- LOOP
  read_loop: loop 
      -- Obtem os valores da linha
      fetch crHISTORY_TICKET into historyId, calendarId, stateId, queueId, historyCreateTime, historyChangeTime;

      if done then
        leave read_loop;
      end if;
  	  
      if (stateIdOld in (2)) then
         -- Soma tempo
         set tempoTotal = tempoTotal + fncTime2ToInt(fncTotalHorasUteis(calendarId, historyCreateTimeOld, historyCreateTime));
		 -- SET tempoTotal = tempoTotal;
      end if;
      -- Reinicia as variaveis do proximo Registro
      set historyCreateTimeOld = historyCreateTime;
      set historyChangeTimeOld = historyChangeTime;
      set stateIdOld = stateId; 
      set queueIdOld = queueId; 
  end loop;

  close crHISTORY_TICKET;
  
  return fncIntToTime(tempoTotal);
end
$$
DELIMITER ;

drop function if exists fncTempoPendenteNaFila;

DELIMITER $$

create definer=`u_dashotrs`@`%` function fncTempoPendenteNaFila(idTicket int, idFila int) returns varchar(10) charset utf8
begin
  /* Criando variaveis do loop */
  declare done int default false;
  declare historyId int;
  declare stateId int;
  declare queueId int;
  declare calendarId int;
  declare historyCreateTime datetime;
  declare historyChangeTime datetime;
  declare tempoTotal int;

  declare historyIdOld int;
  declare stateIdOld int;
  declare queueIdOld int;
  declare historyCreateTimeOld datetime;
  declare historyChangeTimeOld datetime;
  
  /* Criando Cursor para o LOOP */
  declare crHISTORY_TICKET cursor for select 
        th.id as history_id,
		coalesce(s.calendar_name,1) as calendar_id,
        th.state_id, 
        th.queue_id,
        th.create_time as history_create_time,
        th.change_time as history_change_time
   from ticket_history th
   join ticket t on th.ticket_id = t.id
   left join sla s on t.sla_id = s.id
  where 1 = 1
    and th.ticket_id = idTicket
    and history_type_id in (1,16,27)
  order by th.id;
  -- DECLARE EXIT HANDLER FOR NOT FOUND BEGIN END;
  declare continue handler for not found set done = true;

  /* Inicializando variaveis */
  set tempoTotal = 0;
  set historyIdOld = 0;
  set stateIdOld = 0;
  set queueIdOld = 0;
  set historyCreateTimeOld = curdate();
  set historyChangeTimeOld = curdate();

  open crHISTORY_TICKET;

  -- LOOP
  read_loop: loop 
      -- Obtem os valores da linha
      fetch crHISTORY_TICKET into historyId, calendarId, stateId, queueId, historyCreateTime, historyChangeTime;

      if done then
        leave read_loop;
      end if;
  	  
      if ( (stateIdOld = 2) and (queueIdOld = idFila) ) then
         -- Soma tempo
         set tempoTotal = tempoTotal + fncTime2ToInt(fncTotalHorasUteis(calendarId, historyCreateTimeOld, historyCreateTime));
		 -- SET tempoTotal = tempoTotal;
      end if;
      -- Reinicia as variaveis do proximo Registro
      set historyCreateTimeOld = historyCreateTime;
      set historyChangeTimeOld = historyChangeTime;
      set stateIdOld = stateId; 
      set queueIdOld = queueId; 
  end loop;

  close crHISTORY_TICKET;
  
  return fncIntToTime(tempoTotal);
end
$$
DELIMITER ;

drop function if exists fncTempoNaFila;

DELIMITER $$
create definer=`u_dashotrs`@`%` function fncTempoNaFila(idTicket int, idFila int) returns varchar(10)
begin
  /* Criando variaveis do loop */
  declare done int default false;
  declare historyId int;
  declare stateId int;
  declare queueId int;
  declare historyCreateTime datetime;
  declare historyChangeTime datetime;
  declare tempoTotal int;

  declare historyIdOld int;
  declare stateIdOld int;
  declare queueIdOld int;
  declare historyCreateTimeOld datetime;
  declare historyChangeTimeOld datetime;
  
  /* Criando Cursor para o LOOP */
  declare crHISTORY_TICKET cursor for select 
        th.id as history_id,
        th.state_id, 
        th.queue_id,
        th.create_time as history_create_time,
        th.change_time as history_change_time
   from ticket_history th
  where 1 = 1
    and th.ticket_id = idTicket
    and history_type_id in (1,16,27)
  order by th.id;
  -- DECLARE EXIT HANDLER FOR NOT FOUND BEGIN END;
  declare continue handler for not found set done = true;

  /* Inicializando variaveis */
  set tempoTotal = 0;
  set historyIdOld = 0;
  set stateIdOld = 0;
  set queueIdOld = 0;
  set historyCreateTimeOld = curdate();
  set historyChangeTimeOld = curdate();

  open crHISTORY_TICKET;

  -- LOOP
  read_loop: loop 
      -- Obtem os valores da linha
      fetch crHISTORY_TICKET into historyId, stateId, queueId, historyCreateTime, historyChangeTime;

      if done then
        leave read_loop;
      end if;
  	  
      if (queueIdOld = idFila) and (stateIdOld in (1,4,5)) then
         -- Soma tempo
         set tempoTotal = tempoTotal + fncTime2ToInt(fncTotalHorasUteis(1,historyCreateTimeOld, historyCreateTime));
      end if;
      -- Reinicia as variaveis do proximo Registro
      set historyCreateTimeOld = historyCreateTime;
      set historyChangeTimeOld = historyChangeTime;
      set stateIdOld = stateId; 
      set queueIdOld = queueId; 
  end loop;

  close crHISTORY_TICKET;
  
  return fncIntToTime(tempoTotal);
end
$$
DELIMITER ;

drop function if exists fncTempoPendenteNasFilasDET2;

DELIMITER $$

create definer=`u_dashotrs`@`%` function fncTempoPendenteNasFilasDET2(idTicket int) returns varchar(10) charset utf8
begin
  /* Criando variaveis do loop */
  declare done int default false;
  declare historyId int;
  declare stateId int;
  declare queueId int;
  declare calendarId int;
  declare historyCreateTime datetime;
  declare historyChangeTime datetime;
  declare tempoTotal int;

  declare historyIdOld int;
  declare stateIdOld int;
  declare queueIdOld int;
  declare historyCreateTimeOld datetime;
  declare historyChangeTimeOld datetime;
  
  /* Criando Cursor para o LOOP */
  declare crHISTORY_TICKET cursor for select 
        th.id as history_id,
		coalesce(s.calendar_name,1) as calendar_id,
        th.state_id, 
        th.queue_id,
        th.create_time as history_create_time,
        th.change_time as history_change_time
   from ticket_history th
   join ticket t on th.ticket_id = t.id
   left join sla s on t.sla_id = s.id
  where 1 = 1
    and th.ticket_id = idTicket
    and history_type_id in (1,16,27)
  order by th.id;
  -- DECLARE EXIT HANDLER FOR NOT FOUND BEGIN END;
  declare continue handler for not found set done = true;

  /* Inicializando variaveis */
  set tempoTotal = 0;
  set historyIdOld = 0;
  set stateIdOld = 0;
  set queueIdOld = 0;
  set historyCreateTimeOld = curdate();
  set historyChangeTimeOld = curdate();

  open crHISTORY_TICKET;

  -- LOOP
  read_loop: loop 
      -- Obtem os valores da linha
      fetch crHISTORY_TICKET into historyId, calendarId, stateId, queueId, historyCreateTime, historyChangeTime;

      if done then
        leave read_loop;
      end if;
  	  
      if ( (stateIdOld = 2) and (queueIdOld in (9,10,11,12,13,14,15,16,17,18,24)) ) then
         -- Soma tempo
         set tempoTotal = tempoTotal + fncTime2ToInt(fncTotalHorasUteis(calendarId, historyCreateTimeOld, historyCreateTime));
		 -- SET tempoTotal = tempoTotal;
      end if;
      -- Reinicia as variaveis do proximo Registro
      set historyCreateTimeOld = historyCreateTime;
      set historyChangeTimeOld = historyChangeTime;
      set stateIdOld = stateId; 
      set queueIdOld = queueId; 
  end loop;

  close crHISTORY_TICKET;
  
  return fncIntToTime(tempoTotal);
end
$$
DELIMITER ;

drop function if exists fncTempoNasFilasDET2;

DELIMITER $$
create definer=`u_dashotrs`@`%` function fncTempoNasFilasDET2(idTicket int) returns varchar(10)
begin
  /* Criando variaveis do loop */
  declare done int default false;
  declare historyId int;
  declare stateId int;
  declare queueId int;
  declare historyCreateTime datetime;
  declare historyChangeTime datetime;
  declare tempoTotal int;

  declare historyIdOld int;
  declare stateIdOld int;
  declare queueIdOld int;
  declare historyCreateTimeOld datetime;
  declare historyChangeTimeOld datetime;
  
  /* Criando Cursor para o LOOP */
  declare crHISTORY_TICKET cursor for select 
        th.id as history_id,
        th.state_id, 
        th.queue_id,
        th.create_time as history_create_time,
        th.change_time as history_change_time
   from ticket_history th
  where 1 = 1
    and th.ticket_id = idTicket
    and history_type_id in (1,16,27)
  order by th.id;
  -- DECLARE EXIT HANDLER FOR NOT FOUND BEGIN END;
  declare continue handler for not found set done = true;

  /* Inicializando variaveis */
  set tempoTotal = 0;
  set historyIdOld = 0;
  set stateIdOld = 0;
  set queueIdOld = 0;
  set historyCreateTimeOld = curdate();
  set historyChangeTimeOld = curdate();

  open crHISTORY_TICKET;

  -- LOOP
  read_loop: loop 
      -- Obtem os valores da linha
      fetch crHISTORY_TICKET into historyId, stateId, queueId, historyCreateTime, historyChangeTime;

      if done then
        leave read_loop;
      end if;
  	  
      if (queueIdOld in (9,10,11,12,13,14,15,16,17,18,24)) and (stateIdOld in (1,4,5)) then
         -- Soma tempo
         set tempoTotal = tempoTotal + fncTime2ToInt(fncTotalHorasUteis(1,historyCreateTimeOld, historyCreateTime));
      end if;
      -- Reinicia as variaveis do proximo Registro
      set historyCreateTimeOld = historyCreateTime;
      set historyChangeTimeOld = historyChangeTime;
      set stateIdOld = stateId; 
      set queueIdOld = queueId; 
  end loop;

  close crHISTORY_TICKET;
  
  return fncIntToTime(tempoTotal);
end
$$
DELIMITER ;


-- Visões
drop view if exists vw_last_closed;
create view vw_last_closed as
    select 
        ticket_history.ticket_id as ticket_id,
        max(ticket_history.id) as history_id
    from ticket_history
    where ticket_history.history_type_id = 27
    and ticket_history.queue_id <> 23
	and ticket_history.state_id in (select id from ticket_state where type_id = 3)
    group by ticket_history.ticket_id
;
drop view if exists vw_first_article;
create view vw_first_article as
    select 
        article.ticket_id as ticket_id,
        article.article_type_id,
        min(article.id) as article_id
    from
        article
    group by article.ticket_id, article.article_type_id
;
drop view if exists vw_first_history;
create view vw_first_history as
select min(th.id) as history_id, th.ticket_id
  from ticket_history th
group by th.ticket_id
;
drop view if exists vw_first_move;
create view vw_first_move as
select min(th.id) as history_id, th.ticket_id
  from ticket_history th
 where history_type_id = 16
 group by th.ticket_id
;
drop view if exists vw_last_state_history;
create view vw_last_state_history as
    select 
        th.ticket_id as ticket_id,
        max(th.id) as history_id
    from ticket_history th
    where th.history_type_id = 27
    group by th.ticket_id
;
drop view if exists vw_all_tickets_finish;
create view vw_all_tickets_finish as
    select 
        max(th.id) as history_id,
        th.ticket_id as ticket_id
    from
        ticket_history th
    where
        ((th.history_type_id = 27)
            and (th.state_id = 6))
    group by th.ticket_id
;

drop view if exists vw_tickets_encerrados;
create view vw_tickets_encerrados as
    select 
        t.id as ticket_id,
        t.create_time as create_time,
		thf.queue_id as queue_create,
		thf.state_id as state_create,
        th.change_time as finish_time,
        th.queue_id as queue_finish,
		th.create_by as user_finish
    from vw_all_tickets_finish atf
		join vw_last_closed lc on atf.ticket_id = lc.ticket_id
		join vw_first_history fh on atf.ticket_id = fh.ticket_id
        join ticket t on atf.ticket_id = t.id
        join ticket_history th on th.id = lc.history_id
		join ticket_history thf on thf.id = fh.history_id
;

-- 
drop view if exists vw_kpi;
create view vw_kpi as
select 
t.id as ticket_id, t.tn, t.title, t.create_time,
tt.id as type_id, tt.name as type_name,
tp.id as priority_id, tp.name as priority_name,
ts.id as state_id, ts.name as state_name,
s.id as service_id, s.name as service_name,
te.queue_create, q1.name as queue_create_name,
te.queue_finish, q2.name as queue_finish_name,
te.finish_time,
te.user_finish as user_finish_id, concat(u.first_name, ' ', u.last_name) as user_finish,
fncTempoPendenteNaFila(te.ticket_id,1) as timePendingCS,
fncTempoPendente(te.ticket_id) as timePending,
fncTotalHorasUteis(1,t.create_time,te.finish_time) as timeResolution
from vw_tickets_encerrados te
join ticket t on te.ticket_id = t.id
join queue q1 on te.queue_create = q1.id
join queue q2 on te.queue_finish = q2.id
join users u on te.user_finish = u.id
join ticket_type tt on t.type_id = tt.id
join ticket_priority tp on t.ticket_priority_id = tp.id
join ticket_state ts on t.ticket_state_id = ts.id
left join service s on t.service_id = s.id
where 1=1
and te.queue_finish in (1,2,3,5,6,7,8)
;

--
drop view if exists vw_kpi_det2;
create view vw_kpi_det2 as
select 
t.id as ticket_id, t.tn, t.title, t.create_time,
tt.id as type_id, tt.name as type_name,
tp.id as priority_id, tp.name as priority_name,
ts.id as state_id, ts.name as state_name,
s.id as service_id, s.name as service_name,
sla.id as sla_id,sla.name as sla_name, sla.solution_time,
te.queue_create, q1.name as queue_create_name,
te.queue_finish, q2.name as queue_finish_name,
te.finish_time,
te.user_finish as user_finish_id, concat(u.first_name, ' ', u.last_name) as user_finish,
fncTempoPendenteNasFilasDET2(te.ticket_id) as timePendingDET2,
fncTempoNasFilasDET2(te.ticket_id) as timeDET2,
fncTempoPendente(te.ticket_id) as timePending,
fncTotalHorasUteis(1,t.create_time,te.finish_time) as timeResolution
from vw_tickets_encerrados te
join ticket t on te.ticket_id = t.id
join queue q1 on te.queue_create = q1.id
join queue q2 on te.queue_finish = q2.id
join users u on te.user_finish = u.id
join ticket_type tt on t.type_id = tt.id
join ticket_priority tp on t.ticket_priority_id = tp.id
join ticket_state ts on t.ticket_state_id = ts.id
left join service s on t.service_id = s.id
left join sla sla on t.sla_id = sla.id
where 1=1
and te.queue_finish in (9,10,11,12,13,14,15,16,17,18,24)
;

--
drop view if exists vw_kpi_pqs;
create view vw_kpi_pqs as 
select
s.id as survey_id, s.status,
sq.id as question_id, sq.question, sq.position as position_question,
sr.id as request_id, sr.public_survey_key, sr.send_to, sr.send_time, sr.vote_time,
t.id as ticket_id, t.tn, t.title, t.create_time,
te.finish_time,
tt.name as type_name,
ts.name as state_name,
srv.name as service_name,
q1.name as queue_create_name,
te.queue_finish,
q2.name as queue_finish_name,
sv.id as vote_id, fnRemTagHtml(replace(sv.vote_value,'$html/text$','')) as vote_value
, sa.answer, sa.position as position_answer
, case when sv.vote_value in (25,26,30,31,35,36,40,41) then 1 else null end as satisfaction
, case when sv.vote_value in (28,29,33,34,38,39,43,44) then 0 else null end as nosatisfaction
from survey s
join survey_question sq on s.id = sq.survey_id
join survey_request sr on s.id = sr.survey_id
join ticket t on sr.ticket_id = t.id
join ticket_type tt on t.type_id = tt.id
join ticket_state ts on t.ticket_state_id = ts.id
join vw_tickets_encerrados te on t.id = te.ticket_id and te.queue_finish in (1,2,3,5,6,7,8)
join queue q1 on te.queue_create = q1.id
join queue q2 on te.queue_finish = q2.id
left join survey_vote sv on sq.id = sv.question_id and sr.id = sv.request_id
left join survey_answer sa on sv.vote_value = sa.id
left join service srv on t.service_id = srv.id
where 1=1
order by sr.ticket_id, sq.position
;

--
drop view if exists vw_survey_questions;
create view vw_survey_questions as
select 
	s.id as survey_id,
	s.title as title,
	s.status as status,
	s.description as description,
	sq.id as question_id,
	sq.question as question,
	sq.question_type as question_type,
	sq.position as position,
	sq.answer_required as answer_required,
	sq.create_by as create_by,
	sq.create_time as create_time
from survey_question sq
join survey s on sq.survey_id = s.id and s.status = 'Master'
order by sq.position
;

--
drop view if exists vw_survey_answers_textarea;
create view vw_survey_answers_textarea as
select 
	sv.question_id as question_id,
	cast(sv.create_time as date) as date_vote,
	(case
		when (sv.vote_value <> '') then 1
		else 0
	end) as amount_answered,
	(case
		when (sv.vote_value = '') then 1
		else 0
	end) as amount_not_answered
from survey_vote sv
join survey_question sq on sv.question_id = sq.id and sq.question_type = 'Textarea'
;

--
drop view if exists vw_survey_answers;
create view vw_survey_answers as
select 
	sq.id as question_id,
	sq.question as question,
	sq.position as pos_question,
	sa.id as answer_id,
	sa.answer as answer,
	sa.position as pos_answer,
	coalesce(cast(sv.create_time as date),
			sat.date_vote) as date_vote,
	count(sv.id) as amount,
	sum(sat.amount_answered) as amount_answered,
	sum(sat.amount_not_answered) as amount_not_answered
from survey_question sq
left join survey_answer sa on sq.id = sa.question_id
left join survey_vote sv on sa.id = sv.vote_value
left join vw_survey_answers_textarea sat on sq.id = sat.question_id
group by sq.id , sq.question , sq.position , sa.id , sa.answer , sa.position , coalesce(cast(sv.create_time as date),sat.date_vote)
order by sq.position , sa.position
;

--
drop view if exists vw_kpi_escalonado;
create view vw_kpi_escalonado as 
select
kpi.*,
fm.history_id,
th.queue_id as escalated_queue,
th.change_time as change_first_move,
case when th.change_time is not null then 
	fncTotalHorasUteis(1,kpi.create_time,th.change_time) else
    '00:00:00'
end as time_move
from vw_kpi kpi
join vw_first_move fm on kpi.ticket_id = fm.ticket_id
join ticket_history th on fm.history_id = th.id
 and th.queue_id not in (23) -- Encerrado
where 1=1
;

-- Primeira notificação ao cliente
drop view if exists vw_first_notify;
create view vw_first_notify as
select
min(th.id) as history_id,
th.ticket_id
from ticket_history th
where history_type_id = 10 -- SendCustomerNotification
group by th.ticket_id
;

-- 
drop view if exists vw_reclassified;
create view vw_reclassified as
select distinct
th.ticket_id
from ticket_history th
join ticket t on th.ticket_id = t.id
join vw_first_notify fn on t.id = fn.ticket_id
where 1=1
and history_type_id in (37,38)-- TypeUpdate & ServiceUpdate
and state_id in (4,5,2,3)
and t.create_time <> th.create_time
and th.id > fn.history_id
;

-- 
drop view if exists vw_kpi_reclassificado;
create view vw_kpi_reclassificado as
select
kpi.*
from vw_kpi kpi
where kpi.ticket_id in (select ticket_id from vw_reclassified)
;

--
drop view if exists vw_notify_resolution;
create view vw_notify_resolution as 
select distinct ticket_id
from article a
where 1=1
and a.a_subject LIKE '%Resolução do Chamado%'
;

--
drop view if exists vw_kpi_notificacao;
create view vw_kpi_notificacao as
select
kpi.*
from vw_kpi kpi
where kpi.ticket_id not in (select ticket_id from vw_notify_resolution)
;

--
drop view if exists vw_reopen;
create view vw_reopen as 
select
t.id as ticket_id, (count(*) -1) as qtd_reopen
from ticket_history th
join ticket t on th.ticket_id = t.id
where 1=1
and th.history_type_id = 27 -- StateUpdate
and th.state_id in (3) -- Resolvido
group by t.id, t.tn
having count(*) >= 2
;

--
drop view if exists vw_tickets_reabertos;
create view vw_tickets_reabertos as
select
kpi.*
from vw_kpi kpi
where kpi.ticket_id in (select ticket_id from vw_reopen)
;

--
drop view if exists vw_user_role;
create view vw_user_role as
select 
r.id as role_id,
r.name as role_name,
u.id as user_id,
u.first_name, u.last_name
from roles r
join role_user ru on r.id = ru.role_id
join users u on ru.user_id = u.id
;

--
drop view if exists vw_sla_fulfill;
create view vw_sla_fulfill as
select
*
from vw_kpi
where 1=1
and (fncTime2ToInt(timeResolution) - fncTime2ToInt(timePendingCS)) <= 14400
;

--
drop view if exists vw_sla_violate;
create view vw_sla_violate as
select
*
from vw_kpi
where 1=1
and (fncTime2ToInt(timeResolution) - fncTime2ToInt(timePendingCS)) > 14400
;

--
drop view if exists vw_ticket_ci;
create view vw_ticket_ci AS
select t.id as ticket_id, t.tn,
lr.*
from link_relation lr
join ticket t on lr.source_key = t.id and lr.source_object_id = 1
join configitem ci on lr.target_key = ci.id and lr.target_object_id = 2
;

--
drop view if exists vw_ticket_stat_general;
create view vw_ticket_stat_general as 
select 
1 as id, 'Tickets sem Serviço' as title, count(*) as qtd from ticket where coalesce(service_id,0) = 0 and ticket_state_id <> 10
union
select 
2 as id, 'Tickets sem CI' as title, count(*) as qtd from ticket where ticket_state_id <> 10 and id not in (select ticket_id from vw_ticket_ci)
union
select 
3 as id, 'Notificações enviadas aos Clientes' as title, count(*) from ticket_history where history_type_id = 10
union
select 
4 as id, 'Ligações de Retorno(Agente)' as title, count(*) from ticket_history where history_type_id = 13
union
select 
5 as id, 'Ligações de Retorno(Cliente)' as title, count(*) from ticket_history where history_type_id = 14
union
select 
6 as id, 'Respostas por Email' as title, count(*) from ticket_history where history_type_id = 8
union
select 
7 as id, 'Atividades Extras' as title, count(*) from ticket_history where history_type_id = 25
union
select 
8 as id, 'Tickets Aberto por Email' as title, count(*) from vw_first_article where article_type_id = 1
union
select 
9 as id, 'Tickets Aberto por Telefone' as title, count(*) from vw_first_article where article_type_id = 5
union
select 
10 as id, 'Tickets Aberto por Self-Service' as title, count(*) from vw_first_article where article_type_id = 8
;
