use stack;
CREATE INDEX created_at_index ON questions (created_at);
CREATE INDEX closed_date_index ON questions (closed_date);
CREATE INDEX score_index ON questions (score);
CREATE INDEX title_index ON questions (title);



CREATE INDEX tags_index ON questions (tags);




CREATE INDEX post_type_id_index on posts(post_type_id);

ALTER TABLE table ADD FULLTEXT INDEX index_table_on_tags (tags);


use admin_1;
SELECT * FROM posts WHERE `tags` LIKE '%php%' LIMIT 0, 10


ALTER TABLE questions
ADD FULLTEXT(tags);


CREATE INDEX post_id_index ON post_tag (post_id);
CREATE INDEX tag_id_index ON post_tag (tag_id);


CREATE INDEX parent_id_index on posts(parent_id);
CREATE INDEX created_at_index on posts(created_at);
CREATE INDEX score_index on posts(score);