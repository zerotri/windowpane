<?php
/*post:
    __table: posts
    __orderby: id
    id: { field: id, type: int }
    user: { field: user, type: string }
    content: { field: content, type: string }*/

class PostModel extends WModel
{
	public $fields = array("id", "user", "content");
	public function __construct()
	{
		
	}
}
?>