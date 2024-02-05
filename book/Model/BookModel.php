<?php 

require_once PROJECT_ROOT_PATH."Model/Database.php";

class BookModel extends Database
{
    public function getBooks($limit)
    {
        return $this->select("select * from book limit ?", ["i",$limit]);
    }

    public function returnBook($id)
    {
        return $this->select("select * from book where id = ?",["i",$id]);
    }

    public function createBook($data)
    {
        $title = htmlspecialchars(strip_tags($data['book_title']));
        $author = htmlspecialchars(strip_tags($data['author']));
        $genre = htmlspecialchars(strip_tags($data['genre']));
        $price = htmlspecialchars(strip_tags( $data['price']));
        return $this->insert("insert into book (book_title, author, genre, price) values(?,?,?,?)", ['sssd',$title,$author,$genre,$price]);
    }

    public function searchBook($param)
    {
        $searchVal = "%".$param."%";
        return $this->select("select * from book where (book_title LIKE ?) OR (author LIKE ?) OR (genre LIKE ?)",['sss',$searchVal,$searchVal,$searchVal]);
    }

    public function updateBook($data)
    {
        $id = htmlspecialchars(strip_tags($data['id']));
        $title = htmlspecialchars(strip_tags($data['book_title']));
        $author = htmlspecialchars(strip_tags($data['author']));
        $genre = htmlspecialchars(strip_tags($data['genre']));
        $price = htmlspecialchars(strip_tags( $data['price']));
        $this->updateDelete("update book set book_title = ?, author = ?, genre = ?, price = ? where id = ?",['sssdi', $title,$author,$genre,$price,$id]);
    }

    public function deleteBook($id)
    {
        $this->updateDelete("delete from book where id = ?",['i',$id]);
    }

    public function updateRating($data)
    {
        $id = htmlspecialchars(strip_tags($data['id']));
        $rating = htmlspecialchars(strip_tags($data['rating']));
        $this->updateDelete("update book set rating = ? where id = ?",['di',$rating,$id]);
    }
}