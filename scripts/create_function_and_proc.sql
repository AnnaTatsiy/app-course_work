
use db_course_work02_tatsiy

-- ----------------------------------------------------------------------------------------------------------------------------------------------------//
-- Создание представления рабочие 
drop view if exists view_workers;

create view  view_workers as
 select 
	workers.id,
    CONCAT(people.surname, ' ', people.name, ' ',people.patronymic) as full_name,
	specializations.name_specialization as specialization,
	workers.workers_category,
	workers.experience

 from workers join people on workers.person_id = people.id
			  join specializations on workers.specialization_id = specializations.id
              
-- ----------------------------------------------------------------------------------------------------------------------------------------------------//
-- Создание представления клиенты
drop view if exists view_client;

create view view_client as
 select 
	clients.id,
	CONCAT(people.surname, ' ', people.name, ' ',people.patronymic) as full_name,
	clients.passport,
	clients.registration,
	clients.date_of_birth

 from clients join people on clients.person_id = people.id	
 
 -- ----------------------------------------------------------------------------------------------------------------------------------------------------//
 -- Создание представления авто
drop view if exists view_cars;

create view view_cars as
 select 
	cars.id,
	brands.id as brands_id,
	brands.name_brand as brand,
	colors.id as colors_id, 
	colors.name_color as color,
	cars.year_of_release,
	cars.state_number,
	view_client.id as owner_id,
	view_client.full_name as owner,
	view_client.passport as owner_passport

 from cars join brands on cars.brand_id = brands.id
		   join colors on cars.color_id = colors.id
		   Join view_client on Cars.client_id = view_client.id
           
-- ----------------------------------------------------------------------------------------------------------------------------------------------------//
-- Создание представления архив 
drop view if exists view_archive;

create view view_archive as
 select 
	repairs.id,
	malfunctions.id as malfunction_id,
	malfunctions.name_malfunction as malfunction,
	malfunctions.price as malfunctions_price,
	view_workers.id as workers_id,
	view_workers.full_name as worker,
	view_workers.specialization,
	view_cars.id as cars_id,
	view_cars.brand,
	view_cars.state_number,
	repairs.date_of_detection,
	repairs.date_of_correction,
	view_client.id as client_id,
	view_client.full_name as client,
	view_client.passport,
	repairs.is_fixed,
	spare_parts.id as spare_part_id,
	spare_parts.name_spare_part as spare_part,
	spare_parts.price as spare_part_price,
	malfunctions.price + spare_parts.price as price
	

 from  repairs join malfunctions on repairs.malfunction_id = malfunctions.id
			   join view_workers on repairs.worker_id = view_workers.id
			   join view_cars on repairs.car_id = view_cars.id
			   join view_client on repairs.client_id = view_client.id
			   join spare_parts on repairs.spare_part_id = spare_parts.id
               
 where repairs.date_of_correction < curdate();
 
 -- ----------------------------------------------------------------------------------------------------------------------------------------------------//
-- Создание представления текущие ремонты 
drop view if exists view_repairs;

create view view_repairs as
 select 
	repairs.id,
	malfunctions.id as malfunction_id,
	malfunctions.name_malfunction as malfunction,
	malfunctions.price as malfunctions_price,
	view_workers.id as workers_id,
	view_workers.full_name as worker,
	view_workers.specialization,
	view_cars.id as cars_id,
	view_cars.brand,
	view_cars.state_number,
	repairs.date_of_detection,
	repairs.date_of_correction,
	view_client.id as client_id,
	view_client.full_name as client,
	view_client.passport,
	repairs.is_fixed,
	spare_parts.id as spare_part_id,
	spare_parts.name_spare_part as spare_part,
	spare_parts.price as spare_part_price,
	malfunctions.price + spare_parts.price as price
	

 from  repairs join malfunctions on repairs.malfunction_id = malfunctions.id
			   join view_workers on repairs.worker_id = view_workers.id
			   join view_cars on repairs.car_id = view_cars.id
			   join view_client on repairs.client_id = view_client.id
			   join spare_parts on repairs.spare_part_id = spare_parts.id
               
 where repairs.date_of_correction > curdate() and repairs.is_fixed = 0;

delimiter ::
-- ----------------------------------------------------------------------------------------------------------------------------------------------------//
-- Запрос 1
-- Фамилия, имя, отчество и адрес владельца автомобиля с данным номером государственной регистрации
drop procedure if exists owner_by_state_number::

