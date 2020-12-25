<?php
class Post {
    private $user_obj;
    private $con;

    public function __construct($con, $user) {
        $this->con = $con;
        $this->user_obj = new User($con, $user);
    }

    public function submitPost($body) {
        $body = strip_tags($body); //HTMLタグ削除
        $body = mysqli_real_escape_string($this->con, $body);

        $check_empty = preg_replace('/\s+/', '', $body); //スペース削除 

        if($check_empty != "") {
            $posted_by = $this->user_obj->getUsername();
            $query = mysqli_query($this->con, "INSERT INTO posts VALUES('', '$body', '$posted_by')");
        }
    }

    public function loadPost() {
        $str = "";  
        $data = mysqli_query($this->con, "SELECT * FROM posts ORDER BY id DESC LIMIT 0,10");
        
        if(mysqli_num_rows($data) > 0) {
            while($row = mysqli_fetch_array($data)) {
                $id = $row['id'];
                $body = $row['body'];
                $posted_by = $row['posted_by'];

                $posted_by_obj = new User($this->con, $posted_by);
                $user_details_query = mysqli_query($this->con, "SELECT username FROM users WHERE username='$posted_by'");
                $user_row = mysqli_fetch_array($user_details_query);
                $username = $user_row['username'];

                $str .= "<div class='status_post'>
                            <div class='posted_by' style='color:#ACACAC;'>
                                $username
                            </div>
                            <div id='post_body'>
                                $body
                                <br>
                            </div>

                        </div>
                        <hr>";
            }

        }
        echo $str;
    }
}

?>