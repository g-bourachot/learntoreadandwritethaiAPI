<?php

require __DIR__ . '/UserMapper.php';
require __DIR__ . '/LevelMapper.php';
require __DIR__ . '/LessonMapper.php';
require __DIR__ . '/QuestionMapper.php';
require __DIR__ . '/AnswerMapper.php';

$app->get('/welcome', function ($request, $response, $args) {
    echo "Welcome to Slim 3.0 based API";
});


$app->get('/users', function ($request, $response, $args) {
	$mapper = new UserMapper($this->db);
	$response->getBody()->write($mapper->getUsers());
});

$app->get('/user/{id}', function ($request, $response, $args) {
	$userId = (int)$args['id'];
	$mapper = new UserMapper($this->db);
	$response->getBody()->write($mapper->getUserById($userId));
});

$app->get('/levels', function ($request, $response, $args) {
	$mapper = new LevelMapper($this->db);
	$response->getBody()->write($mapper->getLevels());
});

$app->get('/level/{id}', function ($request, $response, $args) {
	$levelId = (int)$args['id'];
	$mapper = new LevelMapper($this->db);
	$response->getBody()->write($mapper->getLevelById($levelId));
});

$app->get('/questions/{levelId}/{limit}', function ($request, $response, $args) {
	$levelId = (int)$args['levelId'];
	$limit = (int)$args['limit'];
	$mapper = new QuestionMapper($this->db);
	$answerMapper = new AnswerMapper($this->db);
	$response->getBody()->write($mapper->getQuestions($levelId, $limit, $answerMapper));
});

$app->get('/answers/{questionId}', function ($request, $response, $args) {
	$questionId = (int)$args['questionId'];
	$mapper = new AnswerMapper($this->db);
	$response->getBody()->write($mapper->getAnswers($questionId));
});

$app->get('/lessons', function ($request, $response, $args) {
	$mapper = new LessonMapper($this->db);
	$response->getBody()->write($mapper->getLessons());
});

$app->get('/lesson/{id}', function ($request, $response, $args) {
	$lessonId = (int)$args['id'];
	$mapper = new LessonMapper($this->db);
	$response->getBody()->write($mapper->getLessonById($lessonId));
});

