USE stack;
LOAD XML LOCAL INFILE '/var/www/html/public/database/Comments.xml' 
INTO TABLE comments
 ROWS IDENTIFIED BY '<row>'
 (
	@`Id`,
    @`PostId`,
    @`UserId`,
    @`Score`,
    @`Text`,
    @`BountyAmount`,
    @`CreationDate`,
    @`UserDisplayName`
 )
SET `id` = @`Id`, 
`user_id` = @`UserId`, 
`post_id` = @`PostId`, 
`score` = @`Score`, 
`text` = @`Text`,
`content_license` = @`ContentLicense`, 
`user_display_name` = @`UserDisplayName`,
 `created_at` = @`CreationDate`, 
 `updated_at` = @`CreationDate`;