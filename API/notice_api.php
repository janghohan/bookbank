<?php
include '../db.php';

$page = $_GET['page'];
$type = $_GET['type'];

if($type=='notice'){

}else if($type=='inquery'){

}else if($type)
$limit = 10;

$start = ($page - 1) * $limit;

$query = "SELECT * FROM posts LIMIT $start, $limit";
$result = $conn->query($query);

$posts = array();
while ($row = $result->fetch_assoc()) {
    $posts[] = $row; // 전체 행을 배열에 추가
}

// 전체 게시글 수 계산
$queryCount = "SELECT COUNT(*) as total FROM posts";
$resultCount = $conn->query($queryCount);
$rowCount = $resultCount->fetch_assoc();
$totalPages = ceil($rowCount['total'] / $limit);

// 페이징 부분을 HTML로 반환
$pagination = '';
for ($i = 1; $i <= $totalPages; $i++) {
    $active = ($i == $page) ? 'active' : '';
    $pagination .= '<a href="#" class="page ' . $active . '" data-page="' . $i . '">' . $i . '</a>';
}

// JSON 형태로 반환
echo json_encode(array('posts' => $posts, 'pagination' => $pagination));

$conn->close();
?>
