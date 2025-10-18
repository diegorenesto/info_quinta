select * from MOCK_DATA
order by last_name asc;

select * from MOCK_DATA
order by last_name desc;

select email as posta from MOCK_DATA where first_name = "Nero";

select distinct first_name from MOCK_DATA;

/* count e limit
select count(*) from MOCK_DATA;
select count(distinct last_name) from MOCK_DATA;
select * from MOCK_DATA limit 10;
select * from MOCK_DATA limit 10 offset 950;
*/