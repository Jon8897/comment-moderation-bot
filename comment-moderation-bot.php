<?php
/**
 * Plugin Name: My Comment Moderation Bot
 * Description: Custom comment moderation bot for WordPress.
 * Version: 1.0.0.1
 * Author: Jonathan Keefe
 */

 add_filter('preprocess_comment', 'comment_moderation_bot');

 function comment_moderation_bot($comment) {
    // Define your list of disallowed keywords
    $disallowed_keywords = ['spamword1', 'spamword2'];
    // Maximum number of hyperlinks allowed in a comment
    $max_links = 0;
    $comment_content = strtolower($comment['comment_content']);
    // Time interval in seconds
    $time_interval = 60;

    foreach ($disallowed_keywords as $keyword) {
        // Check if any disallowed keyword is in the comment content
        if (strpos(strtolower($comment['comment_content']), strtolower($keyword))!== false) {
            // Kill the script and send a message to the user
            wp_die('Comment contains disallowed words');
        }
    }

    // Check number of links
    $link_count = preg_match_all('/<a\s+href/i', $comment_content);
    if ($link_count > $max_links) {
        wp_die('Too many links in comment.');
    } 

    // Check the time of the user's last comment
    $last_comment_time = get_transient('last_comment_time_'. $comment['comment_author_IP']);
    if($last_comment_time) {
        wp_die('Your are posting comments to quickly. Slow Down.');
    }

    // Save the time of current comment
    set_transient('last_comment_time_'. $comment['comment_author_IP'], current_time('timestamp'), $time_interval);

    // Additional Checks to be added here

    // Return the comment if it passes the checks
    return $comment;
 }