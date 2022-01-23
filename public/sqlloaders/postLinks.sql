USE stack;
LOAD XML LOCAL INFILE '/var/www/html/public/database/PostLinks.xml' 
INTO TABLE post_links
 ROWS IDENTIFIED BY '<row>'
 (
	@`Id`,
    @`PostId`,
    @`RelatedPostId`,
    @`LinkTypeId`,
    @`CreationDate`
 )
SET `id` = @`Id`, 
`related_post_id` = @`RelatedPostId`, 
`post_id` = @`PostId`, 
`link_type_id` = @`LinkTypeId`, 
 `created_at` = @`CreationDate`, 
 `updated_at` = @`CreationDate`;