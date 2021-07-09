<?php
$baseName = __DIR__; //Library/WebServer/Documents/post_api/
$baseName = str_replace('dal', '', $baseName);

require_once $baseName.'/Connect.php';

class PostDAL extends Connect
{
    function getAll ()
    {
        $rs = $this->pdo->query('SELECT * FROM posts');
        return $rs->fetchAll(PDO::FETCH_ASSOC);
    }

    function add ($payload)
    {
        try {
            $stm = $this->pdo->prepare('INSERT INTO posts(title,content,keyword,author) 
                            VALUES(:title,:content,:keyword,:author)');
            $stm->bindParam(':title', $title);
            $stm->bindParam(':content', $content);
            $stm->bindParam(':keyword', $keyword);
            $stm->bindParam(':author', $author);
            $title = $payload['title'];
            $content = $payload['content'];
            $keyword = $payload['keyword'];
            $author = $payload['author'];
            $stm->execute();
        } catch (Exception $e) {
            var_dump($e->getMessage());
            return false;
        }
        return true;
    }

    function edit ()
    {

    }

    function delete ($id)
    {
        try {
            $this->pdo->query('DELETE FROM posts WHERE id='.$id);
        } catch (Exception $e) {
            return false;
        }
        return true;
    }
}

?>