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


ALTER TABLE comments MODIFY id INTEGER(4);

CREATE INDEX post_id_index ON comments (post_id);

ALTER TABLE questions MODIFY id INTEGER(4);

ALTER TABLE questions MODIFY owner_user_id INTEGER(4);
ALTER TABLE questions MODIFY last_editor_user_id INTEGER(4);
ALTER TABLE questions MODIFY accepted_answer_id INTEGER(4);
ALTER TABLE questions MODIFY score INTEGER(4);
ALTER TABLE questions MODIFY parent_id INTEGER(4);
ALTER TABLE questions MODIFY view_count INTEGER(4);
ALTER TABLE questions MODIFY answer_count INTEGER(4);
ALTER TABLE questions MODIFY comment_count INTEGER(4);
ALTER TABLE questions MODIFY favorite_count INTEGER(4);


CREATE INDEX reputation_index ON users (reputation);
CREATE INDEX up_votes_index ON users (up_votes);
CREATE INDEX down_votes_index ON users (down_votes);
CREATE INDEX created_at_index ON users (created_at);

ALTER TABLE answers MODIFY score INTEGER(5);

TRUNCATE another_posts;

SET GLOBAL local_infile = 1;

ALTER TABLE questions MODIFY answer_count INTEGER(4);

CREATE INDEX title_index on questions(title);

ALTER TABLE questions  
ADD FULLTEXT(title);

CREATE INDEX answer_count_index on questions(answer_count);
CREATE INDEX owner_user_id_index on questions(owner_user_id);
CREATE INDEX accepted_answer_id_index on questions(accepted_answer_id);
CREATE INDEX display_name_index on users(display_name);


CREATE INDEX title_index on questions(title);
CREATE INDEX title_index on questions(title);
CREATE INDEX title_index on questions(title);
CREATE INDEX title_index on questions(title);

CREATE INDEX user_id_index on comments(user_id);
