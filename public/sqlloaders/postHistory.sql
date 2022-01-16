USE stack;
LOAD XML LOCAL INFILE '/var/www/html/public/database/PostHistory.xml' 
INTO TABLE post_histories
 ROWS IDENTIFIED BY '<row>'
 (
	@`Id`,
    @`PostId`,
    @`UserId`,
    @`PostHistoryTypeId`,
    @`ContentLicense`,
    @`RevisionGUID`,
    @`Text`,
    @`Comment`,
    @`CreationDate`
 )
SET `id` = @`Id`, 
`user_id` = @`UserId`, 
`post_id` = @`PostId`, 
`post_history_type_id` = @`PostHistoryTypeId`, 
`content_license` = @`ContentLicense`,
`revision_guid` = @`RevisionGUID`,
`text` = @`Text`,
`comment` =  @`Comment`,
 `created_at` = @`CreationDate`, 
 `updated_at` = @`CreationDate`;