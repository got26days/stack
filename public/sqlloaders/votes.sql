USE stack;
LOAD XML LOCAL INFILE '/var/www/html/public/database/Votes.xml' 
INTO TABLE votes
 ROWS IDENTIFIED BY '<row>'
 (
	@`Id`,
    @`UserId`,
    @`PostId`,
    @`VoteTypeId`,
    @`BountyAmount`,
    @`CreationDate`
 )
SET `id` = @`Id`, `user_id` = @`UserId`, `post_id` = @`PostId`, `vote_type_id` = @`VoteTypeId`, `bounty_amount` = @`BountyAmount`, `created_at` = @`CreationDate`, `updated_at` = @`CreationDate`;