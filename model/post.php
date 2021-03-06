<?php
include_once "../db/database.php";

class Post
{


    public $title;
    private $slug;
    public $content;
    private $table = "posts";



    public function __construct()
    {
    }

    function insertPost()
    {
        $this->slug = $this->slug_encoder($this->title);

        $conn = $this->getConn();

        $sql = "INSERT INTO " . $this->table . " (title, slug, content)
        VALUES (?,?,?)";

        try {
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $this->title, $this->slug, $this->content);

            /*
        $stmt->bind_param("sss", $title, $slug, $content);
        $title = $this->title;
        $slug = $this->slug;
        $content = $this->content;
*/
            $stmt->execute();
            $stmt->close();
            $conn->close();
            return "New record created successfully";
        } catch (Exception $e) {
            if ($conn->errno === 1062) return 'Duplicate entry';
        }
    }

    public function getAllPosts()
    {
        $data = array();

        $conn = $this->getConn();
        $sql = "SELECT id, title, content FROM " . $this->table . " ORDER BY created_at DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            $data['message'] = "success";
            // $data['results'] = array(); //json_encode($result->fetch_assoc());
            $temp = $result->fetch_all(MYSQLI_ASSOC);

            $data['results']  = json_encode($temp);
        } else {
            $data['message'] = "unsuccessful";

            $data['results'] = "0";
        }
        $conn->close();
        return json_encode($data);
    }

    public function getPost($id)
    {
        $data = array();

        $conn = $this->getConn();
        $sql = "SELECT id, title, content FROM " . $this->table . " WHERE id = ?";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param("i", $id);

        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // output data of each row
            $data['message'] = "success";
            $temp = $result->fetch_assoc();

            $data['results']  = json_encode($temp);
        } else {
            $data['message'] = "unsuccessful";

            $data['results'] = "0";
        }
        $conn->close();
        return json_encode($data);
    }

    public function updatePost($id)
    {
        $conn = $this->getConn();
        $this->slug = $this->slug_encoder($this->title);


        $sql = "UPDATE " . $this->table
            . " SET title=? , slug = ? , content = ? WHERE id=?";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param("sssi", $this->title, $this->slug, $this->content, $id);


        /*
        $stmt->bind_param("sssi", $title, $slug, $content, $postid);
        
        $title = $this->title;
        $slug = $this->slug;
        $content = $this->content;
        $postid = $id;
*/
        $stmt->execute();
        $stmt->close();
        $conn->close();
        return "Post updated successfully";
    }



    public function deletePost($id)
    {
        # code...
        $conn = $this->getConn();
        $sql = "DELETE FROM " . $this->table . " WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);


        $stmt->execute();
        $stmt->close();

        $conn->close();
        return "Post deleted successfully";
    }

    private function getConn()
    {
        $db = new Database();
        return $db->connection();
    }
    private function remove_accent($str)
    {
        $a = array('??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??');
        $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o');
        return str_replace($a, $b, $str);
    }

    private function slug_encoder($slug)
    {

        return  strtolower(preg_replace(array('/[^a-zA-Z0-9 -]/', '/[ -]+/', '/^-|-$/'), array('', '-', ''), $this->remove_accent($slug)));
    }
}
