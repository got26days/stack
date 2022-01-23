USE stack;
LOAD XML LOCAL INFILE '/var/www/html/public/database/Users.xml' 
INTO TABLE users
 ROWS IDENTIFIED BY '<row>'
 (
	@`Id`,
    @`Reputation`,
    @`DisplayName`,
    @`LastAccessDate`,
    @`AboutMe`,
    @`Views`,
    @`UpVotes`,
    @`DownVotes`,
    @`AccountId`,
    @`Location`,
    @`ProfileImageUrl`,
    @`RelatedPostId`,
    @`LinkTypeId`,
    @`WebsiteUrl`,
    @`CreationDate`
 )
SET `id` = @`Id`, 
`email` = CONCAT(MD5(UUID()),'@test.fr'),
`password` = '$2y$10$DFwjLKxdbISkQA285.jkR.lxgNH5wPb6SSAJAR3HVn2XHePBTR0ue',
`account_id` = @`AccountId`,
`reputation` = @`Reputation`, 
`views` = @`Views`, 
`down_votes` = @`DownVotes`,
`up_votes` = @`UpVotes`,
`display_name` = @`DisplayName`,
`location` = @`Location`,
`profile_image_url` = @`ProfileImageUrl`,
`website_url` = @`WebsiteUrl`,
`about_me` = @`AboutMe`,
`last_access_date` = @`LastAccessDate`,
 `created_at` = @`CreationDate`, 
 `updated_at` = @`CreationDate`;