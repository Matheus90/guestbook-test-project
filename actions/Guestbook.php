<?php

class Guestbook extends MBaseAction {

    public function call($parameters){

        $review = new Review();

        $pagination = [
            'page' => isset($parameters['page']) ? $parameters['page'] : 1,
            'limit' => isset($parameters['count']) ? $parameters['count'] : 10,
        ];
        $reviews = $this->getReviewsList($pagination);

        $sql = "SELECT count(`id`) FROM `".(Review::model()->tableName())."`";
        $countStmt = App::db()->query($sql);
        $pagination['count'] = $countStmt->fetchColumn();
        $pagination['pageCount'] = ceil($pagination['count'] / $pagination['limit']);


        $sql = "SELECT AVG(`rating`) FROM `".(Review::model()->tableName())."`";
        $avgRating = App::db()->query($sql)->fetch();

        $this->render('guestbook', [
            'pagination' => $pagination,
            'review' => $review,
            'reviews' => $reviews->fetchAll(),
            'avgRating' => $avgRating[0]
        ]);
    }


    public function getReviewsList($pagination){
        $page = $pagination['page'];
        $limit = $pagination['limit'];
        $start = ($page-1) * $limit;
        $sql = "SELECT * FROM `".(Review::model()->tableName())."` ORDER BY `create_time` DESC LIMIT $start, $limit";
        return App::db()->query($sql, PDO::FETCH_CLASS, 'Review');
    }
}