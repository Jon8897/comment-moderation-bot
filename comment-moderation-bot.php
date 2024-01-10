<?php
/**
 * Plugin Name: My Comment Moderation Bot
 * Description: Custom comment moderation bot for WordPress.
 * Version: 1.0
 * Author: Jonathan Keefe
 */

 add_filter('preprocess_comment', 'comment_moderation_bot');

 function comment_moderation_bot($comment) {
    // Define your list of disallowed keywords
    $disallowed_keywords = ['spamword1', 'spamword2'];

    foreach ($disallowed_keywords as $keyword) {
        // Check if any disallowed keyword is in the comment content
        if (strpos(strtolower($comment['comment_content']), strtolower($keyword))!== false) {
            // Kill the script and send a message to the user
            wp_die('Comment contains disallowed words');
        }
    }

    // Return the comment if it passes the checks
    return $comment;
 }