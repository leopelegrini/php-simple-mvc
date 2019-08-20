<?php

class Task extends Model
{
	public function all()
	{
		$query_str = '
			select *,
			tasks.id as task_id,
			users.id as user_id,
			tasks.created_at as task_created_at,
			users.created_at as user_created_at,
			users.name as author
			from tasks
			inner join users on tasks.user_id = users.id
			order by tasks.created_at desc
		';

		$query = $this->conn->pdo->prepare($query_str);

		$query->execute();

		$tasks = $query->fetchAll(PDO::FETCH_OBJ);

		return $tasks;
	}

	public function create($data)
	{
		$query = $this->conn->pdo->prepare('INSERT INTO tasks (description, user_id) VALUES (:description, :user_id)');

        $query->bindValue(':description', $data['description']);

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
			tasks.id as task_id,
			users.id as user_id,
			tasks.created_at as task_created_at,
			users.created_at as user_created_at,
			users.name as author
			from tasks
			inner join users on tasks.user_id = users.id
			where tasks.id = :taskId
			order by tasks.created_at desc
		';
		
		$query = $this->conn->pdo->prepare($query_str);
		
		$query->bindValue(':taskId', $id);

		$query->execute();

		$task = $query->fetch(PDO::FETCH_OBJ);

		return $task;
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