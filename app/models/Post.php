<?php

class Post extends Model
{
	public function all()
	{
		$query_str = '
			select *,
			posts.id as post_id,
			users.id as user_id,
			posts.created_at as post_created_at,
			users.created_at as user_created_at,
			users.name as author
			from posts
			inner join users on posts.user_id = users.id
			order by posts.created_at desc
		';

		$query = $this->conn->pdo->prepare($query_str);

		$query->execute();

		$posts = $query->fetchAll(PDO::FETCH_OBJ);

		return $posts;
	}

	public function create($data)
	{
		$query = $this->conn->pdo->prepare('INSERT INTO posts (title, body, user_id) VALUES (:title, :body, :user_id)');

        $query->bindValue(':title', $data['title']);

        $query->bindValue(':body', $data['body']);

        $query->bindValue(':user_id', $data['user_id']);

        if($query->execute()){
            return true;
        }
        else {
            return false;
        }
	}

	public function find($id)
	{
		$query_str = '
			select *,
			posts.id as post_id,
			users.id as user_id,
			posts.created_at as post_created_at,
			users.created_at as user_created_at,
			users.name as author
			from posts
			inner join users on posts.user_id = users.id
			where posts.id = :postId
			order by posts.created_at desc
		';
		
		$query = $this->conn->pdo->prepare($query_str);
		
		$query->bindValue(':postId', $id);

		$query->execute();

		$post = $query->fetch(PDO::FETCH_OBJ);

		return $post;
	}

	public function update($data)
	{
		$query = $this->conn->pdo->prepare('UPDATE posts SET title = :title, body = :body WHERE id = :post_id');

        $query->bindValue(':title', $data['title']);

        $query->bindValue(':body', $data['body']);

        $query->bindValue(':post_id', $data['post_id']);

        if($query->execute()){
            return true;
        }
        else {
            return false;
        }
	}

	public function delete($id)
	{
		$query = $this->conn->pdo->prepare('DELETE FROM posts WHERE id = :post_id');

        $query->bindValue(':post_id', $id);

        if($query->execute()){
            return true;
        }
        else {
            return false;
        }
	}
}