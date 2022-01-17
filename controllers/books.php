<?php
require "models/books.php";

$page = filter_input(INPUT_GET, "currentPage", FILTER_SANITIZE_NUMBER_INT) ?? 1;

$search = filter_input(INPUT_GET, "search", FILTER_SANITIZE_STRING) ?? "";

$pagination = [
    "numberPerPage" => 5,
    "totalNumberOfRows" => countBooks($search),
    "currentPage" => $page,
];

$pagination["numberOfPages"] = ceil($pagination["totalNumberOfRows"]/$pagination["numberPerPage"]);

if($pagination["numberOfPages"] < $page){
    $pagination["currentPage"] = 1;
}

$books = findBooks($pagination, $search);

echo render("books", [
    "bookList" => $books,
    "pagination" => $pagination,
    "search" => $search
]);