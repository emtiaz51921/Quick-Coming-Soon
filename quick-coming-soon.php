<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>
        <?php bloginfo( 'name' )?>
        |<?php _e( 'Coming Soon', 'quick-coming-soon' );?>
    </title>
    <link href="<?php echo QUICK_COMINGSOON_URL . '/includes/css/style.css' ?> " rel="stylesheet" type="text/css"
        media="screen" />
    <link href='http://fonts.googleapis.com/css?family=Josefin+Sans:600,700|Damion' rel='stylesheet' type='text/css'>
    <meta name="viewport" content="width=device-width, initial-scale = 1.0, user-scalable = no">
</head>

<body>
    <div class="black">
    </div>
    <div id="wrapper">
        <div id="header">
            <h1>
                <?php bloginfo( 'name' )?>
            </h1>
            <h2>
                <strong class="sep-one">
                </strong>
                <?php bloginfo( 'description' )?>
                <strong class="sep-two">
                </strong>
            </h2>
        </div>

        <?php $getText = qcs_get_option( 'textarea', 'qcs_basic' );
        if ( $getText ) {?>
        <div id="middle">
            <p><?php esc_attr_e( $getText, 'quick-coming-soon' );?></p>
        </div>
        <?php }?>

        <div id="footer">
            <div>
                <?php
                    $qc_facebook = qcs_get_option( 'qc_facebook', 'qcs_basic' );
                    $qc_twitter = qcs_get_option( 'qc_twitter', 'qcs_basic' );
                    $qc_youtube = qcs_get_option( 'qc_youtube', 'qcs_basic' );
                ?>

                <ul class="social">
                    <?php if ( $qc_facebook ) {echo "<li class='facebook'><a href='{$qc_facebook}' target='_blank'></li>";}?>
                    <?php if ( $qc_twitter ) {echo "<li class='twitter'><a href='{$qc_twitter}' target='_blank'></li>";}?>
                    <?php if ( $qc_youtube ) {echo "<li class='youtube'><a href='{$qc_youtube}' target='_blank'></li>";}?>
                </ul>


            </div>
        </div>
    </div>
</body>





<?php $qc_background = qcs_get_option( 'back_image', 'qcs_basic' );?>
<style type="text/css">
<?php if ($qc_background) {
    ?>body {
        background-image: url(<?php echo $qc_background; ?>);
    }

    <?php
}

else {
    ?>body {
        background-image: url(<?php echo QUICK_COMINGSOON_URL; ?>/includes/images/bg.jpg);
    }

    <?php
}

?>
</style>

</html>