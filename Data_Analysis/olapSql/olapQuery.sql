SELECT f.week, SUM(f.value) as SUM, MIN(f.value) as MIN, MAX(f.value) as MAX
FROM	fact3 f
where	f.sensor_id = 5500 and extract(year from date_created) = 2015 and extract(month from date_created) = 11
GROUP BY f.week;
