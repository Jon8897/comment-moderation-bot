<?php
/**
 * Plugin Name: My Comment Moderation Bot
 * Description: Custom comment moderation bot for WordPress.
 * Version: 1.0
 * Author: Jonathan Keefe
 */

 add_filter('preprocess_comment', 'comment_moderation_bot');

 function comment_moderation_bot($comment) {
    // Moderation logic
    $diallowed_keywords = ['spamword1', 'spamword2'];

    foreach ($disallowed_keywords as $keyword) {
        if (strops(strtolower($comment['comment_content']), strtolower($keyword))!== false) {
            wp_die('Comment contains disallowed words');
        }
    }

    return $comment;
 }