create procedure owner_by_state_number(in id int)
		begin 
			select 
				view_client.id,
				view_client.full_name,
				view_client.passport,
				view_client.registration,
				view_client.date_of_birth

			from view_cars join view_client on view_cars.owner_id = view_client.id
		where view_cars.id = id;
end::

-- ----------------------------------------------------------------------------------------------------------------------------------------------------//
-- Запрос 3
-- Перечень устраненных неисправностей в автомобиле данного владельца 
drop procedure if exists malfunctions_by_owner::

create procedure malfunctions_by_owner(in id int)

		begin
			select 
				malfunctions.id,
				malfunctions.name_malfunction,
				malfunctions.price
			from repairs join malfunctions on repairs.malfunction_id = malfunctions.id
						 join cars on repairs.car_id = cars.id
			where repairs.is_fixed = 1 and cars.client_id = id;
	end::
  
-- ----------------------------------------------------------------------------------------------------------------------------------------------------//
-- Запрос 4
-- Фамилия, имя, отчество работника станции, устранявшего данную неисправность в автомобиле данного клиента, и время ее устранения
drop procedure if exists worker_by_malfunction_client::

create procedure worker_by_malfunction_client(in id_client int, in id_malfunctions int)
		begin
			select 
					view_workers.full_name,
					view_workers.specialization,
					repairs.is_fixed,
					repairs.date_of_correction

			from repairs join malfunctions on repairs.malfunction_id = malfunctions.id
						 join view_workers on repairs.worker_id = view_workers.id
			where repairs.malfunction_id = id_malfunctions and repairs.client_id = id_client;
end::

-- ----------------------------------------------------------------------------------------------------------------------------------------------------//
-- Запрос 5
-- Фамилия, имя, отчество клиентов, сдавших в ремонт автомобили с указанным типом неисправности? 
drop procedure if exists clients_by_malfunctions::

create procedure clients_by_malfunctions(in id_malfunctions int)
		begin 
			select distinct
					view_client.id,
					view_client.full_name,
					view_client.passport,
					view_client.registration,
					view_client.date_of_birth

			from repairs join malfunctions on repairs.malfunction_id = malfunctions.id
						 join view_client on view_client.id = repairs.client_id
			where repairs.malfunction_id = id_malfunctions;
end::

-- ----------------------------------------------------------------------------------------------------------------------------------------------------//
-- Запрос 6
-- Самая распространенная неисправность в автомобилях указанной марки? 
drop procedure if exists malfunction_by_brand::

create procedure malfunction_by_brand(in id_brand int)
	begin
		select 
			malfunctions.name_malfunction,
			Max(Count(Malfunctions.Id)) as max_count_malfunctions
		from repairs join malfunctions on repairs.malfunction_id = malfunctions.id
					 join (cars join brands on cars.brand_id = brands.id) on cars.id = repairs.car_id
		where brands.id = id_brand
		group by malfunctions.name_malfunction;
end::

-- ----------------------------------------------------------------------------------------------------------------------------------------------------//
-- Запрос 7
-- Количество рабочих каждой специальности на станции? 
drop procedure if exists count_by_specialization::

create procedure count_by_specialization()
		begin 
			select 
				specializations.id,
				specializations.name_specialization,
				Count(workers.specialization_id) as count_workers
			from specializations left join workers on workers.specialization_id = specializations.id 
		group by specializations.id, specializations.name_specialization;
end::

-- ----------------------------------------------------------------------------------------------------------------------------------------------------//
-- Запрос 9
-- Id занятых рабочих на текущий момент.
drop procedure if exists free_workers::

create procedure free_workers()

		begin
			select distinct
				workers_id
			from view_repairs;
end::

-- ----------------------------------------------------------------------------------------------------------------------------------------------------//
-- Запрос 10
-- Требуется также выдача месячного отчета о работе станции 
-- техобслуживания. В отчет должны войти данные о количестве 
-- устраненных неисправностей каждого вида и о доходе, полученном станцией,
drop procedure if exists month_report_about_profit::

create procedure month_report_about_profit(in param_month int)
		begin
        	select 
				malfunctions.id,
				malfunctions.name_malfunction,
				count(repairs.malfunction_id) as count_repairs,
				malfunctions.price * count(repairs.malfunction_id) as profit
			from malfunctions left join repairs on malfunctions.id = repairs.malfunction_id
			where repairs.is_fixed = 1 and MONTH(repairs.date_of_correction) = param_month
			group by malfunctions.id, malfunctions.name_malfunction, malfunctions.price;
        end::

delimiter ;

		







