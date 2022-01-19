use stack;
CREATE INDEX created_at_index ON posts (created_at);

CREATE INDEX score_index ON posts (score);
CREATE INDEX title_index ON posts (title);
CREATE INDEX tags_index ON posts (tags);
CREATE INDEX closed_date_index ON posts (closed_date);

CREATE INDEX post_type_id_index on posts(post_type_id);

-- CREATE INDEX id_index ON users (id);