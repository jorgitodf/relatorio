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

