<?php
/**
 * Ad Slot A: Top Leaderboard
 */
$ad = pkm_render_ad('ad_slot_top', 'pkm-ad-top');
if (!empty($ad)) {
    echo $ad;
}
