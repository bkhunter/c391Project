SELECT extract(year from date_created) as YEAR, SUM(f.value) as SUM, MIN(f.value) as MIN, MAX(f.value) as MAX
FROM   fact3 f
GROUP BY extract(year from date_created);
