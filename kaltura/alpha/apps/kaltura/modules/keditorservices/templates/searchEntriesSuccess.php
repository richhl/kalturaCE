<?php ?>

<assets total_count="<? echo $number_of_results ?>" pages="<? echo $number_of_pages ?>">
<?
assetsUtils::createAssets ( $entry_results , "search" );
?>
</assets>

