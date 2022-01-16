USE stack;
LOAD XML LOCAL INFILE '/var/www/html/public/database/Badges.xml' 
INTO TABLE badges 
 ROWS IDENTIFIED BY '<row>'
 (
	@`Id`,
    @`UserId`,
    @`Class`,
    @`Name`,
    @`TagBased`,
    @`Date`
 )
SET `id` = @`Id`, 
`user_id` = @`UserId`, 
`class` = @`Class`, 
`name` = @`Name`, 
`tag_based` = @`TagBased`, 
`date` = @`Date`, 
 `created_at` = @`Date`, 
 `updated_at` = @`Date`;