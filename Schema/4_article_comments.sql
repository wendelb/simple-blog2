CREATE VIEW article_comments as (
    SELECT `article`, count(*) as `count`
    FROM `comment` 
    GROUP BY `article`
);