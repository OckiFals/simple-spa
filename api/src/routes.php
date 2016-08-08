<?php 
use \Psr\Http\Message\ServerRequestInterface as Request;
// Routes

$app->get('/books', function() {
	$pdo = $this->db->query("SELECT * FROM `books`");
	$data = $pdo->fetchAll();

	echo json_encode($data);
});

$app->post('/books', function(Request $request) {
	# ambil data post
	$body = $request->getParsedBody();
	# prepared statement
	$pdo = $this->db->prepare("INSERT INTO `books`(title, author, publisher, year)
		VALUES(:title, :author, :publisher, :year)
	");

	$pdo->bindParam(':title', $body['title']);
	$pdo->bindParam(':author', $body['author']);
	$pdo->bindParam(':publisher', $body['publisher']);
	$pdo->bindParam(':year', $body['year']);

	$pdo->execute();
});

$app->get('/books/{id}', function(Request $request) {
	# prepared statement
	$pdo = $this->db->prepare("SELECT * FROM `books` WHERE id=:book_id");
	$pdo->bindParam("book_id", $request->getAttribute('id'));
	$pdo->execute();
	$data = $pdo->fetch();

	echo json_encode($data);
});

$app->post('/books/{id}', function(Request $request) {
	# ambil data post
	$body = $request->getParsedBody();
	# ambil id buku dari url
	$id = $request->getAttribute('id');
	$pdo = $this->db->prepare("UPDATE `books` 
		SET title=:title, author=:author, publisher=:publisher, year=:year
		WHERE id=:book_id"
	);

	$pdo->bindParam(':title', $body['title']);
	$pdo->bindParam(':author', $body['author']);
	$pdo->bindParam(':publisher', $body['publisher']);
	$pdo->bindParam(':year', $body['year']);
	$pdo->bindParam(':book_id', $id);
	$pdo->execute();
	
	$pdo = $this->db->prepare("SELECT * FROM `books` WHERE id=:book_id");
	$pdo->bindParam("book_id", $request->getAttribute('id'));
	$pdo->execute();
	$data = $pdo->fetch();

	echo json_encode($data);
});

$app->delete('/books/{id}', function(Request $request) {
	# prepared statement
	$pdo = $this->db->prepare("DELETE FROM `books` WHERE id=:book_id");
	$pdo->bindParam("book_id", $request->getAttribute('id'));
	$pdo->execute();
	$data = $pdo->fetch();
});