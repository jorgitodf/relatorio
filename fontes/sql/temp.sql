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
coalesce(mv.qtd_move,0) as qtd_move,
coalesce(bp.history_id,0) as bypass_cs,
fncTempoNaFila(te.ticket_id,5) as timeQueueCS,
fncTempoPendente(te.ticket_id) as timePending,
fncTempoPendenteNaFila(te.ticket_id,5) as timePendingQueueCS,
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
left join vw_qtd_move mv on t.id = mv.ticket_id
left join vw_bypass_cs bp on t.id= bp.ticket_id
where 1=1
;

create view vw_kpi_pqs as 
select
s.id as survey_id, s.status,
sq.id as question_id, sq.question, sq.position,
sr.id as request_id, sr.public_survey_key, sr.send_to, sr.send_time, sr.vote_time,
t.id as ticket_id, t.tn, t.title, t.create_time,
te.queue_finish,
te.finish_time,
tt.name as type_name,
ts.name as state_name,
srv.name as service_name,
q1.name as queue_create_name,
q2.name as queue_finish_name,
te.user_finish,
sv.id as vote_id, fnRemTagHtml(replace(sv.vote_value,'$html/text$','')) as vote_value
, sa.answer
, case when sv.vote_value in (10,11,12,13) then 1 else null end as satisfaction
, case when sv.vote_value in (4,5,6,7,8,9) then 1 else null end as nosatisfaction
from survey s
join survey_question sq on s.id = sq.survey_id
join survey_request sr on s.id = sr.survey_id
join ticket t on sr.ticket_id = t.id
join ticket_type tt on t.type_id = tt.id
join ticket_state ts on t.ticket_state_id = ts.id
join vw_tickets_encerrados te on t.id = te.ticket_id and te.queue_finish in (5)
join queue q1 on te.queue_create = q1.id
join queue q2 on te.queue_finish = q2.id
left join survey_vote sv on sq.id = sv.question_id and sr.id = sv.request_id
left join survey_answer sa on sv.vote_value = sa.id
left join service srv on t.service_id = srv.id
where 1=1
order by sr.ticket_id, sq.position
;



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
join ticket_history thf on thf.id = fh.history_id;


-- Tempo encaminhamento OLA
create view vw_tickets_ola as
select
kpi.*,
th.change_time as move_ola,
fncTotalHorasUteis(1,kpi.create_time,th.change_time) as time_move_ola
from vw_kpi kpi
join (
	select min(th.id) as history_id, th.ticket_id
	  from ticket_history th
	 where history_type_id = 16
	   and queue_id = 27
	 group by th.ticket_id
) ola on kpi.ticket_id = ola.ticket_id
join ticket_history th on ola.history_id = th.id
;

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
coalesce(mv.qtd_move,0) as qtd_move,
coalesce(bp.history_id,as bypass_cs,
fncTempoNaFila(te.ticket_id,5) as timeQueueCS,
fncTempoPendente(te.ticket_id) as timePending,
fncTempoPendenteNaFila(te.ticket_id,5) as timePendingQueueCS,
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
left join vw_qtd_move mv on t.id = mv.ticket_id
left join vw_bypass_cs bp on t.id= bp.ticket_id
where 1=1
;


CREATE 
    ALGORITHM = UNDEFINED 
    DEFINER = `root`@`localhost` 
    SQL SECURITY DEFINER
VIEW `vw_kpi` AS
    SELECT 
        `t`.`id` AS `ticket_id`,
        `t`.`tn` AS `tn`,
        `t`.`title` AS `title`,
        `t`.`create_time` AS `create_time`,
        `tt`.`id` AS `type_id`,
        `tt`.`name` AS `type_name`,
        `tp`.`id` AS `priority_id`,
        `tp`.`name` AS `priority_name`,
        `ts`.`id` AS `state_id`,
        `ts`.`name` AS `state_name`,
        `s`.`id` AS `service_id`,
        `s`.`name` AS `service_name`,
        `te`.`queue_create` AS `queue_create`,
        `q1`.`name` AS `queue_create_name`,
        `te`.`queue_finish` AS `queue_finish`,
        `q2`.`name` AS `queue_finish_name`,
        `te`.`finish_time` AS `finish_time`,
        `te`.`user_finish` AS `user_finish_id`,
        CONCAT(`u`.`first_name`, ' ', `u`.`last_name`) AS `user_finish`,
        COALESCE(`mv`.`qtd_move`, 0) AS `qtd_move`,
        COALESCE(`bp`.`history_id`, 0) AS `bypass_cs`,
        FNCTEMPONAFILA(`te`.`ticket_id`, 5) AS `timeQueueCS`,
        FNCTEMPOPENDENTE(`te`.`ticket_id`) AS `timePending`,
        FNCTEMPOPENDENTENAFILA(`te`.`ticket_id`, 5) AS `timePendingQueueCS`,
        FNCTOTALHORASUTEIS(1, `t`.`create_time`, `te`.`finish_time`) AS `timeResolution`
    FROM
        ((((((((((`vw_tickets_encerrados` `te`
        JOIN `ticket` `t` ON ((`te`.`ticket_id` = `t`.`id`)))
        JOIN `queue` `q1` ON ((`te`.`queue_create` = `q1`.`id`)))
        JOIN `queue` `q2` ON ((`te`.`queue_finish` = `q2`.`id`)))
        JOIN `users` `u` ON ((`te`.`user_finish` = `u`.`id`)))
        JOIN `ticket_type` `tt` ON ((`t`.`type_id` = `tt`.`id`)))
        JOIN `ticket_priority` `tp` ON ((`t`.`ticket_priority_id` = `tp`.`id`)))
        JOIN `ticket_state` `ts` ON ((`t`.`ticket_state_id` = `ts`.`id`)))
        LEFT JOIN `service` `s` ON ((`t`.`service_id` = `s`.`id`)))
        LEFT JOIN `vw_qtd_move` `mv` ON ((`t`.`id` = `mv`.`ticket_id`)))
        LEFT JOIN `vw_bypass_cs` `bp` ON ((`t`.`id` = `bp`.`ticket_id`)))
    WHERE
        (1 = 1)