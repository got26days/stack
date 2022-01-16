USE stack;
LOAD XML LOCAL INFILE '/var/www/html/public/database/Tags.xml' 
INTO TABLE tags
 ROWS IDENTIFIED BY '<row>'
 (
	@`Id`,
    @`ExcerptPostId`,
    @`WikiPostId`,
    @`TagName`,
    @`Count`
 )
SET `id` = @`Id`, 
`excerpt_post_id` = @`ExcerptPostId`, 
`wiki_post_id` = @`WikiPostId`, 
`tag_name` = @`TagName`, 
`count` = @`Count`,
 `created_at` = now(), 
 `updated_at` = now();